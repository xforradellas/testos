<?php
namespace Ajt\Test\pub\controllers;

use Ajt\DB\ConexionsDB;
use Ajt\ApiBase\BaseController;
use Ajt\ApiBase\Request;
use Ajt\Test\pub\services\PortalsService;


class PortalsController extends BaseController {

    public function __construct(?ConexionsDB $db = null,object $service = null)
    {
        parent::__construct($service ?? new PortalsService($db));
    }

    public function getById(Request $req, $params)
    {
        $id = $params['id'] ?? null;

        return [
            "dades" => $this->service->find($id),
            "total" => 1
        ];

    }

    public function getAll(Request $req) {
        $Resultat = [];


        $vUrl = $req->query['url'] ?? "";
        $resultat = $this->service->getPortalByUrl($vUrl);
        $resultat->vars = $this->service->getVarsByIdPortal($resultat->id);
        $resultat->idiomes = $this->service->getIdiomesByIdPortal($resultat->id,$resultat->hostTipus);
        $resultat->menus = $this->service->getMenus($resultat->id_menu_principal,$resultat->idioma);
        if (!empty($vUrl)) {
            $Resultat = [
                "dades" => $resultat,
                "total" => 1
            ];
        }

        return $Resultat;
    }



}
