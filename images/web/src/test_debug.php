<?php
namespace Ajt\Test;

require_once 'vendor/autoload.php';

use Ajt\Debug\Debug;

echo "hello world";

Debug::dump("missatge de prova","general");

Debug::dump("missatge de prova 2","general");

$retrornApi = [
  "dades" => [
    "0" => [
        "id" => "0",
        "titolo" => "APIlñǵñlkdfsglñks´ñlgksĺñgkśdñlgñĺkglñsdfkglñskdgĺñskdfglñksglñkdfǵlñksflñgksdfĺñkgñśdlfgksdflñgkñśdflgsdflñgkñśldfkgñsdflgkñślkglñskglñ ñ´dlkgslñdfkgslñdfkgñldsfkgñlsdfkgñlksdflñgksdflñgksdflñkglñs lñdkglñskdfglñkdfglñksdfñlgñślfgkslñ ñsdlfkgñlsdfkgsdflkgñlsdkgñlsdfkglñ sdlñkglñdksfglñksdfglñksdlñgksdflñgkñśdflgkñlsdfkglñsdkfglñksdfglñksdfǵlñksdflñgksdflñgksdflñgkñlsdkgĺdñsfkglñdfkgśdlñkglñdfkgsdflñkgsǵ",
    ]
  ]

];
Debug::dump($retrornApi,"api");


$vResultat = Debug::getDump(Debug::DETAIL_EXTENDED);
$vResultatHTML = Debug::getDumpHTML(Debug::DETAIL_EXTENDED);

echo $vResultatHTML;

echo "<pre>";
echo print_r($vResultat);
echo "</pre>";