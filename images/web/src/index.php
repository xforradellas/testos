<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Ajt\ApiBase\{Response, Router, Request};
use \Ajt\Test\controllers\HostsController;
use \Ajt\Test\controllers\PortalsController;
use \Ajt\ApiBase\AuthService;
$conexio = new \Ajt\DB\ConexionsDB();

$router = new Router();
$request = new Request();
$hostsCtrl = new HostsController($conexio);
$portalsCtrl = new PortalsController($conexio);


AuthService::init(function(array $token) {
//    print_r($token);
    if (!isset($token['idApp']) || $token['idApp'] !== 1) {
        Response::json(['error' => 'Requereix token (IdApp error)'], 401);
    }
    return true;
});

// Definició de rutes (estructura jeràrquica)
// hosts
$router->register('GET', '/hosts', [$hostsCtrl, 'getAll'],['cache' => true,'cache_ttl' => 60]);
$router->register('GET', '/hosts/@all', [$hostsCtrl, 'getAll']);
$router->register('GET', '/hosts/@all/{id}', [$hostsCtrl, 'getById']);
$router->register('GET', '/hosts/{id}', [$hostsCtrl, 'getById']);
$router->register('POST', '/hosts', [$hostsCtrl, 'create']);
$router->register('PUT', '/hosts/{id}', [$hostsCtrl, 'update']);
$router->register('DELETE', '/hosts/{id}', [$hostsCtrl, 'deleteUpdate']);

// portals
$router->register('GET', '/portals', [$portalsCtrl, 'getAll'],[
    'auth' => true,
    'permission' => "portal"]);
$router->register('GET', '/portals/{id}', [$portalsCtrl, 'getById'],[
    'auth' => true,
    'permission' => "portal"]);
//$router->register('GET', '/portals/{id}', [$portalsCtrl, 'getById']);
$router->register('POST', '/portals', [$portalsCtrl, 'create']);
$router->register('PUT', '/portals/{id}', [$portalsCtrl, 'update']);
$router->register('DELETE', '/portals/{id}', [$portalsCtrl, 'delete']);
$router->register('GET', '/portals/{id}/hosts/{idhost}', [$hostsCtrl, 'getById'],[
    'auth' => true,
    'permission' => "portal",
    'permission_validator' => function($request, $matches) {
        // Validar dos permisos distintos:
        $okPortal = AuthService::hasPermission('portal', $matches['id'] ?? null);
        $okHost   = AuthService::hasPermission('portalroot', $matches['idhost'] ?? null);

        return $okPortal && $okHost;
}]);

$router->register('GET', '/portals/{id}/plantilles', [$hostsCtrl, 'getAll'],[
    'auth' => true,
    'permission' => "portal",
    'permission_validator' => function($request, $matches) {
        // Validar dos permisos distintos:
        $okPortal = AuthService::hasPermission('portal', $matches['id'] ?? null);
        $okHost   = AuthService::hasPermission('plantilles', $matches['id'] ?? null);

        return $okPortal && $okHost;
    }]);

// Llança el router
$router->dispatch($request);
