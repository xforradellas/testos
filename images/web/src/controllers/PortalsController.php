<?php
namespace Ajt\Test\controllers;

use Ajt\DB\ConexionsDB;
use Ajt\ApiBase\BaseController;
use Ajt\ApiBase\Request;
use Ajt\ApiBase\Response;
use Ajt\Test\models\HostsModel;
use Ajt\Test\models\PortalsModel;
use Ajt\Test\services\HostsService;
use Ajt\Test\services\PortalsService;


class PortalsController extends BaseController {
    protected string $modelClass = PortalsModel::class;
    public function __construct(ConexionsDB $db = null)
    {
        parent::__construct($db);
    }

    public function getAll(Request $req) {
        return PortalsService::getAll();
    }

    public function create(Request $req) {

        return PortalsService::create($req->body['obj']);
    }

    public function update(Request $req, $params) {
        $id = $params['id'] ?? null;

        return PortalsService::update($id,$req->body['obj']);
    }

    public function delete(Request $req, $params) {
        $id = $params['id'] ?? null;
        PortalsService::delete($id);
        return true;
    }


    public function getById(Request $req, $params)
    {
        $id = $params['id'] ?? null;
        $portal = PortalsService::find($id);

        // Obtener hosts usando la lógica de negocio
        $user = $req->user ?? []; // info del usuario autenticado
        $portal->hosts = HostsService::findHostsWithRules($portal->id, $user);
        return $portal;
    }
}
