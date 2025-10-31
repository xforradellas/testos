<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use Ajt\ApiBase\{Response, Router, Request};
use \Ajt\Test\pub\controllers\HostsController;
use \Ajt\Test\pub\controllers\PortalsController;
use \Ajt\ApiBase\AuthService;
use \Ajt\Test\pub\controllers\MenusController;
use \Ajt\DB\Model;

// crem la connexio per defecte a la DB fent servir les variables d'entorn
$conexio = new \Ajt\DB\ConexionsDB();
Model::setDefaultDb($conexio);


$request = new Request();

// creem els controladors que necesitem per cada petició
$portalsCtrl = new PortalsController();
//$menusCtrl = new MenusController($conexio);

$router = new Router();

// Definició de rutes (estructura jeràrquica)
// hosts
$router->register('GET', '/pub/portals', [$portalsCtrl, 'getAll'],['cache' => true,'cache_ttl' => 60]);
$router->register('GET', '/pub/portals/{id}', [$portalsCtrl, 'getById'],['cache' => true,'cache_ttl' => 60]);
//$router->register('GET', '/pub/portals/{id}/menus', [$menusCtrl, 'getAll'],['cache' => true,'cache_ttl' => 60]);
//$router->register('GET', '/pub/portals/{id}/menus/{idmenu}', [$menusCtrl, 'getById'],['cache' => true,'cache_ttl' => 60]);
//$router->register('GET', '/pub/portals/{id}/menus/@filariadna', [$menusCtrl, 'getFilAriadna'],['cache' => true,'cache_ttl' => 60]);

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

