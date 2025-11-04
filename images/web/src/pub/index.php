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
$portalsCtrl = new PortalsController();
$menusCtrl = new MenusController();
$router = new Router();

// Definició de rutes (estructura jeràrquica)
// hosts
$router->register('GET', '/pub/portals', [$portalsCtrl, 'getAll'],['cache' => true,'cache_ttl' => 60]);
$router->register('GET', '/pub/portals/{id}', [$portalsCtrl, 'getById'],['cache' => true,'cache_ttl' => 60]);

$router->register('GET', '/pub/portals/{id}/menus', [$menusCtrl, 'getAll'],['cache' => true,'cache_ttl' => 60]);
$router->register('GET', '/pub/portals/{id}/menus/{idMenu}', [$menusCtrl, 'getById'],['cache' => true,'cache_ttl' => 60]);
$router->register('GET', '/pub/portals/{id}/menus/{idMenu}/@filariadna', [$menusCtrl, 'getFilAriadna'],['cache' => true,'cache_ttl' => 60]);
$router->register('GET', '/pub/portals/{id}/ultimesact', [$menusCtrl, 'getUltimesAct']);
$router->register('GET', '/pub/portals/{id}/cercar/{cerca}', [$menusCtrl, 'getCerca'],['cache' => true,'cache_ttl' => 60]);

// Llança el router
$router->dispatch($request);

