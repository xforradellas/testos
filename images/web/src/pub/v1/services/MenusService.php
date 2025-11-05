<?php

namespace Ajt\Test\pub\v1\services;

use Ajt\ApiBase\BaseService;
use Ajt\ApiBase\ExceptionApiBase;
use Ajt\Test\pub\v1\models\MenusModel;

class MenusService extends BaseService {

    /** @var class-string<MenusModel> */
    protected string $modelClass = MenusModel::class;
    // Aquí pots afegir lògica extra si cal

    public function getById(int $vIdPortal,int $vIdMenu,string $vIdioma) {

        $portalSvc=new PortalsService();
        $portal = $portalSvc->find($vIdPortal);
        $menu = MenusModel::getMenu($vIdMenu,$vIdioma);
        if (!$menu) {
            throw new ExceptionApiBase("No trobat",404);
        }
        $idMenuPrincipal = $portal->id_menu_principal;

        switch($menu['gestor']) {

            case "article": // article
                $menu['tipus']="1";
                $menu['contingut']=$this->getContingut($vIdMenu,$vIdioma) ?? "";
                break;
            case "articleJSON": // article
                $menu['tipus']="7";
                $menu['contingut']=$this->getContingut($vIdMenu,$vIdioma) ?? "";
                break;
            case "enllac": //
                $menu['tipus']="2";
                break;
            case "menuCompartit": //compartit -> no hauria d'arribar mai aqui
                $menu['tipus']="3";
                $vIdCompartit = $this->getIdCompartitFinal((int) $menu['id_compartit'],$vIdMenu);
                $menu['contingut']=$this->getContingut($vIdCompartit,$vIdioma) ?? "";
                break;

            case "llistatDocuments": //llistatdocuments
                $menu['tipus']="4";
                $menu['contingut']=$this->getContingut($vIdMenu,$vIdioma) ?? "";
                $menu['documents']=$this->getDocsByMenuPare($aRetorn['id_arxius']) ?? "";

                break;
            case "album": // Album ??
                $menu['tipus']="5";
                break;
            case "codi": //codi
                $menu['tipus']="6";
                $menu['contingut']=$this->getContingut($vIdMenu,$vIdioma) ?? "";
                break;
            default:
                // sense acció
                $menu['contingut']=$this->getContingut($vIdMenu,$vIdioma) ?? "";
                break;
        }

        $menu['filAriadna'] = $this->getFilAriadna($vIdMenu,$idMenuPrincipal,$vIdioma);

        return $menu;
    }
    public function getNodeByMenuPare($vMenuPare,$vIdioma) {

        $aRetorn = MenusModel::getMenusByMenuPare($vMenuPare,null,null,$vIdioma) ?? [];

        if (!empty($aRetorn)) {
            foreach($aRetorn as $vKey => $aObj) {
                if ($aObj['te_fills'] == 1) {
                    $aRetorn[$vKey]['fills'] = $this->getNodeByMenuPare($aObj['id'],$vIdioma);
                }

            }
        }

        return $aRetorn;
    }

    public  function getUltimesAct(int $vIdPortal)
    {
        return MenusModel::getMenusUltimesActualitzacions($vIdPortal);
    }

    public  function getCercaByPortal(int $vIdPortal,string $vCerca,string $vIdioma = "CA"): ?array
    {
        return MenusModel::getCercaByPortal($vIdPortal,$vCerca,$vIdioma);
    }
    public function getFilAriadna (int $id,int $idArrel,string $vIdioma = "CA",int $posicio = 0) {
        // si l'arrel i el id són iguals tornem array buit

        if ($id === $idArrel || $id < 1) {
            return [];
        }
        //recuperem l'id actual
        $aResult = MenusModel::getMenusForFilAriadna($id,$vIdioma) ?? [];
        //mirem si l'identificador és més gran de 0 ( el primer)
        //controlem que no fem més de 100 iteracions, això seria un bucle infinit
        if (!empty($aResult) && $posicio < 100) {
            $aRetorn = $this->getFilAriadna($aResult['menu_pare'],$idArrel,$posicio+1);
            if (!empty($aResult)) {
                $aRetorn[] = [
                    'id' => $aResult['id'],
                    'idseo' => $aResult['idseo'],
                    'titol' => $aResult['titol']
                ];
            }
        }

        return $aRetorn ?? [];
    }

    public  function getContingut($vIdMenu,$vIdioma = "CA") {
        $aMenu = MenusModel::getContingut($vIdMenu,$vIdioma);
        if (!$aMenu) {
            throw new ExceptionApiBase("No trobat",404);
        }

        $aMenu['vars'] = $this->getVarsMenu($aMenu);
        $aMenu['documents'] = $this->getDocsMenu($aMenu);
        $aMenu['fills'] = $this->getFillsMenu($aMenu,$vIdioma);
        $aMenu['relacionats'] = $this->getRelacionatsMenu($aMenu,$vIdioma);

        return $aMenu;
    }

    public function getIdCompartitFinal(int $vIdCompartit,int $vIdOrig) {
        $aRetorn = MenusModel::getMenu($vIdCompartit);

        if (!$aRetorn) {
            throw new ExceptionApiBase("Menú compartit no trobat",404);
        }

        if ($aRetorn['gestor'] === 'menuCompartit') {
            if ((int) $aRetorn['id_compartit'] !== $vIdOrig) {
                return $this->getIdCompartitFinal((int) $aRetorn['id_compartit'],$vIdOrig);
            } else {
                throw new ExceptionApiBase("Bucle de menú compartit ".$vIdOrig,500);
            }
        }
        return $vIdCompartit;
    }

    private function getVarsMenu($aMenu) {
        $aVars = MenusModel::getMenusVars($aMenu['id']) ?? [];
        $aResult = [];

        foreach($aVars as $aVar) {

            // no contem la variable id_contingut, per no fer el contingut més petit sense necesitat
            if ($aVar['param'] !== 'id_contingut') {
                $aResult[$aVar['param']] = $aVar['valor'];
            }
        }

        $vCssPagTrobat = false;
        if (!empty($aResult['css_pag'])) {
            $vCssPagTrobat = true;
        }

        if (!$vCssPagTrobat) {
            //mirem si el pare té css_pag
            $vCssPag = MenusModel::getCssPag($aMenu['id'])['css_pag'] ?? '';
            $aResult['css_pag'] = $vCssPag;
        }

        // no contem el css_pag. El total el fem servir per saber si tenim variables que es mostren en pantalla i s'ha de modificar la pantalla
        $aResult['total'] = sizeof($aResult) - 1;

        return $aResult ?? [];
    }

    private function getDocsByMenuPare($vMenuPare) {
        if ($vMenuPare != 0) {
            $aRetorn = MenusModel::getDocument($vMenuPare);
            if (!$aRetorn) {
                throw new ExceptionApiBase("Menú pare no trobat",404);
            }
        }

        $ordreDesc = $aRetorn['ordreDescendent'] ?? 0;

        return $this->getNodeDocByMenuPare((int) $vMenuPare,(int) $ordreDesc);
    }

    private function getNodeDocByMenuPare(int $vMenuPare,int $ordreDesc) {

        $aRetorn = MenusModel::getAllDocumentsByMenuPare($vMenuPare,$ordreDesc);

        if ($aRetorn) {
            foreach($aRetorn as $vKey => $aObj) {
                if ($aObj['tipus'] == 'C' && $aObj['te_fills'] == 1) {
                    $aRetorn[$vKey]['items'] = $this->getNodeDocByMenuPare($aObj['id'],$aObj['ordreDescendent']);
                }
            }
        }

        return $aRetorn;
    }

    private function getDocsMenu($aMenu) {
        $aDocuments = MenusModel::getMenusDocuments((int) $aMenu['id']) ?? [];
        $aResult = [];

        if (!empty($aDocuments)) {

            $aResult = [
                'imatges'      => [],
                'documents'    => [],
                'enllacos'     => [],
                'enllacos_img' => [],
            ];

            foreach ($aDocuments as $obj) {
                $categoria = $obj['categoria'] ?? '';
                $tipus     = $obj['tipus'] ?? '';
                $path      = $obj['path'] ?? '';

                // Classificació especial
                if ($categoria === 'img' || ($categoria === '' && $tipus === 'img')) {
                    $aResult['imatges'][] = $obj;
                } elseif ($categoria === 'pdf' || ($categoria === '' && $tipus === 'pdf')) {
                    $aResult['documents'][] = $obj;
                } elseif (($categoria === 'lnk' || ($categoria === '' && $tipus === 'lnk')) && $path === '') {
                    $aResult['enllacos'][] = $obj;
                } elseif (($categoria === 'lnk' || ($categoria === '' && $tipus === 'lnk')) && $path !== '') {
                    $aResult['enllacos_img'][] = $obj;
                } else {
                    // Altres categories automàtiques
                    $nomCategoria = $categoria ?: $tipus ?: 'altres';
                    $aResult[$nomCategoria][] = $obj;
                }
            }
        }

        return $aResult ?? [];
    }

    private function getFillsMenu(array $aMenu,string $vIdioma) {

        // ordre en que s'ordenaran els menus del contingut
        // (ASC: 1...9, DESC: 9...1, ALF_ASC: A...Z, ALF_DESC: Z...A,
        // DATA_ASC: 01/01/1900...31/12/2020, DATA_DESC: 31/12/2020...01/01/1900)
        $vOrdre = $aMenu['format_fills'] == 3 ? 'DATA_ASC' : 'ASC';

        $aResult = MenusModel::getMenusByMenuPareForFills($aMenu['id'],$vIdioma,0,$vOrdre) ?? [];
        foreach($aResult as &$aMenuFills) {
            $aMenuFills['vars'] = $this->getVarsMenu($aMenuFills);
            $aMenuFills['vars']['total'] = sizeof($aMenuFills['vars']);
        }

        return $aResult ?? [];

    }

    private function getRelacionatsMenu(array $aMenu,string $vIdioma) {

        $aResult = MenusModel::getMenusByMenuPareForFills($aMenu['menu_pare'],$vIdioma) ?? [];
        foreach($aResult as &$aMenuRel) {
            $aMenuRel['vars'] = $this->getVarsMenu($aMenuRel);
            $aMenuRel['vars']['total'] = sizeof($aMenuRel['vars']);
        }

        return $aResult ?? [];

    }
}
