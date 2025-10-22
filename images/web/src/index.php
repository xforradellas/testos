<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Ajt\ApiBase\{Router, Request};
use \Ajt\Test\controllers\HostsController;
use \Ajt\Test\controllers\PortalsController;

$conexio = new \Ajt\DB\ConexionsDB();

$router = new Router();
$request = new Request();
$hostsCtrl = new HostsController($conexio);
$portalsCtrl = new PortalsController($conexio);

// Definició de rutes (estructura jeràrquica)
// hosts
$router->register('GET', '/hosts', [$hostsCtrl, 'getAll']);
$router->register('GET', '/hosts/{id}', [$hostsCtrl, 'getById']);
$router->register('POST', '/hosts', [$hostsCtrl, 'create']);
$router->register('PUT', '/hosts/{id}', [$hostsCtrl, 'update']);
$router->register('DELETE', '/hosts/{id}', [$hostsCtrl, 'deleteUpdate']);

// portals
$router->register('GET', '/portals', [$portalsCtrl, 'getAll']);
$router->register('GET', '/portals/{id}', [$portalsCtrl, 'getById']);
$router->register('POST', '/portals', [$portalsCtrl, 'create']);
$router->register('PUT', '/portals/{id}', [$portalsCtrl, 'update']);
$router->register('DELETE', '/portals/{id}', [$portalsCtrl, 'delete']);


// Llança el router
$router->dispatch($request);
