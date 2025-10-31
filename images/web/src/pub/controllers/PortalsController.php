<?php
namespace Ajt\Test\pub\controllers;

use Ajt\ApiBase\BaseService;
use Ajt\ApiBase\BaseController;
use Ajt\ApiBase\Request;
use Ajt\Test\pub\services\PortalsService;


class PortalsController extends BaseController {
    /** @var PortalsService */
    protected BaseService $service;

    public function __construct(object $service = null)
    {
        parent::__construct($service ?? new PortalsService());
    }

    public function getById(Request $req, $params)
    {
        $id = $params['id'] ?? null;
        return [
            "dades" => $this->service->find($id),
            "total" => 1,
            "date" => date("Y-m-d H:i:s")
        ];

    }

    public function getAll(Request $req) {
        $aRetorn = [];


        $vUrl = $req->query['url'] ?? null;
        if ($vUrl) {
            $resultat = $this->service->getPortalByUrl($vUrl);
            $resultat->vars = $this->service->getVarsByIdPortal($resultat->id);
            $resultat->idiomes = $this->service->getIdiomesByIdPortal($resultat->id,$resultat->hostTipus);
            $resultat->menus = $this->service->getMenus($resultat->id_menu_principal,$resultat->idioma);
            if (!empty($vUrl)) {
                $aRetorn = [
                    "dades" => $resultat,
                    "total" => 1,
                    "date" => date("Y-m-d H:i:s")
                ];
            }
        }

        return $aRetorn;
    }



}
