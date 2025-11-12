<?php
namespace Ajt\Test\adm\v2\controllers;

use Ajt\ApiBase\BaseService;
use Ajt\ApiBase\BaseController;
use Ajt\ApiBase\ExceptionApiBase;
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

    public function add(Request $req,array $params,array $token): array {
        $data = $req->body['obj'];

        $data['data_mod'] = date('Y-m-d H:i:s');
        $data['data_mod_contingut'] = date('Y-m-d H:i:s');
        $data['contingutJSON'] = str_replace("\r", "",$data['contingutJSON'] ?? "");

        // creem portal
        $aRetorn = $this->service->create($data);

        return [
            "dades" => $aRetorn,
            "total" => 1,
            "date" => date("Y-m-d H:i:s")
        ];

    }

    public function update(Request $req,array $params,array $token): array {
        $id = $params['idMenu'] ?? null;
        $data = $req->body['obj'];

        if ((int)$id !== (int) $data['id']) {
            throw new ExceptionApiBase("Ids no coindideixen",500);
        }
        // creem portal
        $aRetorn = $this->service->update($id,$data);

        return [
            "dades" => $aRetorn,
            "total" => 1,
            "date" => date("Y-m-d H:i:s")
        ];

    }

//    public function delete(Request $req,array $params,array $token):array {
//        $id = $params['id'] ?? null;
//
//        // creem portal
//        $aRetorn = $this->service->delete($id);
//
//        return [
//            "dades" => $aRetorn,
//            "total" => 1,
//            "date" => date("Y-m-d H:i:s")
//        ];
//
//    }
}
