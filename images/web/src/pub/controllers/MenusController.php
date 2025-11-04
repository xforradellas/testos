<?php
namespace Ajt\Test\pub\controllers;

use Ajt\ApiBase\BaseService;
use Ajt\ApiBase\BaseController;
use Ajt\ApiBase\Request;
use Ajt\Test\pub\services\MenusService;
use Ajt\Test\pub\services\PortalsService;


class MenusController extends BaseController {
    /** @var MenusService */
    protected BaseService $service;

    public function __construct(object $service = null)
    {
        parent::__construct($service ?? new MenusService());
    }

    public function getById(Request $req, $params)
    {
        $id = (int) $params['idMenu'] ?? null;
        $idPortal = (int) $params['id'] ?? null;
        $idioma = $req->query['idioma'] ?? "CA";

        $result = $this->service->getById($idPortal,$id,$idioma);
        return [
            "dades" => $result,
            "total" => 1,
            "date" => date("Y-m-d H:i:s")
        ];

    }

    public function getAll(Request $req) {
        return $this->service->getAll();
    }

    public function getFilAriadna(Request $req,$params) {

        $idPortal = (int) $params['id'] ?? null;
        $id = (int) $params['idMenu'] ?? 0;
        $idioma = $req->query['idioma'] ?? "CA";

        $portalSvc = new PortalsService();
        $portal = $portalSvc->find($idPortal);
        $idArrel = $portal->id_menu_principal;

        $resultat = $this->service->getFilAriadna($id,$idArrel,$idioma);
        return [
            "dades" => $resultat,
            "total" => sizeof($resultat),
            "date" => date("Y-m-d H:i:s")
        ];
    }

    public function getUltimesAct(Request $req,$params) {

        $idPortal = (int) $params['id'] ?? null;
        $max = $req->query['maxres'] ?? 5;

        $resultat = $this->service->getUltimesAct($idPortal);
        $resultat = array_slice($resultat,0,$max);
        return [
            "dades" => $resultat,
            "total" => sizeof($resultat),
            "date" => date("Y-m-d H:i:s")
        ];
    }
}
