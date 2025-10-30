<?php
namespace Ajt\Test\pub\models;

use Ajt\DB\ConexionsDB;
use Ajt\DB\Model;

class MenusModel extends Model
{
    protected string $table = 'menus';
    protected string $primaryKey = 'id';

    public int $id;
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
    public ?int $cercable;
    public ?string $data_baixa;
    public ?string $data_mod;
    public ?string $data_mod_contingut;
    public ?int $teFillsPublicats;
    public ?int $teFillsAmbMenu;

    protected static function createInstance(?ConexionsDB $db = null): static
    {
        return new self($db);
    }

    public static function getMenusByMenuPare(int $vMenuPare, ?int $vPublicatParam = 0, ?string $vOrdreParam = "ASC", string $vIdioma = 'CA')
    {
        $instance = static::createInstance();

        list ($vOrdre,$vPublicat) = self::getOrdres($vPublicatParam,$vOrdreParam);

        $aSentencies = [
            "0" => [
                "query" =>
                    "SELECT
                        id,
                        getIdSeo_f(id,getTitolByIdioma_f(id,:idioma)) as idseo,
                        getTitolByIdioma_f(id,:idioma) as titol,
                        IF(gestor = 'enllac',
                            2,
                            IF(gestor = 'menuCompartit',
                                3,
                                IF(gestor = 'llistatDocuments',
                                    4,
                                    IF(gestor = 'codi',
                                        6,
                                        1
                                    )
                                )
                            )
                        ) as tipus,
                        publicat,
                        IF(gestor = 'enllac', url, '') as  url,
                        IF(gestor = 'enllac', enllac_extern, 0) as  enllac_extern,
                        img as img_abs,
                        SUBSTRING_INDEX(img, '/', -1) as img,
                        teFillsPublicats as te_fills,
                        teFillsAmbMenu as te_fills_amb_menu
                    FROM menus
                    WHERE menu_pare = :menuPare
                        AND data_baixa is null
                        AND ".$vPublicat
                    .$vOrdre,
                "params" => [
                    ":menuPare" => $vMenuPare,
                    ":idioma" => $vIdioma,

                ]
            ]
        ];

        print_r($aSentencies);
        return $instance->db->execute($aSentencies)[0];
    }

    private static function getOrdres($vPublicatParam,$vOrdreParam) {
        switch ($vOrdreParam) {
            default:
            case "ASC": // 1...9
                $vOrdre = " ORDER BY ordre";
                break;
            case "DESC": // 9...1
                $vOrdre = " ORDER BY ordre DESC";
                break;
            case "ALF_ASC": // A...Z
                $vOrdre = " ORDER BY titol,ordre";
                break;
            case "ALF_DESC": // Z...A
                $vOrdre = " ORDER BY titol DESC,ordre";
                break;
            case "DATA_ASC": // 01/01/1900...12/31/2000
                $vOrdre = " ORDER BY data,ordre";
                break;
            case "DATA_DESC": // 12/31/2000...01/01/1900
                $vOrdre = " ORDER BY data DESC,ordre";
                break;
        }

        switch ($vPublicatParam) {
            default:
            case "0": // 1...9
                $vPublicat = " publicat > 0 ";
                break;
            case "1": // 9...1
                $vPublicat = " publicat = 1 ";
                break;
            case "2": // A...Z
                $vPublicat = " publicat = 2 ";
                break;
        }
        return [
            $vOrdre,
            $vPublicat
        ];
    }
}