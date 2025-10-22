<?php
namespace Ajt\Test;

use Ajt\DB\ConexionsDB;
use Ajt\Debug\Debug;
use Ajt\Test\modelDB\ModelMenus;

require_once 'vendor/autoload.php';

$db = new ConexionsDB();
ModelMenus::setDefaultDb($db);

echo "<pre>";
try {

    //netejem
    ModelMenus::truncate();

    //creem un menu
    $menu = new ModelMenus();
    $menu->titol = "Menu de prova 1 ";
    $menu->ordre = 1;
    $menu->descripcio = "Descripció de prova 1";
    $menu->menu_pare = "0";
    $menu->save();
    unset($menu);
    //llistem menu
    echo "Buscar id 1" . chr(13);

    // Carregar usuari existent
    $found = ModelMenus::find(1);
    $usuari = $found->toArray();
    print_r($usuari);

    //llistem tots els menus
    $menus = ModelMenus::all();
    print_r($menus);

    //creem un segon menu
    $menu = new ModelMenus();
    $menu->titol = "Menu de prova 2";
    $menu->ordre = 1;
    $menu->descripcio = "Descripció de prova 2";
    $menu->menu_pare = "0";
    $menu->save();

    $menus = ModelMenus::all();
    print_r($menus);

    $menus = ModelMenus::SelectOrdenat();
    print_r($menus);
    $menus2 = ModelMenus::arrayToObj($menus);
    print_r($menus2);
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
// "Marc"


echo "</pre>";

$vResultatHTML = Debug::getDumpHTML();

echo $vResultatHTML;
