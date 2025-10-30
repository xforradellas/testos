<?php
namespace Ajt\Test\pub\models;

use Ajt\DB\ConexionsDB;
use Ajt\DB\Model;

class PortalsI18nModel extends Model
{
    protected string $table = 'portals_i18n';
    protected string $primaryKey = 'id';

    public int $id;
    public int $id_portal;
    public ?string $idioma;
    public ?string $meta_descripcio;

    protected static function createInstance(?ConexionsDB $db = null): static
    {
        return new self($db);
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
}