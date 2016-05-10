-- MySQL dump 10.13  Distrib 5.5.44, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: innomaid
-- ------------------------------------------------------
-- Server version	5.5.44-0ubuntu0.14.04.1

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

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,1),(3,1),(4,1),(9,1),(10,1),(11,1),(13,1),(14,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(25,1),(29,1),(30,1),(31,1),(32,1),(33,1),(39,1),(47,1),(49,1),(50,1),(54,1),(55,1),(59,1),(63,1),(64,1),(65,1),(70,1),(72,1),(1,2),(3,2),(4,2),(9,2),(10,2),(11,2),(13,2),(14,2),(17,2),(18,2),(19,2),(20,2),(21,2),(22,2),(23,2),(39,2),(47,2),(50,2),(54,2),(59,2),(63,2),(64,2),(65,2),(72,2),(1,3),(4,3),(9,3),(10,3),(11,3),(13,3),(14,3),(19,3),(20,3),(47,3),(50,3),(54,3),(1,4),(4,4),(50,4),(54,4),(56,4),(58,4),(1,5),(3,5),(4,5),(1,6),(3,6),(10,6),(58,6),(61,6),(1,7),(3,7),(4,7),(9,7),(10,7),(58,7),(61,7),(11,8),(13,8),(14,8),(47,8),(1,9),(3,9),(4,9),(9,9),(10,9),(11,9),(13,9),(14,9),(17,9),(18,9),(19,9),(20,9),(21,9),(22,9),(23,9),(25,9),(29,9),(30,9),(31,9),(32,9),(33,9),(39,9),(47,9),(49,9),(50,9),(54,9),(55,9),(59,9),(63,9),(64,9),(65,9),(70,9),(72,9),(73,9),(74,9),(75,9),(76,9),(77,9),(78,9),(79,9),(80,9),(81,9),(82,9);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-22  7:46:03
