<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use Ajt\ApiBase\{Response, Router, Request};
use \Ajt\Test\pub\controllers\HostsController;
use \Ajt\Test\pub\controllers\PortalsController;
use \Ajt\ApiBase\AuthService;

$conexio = new \Ajt\DB\ConexionsDB();


$request = new Request();
$hostsCtrl = new HostsController($conexio);
$portalsCtrl = new PortalsController($conexio);

$tokenValidation = function(array $token) {

    if (!isset($token['idApp']) || $token['idApp'] !== 1) {
        Response::json(['error' => 'Requereix token (IdApp error)'], 401);
    }
    return true;
};

$auth = new AuthService($tokenValidation);

$router = new Router($auth);

// Definició de rutes (estructura jeràrquica)
// hosts
$router->register('GET', '/pub/portals', [$portalsCtrl, 'getAll'],['cache' => true,'cache_ttl' => 60]);
$router->register('GET', '/pub/portals/{id}', [$portalsCtrl, 'getById'],['cache' => true,'cache_ttl' => 60]);


/*
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
    'permission_validator' => function($request, $matches) use ($auth) {
        // Validar dos permisos distintos:
        $okPortal = $auth->hasPermission('portal', $matches['id'] ?? null);
        $okHost   = $auth->hasPermission('portalroot', $matches['idhost'] ?? null);

        return $okPortal && $okHost;
}]);

$router->register('GET', '/portals/{id}/plantilles', [$hostsCtrl, 'getAll'],[
    'auth' => true,
    'permission' => "portal",
    'permission_validator' => function($request, $matches) use ($auth) {
        // Validar dos permisos distintos:
        $okPortal = $auth->hasPermission('portal', $matches['id'] ?? null);
        $okHost   = $auth->hasPermission('plantilles', $matches['id'] ?? null);

        return $okPortal && $okHost;
    }]);
*/
// Llança el router
$router->dispatch($request);
