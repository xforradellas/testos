<?php
namespace Ajt\Test\controllers;

use Ajt\ApiBase\BaseController;
use Ajt\ApiBase\Request;
use Ajt\ApiBase\Response;
use Ajt\DB\ConexionsDB;

use Ajt\Test\models\HostsModel;
use Ajt\Test\services\HostsService;


class HostsController extends BaseController {
    protected string $modelClass = HostsModel::class;
    public function __construct(ConexionsDB $db = null)
    {
        parent::__construct($db);
    }
    public function getAll(Request $req) {
        Response::json(HostsService::getAll());
    }

    public function getById(Request $req, $params) {
        $id = $params['id'] ?? null;
        Response::json(HostsService::find($id));
    }

    public function create(Request $req) {
        unset($req->body['obj']['id_portal']);
        Response::json(HostsService::create($req->body['obj']));
    }

    public function update(Request $req, $params) {
        $id = $params['id'] ?? null;
        unset($req->body['obj']['id_portal']);

        Response::json(HostsService::update($id,$req->body['obj']));
    }

    public function delete(Request $req, $params) {
        $id = $params['id'] ?? null;
        HostsService::delete($id);
    }

    public function deleteUpdate(Request $req, $params) {
        $id = $params['id'] ?? null;

        $req->body= [
            'obj' => [
                'id' => $id,
                'idioma' => 'eliminat'
            ]
        ];
        Response::json(HostsService::update($id,$req->body['obj']));
    }
}
