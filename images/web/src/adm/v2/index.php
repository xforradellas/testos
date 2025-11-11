<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use Ajt\ApiBase\{Response, Router, Request};
use \Ajt\Test\adm\v2\controllers\PortalsController;
use \Ajt\Test\adm\v2\controllers\MenusController;
use \Ajt\ApiBase\AuthService;
use \Ajt\DB\Model;
use Ajt\Test\adm\v2\services\MenusService;

// crem la connexio per defecte a la DB fent servir les variables d'entorn
$conexio = new \Ajt\DB\ConexionsDB();
Model::setDefaultDb($conexio);

$arrel="/adm/v2";

$request = new Request();

// creem els controladors que necesitem per cada petició
$portalsCtrl = new PortalsController();
$menusCtrl = new MenusController();
$menusSvc = new MenusService();


$tokenValidation = function(array $token) {

    if (!isset($token['idApp']) || $token['idApp'] !== 19) {
        Response::json(['error' => 'Requereix token (IdApp error)'], 401);
    }
    return true;
};

$auth = new AuthService($tokenValidation);

$router = new Router($auth);

$functionValidacioPortalMenu = function($request, $matches) use ($auth,$menusSvc) {
    // Validar dos permisos distintos:
    $vIdPortal = $matches['id'] ?? null;
    $vIdMenu = $matches['idMenu'] ?? null;

    $okMenu = $menusSvc->validarMenuPermis($auth->currentUser['permisos'] ?? [],$vIdPortal,$vIdMenu);
    return $okMenu;
};

//'permission_validator' => function($request, $matches) use ($auth) {
//    // Validar dos permisos distintos:
//    $okPortal = $auth->hasPermission('portal', $matches['id'] ?? null);
//    $okHost   = $auth->hasPermission('portalroot', $matches['idhost'] ?? null);
//
//    return $okPortal && $okHost;
//}



// Definició de rutes (estructura jeràrquica)
// Portals
$router->register('GET', $arrel.'/portals', [$portalsCtrl, 'getAll'], ['auth' => true, 'permission' => "portals"]);
$router->register('GET', $arrel.'/portals/{id}', [$portalsCtrl, 'getById'], ['auth' => true, 'permission' => "portals"]);
$router->register('POST', $arrel.'/portals', [$portalsCtrl, 'add'], ['auth' => true, 'permission' => "portals"]);
$router->register('PUT', $arrel.'/portals/{id}', [$portalsCtrl, 'update'], ['auth' => true, 'permission' => "portals"]);
$router->register('DELETE', $arrel.'/portals/{id}', [$portalsCtrl, 'delete'], ['auth' => true, 'permission' => "portals"]);

// Menus
$router->register('GET', $arrel.'/portals/{id}/menus/{idMenu}', [$menusCtrl, 'getById'], ['auth' => true, 'permission' => "menus",
    'permission_validator' => $functionValidacioPortalMenu
    ]
);
$router->register('GET', $arrel.'/portals/{id}/menus', [$menusCtrl, 'getByPortal'],
    ['auth' => true, 'permission' => "menus",
        'permission_validator' => $functionValidacioPortalMenu
    ]
);
//
//
//$router->register('GET', $arrel.'/portals/{id}/menus/{idMenu}/@filariadna',
//    [$menusCtrl, 'getFilAriadna']
//);
//$router->register('GET', $arrel.'/portals/{id}/ultimesact',
//    [$menusCtrl, 'getUltimesAct']
//);
//$router->register('GET', $arrel.'/portals/{id}/cercar/{cerca}',
//    [$menusCtrl, 'getCerca']
//);

/*

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

