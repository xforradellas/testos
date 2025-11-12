<?php
namespace Ajt\Test\adm\v2\models;

use Ajt\DB\ConexionsDB;
use Ajt\DB\Model;

class MenusModel extends Model
{
    protected string $table = 'menus';
    protected string $primaryKey = 'id';

    public int $id = 0;
    public int $id_portal;
    public int $ordre;
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
    public ?string $img_fons;
    public ?int $id_compartit;
    public ?int $id_arxius;
    public ?int $format_fills;
    public ?string $contingut;
    public ?string $contingutJSON;
    public ?int $plantillaJSON;
    public ?string $copia_contingut;
    public ?string $url;
    public ?int $enllaç_extern;
    public ?int $cercable = 1;
    public ?string $data_baixa;
    public ?string $data_mod;
    public ?string $data_mod_contingut;
    public ?int $teFillsPublicats;
    public ?int $teFillsAmbMenu;

    protected static function createInstance(?ConexionsDB $db = null): static
    {
        return new self($db);
    }

    public static function getMenu(int $vId): ?array
    {
        $instance = static::createInstance();
        $aSentencies = [
            [
                "query" =>
                    "SELECT
                        *,
                        (SELECT
                                id_portal
                            FROM menus
                            WHERE id = m.id_compartit
                         ) id_portal_compartit
                    FROM menus m
                    WHERE id = :id",
                "params" => [
                    ":id" => $vId,
                ]
            ]
        ];

        return $instance->db->execute($aSentencies)[0][0] ?? null;
    }

    public static function getDocumentsByIdMenu(int $vIdMenu)
    {
        $instance = static::createInstance();
        $aSentencies = [
            [
                "query" =>
                    "SELECT
                        *
                    FROM menus_documents
                    WHERE
                        id_menu = :idMenu
                    ORDER BY ordre",
                "params" => [
                    ":idMenu" => $vIdMenu,
                ]
            ]
        ];

        return $instance->db->execute($aSentencies)[0] ?? null;
    }

    public static function getVarsByIdMenu(int $vIdMenu)
    {
        $instance = static::createInstance();
        $aSentencies = [
            "0" => [
                "query" =>
                    "SELECT
                        *
                    FROM menus_vars
                    WHERE
                        id_menu = :idMenu",
                "params" => [
                    ":idMenu" => $vIdMenu,
                ]
            ]
        ];

        return $instance->db->execute($aSentencies)[0] ?? null;
    }

    public static function getDescriptorsByIdMenu(int $vIdMenu)
    {
        $instance = static::createInstance();
        $aSentencies = [
            [
                "query" =>
                    "SELECT
                    *
                FROM menus_descriptors
                WHERE
                    id_menu = :idMenu",
                "params" => [
                    ":idMenu" => $vIdMenu,
                ]
            ]
        ];

        return $instance->db->execute($aSentencies)[0] ?? null;
    }

    public static function getI18nByIdMenu(int $vIdMenu)
    {
        $instance = static::createInstance();
        $aSentencies = [
            [
                "query" =>
                    "SELECT
                        *
                    FROM menus_i18n
                    WHERE
                        id_menu = :idMenu",
                "params" => [
                    ":idMenu" => $vIdMenu,
                ]
            ]
        ];

        return $instance->db->execute($aSentencies)[0] ?? null;
    }

    public static function getMenusByMenuPare(int $vIdMenuPare)
    {
        $instance = static::createInstance();
        $aSentencies = [
            "0" => [
                "query" =>
                    "SELECT
							m.*,
                            p.valor as img_defecte
                    FROM menus m
                    LEFT JOIN portals_vars p ON p.id_portal = m.id_portal AND nom = 'imgDefault'
                    WHERE menu_pare = :menu_pare
                        AND publicat > 0
                        AND data_baixa is null
                    ORDER BY ordre",
                "params" => [
                    ":menu_pare" => $vIdMenuPare,
                ]
            ]
        ];

        return $instance->db->execute($aSentencies)[0] ?? null;
    }

    public static function getMenusByIdPortal(int $vIdPortal,string $vIdsPermisos)
    {
        $instance = static::createInstance();
        $aSentencies = [
            "0" => [
                "query" =>
                    "SELECT
                        *,
                        CASE 
                            WHEN m.gestor = 'menuCompartit' THEN (
                                SELECT id_portal 
                                FROM menus 
                                WHERE id = m.id_compartit
                                LIMIT 1
                            )
                            ELSE 0
                        END AS id_portal_compartit,
                        tePermisMenu_f(id,:idsPermisos) as permis,
                        estaPublicat_f(id) as estaPublicat
                    FROM menus m
                    WHERE
                        id_portal = :idPortal
                        AND data_baixa is null
                    ORDER BY ordre",
                "params" => [
                    ":idPortal" => $vIdPortal,
                    ":idsPermisos" => $vIdsPermisos,
                ]
            ]
        ];
        return $instance->db->execute($aSentencies)[0] ?? null;
    }

    public static function getI18nByPortal($vIdPortal)
    {
        return PortalsModel::getI18nByPortal($vIdPortal);
    }

    public static function validarPermisos(int $vIdPortal,int $vId,string $vIdsPermisos)
    {
        $instance = static::createInstance();
        $aSentencies = [
            "0" => [
                "query" =>
                    "SELECT
                        tePermisMenu_f(id,:idsPermisos) as permis
                    FROM menus m
                    WHERE
                        id = :id AND
                        id_portal = :idPortal
                        AND data_baixa is null",
                "params" => [
                    ":id" => $vId,
                    ":idPortal" => $vIdPortal,
                    ":idsPermisos" => $vIdsPermisos,
                ]
            ]
        ];
        return $instance->db->execute($aSentencies)[0][0] ?? null;
    }

    protected function beforeSave(): void
    {
        if ($this->exists()) {
            // update
            $aSentencies = [
                [
                    "query" =>
                        "CALL ordenarMenus_p('U',:ordre, :id, :id_pare)",
                    "params" => [
                        ":ordre" => $this->ordre,
                        ":id" => $this->id,
                        ":id_pare" => $this->menu_pare,
                    ]
                ]
            ];

        } else {
            // insert
            $aSentencies = [
                [
                    "query" =>
                        "CALL ordenarMenus_p('A',:ordre, :id, :id_pare)",
                    "params" => [
                        ":ordre" => $this->ordre,
                        ":id" => 0,
                        ":id_pare" => $this->menu_pare,
                    ]
                ]
            ];

        }

        $this->db->execute($aSentencies);
    }

    protected function afterSave(): void
    {
        $aSentencies = [
            [
                "query" =>
                    "CALL revisarFills_p(:menu_pare)",
                "params" => [
                    ":menu_pare" => $this->menu_pare
                ]
            ]
        ];

        $this->db->execute($aSentencies);
    }
}