<?php
namespace Ajt\Test\adm\v2\controllers;

use Ajt\ApiBase\BaseService;
use Ajt\ApiBase\BaseController;
use Ajt\ApiBase\Request;
use Ajt\Test\adm\v2\services\MenusService;
use Ajt\Test\adm\v2\services\PortalsService;


class MenusController extends BaseController {
    /** @var MenusService */
    protected BaseService $service;

    public function __construct(object $service = null)
    {
        parent::__construct($service ?? new MenusService());
    }

    public function getById(Request $req, $params, $permisos): array
    {
        $id = (int) $params['idMenu'] ?? null;
        $idPortal = (int) $params['id'] ?? null;

        $result = $this->service->getById($idPortal,$id,$permisos);
        return [
            "dades" => $result,
            "total" => 1,
            "date" => date("Y-m-d H:i:s")
        ];

    }

    public function getByPortal(Request $req,array $params,?array $token) {

        $permisos = $token['permisos'];
        $idPortal = (int) $params['id'] ?? null;
        $result = $this->service->getByPortal($idPortal,$permisos);
        return [
            "dades" => $result,
            "total" => sizeof($result),
            "date" => date("Y-m-d H:i:s")
        ];
    }
}
