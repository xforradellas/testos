<?php
namespace Ajt\Test\pub\models;

use Ajt\DB\ConexionsDB;
use Ajt\DB\Model;

class PortalsVarsModel extends Model
{
    protected string $table = 'portals_vars';
    protected string $primaryKey = 'id';

    public int $id;
    public int $id_portal;
    public ?string $nom;
    public ?string $valor;
    public ?string $tipus;
    public ?string $mides;
    public ?string $format;

    protected static function createInstance(?ConexionsDB $db = null): static
    {
        return new self($db);
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
}