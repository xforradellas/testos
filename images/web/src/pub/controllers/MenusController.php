<?php
namespace Ajt\Test\pub\controllers;

use Ajt\ApiBase\BaseService;
use Ajt\ApiBase\BaseController;
use Ajt\ApiBase\Request;
use Ajt\Test\pub\services\MenusService;


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

        $result = $this->service->getById($idPortal,$id);
        return [
            "dades" => $result,
            "total" => 1,
            "date" => date("Y-m-d H:i:s")
        ];

    }

    public function getAll(Request $req) {
        return $this->service->getAll();
    }

    public function getFilAriadna(Request $req) {
        return [];
    }

}
