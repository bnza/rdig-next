
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `app_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_users` (
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `roles` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ROLE_USER',
  `attempts` smallint(6) NOT NULL DEFAULT '0',
  `uuid` char(36) CHARACTER SET ascii NOT NULL,
  PRIMARY KEY (`uuid`),
  UNIQUE KEY `UNIQ_C2502824F85E0677` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site` int(11) NOT NULL,
  `code` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D7943D6877153098694309E4` (`code`,`site`),
  UNIQUE KEY `UNIQ_D7943D685E237E06694309E4` (`name`,`site`),
  KEY `IDX_D7943D68694309E4` (`site`),
  CONSTRAINT `FK_D7943D68694309E4` FOREIGN KEY (`site`) REFERENCES `site` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=900 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `bucket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bucket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign` int(11) NOT NULL,
  `context` int(11) NOT NULL,
  `type` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `num` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_E73F36A61F1512DDDC43AF6E` (`campaign`,`num`),
  KEY `IDX_E73F36A61F1512DD` (`campaign`),
  KEY `IDX_E73F36A6E25D857E` (`context`),
  CONSTRAINT `FK_E73F36A61F1512DD` FOREIGN KEY (`campaign`) REFERENCES `campaign` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `FK_E73F36A6E25D857E` FOREIGN KEY (`context`) REFERENCES `context` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=30490 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `campaign`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site` int(11) NOT NULL,
  `year` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1F1512DD694309E4BB827337` (`site`,`year`),
  KEY `IDX_1F1512DD694309E4` (`site`),
  CONSTRAINT `FK_1F1512DD694309E4` FOREIGN KEY (`site`) REFERENCES `site` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `context`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `context` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site` int(11) NOT NULL,
  `area` int(11) NOT NULL,
  `type` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `num` int(10) unsigned NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `chronology` int(11) DEFAULT NULL,
  `c_type` smallint(5) unsigned DEFAULT NULL,
  `phase` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_E25D857EDC43AF6E694309E4` (`num`,`site`),
  KEY `IDX_E25D857E694309E4` (`site`),
  KEY `IDX_E25D857ED7943D68` (`area`),
  KEY `IDX_E25D857EB5E820B0` (`chronology`),
  KEY `IDX_E25D857EB1BDD6CB` (`phase`),
  CONSTRAINT `FK_E25D857E694309E4` FOREIGN KEY (`site`) REFERENCES `site` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `FK_E25D857EB1BDD6CB` FOREIGN KEY (`phase`) REFERENCES `phase` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `FK_E25D857EB5E820B0` FOREIGN KEY (`chronology`) REFERENCES `voc__f__chronology` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `FK_E25D857ED7943D68` FOREIGN KEY (`area`) REFERENCES `area` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=24593 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `finding`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `finding` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bucket` int(11) NOT NULL,
  `chronology` int(11) DEFAULT NULL,
  `num` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` longtext COLLATE utf8mb4_unicode_ci,
  `discr` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_A7191336E73F36A64AD26064DC43AF6E` (`bucket`,`discr`,`num`),
  KEY `IDX_A7191336E73F36A6` (`bucket`),
  KEY `IDX_A7191336B5E820B0` (`chronology`),
  CONSTRAINT `FK_A7191336B5E820B0` FOREIGN KEY (`chronology`) REFERENCES `voc__f__chronology` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `FK_A7191336E73F36A6` FOREIGN KEY (`bucket`) REFERENCES `bucket` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=200183 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `object`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `object` (
  `id` int(11) NOT NULL,
  `class` int(11) DEFAULT NULL,
  `material_class` int(11) DEFAULT NULL,
  `material_type` int(11) DEFAULT NULL,
  `technique` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `color` int(11) DEFAULT NULL,
  `preservation` int(11) DEFAULT NULL,
  `decoration` int(11) DEFAULT NULL,
  `no` int(11) DEFAULT NULL,
  `height` double DEFAULT NULL,
  `length` double DEFAULT NULL,
  `width` double DEFAULT NULL,
  `thickness` double DEFAULT NULL,
  `diameter` double DEFAULT NULL,
  `perforation_diameter` double DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `sub_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `retrieval_date` date DEFAULT NULL,
  `inscription` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `conservation_year` smallint(6) DEFAULT NULL,
  `fragments` int(11) DEFAULT NULL,
  `coord_n` double DEFAULT NULL,
  `coord_e` double DEFAULT NULL,
  `coord_z` double DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `drawing` tinyint(1) DEFAULT NULL,
  `photo` tinyint(1) DEFAULT NULL,
  `envanterlik` tinyint(1) DEFAULT NULL,
  `etutluk` tinyint(1) DEFAULT NULL,
  `campaign` int(11) NOT NULL,
  `duplicate` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_A8ADABEC1F1512DD67AA281F1247811B` (`campaign`,`no`,`duplicate`),
  KEY `IDX_A8ADABECED4B199F` (`class`),
  KEY `IDX_A8ADABECBBACB5D1` (`material_class`),
  KEY `IDX_A8ADABECD8B63A1C` (`material_type`),
  KEY `IDX_A8ADABECD73B9841` (`technique`),
  KEY `IDX_A8ADABEC8CDE5729` (`type`),
  KEY `IDX_A8ADABEC665648E9` (`color`),
  KEY `IDX_A8ADABEC76D0BF22` (`preservation`),
  KEY `IDX_A8ADABEC7649DA7` (`decoration`),
  KEY `IDX_A8ADABEC1F1512DD` (`campaign`),
  CONSTRAINT `FK_A8ADABEC1F1512DD` FOREIGN KEY (`campaign`) REFERENCES `campaign` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `FK_A8ADABEC665648E9` FOREIGN KEY (`color`) REFERENCES `voc__f__color` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `FK_A8ADABEC7649DA7` FOREIGN KEY (`decoration`) REFERENCES `voc__o__decoration` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `FK_A8ADABEC76D0BF22` FOREIGN KEY (`preservation`) REFERENCES `voc__o__preservation` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `FK_A8ADABEC8CDE5729` FOREIGN KEY (`type`) REFERENCES `voc__o__type` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `FK_A8ADABECBBACB5D1` FOREIGN KEY (`material_class`) REFERENCES `voc__o__material_class` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `FK_A8ADABECBF396750` FOREIGN KEY (`id`) REFERENCES `finding` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_A8ADABECD73B9841` FOREIGN KEY (`technique`) REFERENCES `voc__o__technique` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `FK_A8ADABECD8B63A1C` FOREIGN KEY (`material_type`) REFERENCES `voc__o__material_type` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `FK_A8ADABECED4B199F` FOREIGN KEY (`class`) REFERENCES `voc__o__class` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `phase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_B1BDD6CB694309E45E237E06` (`site`,`name`),
  KEY `IDX_B1BDD6CB694309E4` (`site`),
  CONSTRAINT `FK_B1BDD6CB694309E4` FOREIGN KEY (`site`) REFERENCES `site` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `pottery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pottery` (
  `id` int(11) NOT NULL,
  `class` int(11) DEFAULT NULL,
  `core_color` int(11) DEFAULT NULL,
  `firing` int(11) DEFAULT NULL,
  `inclusions_frequency` int(11) DEFAULT NULL,
  `inclusions_size` int(11) DEFAULT NULL,
  `inclusions_type_id` int(11) DEFAULT NULL,
  `inner_color` int(11) DEFAULT NULL,
  `inner_decoration` int(11) DEFAULT NULL,
  `inner_surface_treatment` int(11) DEFAULT NULL,
  `outer_color` int(11) DEFAULT NULL,
  `outer_surface_treatment` int(11) DEFAULT NULL,
  `preservation` int(11) DEFAULT NULL,
  `shape` int(11) DEFAULT NULL,
  `technique` int(11) DEFAULT NULL,
  `base_diameter` double DEFAULT NULL,
  `base_height` double DEFAULT NULL,
  `base_width` double DEFAULT NULL,
  `height` double DEFAULT NULL,
  `max_wall_diameter` double DEFAULT NULL,
  `rim_diameter` double DEFAULT NULL,
  `rim_width` double DEFAULT NULL,
  `wall_width` double DEFAULT NULL,
  `drawing_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `restored` tinyint(1) DEFAULT NULL,
  `envanterlik` tinyint(1) DEFAULT NULL,
  `etutluk` tinyint(1) DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1A651839ED4B199F` (`class`),
  KEY `IDX_1A65183930D76909` (`core_color`),
  KEY `IDX_1A65183955D572B2` (`firing`),
  KEY `IDX_1A6518395BF07BE7` (`inclusions_frequency`),
  KEY `IDX_1A6518396B40B2A2` (`inclusions_size`),
  KEY `IDX_1A6518399053E54B` (`inclusions_type_id`),
  KEY `IDX_1A651839A5C11DAF` (`inner_color`),
  KEY `IDX_1A651839348FE526` (`inner_decoration`),
  KEY `IDX_1A6518396E8C188F` (`inner_surface_treatment`),
  KEY `IDX_1A651839ABD4651C` (`outer_color`),
  KEY `IDX_1A6518392058B113` (`outer_surface_treatment`),
  KEY `IDX_1A65183976D0BF22` (`preservation`),
  KEY `IDX_1A651839DD30FFD8` (`shape`),
  KEY `IDX_1A651839D73B9841` (`technique`),
  CONSTRAINT `FK_1A6518392058B113` FOREIGN KEY (`outer_surface_treatment`) REFERENCES `voc__p__surface_treatment` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `FK_1A65183930D76909` FOREIGN KEY (`core_color`) REFERENCES `voc__f__color` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `FK_1A651839348FE526` FOREIGN KEY (`inner_decoration`) REFERENCES `voc__p__decoration` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `FK_1A65183955D572B2` FOREIGN KEY (`firing`) REFERENCES `voc__p__firing` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `FK_1A6518395BF07BE7` FOREIGN KEY (`inclusions_frequency`) REFERENCES `voc__p__inclusions_frequency` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `FK_1A6518396B40B2A2` FOREIGN KEY (`inclusions_size`) REFERENCES `voc__p__inclusions_size` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `FK_1A6518396E8C188F` FOREIGN KEY (`inner_surface_treatment`) REFERENCES `voc__p__surface_treatment` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `FK_1A65183976D0BF22` FOREIGN KEY (`preservation`) REFERENCES `voc__p__preservation` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `FK_1A6518399053E54B` FOREIGN KEY (`inclusions_type_id`) REFERENCES `voc__p__inclusions_type` (`id`),
  CONSTRAINT `FK_1A651839A5C11DAF` FOREIGN KEY (`inner_color`) REFERENCES `voc__f__color` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `FK_1A651839ABD4651C` FOREIGN KEY (`outer_color`) REFERENCES `voc__f__color` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `FK_1A651839BF396750` FOREIGN KEY (`id`) REFERENCES `finding` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_1A651839D73B9841` FOREIGN KEY (`technique`) REFERENCES `voc__p__technique` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `FK_1A651839DD30FFD8` FOREIGN KEY (`shape`) REFERENCES `voc__p__shape` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `FK_1A651839ED4B199F` FOREIGN KEY (`class`) REFERENCES `voc__p__class` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `sample`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sample` (
  `id` int(11) NOT NULL,
  `type` int(11) DEFAULT NULL,
  `no` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `campaign` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F10B76C31F1512DD67AA281F` (`campaign`,`no`),
  KEY `IDX_F10B76C38CDE5729` (`type`),
  KEY `IDX_F10B76C31F1512DD` (`campaign`),
  CONSTRAINT `FK_F10B76C31F1512DD` FOREIGN KEY (`campaign`) REFERENCES `campaign` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `FK_F10B76C38CDE5729` FOREIGN KEY (`type`) REFERENCES `voc__s__type` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `FK_F10B76C3BF396750` FOREIGN KEY (`id`) REFERENCES `finding` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `site`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_694309E477153098` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `users_allowed_sites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_allowed_sites` (
  `site_id` int(11) NOT NULL,
  `user_uuid` char(36) CHARACTER SET ascii NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_694309E477153098` (`user_uuid`,`site_id`),
  KEY `IDX_7644B8B6F6BD1646` (`site_id`),
  CONSTRAINT `FK_7644B8B6A76ED395` FOREIGN KEY (`user_uuid`) REFERENCES `app_users` (`uuid`) ON DELETE CASCADE,
  CONSTRAINT `FK_7644B8B6F6BD1646` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `voc__f__chronology`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voc__f__chronology` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F3B243301D775834` (`value`)
) ENGINE=InnoDB AUTO_INCREMENT=461 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `voc__f__color`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voc__f__color` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_FDD4804D1D775834` (`value`)
) ENGINE=InnoDB AUTO_INCREMENT=2881 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `voc__o__class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voc__o__class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_6986CA101D775834` (`value`)
) ENGINE=InnoDB AUTO_INCREMENT=351 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `voc__o__decoration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voc__o__decoration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_C6ABF4CF1D775834` (`value`)
) ENGINE=InnoDB AUTO_INCREMENT=236 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `voc__o__material_class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voc__o__material_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_A239A3351D775834` (`value`)
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `voc__o__material_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voc__o__material_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2196AF8A1D775834` (`value`)
) ENGINE=InnoDB AUTO_INCREMENT=556 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `voc__o__preservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voc__o__preservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_EF9A46BE1D775834` (`value`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `voc__o__technique`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voc__o__technique` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_794F5B7F1D775834` (`value`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `voc__o__type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voc__o__type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_FF4C063A1D775834` (`value`)
) ENGINE=InnoDB AUTO_INCREMENT=2592 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `voc__p__class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voc__p__class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_CC1DE9971D775834` (`value`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `voc__p__decoration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voc__p__decoration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_55DC87201D775834` (`value`)
) ENGINE=InnoDB AUTO_INCREMENT=772 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `voc__p__firing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voc__p__firing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_5B2FAC701D775834` (`value`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `voc__p__inclusions_frequency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voc__p__inclusions_frequency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D79E94FC1D775834` (`value`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `voc__p__inclusions_size`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voc__p__inclusions_size` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_14E2F9A51D775834` (`value`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `voc__p__inclusions_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voc__p__inclusions_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_6FFC8AE61D775834` (`value`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `voc__p__preservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voc__p__preservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_FF701A6C1D775834` (`value`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `voc__p__shape`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voc__p__shape` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_FC660FD01D775834` (`value`)
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `voc__p__surface_treatment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voc__p__surface_treatment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_B449A6991D775834` (`value`)
) ENGINE=InnoDB AUTO_INCREMENT=584 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `voc__p__technique`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voc__p__technique` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_7C329F21D775834` (`value`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `voc__s__type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voc__s__type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_5F32F0801D775834` (`value`)
) ENGINE=InnoDB AUTO_INCREMENT=168 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `vw_finding`;
/*!50001 DROP VIEW IF EXISTS `vw_finding`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vw_finding` AS SELECT 
 1 AS `id`,
 1 AS `bucket`,
 1 AS `num`,
 1 AS `remarks`,
 1 AS `discr`,
 1 AS `chronology`,
 1 AS `no`*/;
SET character_set_client = @saved_cs_client;


/*!50001 DROP VIEW IF EXISTS `vw_finding`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`rdig_dev`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_finding` AS select `finding`.`id` AS `id`,`finding`.`bucket` AS `bucket`,`finding`.`num` AS `num`,`finding`.`remarks` AS `remarks`,`finding`.`discr` AS `discr`,`finding`.`chronology` AS `chronology`,(case `finding`.`discr` when 'O' then `object`.`no` when 'S' then `sample`.`no` else `finding`.`num` end) AS `no` from ((`finding` left join `object` on((`finding`.`id` = `object`.`id`))) left join `sample` on((`finding`.`id` = `sample`.`id`))) */;
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

