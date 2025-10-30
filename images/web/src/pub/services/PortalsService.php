<?php

namespace Ajt\Test\pub\services;

use Ajt\ApiBase\BaseService;
use Ajt\ApiBase\Response;
use Ajt\DB\ConexionsDB;
use Ajt\Test\pub\models\HostsModel;
use Ajt\Test\pub\models\PortalsI18nModel;
use Ajt\Test\pub\models\PortalsModel;
use Ajt\Test\pub\models\PortalsVarsModel;

class PortalsService extends BaseService {

    // Aquí pots afegir lògica extra si cal
    public function __construct(?ConexionsDB $db,?string $modelClass = null) {
        parent::__construct($db,$modelClass ?? PortalsModel::class);
    }

    public function getPortalByUrl(string $vUrl) {
        $aUrl=explode("/",$vUrl);
        $vUrl = $aUrl[0];
        unset($aUrl[0]);
        $vSufix = implode("/", $aUrl);

        $resultat = PortalsModel::getPortalByUrl($vUrl,$vSufix) ?? null;
        if (!$resultat) {
            Response::json(["error" => "Portal no trobat"],404);
        }

        return $resultat;
    }

    public function getVarsByIdPortal(int $idPortal) {
        $resultat = PortalsVarsModel::getVarsByIdPortal($idPortal);
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
//                        $resultat[$kObj]['content'] = $this->getRepositori()
//                            ->getContingut($aObj['value'],$aRetorn['idioma'],0) ?? "";
                        $resultat[$kObj]['content'] = "contingut";
                    } catch (\Throwable $e) {
                        $resultat[$kObj]['error'] = $e->getMessage();
                    }
                    break;
                case "destacats":
                    try {
//                        $resultat[$kObj]['llistat'] = $this->getRepositori()
//                            ->getDestacatsByPortalAndTipus($aRetorn['id'],$aObj['name']) ?? "";
                        $resultat[$kObj]['llistat'] = "llistat";

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

        return PortalsI18nModel::getIdiomesByPortal($idPortal,$hostTipus) ?? null;
    }

    public function getMenus(int $idMenuPrincipal, string $idioma) {
        $menus = new MenusService($this->db);
        return $menus->getNodeByMenuPare($idMenuPrincipal,$idioma);
    }
}
