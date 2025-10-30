<?php
namespace Ajt\Test\pub\controllers;

use Ajt\ApiBase\BaseController;
use Ajt\ApiBase\Request;
use Ajt\DB\ConexionsDB;
use Ajt\Test\pub\services\HostsService;


class HostsController extends BaseController {


    public function __construct(?ConexionsDB $db = null,object $service = null)
    {
        parent::__construct($service ?? new HostsService($db));
    }
    public function getAll(Request $req) {
        $resultat = $this->service->getAll();
        return [
            "dades" => $resultat,
            "total" => sizeof($resultat)
        ];
    }

    public function getById(Request $req, $params) {
        $id = $params['id'] ?? null;
        $resultat = $this->service->find($id);
        return [
            "dades" => $resultat,
            "total" => 1
        ];
    }

    public function create(Request $req) {
        unset($req->body['obj']['id_portal']);
        return $this->service->create($req->body['obj']);
    }

    public function update(Request $req, $params) {
        $id = $params['id'] ?? null;
        unset($req->body['obj']['id_portal']);
        return $this->service->update($id, $req->body['obj']);
    }

    public function delete(Request $req, $params) {
        $id = $params['id'] ?? null;
        return $this->service->delete($id);
    }

    public function deleteUpdate(Request $req, $params) {
        $id = $params['id'] ?? null;

        $req->body= [
            'obj' => [
                'id' => $id,
                'idioma' => 'eliminat'
            ]
        ];
        return $this->service->update($id, $req->body['obj']);
    }
}
