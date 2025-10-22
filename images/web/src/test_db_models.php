<?php
namespace Ajt\Test;

use Ajt\DB\ConexionsDB;
use Ajt\Debug\Debug;
use Ajt\Test\modelDB\ModelMenus;
use Ajt\Test\modelDB\ModelTestMenus;
use Ajt\Test\modelDB\TestMenusModel;

require_once 'vendor/autoload.php';

$db = new ConexionsDB();
ModelTestMenus::setDefaultDb($db);

echo "<pre>";
try {
    $test = new ModelTestMenus();
    $test->titol = 'Titol de prova';
    $test->descripcio = 'descripcio';
    $test->ordre = 1;
    $test->publicat = 0;
    $test->save(); // fa INSERT

    echo "Buscar id 1" . chr(13);
    // Carregar usuari existent
    $found = ModelTestMenus::find($test->id);
    echo $found->titol . chr(13); // "Marc"

    echo "Modificar titol" . chr(13);
    // Actualitzar
    $found->titol = 'Titol modificat';
    $found->save(); // fa UPDATE

    $found = ModelTestMenus::find($test->id);
    $usuari = $found->toArray();
    echo chr(13)."Usuari ". $test->id.chr(13);
    print_r($usuari);
    echo $found->titol; // "Marc"

    // Obtenir tots
    $users = ModelTestMenus::all();

    echo chr(13)."users:".chr(13);

    foreach ($users as $u) {
        print_r($u->toArray());
    }

    $test->truncate();
} catch (\Exception $e) {

}
// Eliminar
$found->delete();

$found = ModelTestMenus::find($test->id);
echo $found->titol; // "Marc"


echo "</pre>";

$vResultatHTML = Debug::getDumpHTML();

echo $vResultatHTML;