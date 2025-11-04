<?php
namespace Ajt\Test\pub\models;

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
    public ?int $mides_img_fons;
    public ?string $mides_img_default;
    public ?string $version_admin;

    protected static function createInstance(?ConexionsDB $db = null): static
    {
        return new self($db);
    }

    public static function getPortalByUrl(string $vHost,string $vSufix): array
    {
        $instance = static::createInstance();
        $aSentencies = [
            [
                "query" =>
                    "SELECT
                        *
                    FROM getPortalsByUrl_v
                    WHERE url = :host AND sufix = :sufix",
                "params" => [
                    ":host" => $vHost,
                    ":sufix" => $vSufix
                ]
            ],
        ];

        return ($instance->db->execute($aSentencies)[0][0] ?? []);
    }

    public static function getVarsByIdPortal(int $vIdPortal)
    {
        $instance = static::createInstance();
        $aSentencies = [
            [
                "query" =>
                    "SELECT
                        nom as name,
                        valor as value,
                        tipus
                    FROM portals_vars
                    WHERE id_portal = :idPortal
                    ORDER BY tipus DESC",
                "params" => [
                    ":idPortal" => $vIdPortal
                ]
            ],
        ];

        return $instance->db->execute($aSentencies)[0];
    }

    public static function getIdiomesByPortal(int $vIdPortal, string $vTipus)
    {
        $instance = static::createInstance();
        $aSentencies = [
            [
                "query" =>
                    "SELECT
                        idioma,
                        concat(URL,'/',SUFIX) as url
                    FROM hosts
                    WHERE tipus = :tipus
                      AND id_portal = :idPortal",
                "params" => [
                    ":idPortal" => $vIdPortal,
                    ":tipus" => $vTipus
                ]
            ]
        ];

        return $instance->db->execute($aSentencies)[0];
    }

    public static function getDestacatsByPortalAndTipus(int $vIdPortal,string $vTipus): array
    {
        $instance = static::createInstance();
        $aSentencies = [
            [
                "query" =>
                    "SELECT
                          id,
                        titol,
                        REPLACE(img,'/docs/".$vTipus."/','') as imatge,
                        img as imatge_abs,
                        url
                     FROM destacats
                     WHERE id_portal = :idPortal
                        AND tipus = :tipus
                        AND (data_fi is null OR CURDATE() <= data_fi)
                        AND (data_inici is null OR  data_inici <= CURDATE())
                     ORDER BY ordre",
                "params" => [
                    ":idPortal" => $vIdPortal,
                    ":tipus" => $vTipus,
                ]
            ]
        ];

        print_r($aSentencies);
        return ($instance->db->execute($aSentencies)[0][0] ?? []);
    }
}