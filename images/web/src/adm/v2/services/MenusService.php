<?php

namespace Ajt\Test\adm\v2\services;

use Ajt\ApiBase\BaseService;
use Ajt\ApiBase\ExceptionApiBase;
use Ajt\Test\adm\v2\models\MenusModel;

class MenusService extends BaseService {

    const ERROR_NO_TROBAT = "Menú no trobat";
    const ERROR_INESPERAT = "Error inesperat";
    const API = "adm/v2/portals/x/menus";

    /** @var class-string<MenusModel> */
    protected string $modelClass = MenusModel::class;
    // Aquí pots afegir lògica extra si cal

    public function getById(int $vIdPortal,int $vIdMenu, $permisos): array {

        //validem que existeixi el portal
        $portalSvc=new PortalsService();
        $portalSvc->find($vIdPortal);

        $menu = MenusModel::getMenu($vIdMenu);
        if (!$menu) {
            throw new ExceptionApiBase(static::ERROR_NO_TROBAT,404);
        }

        $menu['docs'] = MenusModel::getDocumentsByIdMenu($vIdMenu) ?? [];
        $menu['vars'] = MenusModel::getVarsByIdMenu($vIdMenu) ?? [];
        $menu['descriptors'] = MenusModel::getDescriptorsByIdMenu($vIdMenu) ?? [];
        // afegir retornar idiomes
        // faltaria agrupar-ho per idiomes
        $menu['i18n'] = MenusModel::getI18nByIdMenu($vIdMenu) ?? [];
        $menu['fills'] = MenusModel::getMenusByMenuPare($vIdMenu) ?? [];

        if (!empty($menu['fills'])) {
            foreach($menu['fills'] as &$aFill) {
                $aFill['vars'] = MenusModel::getVarsByIdMenu($aFill['id']) ?? [];
            }
        }

        $menu['permis_plantilla'] = $this->tePermis((object) ($permisos ??  []), "plantilles", $vIdPortal) ?? 0;

        $menu['errors'] = [];

        $error = $this->validarIdioma($vIdPortal,$menu['i18n'],$menu['data_mod_contingut']);
        if ($error) {
            $menu['errors'] = $error;
        }

        $error = $this->validarCompartit($menu);
        if ($error) {
            $menu['errors'][] = $error;
        }

        return $menu;
    }

    private function validarCompartit(array $menu):?string {
        if ($menu['gestor'] == 'menuCompartit' && $menu['id_portal'] != $menu['id_portal_compartit']) {
            return "El contingut compartit ha de ser del mateix portal";
        }
        return null;
    }

    private function validarIdioma(int|string $idPortal, array $idiomesMenu, ?string $dataModContingut): ?array
    {
        $idiomesPortal = MenusModel::getI18nByPortal($idPortal);
        if (empty($idiomesPortal)) {return null;}

        $errors = array_reduce($idiomesPortal, function($carry, $idiomaPortal) use ($idiomesMenu, $dataModContingut) {
            $idioma = $idiomaPortal['idioma'];
            $idiomaMenu = current(array_filter($idiomesMenu, fn($i) => $i['idioma'] === $idioma));

            if (!$idiomaMenu) {
                $carry[] = "Falta la traducció a l’idioma {$idioma}.";
            } elseif (($idiomaMenu['estat'] ?? '') !== 'Revisat') {
                $carry[] = "La traducció automàtica a l’idioma {$idioma} s’ha de revisar.";
            }

            if ($dataModContingut && $idiomaMenu && $dataModContingut > ($idiomaMenu['data_mod'] ?? '')) {
                $carry[] = "El contingut s’ha modificat després de la darrera revisió de {$idioma}.";
            }

            return $carry;
        }, []);

        return $errors ?: null;
    }

    public function getByPortal(int $vIdPortal,?object $permisos): array {
        //validem que existeixi el portal
        $portalSvc=new PortalsService();
        $portalSvc->find($vIdPortal);

        $vCalcularPermis = false;

        // pot accedir a tots els menus del portal idPortal#*
        if ($this->tePermis($permisos,"menus",$vIdPortal,'*')) {
            $IdMenus = 0;
        } else {
            $IdMenus = $this->getPermisosMenusByPortal($permisos->menus,$vIdPortal);
            $vCalcularPermis = true;
        }
        $menus = MenusModel::getMenusByIdPortal($vIdPortal,$IdMenus);
        if ($menus) {
            foreach ($menus  as &$menu) {
                if ($vCalcularPermis) {
                    $this->calcularPermis($menus, $menu);
                }
                $menu['errors'] = [];
                $menu['i18n'] = MenusModel::getI18nByPortal($menu['id']) ?? [];
                $menu['descriptors'] = MenusModel::getDescriptorsByIdMenu($menu['id']) ?? [];
                $error = $this->validarIdioma($vIdPortal,$menu['i18n'],$menu['data_mod_contingut']);
                if ($error) {
                    $menu['errors'] = $error;
                }

                $error = $this->validarCompartit($menu);
                if ($error) {
                    $menu['errors'][] = $error;
                }
            }
        }

        return $menus;
    }

    private function getPermisosMenusByPortal($permisos, $idPortal) {
        $result = [];

        $permisos = explode(",",$permisos);
        foreach ($permisos as $item) {
            // Separar per '#'
            [$p, $valor] = explode('#', $item);
            if ($p === (string)$idPortal) {
                $result[] = $valor;
            }
        }

        // Retornar els valors separats per coma
        return implode(',', $result);
    }

    private function calcularPermis(&$aMenus,&$aMenu) {

        // Calcular si tiene hijos con permisos
        $aMenu['fillsAmbPermis'] = $aMenu['fillsAmbPermis'] ?? 0;
        if ($aMenu['permis'] == 1) {
            $this->modificarPermisPare($aMenus,$aMenu['menu_pare']);
        }
    }

    private function modificarPermisPare(&$aMenus,$vIdMenuPare) {
        foreach ($aMenus as &$menu) {
            if ($menu['id'] == $vIdMenuPare) {
                $menu['fillsAmbPermis'] = 1;
                $this->modificarPermisPare($aMenus,$menu['menu_pare']);
            }
        }
    }
}
