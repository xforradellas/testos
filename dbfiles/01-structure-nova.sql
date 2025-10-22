-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: manresa_v2
-- ------------------------------------------------------
-- Server version	5.7.44

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `descriptors`
--

DROP TABLE IF EXISTS `descriptors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `descriptors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_portal` varchar(255) DEFAULT NULL,
  `tipus` varchar(255) DEFAULT NULL,
  `titol` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `descriptors_i18n`
--

DROP TABLE IF EXISTS `descriptors_i18n`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `descriptors_i18n` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_descriptor` int(11) DEFAULT NULL,
  `idioma` varchar(2) DEFAULT NULL,
  `titol` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `destacats`
--

DROP TABLE IF EXISTS `destacats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `destacats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_portal` int(11) DEFAULT NULL,
  `tipus` varchar(255) DEFAULT NULL,
  `titol` varchar(2000) DEFAULT NULL,
  `ordre` int(11) DEFAULT NULL,
  `data_inici` datetime DEFAULT NULL,
  `data_fi` datetime DEFAULT NULL,
  `img` varchar(2000) DEFAULT NULL,
  `url` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ordenar_destacats` (`id_portal`,`tipus`,`ordre`)
) ENGINE=InnoDB AUTO_INCREMENT=1010 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ordre` int(11) DEFAULT NULL,
  `titol` varchar(2000) DEFAULT NULL,
  `descripcio` varchar(2000) DEFAULT NULL,
  `tipus` varchar(2) DEFAULT NULL,
  `menu_pare` int(11) DEFAULT NULL,
  `url_document` varchar(2000) DEFAULT NULL,
  `url_document_csv` varchar(2000) DEFAULT NULL,
  `url_document_xml` varchar(2000) DEFAULT NULL,
  `ordenat_per` int(11) DEFAULT NULL,
  `max_anys` int(11) NOT NULL DEFAULT '0',
  `data_mod` datetime DEFAULT NULL,
  `data_baixa` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_pare` (`menu_pare`)
) ENGINE=InnoDB AUTO_INCREMENT=14789 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary view structure for view `getMenuForFills2_v`
--

DROP TABLE IF EXISTS `getMenuForFills2_v`;
/*!50001 DROP VIEW IF EXISTS `getMenuForFills2_v`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `getMenuForFills2_v` AS SELECT 
 1 AS `id`,
 1 AS `id_portal`,
 1 AS `idseo`,
 1 AS `titol`,
 1 AS `tipus`,
 1 AS `publicat`,
 1 AS `url`,
 1 AS `enllac_extern`,
 1 AS `img_abs`,
 1 AS `alt_img`,
 1 AS `desc_llarga_img`,
 1 AS `img`,
 1 AS `te_fills`,
 1 AS `te_fills_amb_menu`,
 1 AS `descripcio`,
 1 AS `ordre`,
 1 AS `menu_pare`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `getMenuForFills_v`
--

DROP TABLE IF EXISTS `getMenuForFills_v`;
/*!50001 DROP VIEW IF EXISTS `getMenuForFills_v`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `getMenuForFills_v` AS SELECT 
 1 AS `id`,
 1 AS `idseo`,
 1 AS `titol`,
 1 AS `tipus`,
 1 AS `publicat`,
 1 AS `url`,
 1 AS `enllac_extern`,
 1 AS `img_abs`,
 1 AS `img`,
 1 AS `te_fills`,
 1 AS `te_fills_amb_menu`,
 1 AS `data`,
 1 AS `horari`,
 1 AS `adreca`,
 1 AS `preu`,
 1 AS `descripcio`,
 1 AS `ordre`,
 1 AS `menu_pare`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `getPortalsByUrl_v`
--

DROP TABLE IF EXISTS `getPortalsByUrl_v`;
/*!50001 DROP VIEW IF EXISTS `getPortalsByUrl_v`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `getPortalsByUrl_v` AS SELECT 
 1 AS `id`,
 1 AS `url`,
 1 AS `sufix`,
 1 AS `prova`,
 1 AS `dir_templates`,
 1 AS `id_menu_principal`,
 1 AS `max_tabs`,
 1 AS `actiu`,
 1 AS `web_dir`,
 1 AS `hostTipus`,
 1 AS `meta_description`,
 1 AS `idioma`,
 1 AS `url_canonical`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `hosts`
--

DROP TABLE IF EXISTS `hosts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hosts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_portal` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `sufix` varchar(255) DEFAULT NULL,
  `principal` int(11) DEFAULT NULL,
  `prova` int(11) DEFAULT NULL,
  `idioma` varchar(45) DEFAULT NULL,
  `tipus` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=171 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_portal` int(11) DEFAULT NULL,
  `ordre` int(11) DEFAULT NULL,
  `titol` varchar(2000) DEFAULT NULL,
  `descripcio` varchar(2000) DEFAULT NULL,
  `meta_descripcio` varchar(2000) DEFAULT NULL,
  `menu_pare` int(11) DEFAULT NULL,
  `publicat` int(11) DEFAULT NULL,
  `gestor` varchar(200) DEFAULT NULL,
  `gestor_pers` varchar(2000) DEFAULT NULL,
  `gestor_params` varchar(2000) DEFAULT NULL,
  `img` varchar(2000) DEFAULT NULL,
  `alt_img` text,
  `desc_llarga_img` text,
  `img_fons` varchar(2000) DEFAULT NULL,
  `id_compartit` int(11) DEFAULT NULL,
  `id_arxius` int(11) DEFAULT NULL,
  `format_fills` int(11) DEFAULT NULL,
  `contingut` longtext,
  `contingutJSON` longtext,
  `plantillaJSON` int(11) DEFAULT NULL,
  `copia_contingut` longtext,
  `url` varchar(2000) DEFAULT NULL,
  `enllac_extern` int(11) DEFAULT NULL,
  `cercable` int(11) DEFAULT NULL,
  `data_baixa` datetime DEFAULT NULL,
  `data_mod` datetime DEFAULT NULL,
  `data_mod_contingut` datetime DEFAULT NULL,
  `teFillsPublicats` int(1) DEFAULT '0',
  `teFillsAmbMenu` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ordenar_menus` (`id_portal`,`menu_pare`,`ordre`),
  KEY `idx_menu_pare` (`menu_pare`),
  KEY `idx_buscar_fills` (`menu_pare`,`publicat`,`data_baixa`),
  KEY `idx_publicat` (`id`,`publicat`,`data_baixa`),
  FULLTEXT KEY `idx_contingut` (`contingut`),
  FULLTEXT KEY `idx_titol` (`titol`)
) ENGINE=InnoDB AUTO_INCREMENT=16919 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `menus_descriptors`
--

DROP TABLE IF EXISTS `menus_descriptors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus_descriptors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) DEFAULT NULL,
  `id_descriptor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `menus_documents`
--

DROP TABLE IF EXISTS `menus_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) DEFAULT NULL,
  `ordre` int(11) DEFAULT NULL,
  `titol` varchar(2000) CHARACTER SET latin1 DEFAULT NULL,
  `descripcio` text,
  `text_boto` varchar(1000) CHARACTER SET latin1 DEFAULT NULL,
  `file` varchar(2000) CHARACTER SET latin1 DEFAULT NULL,
  `img` varchar(2000) CHARACTER SET latin1 DEFAULT NULL,
  `alt_img` varchar(2000) DEFAULT NULL,
  `desc_llarga_img` text,
  `url` varchar(2000) CHARACTER SET latin1 DEFAULT NULL,
  `tipus` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `categoria` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `visible_auto` int(11) DEFAULT NULL,
  `data_inici` datetime DEFAULT NULL,
  `data_fi` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ordenar_menus` (`id_menu`,`tipus`,`ordre`)
) ENGINE=InnoDB AUTO_INCREMENT=29719 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `menus_i18n`
--

DROP TABLE IF EXISTS `menus_i18n`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus_i18n` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) DEFAULT NULL,
  `idioma` varchar(45) DEFAULT NULL,
  `titol` varchar(2000) DEFAULT NULL,
  `descripcio` varchar(2000) DEFAULT NULL,
  `meta_descripcio` varchar(2000) DEFAULT NULL,
  `img` varchar(2000) DEFAULT NULL,
  `alt_img` text,
  `desc_llarga_img` text,
  `contingut` longtext,
  `contingutJSON` longtext,
  `copia_contingut` longtext,
  `url` varchar(2000) DEFAULT NULL,
  `estat` varchar(100) DEFAULT NULL,
  `data_mod` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_menu_idioma` (`id_menu`,`idioma`),
  FULLTEXT KEY `idx_contingut` (`contingut`),
  FULLTEXT KEY `idx_titol` (`titol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `menus_plantilles`
--

DROP TABLE IF EXISTS `menus_plantilles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus_plantilles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_portal` int(11) DEFAULT NULL,
  `nom` varchar(200) DEFAULT NULL,
  `plantilla` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `menus_vars`
--

DROP TABLE IF EXISTS `menus_vars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus_vars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) DEFAULT NULL,
  `param` varchar(255) DEFAULT NULL,
  `valor` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_id_menu` (`id_menu`),
  KEY `idx_menu_param` (`id_menu`,`param`)
) ENGINE=InnoDB AUTO_INCREMENT=4925 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `portals`
--

DROP TABLE IF EXISTS `portals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `portals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titol` varchar(50) DEFAULT NULL,
  `actiu` int(11) DEFAULT NULL,
  `web_dir` varchar(45) DEFAULT NULL,
  `meta_description` varchar(2000) DEFAULT NULL,
  `id_menu_principal` int(11) DEFAULT NULL,
  `mides_img_fons` varchar(100) DEFAULT NULL,
  `mides_img_default` varchar(100) DEFAULT NULL,
  `version_admin` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `portals_i18n`
--

DROP TABLE IF EXISTS `portals_i18n`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `portals_i18n` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_portal` int(11) DEFAULT NULL,
  `idioma` varchar(45) DEFAULT NULL,
  `meta_descripcio` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `portals_vars`
--

DROP TABLE IF EXISTS `portals_vars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `portals_vars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_portal` int(11) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `valor` varchar(255) DEFAULT NULL,
  `tipus` varchar(255) DEFAULT NULL,
  `mides` varchar(45) DEFAULT NULL,
  `format` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=827 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tipus`
--

DROP TABLE IF EXISTS `tipus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipus` varchar(45) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `valor` varchar(255) DEFAULT NULL,
  `format` varchar(100) DEFAULT NULL,
  `categoria` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'manresa_v2'
--
/*!50003 DROP FUNCTION IF EXISTS `documentEsFill_f` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `documentEsFill_f`(var_id_fill INT, var_id_pare TEXT) RETURNS int(11)
    DETERMINISTIC
BEGIN
    -- Retorna 1 si el var_id_fill SI és descendent de var_id_pare
    -- Retorna 0 si el var_id_fill NO és descendent de var_id_pare

	DECLARE var_res INT;
	DECLARE var_pare INT;

    IF FIND_IN_SET(var_id_fill,var_id_pare) then
		RETURN 1;
    END IF;
    select menu_pare INTO var_pare FROM documents WHERE id = var_id_fill;
    IF var_pare is null OR var_pare = 0 THEN
		set var_res = 0;
    elseif find_in_set(var_pare,var_id_pare) then
		set var_res = 1;
	else
		inici: LOOP
			SELECT menu_pare INTO var_pare FROM documents WHERE id = var_pare;
			IF var_pare is null OR var_pare = 0 THEN
				set var_res = 0;
				leave inici;
			elseif find_in_set(var_pare,var_id_pare) then
				set var_res = 1;
				leave inici;
			end if;
		END LOOP inici;
	end if;
	RETURN var_res;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `estaPublicat_f` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `estaPublicat_f`(var_id_menu INT) RETURNS int(11)
    DETERMINISTIC
BEGIN
	DECLARE loops INT;
	DECLARE var_publicat_orig INT;
    DECLARE var_publicat INT;
	DECLARE var_pare INT;

	SET loops = 0;
	select id,publicat INTO var_pare,var_publicat_orig FROM menus WHERE id = var_id_menu;
	IF var_publicat_orig = 0 OR var_pare is null OR var_pare = 0  THEN
		RETURN var_publicat_orig;
	ELSE
		inici: LOOP
			SET loops = loops + 1;
            IF loops > 99 THEN
				return -1;
			END IF;
			SELECT menu_pare,publicat INTO var_pare,var_publicat FROM menus WHERE id = var_pare  AND id != menu_pare;
			IF var_publicat = 0 THEN
				return 0;
			ELSEIF var_pare is not null AND var_pare != 0 THEN
				ITERATE inici;
			end if;	
			leave inici;
		END LOOP inici;
	end if;
	RETURN var_publicat_orig;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getArrelDocumentsByDocument_f` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `getArrelDocumentsByDocument_f`(var_id INT) RETURNS int(11)
    DETERMINISTIC
BEGIN
	DECLARE var_id_result INT;
	DECLARE var_pare INT;

  inici: LOOP
	SELECT id,menu_pare INTO var_id_result, var_pare FROM documents WHERE id = var_id;
    IF var_pare is not null AND var_pare > 0 AND var_pare != var_id THEN
	  SET var_id = var_pare;
	  SET var_pare = null;
      ITERATE inici;
    END IF;
    LEAVE inici;
  END LOOP inici;

RETURN var_id_result;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getContingutByIdioma_f` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `getContingutByIdioma_f`(var_id_menu  int, var_idioma VARCHAR(100)) RETURNS longtext CHARSET latin1
    DETERMINISTIC
BEGIN

	DECLARE var_result LONGTEXT;
    
 	SELECT contingut INTO var_result FROM menus_i18n WHERE id_menu = var_id_menu AND idioma = var_idioma;
    IF var_result is null THEN 
		SELECT contingut INTO var_result FROM menus WHERE id = var_id_menu;
	END IF;

RETURN var_result;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getContingutJSONByIdioma_f` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `getContingutJSONByIdioma_f`(var_id_menu  int, var_idioma VARCHAR(100)) RETURNS longtext CHARSET latin1
       DETERMINISTIC
BEGIN

	DECLARE var_result LONGTEXT;
    
 	SELECT contingutJSON INTO var_result FROM menus_i18n WHERE id_menu = var_id_menu AND idioma = var_idioma;
    IF var_result is null THEN 
		SELECT contingutJSON INTO var_result FROM menus WHERE id = var_id_menu;
	END IF;

RETURN var_result;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getDescripcioByIdioma_f` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `getDescripcioByIdioma_f`(var_id_menu  int, var_idioma VARCHAR(100)) RETURNS varchar(2000)  CHARSET latin1
       DETERMINISTIC
BEGIN

	DECLARE var_result VARCHAR(2000);
    
 	SELECT descripcio INTO var_result FROM menus_i18n WHERE id_menu = var_id_menu AND idioma = var_idioma;
    IF var_result is null THEN 
		SELECT descripcio INTO var_result FROM menus WHERE id = var_id_menu;
	END IF;

RETURN var_result;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getFilAriadnaIdioma_f` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `getFilAriadnaIdioma_f`(var_id_act INT,var_idioma VARCHAR(2)) RETURNS text CHARSET latin1
       DETERMINISTIC
BEGIN
	DECLARE var_descr TEXT;
	DECLARE var_id INT;
	DECLARE var_pare INT;
	DECLARE var_retorn TEXT;

	SET var_retorn = '';
  inici: LOOP
SELECT getTitolByIdioma_f(id,var_idioma) as descr,id,menu_pare INTO var_descr,var_id,var_pare FROM menus WHERE id = var_id_act;
IF var_pare is not null AND var_pare > 0 THEN
	  SET var_id_act = var_pare;
	  SET var_pare = null;
	  SET var_retorn = CONCAT(var_descr, ' > ' ,var_retorn);
	  ITERATE inici;
END IF;
    LEAVE inici;
END LOOP inici;

RETURN var_retorn;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getFilAriadna_f` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `getFilAriadna_f`(var_id_act INT) RETURNS text CHARSET latin1
       DETERMINISTIC
BEGIN
	DECLARE var_descr TEXT;
	DECLARE var_id INT;
	DECLARE var_pare INT;
	DECLARE var_retorn TEXT;

	SET var_retorn = '';
  inici: LOOP
	SELECT titol,id,menu_pare INTO var_descr,var_id,var_pare FROM menus WHERE id = var_id_act;
    IF var_pare is not null AND var_pare > 0 THEN
	  SET var_id_act = var_pare;
	  SET var_pare = null;
	  SET var_retorn = CONCAT(var_descr, ' > ' ,var_retorn);
	  ITERATE inici;
    END IF;
    LEAVE inici;
  END LOOP inici;

RETURN var_retorn;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `GETIDSEO_F` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `GETIDSEO_F`(`id` INTEGER, `seoText` TEXT) RETURNS text CHARSET latin1
    NO SQL
    DETERMINISTIC
    SQL SECURITY INVOKER
BEGIN
DECLARE idSeo TEXT;

SET idSeo = CONCAT(id , '-',  LOWER(TRIM(seoText))) ;
SET idSeo = REPLACE(idSeo, '\'','-') ;
SET idSeo = REPLACE(idSeo, ',','-') ;
SET idSeo = REPLACE(idSeo, '.','-') ;
SET idSeo = REPLACE(idSeo, ':','-') ;
SET idSeo = REPLACE(idSeo, ';','-') ;
SET idSeo = REPLACE(idSeo, '_','-') ;
SET idSeo = REPLACE(idSeo, '"','-') ;
SET idSeo = REPLACE(idSeo, ' ','-') ;
SET idSeo = REPLACE(idSeo, ' ','-') ;

SET idSeo = REPLACE(idSeo, 'à','a') ;
SET idSeo = REPLACE(idSeo, 'è','e') ;
SET idSeo = REPLACE(idSeo, 'é','e') ;
SET idSeo = REPLACE(idSeo, 'í','i') ;
SET idSeo = REPLACE(idSeo, 'ï','i') ;
SET idSeo = REPLACE(idSeo, 'ò','o') ;
SET idSeo = REPLACE(idSeo, 'ó','o') ;
SET idSeo = REPLACE(idSeo, 'ú','u') ;
SET idSeo = REPLACE(idSeo, 'ü','u') ;
SET idSeo = REPLACE(idSeo, 'ñ','ny') ;
SET idSeo = REPLACE(idSeo, 'ç','c') ;
SET idSeo = REPLACE(idSeo, '/','-') ;
SET idSeo = REPLACE(idSeo, '%','-') ;

SET idSeo = REPLACE(idSeo, '--','-') ;

RETURN idSeo;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getImgFonsMenu_f` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `getImgFonsMenu_f`(var_id_contingut INT) RETURNS text CHARSET latin1
    DETERMINISTIC
BEGIN
	DECLARE var_img TEXT;
	DECLARE var_id INT;
	DECLARE var_pare INT;

  inici: LOOP
	SELECT img_fons,id,menu_pare INTO var_img,var_id,var_pare FROM menus WHERE id = var_id_contingut;
    IF var_img IS NOT NULL AND var_img != '' THEN
		RETURN var_img;
    END IF;
    IF var_pare is not null AND var_pare > 0 THEN
	  SET var_id_contingut = var_pare;
	  SET var_pare = null;
	  ITERATE inici;
    END IF;
    LEAVE inici;
  END LOOP inici;

RETURN '';
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getMenuArrelByMenu_f` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `getMenuArrelByMenu_f`(var_id_menu INT) RETURNS int(11)
    DETERMINISTIC
BEGIN
	DECLARE var_id INT;
	DECLARE var_pare INT;

  inici: LOOP
	SELECT id,menu_pare INTO var_id, var_pare FROM menus WHERE id = var_id_menu;
    IF var_pare is not null AND var_pare > 0 AND var_pare != var_id THEN
	  SET var_id_menu = var_pare;
	  SET var_pare = null;
      ITERATE inici;
    END IF;
    LEAVE inici;
  END LOOP inici;

RETURN var_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getMetaDescripcioByIdioma_f` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `getMetaDescripcioByIdioma_f`(var_id_menu  int, var_idioma VARCHAR(100)) RETURNS varchar(2000) CHARSET latin1
    DETERMINISTIC
BEGIN

	DECLARE var_result VARCHAR(2000);
    
 	SELECT meta_descripcio INTO var_result FROM menus_i18n WHERE id_menu = var_id_menu AND idioma = var_idioma;
    IF var_result is null THEN 
		SELECT meta_descripcio INTO var_result FROM menus WHERE id = var_id_menu;
	END IF;

RETURN var_result;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getTipusMenu_f` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `getTipusMenu_f`(var_id int) RETURNS int(11)
    DETERMINISTIC
BEGIN
	DECLARE var_resultat INT;
	SELECT 
		(CASE
			WHEN (`gestor` = 'enllac') THEN 2
			WHEN (`gestor` = 'menuCompartit') THEN 3
			WHEN (`gestor` = 'llistatDocuments') THEN 4
			WHEN (`gestor` = 'codi') THEN 6
			ELSE 1
		END) INTO var_resultat
	FROM menus 
	WHERE id = var_id 
    GROUP BY id;
RETURN var_resultat;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getTitolByIdioma_f` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `getTitolByIdioma_f`(var_id_menu  int, var_idioma VARCHAR(100)) RETURNS varchar(2000) CHARSET latin1
    DETERMINISTIC
BEGIN

	DECLARE var_titol VARCHAR(2000);
    
 	SELECT titol INTO var_titol FROM menus_i18n WHERE id_menu = var_id_menu AND idioma = var_idioma;
    IF var_titol is null THEN 
		SELECT titol INTO var_titol FROM menus WHERE id = var_id_menu;
	END IF;

RETURN var_titol;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `menuEsFill_f` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `menuEsFill_f`(var_id INT, var_id_pare TEXT) RETURNS int(11)
    DETERMINISTIC
BEGIN
    -- Retorna 1 si el var_id SI és descendent de var_id_pare
    -- Retorna 0 si el var_id NO és descendent de var_id_pare

    IF  FIND_IN_SET(var_id, var_id_pare) THEN
		RETURN 1;
	END IF;

	inici:LOOP
		select menu_pare INTO var_id FROM menus WHERE id = var_id;
		IF var_id = 0 OR var_id = null THEN
			RETURN 0;
		ELSEIF FIND_IN_SET(var_id, var_id_pare) THEN
			RETURN 1;
		END IF;
	END LOOP inici;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `teCssPag_f` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `teCssPag_f`(var_id_menu INT) RETURNS varchar(2000) CHARSET latin1
    DETERMINISTIC
BEGIN
	DECLARE loops INT;
	DECLARE var_csspag_orig varchar(2000);
    DECLARE var_csspag varchar(2000);
	DECLARE var_pare INT;

	SET loops = 0;
    
    -- busquem per l'id de menu si te csspag
	SELECT m.id,mv.valor INTO var_pare,var_csspag_orig
		FROM menus m 
	LEFT JOIN menus_vars mv ON m.id = mv.id_menu AND param = 'css_pag'
		WHERE m.id = var_id_menu ;
        
    -- si no en te el declarem buit    
	IF var_csspag_orig is null THEN
		SET var_csspag_orig = "";
	END IF;
    
    -- si tenim csspag o no té menus pare retornem el csspage
	IF var_csspag_orig != '' OR var_pare is null OR var_pare = 0  THEN
		RETURN var_csspag_orig;
	ELSE
		inici: LOOP
			-- loop de seguretat per evitar loop infinit
			SET loops = loops + 1;
            IF loops > 99 THEN
				return "";
			END IF;
			-- SELECT menu_pare,publicat INTO var_pare,var_publicat FROM menus WHERE id = var_pare  AND id != menu_pare;
            -- Mirem el menu pare si té csspag 
			SELECT m.menu_pare,mv.valor INTO var_pare,var_csspag
				FROM menus m 
			LEFT JOIN menus_vars mv ON m.id = mv.id_menu AND param = 'css_pag'
				WHERE m.id = var_pare AND
                m.id != menu_pare ;
            -- si csspag es diferent de res i de null retornem el css page
			IF var_csspag != ''  AND var_csspag is not null THEN
				return var_csspag;
			ELSEIF var_pare is not null AND var_pare != 0 THEN -- si te menus pare seguim buscant
				ITERATE inici;
			end if;	
			leave inici;
		END LOOP inici;
	end if;
	RETURN ""; -- si no em trobat cap css pag tornem valor en blanc
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `teDocumentsFills_f` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `teDocumentsFills_f`(var_menu numeric) RETURNS int(11)
    DETERMINISTIC
BEGIN
	DECLARE hihaFills numeric;
SELECT count(1) INTO hihaFills FROM documents WHERE menu_pare = var_menu AND data_baixa is null;
RETURN hihaFills > 0;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `TEFILLSAMBMENU_F` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `TEFILLSAMBMENU_F`(var_menu numeric) RETURNS int(11)
    DETERMINISTIC
BEGIN
	DECLARE hihaFills numeric;
SELECT count(1) INTO hihaFills FROM menus WHERE menu_pare = var_menu AND data_baixa is null AND publicat = 1;
RETURN hihaFills > 0;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `TEFILLSPUBLICATS_F` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `TEFILLSPUBLICATS_F`(var_menu numeric) RETURNS int(11)
    DETERMINISTIC
BEGIN
	DECLARE hihaFills numeric;
SELECT count(1) INTO hihaFills FROM menus WHERE menu_pare = var_menu AND (data_baixa < curdate() OR data_baixa is null) AND publicat > 0;
RETURN hihaFills > 0;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `teFills_f` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `teFills_f`(var_menu numeric) RETURNS int(11)
    DETERMINISTIC
BEGIN
	DECLARE hihaFills numeric;
SELECT count(1) INTO hihaFills FROM menus WHERE menu_pare = var_menu AND data_baixa is null;
RETURN hihaFills > 0;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `tePermisDocument_f` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `tePermisDocument_f`(var_id INT,var_id_principal TEXT) RETURNS int(11)
    DETERMINISTIC
BEGIN
-- Saber si l'id_contingut pertany a l'arbre de id_contingut_principal
	DECLARE var_pare INT;
	DECLARE var_trobat INT;
	SET var_trobat = 0;

    inici: LOOP
SELECT menu_pare INTO var_pare FROM documents WHERE id = var_id;
IF FIND_IN_SET(var_pare,var_id_principal) || FIND_IN_SET(var_id,var_id_principal)  THEN
			SET var_trobat = 2;
			LEAVE inici;
END IF;
        IF var_pare is null OR var_pare = 0 OR var_pare = var_id THEN
			LEAVE inici;
END IF;

        SET var_id = var_pare;
	    SET var_pare = null;
	    ITERATE inici;

END LOOP inici;
RETURN var_trobat;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `tePermisMenu_f` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `tePermisMenu_f`(var_id INT,var_id_principal TEXT) RETURNS int(11)
    DETERMINISTIC
BEGIN
-- Saber si l'id_contingut pertany a l'arbre de id_contingut_principal
	DECLARE var_pare INT;
	DECLARE var_trobat INT;
	SET var_trobat = 0;

    inici: LOOP
SELECT menu_pare INTO var_pare FROM menus WHERE id = var_id;
IF FIND_IN_SET(var_pare,var_id_principal) || FIND_IN_SET(var_id,var_id_principal)  THEN
			SET var_trobat = 1;
			LEAVE inici;
END IF;
        IF var_pare is null OR var_pare = 0 OR var_pare = var_id THEN
			LEAVE inici;
END IF;

        SET var_id = var_pare;
	    SET var_pare = null;
	    ITERATE inici;

END LOOP inici;
RETURN var_trobat;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `esborrarDocuments_p` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `esborrarDocuments_p`(var_id INT)
BEGIN
    DECLARE var_fills TEXT;
	DECLARE var_menu_pare INT;
    DECLARE var_ordre INT;

SELECT menu_pare INTO var_menu_pare FROM documents WHERE id = var_id;
SELECT MAX(ordre) INTO var_ordre FROM documents WHERE menu_pare = var_menu_pare;

UPDATE documents SET data_baixa = NOW(), ordre = var_ordre + 1  WHERE id = var_id;
SELECT GROUP_CONCAT(id) INTO var_fills FROM documents WHERE FIND_IN_SET(menu_pare, var_id);
inici: LOOP
		IF (var_fills is null) THEN
			leave INICI;
END IF;
UPDATE documents SET data_baixa = NOW() WHERE FIND_IN_SET(id, var_fills);
SELECT GROUP_CONCAT(id) INTO var_fills FROM documents WHERE FIND_IN_SET(menu_pare, var_fills);
END LOOP;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `esborrarDocument_p` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `esborrarDocument_p`(var_id INT)
BEGIN
    DECLARE var_fills TEXT;
	DECLARE var_menu_pare INT;
    DECLARE var_ordre INT;

SELECT menu_pare INTO var_menu_pare FROM documents WHERE id = var_id;
SELECT MAX(ordre) INTO var_ordre FROM documents WHERE menu_pare = var_menu_pare;

UPDATE documents SET data_baixa = NOW(), ordre = var_ordre + 1  WHERE id = var_id;
SELECT GROUP_CONCAT(id) INTO var_fills FROM documents WHERE FIND_IN_SET(menu_pare, var_id);
inici: LOOP
		IF (var_fills is null) THEN
			leave INICI;
END IF;
UPDATE documents SET data_baixa = NOW() WHERE FIND_IN_SET(id, var_fills);
SELECT GROUP_CONCAT(id) INTO var_fills FROM documents WHERE FIND_IN_SET(menu_pare, var_fills);
END LOOP;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `esborrarMenus_p` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `esborrarMenus_p`(var_id INT)
BEGIN
    DECLARE var_fills TEXT;
	DECLARE var_menu_pare INT;
    DECLARE var_ordre INT;

SELECT menu_pare INTO var_menu_pare FROM menus WHERE id = var_id;
SELECT MAX(ordre) INTO var_ordre FROM menus WHERE menu_pare = var_menu_pare;

UPDATE menus SET data_baixa = NOW(), ordre = var_ordre + 1  WHERE id = var_id;
SELECT GROUP_CONCAT(id) INTO var_fills FROM menus WHERE FIND_IN_SET(menu_pare, var_id);
inici: LOOP
		IF (var_fills is null) THEN
			leave INICI;
END IF;
UPDATE menus SET data_baixa = NOW() WHERE FIND_IN_SET(id, var_fills);
SELECT GROUP_CONCAT(id) INTO var_fills FROM menus WHERE FIND_IN_SET(menu_pare, var_fills);
END LOOP;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `ordenarDestacats_p` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `ordenarDestacats_p`(var_accio VARCHAR(1),var_ordre INT, var_id INT,var_idPare INT, var_tipus VARCHAR(2000))
BEGIN
    DECLARE var_ordreOrig INTEGER;
    DECLARE var_idPareOrig INTEGER;
    DECLARE var_ordreExist INTEGER;
    DECLARE var_tipusOrig VARCHAR(2000);

    -- segur que existeix, el busqeum nosaltres
	IF (var_accio = 'D') THEN
		-- Tipus esborrar(DELETE)
SELECT ordre,id_portal,tipus INTO var_ordreOrig,var_idPareOrig,var_tipusOrig FROM destacats WHERE id = var_id;
UPDATE destacats SET ordre = ordre - 1 WHERE ordre > var_ordreOrig AND id_portal = var_idPareOrig AND tipus = var_tipusOrig;
END IF;
        -- Mirem si la posicio exiteix
SELECT count(1) INTO var_ordreExist FROM destacats WHERE ordre = var_ordre AND id_portal = var_idPare AND tipus = var_tipus;
IF var_ordreExist > 0 THEN
		IF (var_accio = 'U') THEN
			-- Tipus actualitzar(UPDATE)

			-- Busquem posicio inicial
SELECT ordre INTO var_ordreOrig FROM destacats WHERE id = var_id;

IF (var_ordre > var_ordreOrig) THEN
				-- si hem mogut l'item per sota de la posicio incial pujem els items entre la posició original i la desti
UPDATE destacats SET ordre = ordre - 1 WHERE ordre > var_ordreOrig AND ordre <= var_ordre AND id_portal = var_idPare AND tipus = var_tipus;
ELSE
				-- si hem mogut l'item per sobre de la posicio incial baixem els items entre la posició original i la desti
UPDATE destacats SET ordre = ordre + 1 WHERE ordre < var_ordreOrig AND ordre >= var_ordre AND id_portal = var_idPare AND tipus = var_tipus;
END IF;
END IF;

		IF (var_accio = 'A') THEN
			-- tipus afegir(ADD)
UPDATE destacats SET ordre = ordre + 1 WHERE ordre >= var_ordre AND id_portal = var_idPare AND tipus = var_tipus;
END IF;
END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `ordenarDocuments_p` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `ordenarDocuments_p`(var_accio VARCHAR(1),var_ordre INT, var_id INT,var_idPare INT)
BEGIN
    DECLARE var_ordreOrig INTEGER;
    DECLARE var_idPareOrig INTEGER;
    DECLARE var_ordreExist INTEGER;

    -- segur que existeix, el busqeum nosaltres
	IF (var_accio = 'D') THEN
		-- Tipus esborrar(DELETE)
SELECT ordre,menu_pare INTO var_ordreOrig,var_idPareOrig FROM documents WHERE id = var_id;
UPDATE documents SET ordre = ordre - 1 WHERE ordre > var_ordreOrig AND menu_pare = var_idPareOrig;
END IF;
        -- Mirem si la posicio exiteix
SELECT count(1) INTO var_ordreExist FROM documents WHERE ordre = var_ordre AND menu_pare = var_idPare;
IF var_ordreExist > 0 THEN
		IF (var_accio = 'U') THEN
			-- Tipus actualitzar(UPDATE)

			-- Busquem posicio inicial
SELECT ordre INTO var_ordreOrig FROM documents WHERE id = var_id;

IF (var_ordre > var_ordreOrig) THEN
				-- si hem mogut l'item per sota de la posicio incial pujem els items entre la posició original i la desti
UPDATE documents SET ordre = ordre - 1 WHERE ordre > var_ordreOrig AND ordre <= var_ordre AND menu_pare = var_idPare ;
ELSE
				-- si hem mogut l'item per sobre de la posicio incial baixem els items entre la posició original i la desti
UPDATE documents SET ordre = ordre + 1 WHERE ordre < var_ordreOrig AND ordre >= var_ordre AND menu_pare = var_idPare ;
END IF;
END IF;

		IF (var_accio = 'A') THEN
			-- tipus afegir(ADD)
UPDATE documents SET ordre = ordre + 1 WHERE ordre >= var_ordre AND menu_pare = var_idPare;
END IF;
END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `ordenarMenusDocuments_p` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `ordenarMenusDocuments_p`(var_accio VARCHAR(1),var_ordre INT, var_id INT,var_idPare INT, var_tipus VARCHAR(2000))
BEGIN
    DECLARE var_ordreOrig INTEGER;
    DECLARE var_idPareOrig INTEGER;
    DECLARE var_ordreExist INTEGER;
    DECLARE var_tipusOrig VARCHAR(2000);

    -- segur que existeix, el busqeum nosaltres
	IF (var_accio = 'D') THEN
		-- Tipus esborrar(DELETE)
SELECT ordre,id_menu,tipus INTO var_ordreOrig,var_idPareOrig,var_tipusOrig FROM menus_documents WHERE id = var_id;
UPDATE menus_documents SET ordre = ordre - 1 WHERE ordre > var_ordreOrig AND id_menu = var_idPareOrig AND tipus = var_tipusOrig;
END IF;
        -- Mirem si la posicio exiteix
SELECT count(1) INTO var_ordreExist FROM menus_documents WHERE ordre = var_ordre AND id_menu = var_idPare AND tipus = var_tipus;
IF var_ordreExist > 0 THEN
		IF (var_accio = 'U') THEN
			-- Tipus actualitzar(UPDATE)

			-- Busquem posicio inicial
SELECT ordre INTO var_ordreOrig FROM menus_documents WHERE id = var_id;

IF (var_ordre > var_ordreOrig) THEN
				-- si hem mogut l'item per sota de la posicio incial pujem els items entre la posició original i la desti
UPDATE menus_documents SET ordre = ordre - 1 WHERE ordre > var_ordreOrig AND ordre <= var_ordre AND id_menu = var_idPare AND tipus = var_tipus;
ELSE
				-- si hem mogut l'item per sobre de la posicio incial baixem els items entre la posició original i la desti
UPDATE menus_documents SET ordre = ordre + 1 WHERE ordre < var_ordreOrig AND ordre >= var_ordre AND id_menu = var_idPare AND tipus = var_tipus;
END IF;
END IF;

		IF (var_accio = 'A') THEN
			-- tipus afegir(ADD)
UPDATE menus_documents SET ordre = ordre + 1 WHERE ordre >= var_ordre AND id_menu = var_idPare AND tipus = var_tipus;
END IF;
END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `ordenarMenus_p` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `ordenarMenus_p`(var_accio VARCHAR(1),var_ordre INT, var_id INT,var_idPare INT)
BEGIN
    DECLARE var_ordreOrig INTEGER;
    DECLARE var_idPareOrig INTEGER;
    DECLARE var_ordreExist INTEGER;

    -- segur que existeix, el busqeum nosaltres
	IF (var_accio = 'D') THEN
		-- Tipus esborrar(DELETE)
SELECT ordre,menu_pare INTO var_ordreOrig,var_idPareOrig FROM menus WHERE id = var_id;
UPDATE menus SET ordre = ordre - 1 WHERE ordre > var_ordreOrig AND menu_pare = var_idPareOrig;
END IF;
        -- Mirem si la posicio exiteix
SELECT count(1) INTO var_ordreExist FROM menus WHERE ordre = var_ordre AND menu_pare = var_idPare;
IF var_ordreExist > 0 THEN
		IF (var_accio = 'U') THEN
			-- Tipus actualitzar(UPDATE)

			-- Busquem posicio inicial
SELECT ordre INTO var_ordreOrig FROM menus WHERE id = var_id;

IF (var_ordre > var_ordreOrig) THEN
				-- si hem mogut l'item per sota de la posicio incial pujem els items entre la posició original i la desti
UPDATE menus SET ordre = ordre - 1 WHERE ordre > var_ordreOrig AND ordre <= var_ordre AND menu_pare = var_idPare ;
ELSE
				-- si hem mogut l'item per sobre de la posicio incial baixem els items entre la posició original i la desti
UPDATE menus SET ordre = ordre + 1 WHERE ordre < var_ordreOrig AND ordre >= var_ordre AND menu_pare = var_idPare ;
END IF;
END IF;

		IF (var_accio = 'A') THEN
			-- tipus afegir(ADD)
UPDATE menus SET ordre = ordre + 1 WHERE ordre >= var_ordre AND menu_pare = var_idPare;
END IF;
END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `revisarAllFills_p` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `revisarAllFills_p`()
BEGIN
	DECLARE var_id INT;
    
	DECLARE done INT DEFAULT FALSE;
	DECLARE cur CURSOR FOR SELECT id FROM menus;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
    
OPEN cur;
read_loop: LOOP
	FETCH cur INTO var_id;
	CALL revisarFills_p(var_id);
	IF done THEN
		LEAVE read_loop;
	END IF;
END LOOP;       
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `revisarFills_p` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `revisarFills_p`(var_id_menu INT)
BEGIN
	IF (var_id_menu > 0 ) THEN
		UPDATE menus SET teFillsPublicats = teFillsPublicats_f(var_id_menu), teFillsAmbMenu = teFillsAmbMenu_f(var_id_menu) WHERE id = var_id_menu;
	END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `getMenuForFills2_v`
--

/*!50001 DROP VIEW IF EXISTS `getMenuForFills2_v`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `getMenuForFills2_v` AS select `m`.`id` AS `id`,`m`.`id_portal` AS `id_portal`,`GETIDSEO_F`(`m`.`id`,`m`.`titol`) AS `idseo`,`m`.`titol` AS `titol`,(case when (`m`.`gestor` = 'enllac') then 2 when (`m`.`gestor` = 'menuCompartit') then 3 when (`m`.`gestor` = 'llistatDocuments') then 4 when (`m`.`gestor` = 'codi') then 6 else 1 end) AS `tipus`,`m`.`publicat` AS `publicat`,if((`m`.`gestor` = 'enllac'),`m`.`url`,'') AS `url`,if((`m`.`gestor` = 'enllac'),`m`.`enllac_extern`,0) AS `enllac_extern`,`m`.`img` AS `img_abs`,`m`.`alt_img` AS `alt_img`,`m`.`desc_llarga_img` AS `desc_llarga_img`,substring_index(`m`.`img`,'/',-(1)) AS `img`,`TEFILLSPUBLICATS_F`(`m`.`id`) AS `te_fills`,`TEFILLSAMBMENU_F`(`m`.`id`) AS `te_fills_amb_menu`,`m`.`descripcio` AS `descripcio`,`m`.`ordre` AS `ordre`,`m`.`menu_pare` AS `menu_pare` from `menus` `m` where isnull(`m`.`data_baixa`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `getMenuForFills_v`
--

/*!50001 DROP VIEW IF EXISTS `getMenuForFills_v`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `getMenuForFills_v` AS select `m`.`id` AS `id`,`GETIDSEO_F`(`m`.`id`,`m`.`titol`) AS `idseo`,`m`.`titol` AS `titol`,(case when (`m`.`gestor` = 'enllac') then 2 when (`m`.`gestor` = 'menuCompartit') then 3 when (`m`.`gestor` = 'llistatDocuments') then 4 when (`m`.`gestor` = 'codi') then 6 else 1 end) AS `tipus`,`m`.`publicat` AS `publicat`,if((`m`.`gestor` = 'enllac'),`m`.`url`,'') AS `url`,if((`m`.`gestor` = 'enllac'),`m`.`enllac_extern`,0) AS `enllac_extern`,`m`.`img` AS `img_abs`,substring_index(`m`.`img`,'/',-(1)) AS `img`,`TEFILLSPUBLICATS_F`(`m`.`id`) AS `te_fills`,`TEFILLSAMBMENU_F`(`m`.`id`) AS `te_fills_amb_menu`,max((case when (`mv`.`param` = 'data') then `mv`.`valor` else NULL end)) AS `data`,max((case when (`mv`.`param` = 'horari') then `mv`.`valor` else NULL end)) AS `horari`,max((case when (`mv`.`param` = 'adreca') then `mv`.`valor` else NULL end)) AS `adreca`,max((case when (`mv`.`param` = 'preu') then `mv`.`valor` else NULL end)) AS `preu`,`m`.`descripcio` AS `descripcio`,`m`.`ordre` AS `ordre`,`m`.`menu_pare` AS `menu_pare` from (`menus` `m` left join `menus_vars` `mv` on((`m`.`id` = `mv`.`id_menu`))) where isnull(`m`.`data_baixa`) group by `m`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `getPortalsByUrl_v`
--

/*!50001 DROP VIEW IF EXISTS `getPortalsByUrl_v`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `getPortalsByUrl_v` AS select `h`.`id_portal` AS `id`,`h`.`url` AS `url`,`h`.`sufix` AS `sufix`,`h`.`prova` AS `prova`,'definit a vars' AS `dir_templates`,`p`.`id_menu_principal` AS `id_menu_principal`,'definit a vars' AS `max_tabs`,`p`.`actiu` AS `actiu`,`p`.`web_dir` AS `web_dir`,`h`.`tipus` AS `hostTipus`,if((`pi`.`meta_descripcio` is not null),`pi`.`meta_descripcio`,`p`.`meta_description`) AS `meta_description`,`h`.`idioma` AS `idioma`,(select concat(`hosts`.`url`,'/',`hosts`.`sufix`) from `hosts` where ((`hosts`.`id_portal` = `h`.`id_portal`) and (`hosts`.`principal` = 1) and (`hosts`.`idioma` = `h`.`idioma`)) limit 1) AS `url_canonical` from ((`portals` `p` join `hosts` `h` on((`p`.`id` = `h`.`id_portal`))) left join `portals_i18n` `pi` on(((`p`.`id` = `pi`.`id_portal`) and (`h`.`idioma` = `pi`.`idioma`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-09-18 13:54:02
