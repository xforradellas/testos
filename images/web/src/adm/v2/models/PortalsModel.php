<?php
namespace Ajt\Test\adm\v2\models;

use Ajt\DB\ConexionsDB;
use Ajt\DB\Model;

class PortalsModel extends Model
{
    protected string $table = 'portals';
    protected string $primaryKey = 'id';

    public int $id;
    public ?string $titol;
    public ?int $actiu;
    public ?string $web_dir;
    public ?string $meta_description;
    public ?int $id_menu_principal;
    public ?string $mides_img_fons;
    public ?string $mides_img_default;
    public ?string $version_admin;

    protected static function createInstance(?ConexionsDB $db = null): static
    {
        return new self($db);
    }
    public static function getAllPortals(): array
    {
        $instance = static::createInstance();
        $aSentencies = [
            "0" => [
                "query" =>
                    "SELECT
                        p.*,
                        CONCAT(h.url,'/',h.sufix) AS hostDefault,
                        GROUP_CONCAT(pv.valor SEPARATOR ', ') AS css
                    FROM portals p
                    LEFT JOIN hosts h
                        ON h.id_portal = p.id
                               AND h.principal = 1
                               AND h.idioma = 'CA'
                    LEFT JOIN portals_vars pv
                        ON pv.id_portal = p.id
                               AND pv.tipus = 'css_contingut'
                    GROUP BY p.id, h.url, h.sufix
                    ORDER BY p.titol
                ",
                "params" => []
            ]
        ];

        return $instance->db->execute($aSentencies)[0] ?? [];
    }

    public static function getI18nByPortal(int $vIdPortal)
    {
        $instance = static::createInstance();
        $aSentencies = [
            [
                "query" =>
                    "SELECT
                        *
                    FROM portals_i18n
                    WHERE id_portal = :id",
                "params" => [
                    ":id" => $vIdPortal
                ]
            ]
        ];

        return $instance->db->execute($aSentencies)[0];
    }

    public static function getTipusDescriptors(int $vIdPortal)
    {
        $instance = static::createInstance();
        $aSentencies = [
            "0" => [
                "query" =>
                    "SELECT
                        nom,
                        valor,
                        mides
                    FROM portals_vars
                    WHERE id_portal = :id
                        AND tipus ='descriptors'",
                "params" => [
                    ":id" => $vIdPortal
                ]
            ]
        ];

        return $instance->db->execute($aSentencies)[0];
    }

    public static function getTipusDestacats(int $vIdPortal): array
    {
        $instance = static::createInstance();
        $aSentencies = [
            "0" => [
                "query" =>
                    "SELECT
                        nom,
                        valor,
                        mides
                    FROM portals_vars
                    WHERE id_portal = :id
                        AND tipus ='destacats'",
                "params" => [
                    ":id" => $vIdPortal
                ]
            ]
        ];

        return $instance->db->execute($aSentencies)[0] ?? [];
    }

}