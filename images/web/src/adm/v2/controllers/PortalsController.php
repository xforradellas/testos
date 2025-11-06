<?php
namespace Ajt\Test\adm\v2\controllers;

use Ajt\ApiBase\BaseService;
use Ajt\ApiBase\BaseController;
use Ajt\ApiBase\Request;
use Ajt\Test\adm\v2\services\PortalsService;


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

    private function tePermisRoot($permisos):bool {
        $permisos_root = $permisos->root ?? "";
//        $permisos_portals = $permisos->portal ?? "";

        if ($permisos_root === "*") {
            return true;
        }

        $allowedIdsRoot = array_map('trim', explode(',', $permisos_root));
        $result = in_array((string)$resourceId, $allowedIdsRoot, true);
//        $allowedIdsPortal = array_map('trim', explode(',', $permisos_portals));
    }

    public function getAll(Request $req,$params,$token) {
        $permisos = $token['permisos'];

        $aRetorn = $this->service->getAllPortals($permisos);
//        $permisos_root = $permisos->root ?? "";
//        $permisos_portals = $permisos->portal ?? "";
//
//        // si tenim permis per tots els portals
//        if ($permisos_portals === "*") {
//            $aRetorn = $this->service->getAll();
//        } else {
//            $aRetorn = [];
//        }


        return [
            "dades" => $aRetorn,
            "total" => sizeof($aRetorn),
            "date" => date("Y-m-d H:i:s")
        ];

    }



}
