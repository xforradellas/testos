<?php
namespace Ajt\Test\controllers;

use Ajt\ApiBase\Request;
use Ajt\ApiBase\Response;

class UserController {
    public function getAll(Request $req) {
        $users = [
            ['id' => 1, 'name' => 'Anna'],
            ['id' => 2, 'name' => 'Pau']
        ];
        Response::json($users);
    }

    public function getById(Request $req, $params) {
        $id = $params['id'] ?? null;
        Response::json(['id' => $id, 'name' => 'Usuari ' . $id]);
    }

    public function create(Request $req) {
        Response::json(['created' => $req->body]);
    }

    public function delete(Request $req, $params) {
        Response::json(['deleted_id' => $params['id']]);
    }
}
