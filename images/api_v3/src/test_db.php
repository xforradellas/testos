<?php
namespace Ajt\Test;

use Ajt\DB\ConexionsDB;
use Ajt\Debug\Debug;

require_once 'vendor/autoload.php';


$db = new ConexionsDB();
try {
    $aSentencies = [
        "0" => [
            "query" =>
                "SELECT * FROM test_menus",
            "params" => [
            ]
        ]
    ];

    $aRetorn1 = $db->execute($aSentencies);

    $aSentencies = [
        "0" => [
            "query" =>
                "INSERT INTO test_menus (titol) VALUES ('Commit Me 1')",
            "params" => [
            ]
        ],
        "1" => [
            "query" =>
                "INSERT INTO test_menus (titol) VALUES ('Commit Me 2')",
            "params" => [
            ]
        ]
    ];

    $aRetorn2 = $db->execute($aSentencies);

    $aSentencies = [
        "0" => [
            "query" =>
                "SELECT * FROM test_menus",
            "params" => [
            ]
        ]
    ];

    $aRetorn3 = $db->execute($aSentencies);

    $aSentencies = [

        [
            "query" =>
                "SET SQL_SAFE_UPDATES = 0;",
            "params" => [
            ]
        ],

        [
            "query" =>
                "TRUNCATE test_menus",
            "params" => [
            ]
        ],
        [
            "query" =>
                "SET SQL_SAFE_UPDATES = 1;",
            "params" => [
            ]
        ]

    ];

    $aRetorn4 = $db->execute($aSentencies);

    $aSentencies = [

        [
            "query" =>
                "SET SQL_SAFE_UPDATES = 0;",
            "params" => [
            ]
        ],

        [
            "query" =>
                "DELETE * FROM test_menus",
            "params" => [
            ]
        ],
        [
            "query" =>
                "SET SQL_SAFE_UPDATES = 1;",
            "params" => [
            ]
        ]

    ];

    $db->execute($aSentencies);
} catch (\PDOException $e) {

}

$db->disconnect();
$vResultatHTML = Debug::getDumpHTML();

echo $vResultatHTML;
echo "<pre>";
echo "<p style='font-size:1.2rem'>Resultat de la consulta 1</p>".chr(13);
var_dump($aRetorn1);

echo "<p style='font-size:1.2rem'>Resultat de la consulta 2</p>".chr(13);
var_dump($aRetorn2);

echo "<p style='font-size:1.2rem'>Resultat de la consulta 3</p>".chr(13);
var_dump($aRetorn3);

echo "<p style='font-size:1.2rem'>Resultat de la consulta 4</p>".chr(13);
var_dump($aRetorn4);

echo "</pre>";