<?php
namespace Ajt\Test\modelDB;

use Ajt\DB\ConexionsDB;
use Ajt\DB\Model;

class ModelMenus extends Model
{
    protected string $table = 'menus';
    protected string $primaryKey = 'id';

    public int $id;
    public ?int $id_portal;
    public ?int $ordre;
    public ?string $titol;
    public ?string $descripcio;
    public ?string $meta_descripcio;
    public ?int $menu_pare;
    public ?int $publicat;
    public ?string $gestor;
    public ?string $gestor_pers;
    public ?string $gestor_params;
    public ?string $img;
    public ?string $alt_img;
    public ?string $desc_llarga_img;
    public ?string $contingut;
    public ?string $contingutJSON;

    protected static function createInstance(?ConexionsDB $db = null): static
    {
        return new self($db);
    }

    public static function truncate() {
        $instance = static::createInstance();
        $aSentencies = [
            [
                "query" =>
                    "TRUNCATE menus",
                "params" => [
                ]
            ],
        ];

        return $instance->db->execute($aSentencies);
    }

    protected function beforeSave(): void
    {
        // reordenem els camps abans de guardar
        $aSentencies = [
            [
                "query" =>
                    "CALL ordenarMenus_p('A',:ordre, :id, :id_pare)",
                "params" => [
                    ":ordre" => $this->ordre,
                    ":id" => 0,
                    ":id_pare" => $this->menu_pare,
                ]
            ],
        ];

        $this->db->execute($aSentencies);
    }

    protected function afterSave(): void
    {
        // revisem si te fills per omplir em camp calculat
//        $aSentencies = [
//            [
//                "query" =>
//                    "CALL revisarFills_p(:menu_pare)",
//                "params" => [
//                    ":menu_pare" => $this->menu_pare
//                ]
//            ],
//        ];
//
//        $this->db->execute($aSentencies);
    }

    public static function SelectOrdenat() {
        $instance = static::createInstance();
        $aSentencies = [
            [
                "query" =>
                    "SELECT * FROM {$instance->table} ORDER BY ordre ASC",
                "params" => [
                ]
            ],
        ];

        return $instance->db->execute($aSentencies)[0];
    }
}