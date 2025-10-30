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

    // camps vista
    public ?string $hostTipus;
    public ?string $idioma;

    // llistats
    public ?array $vars;
    public ?array $idiomes;
    public ?array $menus;
    protected static function createInstance(?ConexionsDB $db = null): static
    {
        return new self($db);
    }

    public static function getPortalByUrl(string $vHost,string $vSufix)
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

        return self::fromArray($instance->db->execute($aSentencies)[0][0] ?? null);
    }
}