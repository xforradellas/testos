<?php
namespace Ajt\Test\models;

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
    public ?array $hosts;

    protected static function createInstance(?ConexionsDB $db = null): static
    {
        return new self($db);
    }
}