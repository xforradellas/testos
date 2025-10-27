<?php
namespace Ajt\Test;

use Ajt\Cache\CacheService;
use Ajt\DB\ConexionsDB;
use Ajt\Debug\Debug;

require_once 'vendor/autoload.php';
echo "<pre>";

CacheService::init();
CacheService::setTtl(1);
$callback = json_encode([
    "prova" => 1,
    ]);

$callback2 = json_encode([
    "prova" => 2,
]);

$method= "GET";
$url="/hosts/10/urls";
$query= $_GET;

$cache = true;
// Si ve no_cache=1, no fem servir la cache
if (isset($query['no_cache']) && $query['no_cache'] == '1') {
   $cache=false;
   echo chr(13)."no recuperem cache".chr(13);
}

$cacheKey = CacheService::getKeyFromRequest($method, $url, $query);
echo chr(13)."Cache key:".$cacheKey.chr(13);
if ($cache) {
    echo chr(13)."Intentem recuperar la cache".chr(13);
    $cached = CacheService::get($cacheKey);
    if ($cached) {
        echo chr(13)."cache trobada".chr(13);
        // retornem resposta cachejada
        print_r(json_decode($cached, true));
        return;
    } else {
        echo chr(13)."cache no trobada".chr(13);
    }

} else {
    echo chr(13)."No volem recuperar la cache".chr(13);
}

// Executem la petició original
$responseData = $callback;

// Guardem a la cache si tot ha anat bé
if ($responseData) {
    CacheService::set($cacheKey, json_encode($responseData));
}

print_r($responseData);

echo "</pre>";