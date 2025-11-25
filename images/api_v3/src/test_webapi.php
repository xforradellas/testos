<?php
namespace Ajt\Test;

require_once '../vendor/autoload.php';

use \Ajt\Test\WebApi\WebPubApi;

$oObj = new WebPubApi();
try {
    $dades = $oObj->getPortal("www.manresacultura.cat/casino");
} catch (Exception $e) {
    echo "Error: ".$e->getMessage();
    exit;
}


echo "<pre>";
print_r($dades);
echo "</pre>";

$vResultatHTML = Debug::getDumpHTML();

echo $vResultatHTML;