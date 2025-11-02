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

    public static function getMenu(int $vId, ?string $vIdioma = "CA"): array
    {
        $instance = static::createInstance();
        $aSentencies = [
            "0" => [
                "query" =>
                    "SELECT
                        id,
                        getIdSeo_f(id,getTitolByIdioma_f(id,:idioma_seo)) as idseo,
                        getTitolByIdioma_f(id,:idioma_titol) as titol,
                        menu_pare,
                        estaPublicat_f(id) as 'publicat',
                        IF(gestor = 'enllac', url, '') as  url,
                        IF(gestor = 'enllac', enllac_extern, 0) as  enllac_extern,
                        gestor,
                        gestor_pers,
                        gestor_params,
                        id_arxius,
                        id_compartit,
                        getMetaDescripcioByIdioma_f(id,:idioma_meta_descipcio) as meta_description,
                        getImgFonsMenu_f(id) as url_img_fons_abs,
                        REPLACE(getImgFonsMenu_f(id),'docs/fons/','') as url_img_fons,
                        teFillsPublicats as te_fills,
                        teFillsAmbMenu as te_fills_amb_menu
                    FROM menus
                    WHERE id = :id
                        AND data_baixa is null
                        AND estaPublicat_f(id) > 0",
                "params" => [
                    ":id" => $vId,
                    ":idioma_seo" => $vIdioma,
                    ":idioma_titol" => $vIdioma,
                    ":idioma_meta_descipcio" => $vIdioma
                ]
            ]
        ];

        return $instance->db->execute($aSentencies)[0][0];
    }

    public static function getMenusForFilAriadna(int $vId, ?string $vIdioma = "CA")
    {
        $instance = static::createInstance();
        $aSentencies = [
            "0" => [
                "query" =>
                    "SELECT
                        id,
                        getIdSeo_f(id,getTitolByIdioma_f(id,:idioma_seo)) as idseo,
                        getTitolByIdioma_f(id,:idioma_titol) as titol,
                        menu_pare
                    FROM menus
                    WHERE id = :id
                        AND data_baixa is null
                        AND estaPublicat_f(id) > 0",
                "params" => [
                    ":id" => $vId,
                    ":idioma_seo" => $vIdioma,
                    ":idioma_titol" => $vIdioma
                ]
            ]
        ];

        return $instance->db->execute($aSentencies)[0][0];
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
                        getIdSeo_f(id,getTitolByIdioma_f(id,:idioma_seo)) as idseo,
                        getTitolByIdioma_f(id,:idioma_titol) as titol,
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
                    ":idioma_seo" => $vIdioma,
                    ":idioma_titol" => $vIdioma,

                ]
            ]
        ];

        return $instance->db->execute($aSentencies)[0];
    }

    public static function getMenusByMenuPareForFills(int $vMenuPare,string $vIdioma = 'CA', ?int $vPublicatParam = 0, ?string $vOrdreParam = "ASC")
    {
        $instance = static::createInstance();

        list ($vOrdre,$vPublicat) = self::getOrdres($vPublicatParam,$vOrdreParam);

        $aSentencies = [
            [
                "query" =>
                    "SELECT
                        m.*,
                        GETIDSEO_F(`m`.`id`, IF (mi.titol is not null,mi.titol,m.titol)) AS `idseo`,
		                IF (mi.titol is not null,mi.titol,m.titol) as titol,
		                IF (mi.descripcio is not null,mi.descripcio,m.descripcio) as descripcio,
                        COALESCE(
							(SELECT valor FROM portals_vars WHERE id_portal = m.id_portal AND tipus = 'var' AND nom = 'imgDefault'),
							''
						) AS img_defecte,
						MAX((CASE
							WHEN (`mv`.`param` = 'id_contingut') THEN `mv`.`valor`
							ELSE m.id
						END)) AS `id_contingut`,
						MAX((CASE
							WHEN (`mv`.`param` = 'data') THEN `mv`.`valor`
							ELSE NULL
						END)) AS `data`,
						MAX((CASE
							WHEN (`mv`.`param` = 'horari') THEN `mv`.`valor`
							ELSE NULL
						END)) AS `horari`,
						MAX((CASE
							WHEN (`mv`.`param` = 'adreca') THEN `mv`.`valor`
							ELSE NULL
						END)) AS `adreca`,
						MAX((CASE
							WHEN (`mv`.`param` = 'preu') THEN `mv`.`valor`
							ELSE NULL
						END)) AS `preu`,
						MAX((CASE
							WHEN (`mv`.`param` = 'durada') THEN `mv`.`valor`
							ELSE NULL
						END)) AS `durada`,
						MAX((CASE
							WHEN (`mv`.`param` = 'url_pagament') THEN `mv`.`valor`
							ELSE NULL
						END)) AS `url_pagament`,
						MAX((CASE
							WHEN (`mv`.`param` = 'telefon') THEN `mv`.`valor`
							ELSE NULL
						END)) AS `telefon`,
						MAX((CASE
							WHEN (`mv`.`param` = 'email') THEN `mv`.`valor`
							ELSE NULL
						END)) AS `email`,
                        GROUP_CONCAT(md.id_descriptor ORDER BY md.id_descriptor SEPARATOR ',') AS descriptors
                    FROM getMenuForFills2_v m
                    LEFT JOIN menus_i18n mi ON mi.id_menu = m.id AND mi.idioma = :idioma
                    LEFT JOIN `menus_vars` `mv` ON `m`.`id` = `mv`.`id_menu`
                    LEFT JOIN menus_descriptors md ON m.id = md.id_menu
                    WHERE menu_pare = :menuPare
                        AND ".$vPublicat
                    ." GROUP BY id,mi.titol,mi.descripcio"
                    .$vOrdre,
                "params" => [
                    ":menuPare" => $vMenuPare,
                    ":idioma" => $vIdioma,

                ]
            ]
        ];

        return $instance->db->execute($aSentencies)[0];
    }
    public static function getContingut(int $vId, ?string $vIdioma = "CA")
    {
        $instance = static::createInstance();
        $aSentencies = [
            "0" => [
                "query" =>
                    "SELECT
                            m.id,
                            m.menu_pare,
                            IF (mi.titol is not null,mi.titol,m.titol) as titol,
                            IF (mi.descripcio is not null,mi.descripcio,m.descripcio) as descripcio,
                            IF (mi.contingut is not null,mi.contingut,m.contingut) as contingut,
                            IF (mi.contingutJSON is not null,mi.contingutJSON,m.contingutJSON) as contingutJSON,
                            m.format_fills as mostrar_fills,
                            null as mostrar_cerca,
                            m.format_fills,
                            m.img as img_abs,
                            IF(m.img is null,'',SUBSTRING_INDEX(m.img, '/', -1)) as img,
                            GROUP_CONCAT(md.id_descriptor ORDER BY md.id_descriptor SEPARATOR ',') AS descriptors
                        FROM  menus m
                        LEFT JOIN menus_i18n mi ON mi.id_menu = m.id AND mi.idioma = :idioma
                        LEFT JOIN menus_descriptors md ON m.id = md.id_menu
                        WHERE publicat > 0
                            AND m.data_baixa is null
                            AND m.id = :id
                        GROUP BY m.id, m.menu_pare, m.titol, m.descripcio, m.contingut, m.contingutJSON,
							m.format_fills, m.img, 
							mi.titol, mi.descripcio, mi.contingut, mi.contingutJSON",
                "params" => [
                    ":id" => $vId,
                    ":idioma" => $vIdioma,
                ]
            ]
        ];

        return $instance->db->execute($aSentencies)[0][0];
    }

    public static function getMenusVars(int $vIdMenu)
    {
        $instance = static::createInstance();
        $aSentencies = [
            "0" => [
                "query" =>
                    "SELECT
                        *
                    FROM menus_vars cm
                    WHERE
                        id_menu = :idMenu",
                "params" => [
                    ":idMenu" => $vIdMenu
                ]
            ]
        ];

        return $instance->db->execute($aSentencies)[0];
    }

    public static function getMenusDocuments(int $vIdMenu)
    {
        $instance = static::createInstance();
        $aSentencies = [
            [
                "query" =>
                    "SELECT
                        SUBSTRING_INDEX(file, '/', -1) as path,
                        file as path_abs,
                        img as img_abs,
                        tipus,
                        categoria,
                        id_menu,
                        titol,
                        titol as descripcio,
                        text_boto,
                        url,
                        alt_img,
                        desc_llarga_img
                    FROM menus_documents cm
                    WHERE
                        id_menu = :idMenu
                        AND visible_auto = 1
                        AND (data_fi is null OR CURDATE() <= data_fi)
                        AND (data_inici is null OR  data_inici <= CURDATE())
                    ORDER BY tipus,ordre,titol",
                "params" => [
                    ":idMenu" => $vIdMenu
                ]
            ]
        ];

        return $instance->db->execute($aSentencies)[0];
    }
    public static function getCssPag(int $vIdMenu)
    {
        $instance = static::createInstance();
        $aSentencies = [
            "0" => [
                "query" =>
                    "SELECT
                        teCssPag_f(:idMenu) as css_pag",
                "params" => [
                    ":idMenu" => $vIdMenu
                ]
            ]
        ];

        return $instance->db->execute($aSentencies)[0][0];
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