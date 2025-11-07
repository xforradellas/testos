<?php
namespace Ajt\Test\adm\v2\controllers;

use Ajt\ApiBase\BaseService;
use Ajt\ApiBase\BaseController;
use Ajt\ApiBase\ExceptionApiBase;
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

    public function getAll(Request $req,$params,$token) {
        $permisos = $token['permisos'];

        $aRetorn = $this->service->getAllPortals($permisos);

        return [
            "dades" => $aRetorn,
            "total" => sizeof($aRetorn),
            "date" => date("Y-m-d H:i:s")
        ];

    }

    public function add(Request $req,$params,$token) {
        $data = $req->body['obj'];

        // creem portal
        $aRetorn = $this->service->create($data);

        return [
            "dades" => $aRetorn,
            "total" => 1,
            "date" => date("Y-m-d H:i:s")
        ];

    }

    public function update(Request $req,$params,$token) {
        $id = $params['id'] ?? null;
        $data = $req->body['obj'];
        if ($id !== $data['id']) {
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

    public function delete(Request $req,$params,$token) {
        $id = $params['id'] ?? null;

        // creem portal
        $aRetorn = $this->service->delete($id);

        return [
            "dades" => $aRetorn,
            "total" => 1,
            "date" => date("Y-m-d H:i:s")
        ];

    }
}
