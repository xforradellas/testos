<?php

namespace Ajt\Test\pub\services;

use Ajt\ApiBase\BaseService;
use Ajt\ApiBase\ExceptionApiBase;
use Ajt\Test\pub\models\MenusModel;
use Ajt\Test\pub\models\PortalsModel;

class PortalsService extends BaseService {

    /** @var class-string<PortalsModel> */
    protected string $modelClass = PortalsModel::class;

    public function getPortalByUrl(string $vUrl) {
        $aUrl=explode("/",$vUrl);
        $vUrl = $aUrl[0];
        unset($aUrl[0]);
        $vSufix = implode("/", $aUrl);

        $resultat = PortalsModel::getPortalByUrl($vUrl,$vSufix) ?? null;
        if (!$resultat) {
            throw new ExceptionApiBase("No trobat",404);
        }

        $resultat['vars'] = $this->getVarsByIdPortal($resultat['id']);
        $resultat['idiomes'] = $this->getIdiomesByIdPortal($resultat['id'],$resultat['hostTipus']);
        $resultat['menus'] = $this->getMenus($resultat['id_menu_principal'],$resultat['idioma']);

        return $resultat;
    }

    public function getVarsByIdPortal(int $idPortal) {
        $resultat = PortalsModel::getVarsByIdPortal($idPortal);
        foreach($resultat as $kObj => $aObj) {
            // treiem vars velles
            switch($aObj['name'] ?? '') {
                case "max_tabs":
                case "dir_templates":
                case "home_tpl":
                case "content_tpl":
                    unset($resultat[$kObj]);
                    break;
                default:
                    // sense acció
                    break;
            }

            switch($aObj['tipus'] ?? '') {
                case "article":
                case "menu":
                    try {
                        $resultat[$kObj]['content'] = MenusModel::getContingut($aObj['value'],$resultat['idioma']) ?? "";
                    } catch (\Throwable $e) {
                        $resultat[$kObj]['error'] = $e->getMessage();
                    }
                    break;
                case "destacats":
                    try {
                        $resultat[$kObj]['llistat'] = PortalsModel::getDestacatsByPortalAndTipus( $idPortal,$aObj['name']) ?? "";

                    } catch (\Throwable $e) {
                        $resultat[$kObj]['error'] = $e->getMessage();
                    }
                    break;
                case "descriptors":
                    try {
//                        $resultat[$kObj]['llistat'] = $this->getRepositori()
//                            ->getDescriptorsByPortalAndTipus($aRetorn['id'],$aObj['name'],$aRetorn['idioma']) ?? "";
                        $resultat[$kObj]['llistat'] = "llistat";
                    } catch (\Throwable $e) {
                        $resultat[$kObj]['error'] = $e->getMessage();
                    }
                default:
                    // sense acció
                    break;
            }
        }
        return $resultat;
    }

    public function getIdiomesByIdPortal(int $idPortal, string $hostTipus) {

        return PortalsModel::getIdiomesByPortal($idPortal,$hostTipus) ?? null;
    }

    public function getMenus(int $idMenuPrincipal, string $idioma) {
        $menus = new MenusService();
        return $menus->getNodeByMenuPare($idMenuPrincipal,$idioma);
    }
}
