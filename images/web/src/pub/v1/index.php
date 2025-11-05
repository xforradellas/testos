<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use Ajt\ApiBase\{Router, Request};
use \Ajt\Test\pub\v2\controllers\PortalsController;
use \Ajt\Test\pub\v2\controllers\MenusController;
use \Ajt\DB\Model;

// crem la connexio per defecte a la DB fent servir les variables d'entorn
$conexio = new \Ajt\DB\ConexionsDB();
Model::setDefaultDb($conexio);

$arrel="/pub/v1";

$request = new Request();
$portalsCtrl = new PortalsController();
$menusCtrl = new MenusController();
$router = new Router();

// Definició de rutes (estructura jeràrquica)
// Portals
$router->register('GET', $arrel.'/portals',
    [$portalsCtrl, 'getAll'],
    ['cache' => true,'cache_ttl' => 60]
);
$router->register('GET', $arrel.'/portals/{id}',
    [$portalsCtrl, 'getById'],
    ['cache' => true,'cache_ttl' => 60]
);

// Menus
$router->register('GET', $arrel.'/portals/{id}/menus',
    [$menusCtrl, 'getAll'],
    ['cache' => true,'cache_ttl' => 60]
);
$router->register('GET', $arrel.'/portals/{id}/menus/{idMenu}',
    [$menusCtrl, 'getById'],
    ['cache' => true,'cache_ttl' => 60]
);
$router->register('GET', $arrel.'/portals/{id}/menus/{idMenu}/@filariadna',
    [$menusCtrl, 'getFilAriadna'],
    ['cache' => true,'cache_ttl' => 60]
);
$router->register('GET', $arrel.'/portals/{id}/ultimesact',
    [$menusCtrl, 'getUltimesAct']
);
$router->register('GET', $arrel.'/portals/{id}/cercar/{cerca}',
    [$menusCtrl, 'getCerca'],
    ['cache' => true,'cache_ttl' => 60]
);

// Llança el router
$router->dispatch($request);

