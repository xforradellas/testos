<?php
namespace Ajt\Test\modelDB;

use Ajt\DB\ConexionsDB;
use Ajt\DB\Model;

class ModelTestMenus extends Model
{
    protected string $table = 'test_menus';
    protected string $primaryKey = 'id';

    public int $id;
    public string $titol;
    public string $descripcio;
    public int $ordre;
    public int $publicat;

    protected static function createInstance(?ConexionsDB $db = null): static
    {
        return new self($db);
    }


    public function truncate() {
        $aSentencies = [
            [
                "query" =>
                    "TRUNCATE test_menus",
                "params" => [
                ]
            ],
        ];

        return $this->db->execute($aSentencies);
    }
}