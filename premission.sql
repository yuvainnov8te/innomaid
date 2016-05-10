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
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `agency_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'fdws.index','Fdws Listing','To show fdws list','2015-10-22 23:41:00','2015-12-16 09:12:50',NULL),(3,'fdws.edit','Fdws Edit','To Edit the fdws details','2015-12-07 12:19:42','2015-12-07 12:19:42',1),(4,'fdws.create','Fdws Create','To create fdw profile','2015-12-08 04:36:43','2015-12-08 04:36:43',1),(9,'sentinel.fdws.delete','Fdws Delete','To delete fdw profile','2015-12-11 04:48:11','2015-12-11 04:52:28',1),(10,'sentinel.fdws.show','Fdws Show PDF','To create PDF of fdws','2015-12-11 04:58:26','2015-12-11 04:58:26',1),(11,'sentinel.users.create','User Create','To create user profile','2015-12-11 05:00:54','2015-12-11 05:00:54',1),(13,'users.edit','User Edit','to edit user detail ','2015-12-11 05:04:57','2015-12-11 05:04:57',1),(14,'users.delete','User Delete','to delete a users from list','2015-12-11 05:07:30','2015-12-17 09:41:17',1),(17,'sentinel.profile.update','Profile Update','To update Profile of user ','2015-12-11 05:20:02','2015-12-11 05:20:02',1),(18,'sentinel.profile.show','Profile Show','to show profile of user','2015-12-11 05:23:40','2015-12-11 05:23:40',1),(19,'employer.delete','Employer Delete','to delete employer ','2015-12-11 05:28:04','2015-12-11 05:28:04',1),(20,'employer.show','Employer Show','To create PDF of employers','2015-12-11 05:30:02','2015-12-11 05:30:02',1),(21,'servicefees.delete','Servicefee Delete','to delete Service Fee','2015-12-11 05:33:50','2015-12-11 05:33:50',1),(22,'servicefees.show','Servicefee Show','To create PDF of service fee','2015-12-11 05:35:55','2015-12-11 05:35:55',1),(23,'servicefees.index','Servicefee Listing','To show service fees list','2015-12-11 05:40:50','2015-12-17 09:40:52',1),(24,'permission.edit','Permission Edit','To edit permission','2015-12-11 05:42:31','2015-12-11 05:52:18',1),(25,'page.edit','Page Edit','To edit  Page','2015-12-11 05:48:06','2015-12-11 05:48:06',1),(26,'permission.create','Permission Create ','To create permission','2015-12-11 05:52:14','2015-12-11 05:52:14',1),(27,'permission.index','Permission Listing','To list permissions','2015-12-11 05:53:07','2015-12-11 05:53:07',1),(28,'sentinel.permission.delete','Permission Delete','to delete permission','2015-12-11 05:55:12','2015-12-11 05:55:12',1),(29,'role.index','Role Listing','To show role list','2015-12-11 05:57:27','2015-12-11 05:57:27',1),(30,'role.create','Role Create','To create role','2015-12-11 05:58:18','2015-12-11 05:58:18',1),(31,'role.edit','Role Edit','To edit role','2015-12-11 06:00:00','2015-12-11 06:00:00',1),(32,'role.delete','Role Delete','To Delete role','2015-12-11 06:00:38','2015-12-11 06:00:38',1),(33,'sentinel.role.permissions','Role Permission','To edit permission for role','2015-12-11 06:03:27','2015-12-11 06:03:27',1),(39,'sentinel.password.change','User Password Change','To change user password','2015-12-15 14:13:56','2015-12-16 11:47:44',1),(47,'users.index','User Listing','to list users','2015-12-11 05:07:30','2015-12-17 09:42:07',1),(49,'page.index','Page Listing','To show page list','2015-10-22 23:41:00','2015-12-05 12:05:55',NULL),(50,'employer.index','Employer Listing','To show Employers list','2015-10-22 23:41:00','2015-12-17 09:40:28',NULL),(54,'employer.create','Employer Create','To create employer','2015-12-11 05:30:02','2015-12-17 09:41:40',1),(55,'page.create','Page Create','To create page','2015-12-11 05:30:02','2015-12-11 05:30:02',1),(59,'servicefees.edit','Servicefee Edit','','2015-12-15 14:17:50','2015-12-15 14:17:50',1),(63,'employer.edit','Employer Edit','To edit of employers','2015-12-11 05:30:02','2015-12-11 05:30:02',1),(64,'service.index','Service Listing','to show services List','2015-12-15 14:17:50','2015-12-17 09:42:41',1),(65,'service.edit','Service Edit','To edit service','2015-12-15 14:17:50','2015-12-15 14:17:50',1),(70,'servicefees.create','Servicefee Create','To create service fee','2015-12-11 05:35:55','2015-12-11 05:35:55',1),(72,'service.create','Service Create','To create service','2015-12-11 05:35:55','2015-12-11 05:35:55',1),(73,'template.create','Template Create','To create Forms Template','2016-01-06 05:11:46','2016-01-06 05:23:38',1),(74,'sentinel.template.delete','Template Delete','To delete Forms Template','2016-01-06 05:14:19','2016-01-06 05:14:19',1),(75,'template.edit','Template Edit','To edit Forms Template','2016-01-06 05:15:27','2016-01-06 05:15:27',1),(76,'sentinel.agreementform.edit','Agreement Form Edit','To edit Agreementform','2016-01-06 05:17:20','2016-01-06 05:17:20',1),(77,'template.index','Template List','To list Forms Templates','2016-01-06 05:18:37','2016-01-06 05:18:37',1),(78,'agreementform.index','Agreement Form List','To list Agreementforms','2016-01-06 05:20:01','2016-01-06 05:20:01',1),(79,'application.index','Maid Application Listing','Show listing for maid application','2016-01-27 10:51:58','2016-01-27 10:51:58',1),(80,'application.create','Maid Application Create','To create maid application','2016-01-27 10:53:11','2016-01-27 10:53:11',1),(81,'application.edit','Maid Application Edit','To edit maid application','2016-01-27 10:55:35','2016-01-27 10:55:35',1),(82,'sentinel.application.delete','Maid Application Delete','To delete maid application','2016-01-27 10:56:14','2016-01-27 10:56:14',1);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-22  7:45:43
