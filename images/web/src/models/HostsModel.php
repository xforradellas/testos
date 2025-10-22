<?php
namespace Ajt\Test\models;

use Ajt\DB\ConexionsDB;
use Ajt\DB\Model;

class HostsModel extends Model
{
    protected string $table = 'hosts';
    protected string $primaryKey = 'id';

    public int $id;
    public ?int $id_portal;
    public ?string $url;
    public ?string $sufix;
    public ?int $principal;
    public ?int $prova;
    public ?string $idioma;
    public ?string $tipus;

    protected static function createInstance(?ConexionsDB $db = null): static
    {
        return new self($db);
    }

    /** Método nuevo: where */
    public static function getByIdPortal(int $id_portal): array
    {
        $instance = static::createInstance();
        $aSentencies = [
            [
                "query" =>
                    "SELECT * FROM {$instance->table} WHERE id_portal = :id_portal",
                "params" => [
                    ":id_portal" => $id_portal
                ]
            ],
        ];

        return $instance->db->execute($aSentencies);
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
//        $aSentencies = [
//            [
//                "query" =>
//                    "CALL ordenarMenus_p('A',:ordre, :id, :id_pare)",
//                "params" => [
//                    ":ordre" => $this->ordre,
//                    ":id" => 0,
//                    ":id_pare" => $this->menu_pare,
//                ]
//            ],
//        ];
//
//        $this->db->execute($aSentencies);
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

//    public static function SelectOrdenat() {
//        $instance = static::createInstance();
//        $aSentencies = [
//            [
//                "query" =>
//                    "SELECT * FROM {$instance->table} ORDER BY ordre ASC",
//                "params" => [
//                ]
//            ],
//        ];
//
//        return $instance->db->execute($aSentencies)[0];
//    }
}