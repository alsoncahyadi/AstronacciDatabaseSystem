-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: localhost    Database: ads
-- ------------------------------------------------------
-- Server version	5.7.20-0ubuntu0.16.04.1

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
-- Table structure for table `aclub_informations`
--

DROP TABLE IF EXISTS `aclub_informations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aclub_informations` (
  `master_id` int(10) unsigned NOT NULL,
  `sumber_data` text COLLATE utf8_unicode_ci,
  `keterangan` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  PRIMARY KEY (`master_id`),
  CONSTRAINT `aclub_informations_master_id_foreign` FOREIGN KEY (`master_id`) REFERENCES `master_clients` (`master_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aclub_informations`
--

LOCK TABLES `aclub_informations` WRITE;
/*!40000 ALTER TABLE `aclub_informations` DISABLE KEYS */;
INSERT INTO `aclub_informations` VALUES (999999,'-','-','2017-12-11 21:11:57','2017-12-11 21:11:57',999,999),(1000004,'Tristian Terry','-','2017-12-11 21:11:57','2017-12-11 21:11:57',999,999),(1000011,'Destinee Batz','-','2017-12-11 21:11:56','2017-12-11 21:11:56',999,999),(1000012,'Brittany Watsica','-','2017-12-11 21:11:56','2017-12-11 21:11:56',999,999),(1000025,'Cristian Torphy','-','2017-12-11 21:11:56','2017-12-11 21:11:56',999,999),(1000028,'Izabella Anderson','-','2017-12-11 21:11:57','2017-12-11 21:11:57',999,999),(1000030,'Prof. Maynard Langworth','-','2017-12-11 21:11:56','2017-12-11 21:11:56',999,999),(1000037,'Brooklyn Ratke III','-','2017-12-11 21:11:56','2017-12-11 21:11:56',999,999),(1000044,'Yessenia Hahn','-','2017-12-11 21:11:57','2017-12-11 21:11:57',999,999),(1000046,'Miss Alexandrine Hand DDS','-','2017-12-11 21:11:56','2017-12-11 21:11:56',999,999),(1000049,'Alf Kozey','-','2017-12-11 21:11:57','2017-12-11 21:11:57',999,999);
/*!40000 ALTER TABLE `aclub_informations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aclub_members`
--

DROP TABLE IF EXISTS `aclub_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aclub_members` (
  `user_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `master_id` int(10) unsigned NOT NULL,
  `group` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `aclub_members_master_id_foreign` (`master_id`),
  CONSTRAINT `aclub_members_master_id_foreign` FOREIGN KEY (`master_id`) REFERENCES `master_clients` (`master_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aclub_members`
--

LOCK TABLES `aclub_members` WRITE;
/*!40000 ALTER TABLE `aclub_members` DISABLE KEYS */;
INSERT INTO `aclub_members` VALUES ('123',1000025,'Stock','2017-12-11 21:11:57','2017-12-11 21:11:57',999,999),('197',1000037,'Stock','2018-02-06 11:44:04','2017-12-11 21:11:57',999,999),('276',1000030,'Stock','2017-12-11 21:11:57','2017-12-11 21:11:57',999,999),('298',999999,'Stock','2017-12-11 21:11:57','2017-12-11 21:11:57',999,999),('371',1000044,'Stock','2017-12-11 21:11:57','2017-12-11 21:11:57',999,999),('483',1000037,'Stock','2017-12-11 21:11:57','2017-12-11 21:11:57',999,999),('548',1000037,'Stock','2017-12-11 21:11:57','2017-12-11 21:11:57',999,999),('661',1000004,'Stock','2017-12-11 21:11:57','2017-12-11 21:11:57',999,999),('929',1000011,'Stock','2017-12-11 21:11:57','2017-12-11 21:11:57',999,999),('999999',999999,'Stock','2018-02-06 11:43:01','2017-12-11 21:11:57',999,999);
/*!40000 ALTER TABLE `aclub_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aclub_transactions`
--

DROP TABLE IF EXISTS `aclub_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aclub_transactions` (
  `transaction_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `payment_date` date DEFAULT NULL,
  `kode` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nominal` bigint(20) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `masa_tenggang` date DEFAULT NULL,
  `yellow_zone` date DEFAULT NULL,
  `red_zone` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sales_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  PRIMARY KEY (`transaction_id`),
  KEY `aclub_transactions_user_id_foreign` (`user_id`),
  CONSTRAINT `aclub_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `aclub_members` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aclub_transactions`
--

LOCK TABLES `aclub_transactions` WRITE;
/*!40000 ALTER TABLE `aclub_transactions` DISABLE KEYS */;
INSERT INTO `aclub_transactions` VALUES (1,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','2018-01-24','1970-02-01','1970-02-01','2017-12-11 21:11:57','2018-01-12 07:37:22','1970-02-01 00:00:00',999,999),(2,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:57','2017-12-11 21:11:57','1970-02-01 00:00:00',999,999),(3,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:57','2017-12-11 21:11:57','1970-02-01 00:00:00',999,999),(4,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:58','2017-12-11 21:11:58','1970-02-01 00:00:00',999,999),(5,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:58','2017-12-11 21:11:58','1970-02-01 00:00:00',999,999),(6,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:58','2017-12-11 21:11:58','1970-02-01 00:00:00',999,999),(7,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:58','2017-12-11 21:11:58','1970-02-01 00:00:00',999,999),(8,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:58','2017-12-11 21:11:58','1970-02-01 00:00:00',999,999),(9,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:58','2017-12-11 21:11:58','1970-02-01 00:00:00',999,999),(10,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:58','2017-12-11 21:11:58','1970-02-01 00:00:00',999,999),(11,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:58','2017-12-11 21:11:58','1970-02-01 00:00:00',999,999),(12,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:58','2017-12-11 21:11:58','1970-02-01 00:00:00',999,999),(13,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:58','2017-12-11 21:11:58','1970-02-01 00:00:00',999,999),(14,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:58','2017-12-11 21:11:58','1970-02-01 00:00:00',999,999),(15,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:58','2017-12-11 21:11:58','1970-02-01 00:00:00',999,999),(16,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:58','2017-12-11 21:11:58','1970-02-01 00:00:00',999,999),(17,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:58','2017-12-11 21:11:58','1970-02-01 00:00:00',999,999),(18,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:58','2017-12-11 21:11:58','1970-02-01 00:00:00',999,999),(19,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:58','2017-12-11 21:11:58','1970-02-01 00:00:00',999,999),(20,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:58','2017-12-11 21:11:58','1970-02-01 00:00:00',999,999),(21,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:58','2017-12-11 21:11:58','1970-02-01 00:00:00',999,999),(22,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:58','2017-12-11 21:11:58','1970-02-01 00:00:00',999,999),(23,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:58','2017-12-11 21:11:58','1970-02-01 00:00:00',999,999),(24,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:58','2017-12-11 21:11:58','1970-02-01 00:00:00',999,999),(25,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:58','2017-12-11 21:11:58','1970-02-01 00:00:00',999,999),(26,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:58','2017-12-11 21:11:58','1970-02-01 00:00:00',999,999),(27,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:59','2017-12-11 21:11:59','1970-02-01 00:00:00',999,999),(28,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:59','2017-12-11 21:11:59','1970-02-01 00:00:00',999,999),(29,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:59','2017-12-11 21:11:59','1970-02-01 00:00:00',999,999),(30,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:59','2017-12-11 21:11:59','1970-02-01 00:00:00',999,999),(31,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:59','2017-12-11 21:11:59','1970-02-01 00:00:00',999,999),(32,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:59','2017-12-11 21:11:59','1970-02-01 00:00:00',999,999),(33,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:59','2017-12-11 21:11:59','1970-02-01 00:00:00',999,999),(34,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:59','2017-12-11 21:11:59','1970-02-01 00:00:00',999,999),(35,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:59','2017-12-11 21:11:59','1970-02-01 00:00:00',999,999),(36,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:59','2017-12-11 21:11:59','1970-02-01 00:00:00',999,999),(37,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:59','2017-12-11 21:11:59','1970-02-01 00:00:00',999,999),(38,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:59','2017-12-11 21:11:59','1970-02-01 00:00:00',999,999),(39,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:59','2017-12-11 21:11:59','1970-02-01 00:00:00',999,999),(40,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:59','2017-12-11 21:11:59','1970-02-01 00:00:00',999,999),(41,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:59','2017-12-11 21:11:59','1970-02-01 00:00:00',999,999),(42,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:59','2017-12-11 21:11:59','1970-02-01 00:00:00',999,999),(43,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:59','2017-12-11 21:11:59','1970-02-01 00:00:00',999,999),(44,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:59','2017-12-11 21:11:59','1970-02-01 00:00:00',999,999),(45,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:59','2017-12-11 21:11:59','1970-02-01 00:00:00',999,999),(46,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:59','2017-12-11 21:11:59','1970-02-01 00:00:00',999,999),(47,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:59','2017-12-11 21:11:59','1970-02-01 00:00:00',999,999),(48,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:59','2017-12-11 21:11:59','1970-02-01 00:00:00',999,999),(49,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:59','2017-12-11 21:11:59','1970-02-01 00:00:00',999,999),(50,'999999','1970-02-01','XX','XX',0,'1970-02-01','1970-02-01','1970-02-01','1970-02-01','1970-02-01','2017-12-11 21:11:59','2017-12-11 21:11:59','1970-02-01 00:00:00',999,999),(51,'661','2017-12-15','SS','Baru',890000,'2018-04-29','2018-04-29','2018-05-11','2018-04-29','2018-04-29','2017-12-11 21:11:59','2018-01-12 07:37:22','Demarcus Macejkovic',999,999),(52,'197','2017-12-31','SS','Tidak Aktif',390000,'2018-04-18','2018-04-18','2018-04-30','2018-04-18','2018-04-18','2017-12-11 21:12:00','2018-01-12 07:37:22','Nathen Schmeler',999,999),(53,'276','2017-12-23','SS','Perpanjang',100000,'2018-05-08','2018-05-08','2018-05-20','2018-05-08','2018-05-08','2017-12-11 21:12:00','2018-01-12 07:37:22','Tomas Miller',999,999),(54,'123','2018-01-05','SS','Perpanjang',190000,'2018-05-10','2018-05-10','2017-12-13','2018-05-10','2018-05-10','2017-12-11 21:12:00','2018-01-12 07:37:22','Dewitt Morar',999,999),(55,'371','2017-12-16','SS','Baru',520000,'2018-04-13','2018-04-13','2018-04-25','2018-04-13','2018-04-13','2017-12-11 21:12:00','2018-01-12 07:37:22','Kenyon Heathcote',999,999),(56,'483','2017-12-27','SS','Baru',450000,'2018-05-10','2018-05-10','2018-05-22','2018-05-10','2018-05-10','2017-12-11 21:12:00','2018-01-12 07:37:22','Kieran Hane',999,999),(57,'548','2017-12-18','SS','Baru',240000,'2018-04-18','2018-04-18','2018-04-30','2018-04-18','2018-04-18','2017-12-11 21:12:00','2018-01-12 07:37:22','Kaylie Raynor',999,999),(58,'298','2017-12-17','SS','Baru',500000,'2018-04-20','2018-04-20','2018-05-02','2018-04-20','2018-04-20','2017-12-11 21:12:00','2018-01-12 07:37:22','Mrs. Ora Krajcik',999,999),(59,'929','2017-12-31','SS','Baru',810000,'2018-04-24','2018-04-24','2018-05-06','2018-04-24','2018-04-24','2017-12-11 21:12:00','2018-01-12 07:37:22','Miss Delphia Parker I',999,999);
/*!40000 ALTER TABLE `aclub_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ashop_transactions`
--

DROP TABLE IF EXISTS `ashop_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ashop_transactions` (
  `transaction_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `master_id` int(10) unsigned NOT NULL,
  `product_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nominal` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  PRIMARY KEY (`transaction_id`),
  KEY `ashop_transactions_master_id_foreign` (`master_id`),
  CONSTRAINT `ashop_transactions_master_id_foreign` FOREIGN KEY (`master_id`) REFERENCES `master_clients` (`master_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ashop_transactions`
--

LOCK TABLES `ashop_transactions` WRITE;
/*!40000 ALTER TABLE `ashop_transactions` DISABLE KEYS */;
INSERT INTO `ashop_transactions` VALUES (1,1000023,'Video','Product85',740000,'2017-12-11 21:11:55','2017-12-11 21:11:55',999,999),(2,1000001,'Event','Product99',700000,'2017-12-11 21:11:55','2017-12-11 21:11:55',999,999),(3,1000042,'Others','Product32',70000,'2017-12-11 21:11:55','2017-12-11 21:11:55',999,999),(4,999999,'Seasonal Report','Product53',590000,'2017-12-11 21:11:55','2017-12-11 21:11:55',999,999),(5,1000019,'Seasonal Report','Product60',790000,'2017-12-11 21:11:55','2017-12-11 21:11:55',999,999),(6,1000029,'E-Book','Product4',960000,'2017-12-11 21:11:55','2017-12-11 21:11:55',999,999),(7,1000018,'Seasonal Report','Product37',860000,'2017-12-11 21:11:55','2017-12-11 21:11:55',999,999),(8,1000027,'Event','Product62',920000,'2017-12-11 21:11:56','2017-12-11 21:11:56',999,999),(9,1000041,'Video','Product34',210000,'2017-12-11 21:11:56','2017-12-11 21:11:56',999,999),(10,1000038,'E-Book','Product17',40000,'2017-12-11 21:11:56','2017-12-11 21:11:56',999,999),(11,1000007,'Others','Product15',450000,'2017-12-11 21:11:56','2017-12-11 21:11:56',999,999),(12,1000002,'Others','Product13',140000,'2017-12-11 21:11:56','2017-12-11 21:11:56',999,999),(13,1000031,'E-Book','Product5',610000,'2017-12-11 21:11:56','2017-12-11 21:11:56',999,999),(14,1000033,'Event','Product75',90000,'2017-12-11 21:11:56','2017-12-11 21:11:56',999,999),(15,1000006,'E-Book','Product35',450000,'2017-12-11 21:11:56','2017-12-11 21:11:56',999,999),(16,1000000,'Video','Product14',780000,'2017-12-11 21:11:56','2017-12-11 21:11:56',999,999),(17,1000021,'Others','Product3',80000,'2017-12-11 21:11:56','2017-12-11 21:11:56',999,999),(18,1000036,'Event','Product65',100000,'2017-12-11 21:11:56','2017-12-11 21:11:56',999,999),(19,1000003,'E-Book','Product49',0,'2017-12-11 21:11:56','2017-12-11 21:11:56',999,999),(20,1000043,'Video','Product9',760000,'2017-12-11 21:11:56','2017-12-11 21:11:56',999,999);
/*!40000 ALTER TABLE `ashop_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cats`
--

DROP TABLE IF EXISTS `cats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cats` (
  `user_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nomor_induk` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `master_id` int(10) unsigned NOT NULL,
  `batch` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sales_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sumber_data` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DP_date` date DEFAULT NULL,
  `DP_nominal` bigint(20) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_nominal` bigint(20) DEFAULT NULL,
  `tanggal_opening_class` date DEFAULT NULL,
  `tanggal_end_class` date DEFAULT NULL,
  `tanggal_ujian` date DEFAULT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `cats_nomor_induk_unique` (`nomor_induk`),
  KEY `cats_master_id_foreign` (`master_id`),
  CONSTRAINT `cats_master_id_foreign` FOREIGN KEY (`master_id`) REFERENCES `master_clients` (`master_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cats`
--

LOCK TABLES `cats` WRITE;
/*!40000 ALTER TABLE `cats` DISABLE KEYS */;
INSERT INTO `cats` VALUES ('123123','123123',1000031,'2','643632523','234241','2017-12-09',12365124,'0000-00-00',123123123123,'2017-12-18','2017-12-13','2017-12-21','sdfasdf','asdfadfs','2017-12-11 21:15:33','2017-12-11 21:17:25',0,0),('18801','Greta Simonis',1000026,'2','Corine Hettinger I','-','2017-12-13',0,'2017-12-29',0,'2017-12-25','2017-12-28','2018-01-03','-','-','2017-12-11 21:11:46','2017-12-11 21:11:46',999,999),('19888','Okey Cummerata',1000043,'4','Prof. Stephen Ullrich V','-','2017-12-29',0,'2017-12-25',0,'2018-01-03','2018-01-09','2017-12-17','-','-','2017-12-11 21:11:47','2017-12-11 21:11:47',999,999),('26415','Retta Larson',1000043,'1','Maryse Cartwright','-','2018-01-06',0,'2018-01-03',0,'2018-01-08','2017-12-22','2017-12-27','-','-','2017-12-11 21:11:47','2017-12-11 21:11:47',999,999),('28337','Zackary Shanahan DVM',1000015,'3','Mrs. Noemie Goyette','-','2017-12-28',0,'2017-12-24',0,'2017-12-30','2018-01-10','2018-01-08','-','-','2017-12-11 21:11:46','2017-12-11 21:11:46',999,999),('30658','Zachariah Littel',1000003,'6','Chloe Flatley','-','2017-12-29',0,'2017-12-22',0,'2018-01-04','2017-12-23','2017-12-20','-','-','2017-12-11 21:11:47','2017-12-11 21:11:47',999,999),('31708','Erica Price',1000043,'0','Jerel Okuneva Jr.','-','2017-12-12',0,'2017-12-23',0,'2017-12-14','2017-12-22','2017-12-31','-','-','2017-12-11 21:11:46','2017-12-11 21:11:46',999,999),('32783','Nikolas Bergstrom',1000016,'6','Javier Paucek','-','2017-12-28',0,'2018-01-03',0,'2018-01-05','2017-12-17','2018-01-09','-','-','2017-12-11 21:11:46','2017-12-11 21:11:46',999,999),('44633','Monte Jenkins',1000004,'5','Prof. Annabel Gerlach','-','2017-12-14',0,'2017-12-26',0,'2017-12-24','2017-12-23','2018-01-03','-','-','2017-12-11 21:11:46','2017-12-11 21:11:46',999,999),('45730','Dr. Aniya Thiel II',1000001,'1','Virginie Bednar','-','2017-12-19',0,'2018-01-08',0,'2017-12-26','2017-12-15','2018-01-07','-','-','2017-12-11 21:11:46','2017-12-11 21:11:46',999,999),('48882','Mr. Bobbie Ankunding DVM',1000033,'6','Mrs. Kaci Treutel DDS','-','2017-12-13',0,'2017-12-22',0,'2017-12-14','2017-12-21','2017-12-17','-','-','2017-12-11 21:11:46','2017-12-11 21:11:46',999,999),('52637','Dr. Jensen Graham',999999,'8','Lambert Swift','-','2017-12-20',0,'2017-12-14',0,'2017-12-21','2017-12-31','2017-12-17','-','-','2017-12-11 21:11:47','2017-12-11 21:11:47',999,999),('58893','Arturo Stamm',1000038,'3','Katharina Abbott','-','2017-12-29',0,'2018-01-10',0,'2018-01-11','2017-12-31','2018-01-03','-','-','2017-12-11 21:11:47','2017-12-11 21:11:47',999,999),('60832','Prof. Jazmyn Homenick',1000021,'5','Oma Gaylord','-','2018-01-07',0,'2017-12-14',0,'2017-12-13','2018-01-02','2017-12-26','-','-','2017-12-11 21:11:46','2017-12-11 21:11:46',999,999),('61406','Gabriella Buckridge',1000035,'9','Dewayne Leuschke DVM','-','2017-12-25',0,'2017-12-19',0,'2017-12-17','2018-01-03','2017-12-23','-','-','2017-12-11 21:11:47','2017-12-11 21:11:47',999,999),('6160','Myrtice Russel',1000002,'0','Sunny Gerlach II','-','2017-12-22',0,'2017-12-26',0,'2017-12-31','2017-12-17','2017-12-21','-','-','2017-12-11 21:11:47','2017-12-11 21:11:47',999,999),('67564','Caitlyn Haag',1000042,'4','Mallie Satterfield','-','2017-12-18',0,'2018-01-01',0,'2017-12-22','2017-12-31','2017-12-14','-','-','2017-12-11 21:11:47','2017-12-11 21:11:47',999,999),('78337','Arnold McCullough',1000023,'8','Kianna Weber','-','2017-12-17',0,'2017-12-25',0,'2017-12-17','2017-12-30','2017-12-18','-','-','2017-12-11 21:11:46','2017-12-11 21:11:46',999,999),('81412','Theodora Dooley',1000021,'4','Dane O\'Hara','-','2017-12-12',0,'2017-12-27',0,'2017-12-25','2017-12-24','2017-12-16','-','-','2017-12-11 21:11:46','2017-12-11 21:11:46',999,999),('83780','Lula Cartwright DVM',1000019,'9','Shayna Satterfield','-','2017-12-13',0,'2017-12-30',0,'2017-12-13','2017-12-12','2017-12-28','-','-','2017-12-11 21:11:46','2017-12-11 21:11:46',999,999),('94487','Melba Adams',1000044,'2','Vernie Mitchell','-','2017-12-18',0,'2018-01-05',0,'2017-12-22','2018-01-06','2018-01-01','-','-','2018-02-06 11:49:55','2017-12-11 21:11:46',999,999);
/*!40000 ALTER TABLE `cats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `green_prospect_clients`
--

DROP TABLE IF EXISTS `green_prospect_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `green_prospect_clients` (
  `green_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `interest` text COLLATE utf8_unicode_ci,
  `pemberi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sumber_data` text COLLATE utf8_unicode_ci,
  `keterangan_perintah` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  PRIMARY KEY (`green_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `green_prospect_clients`
--

LOCK TABLES `green_prospect_clients` WRITE;
/*!40000 ALTER TABLE `green_prospect_clients` DISABLE KEYS */;
INSERT INTO `green_prospect_clients` VALUES (5,'2018-01-10','Dr. Melvin Kerluke MD','(510) 214-8277 x59682','wcronin@example.com','Interest61','Mr. Obie Vandervort','Ms. Darby Jenkins DVM','keterangan_perintah3','2017-12-11 21:12:00','2017-12-11 21:12:00',999,999),(6,'2018-01-01','Lempi Kohler','+1-895-424-2841','fiona.wiegand@example.com','Interest35','Prof. Alvah Leannon','Dr. Florine Weissnat I','keterangan_perintah44','2017-12-11 21:12:00','2017-12-11 21:12:00',999,999),(13,'2018-01-10','Sister Oberbrunner II','(615) 434-1692','rwilkinson@example.org','Interest39','Miss Queen Kuhn','Dr. Gina Abshire','keterangan_perintah32','2017-12-11 21:12:01','2017-12-11 21:12:01',999,999),(14,'2017-12-23','Jarrell Funk','+1.881.558.9209','zpurdy@example.org','Interest93','Chelsea Boehm IV','Arno Schimmel','keterangan_perintah93','2017-12-11 21:12:01','2017-12-11 21:12:01',999,999),(18,'2017-12-28','Bonita Dietrich','(249) 826-1654','glover.luis@example.net','Interest48','Santiago Lockman','Dr. Carley Goldner','keterangan_perintah71','2017-12-11 21:12:01','2017-12-11 21:12:01',999,999);
/*!40000 ALTER TABLE `green_prospect_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `green_prospect_progresses`
--

DROP TABLE IF EXISTS `green_prospect_progresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `green_prospect_progresses` (
  `progress_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `green_id` int(10) unsigned NOT NULL,
  `date` date DEFAULT NULL,
  `sales_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nama_product` text COLLATE utf8_unicode_ci,
  `nominal` bigint(20) DEFAULT NULL,
  `keterangan` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  PRIMARY KEY (`progress_id`),
  KEY `green_prospect_progresses_green_id_foreign` (`green_id`),
  CONSTRAINT `green_prospect_progresses_green_id_foreign` FOREIGN KEY (`green_id`) REFERENCES `green_prospect_clients` (`green_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `green_prospect_progresses`
--

LOCK TABLES `green_prospect_progresses` WRITE;
/*!40000 ALTER TABLE `green_prospect_progresses` DISABLE KEYS */;
INSERT INTO `green_prospect_progresses` VALUES (1,14,'2017-12-12','Eliezer Jerde','GOAL-JOIN','CAT',490000,'-','2017-12-11 21:12:01','2017-12-11 21:12:01',999,999),(3,18,'2018-01-10','Prof. Keira Weimann','TIDAK GOAL','A-Club',370000,'-','2017-12-11 21:12:02','2017-12-11 21:12:02',999,999),(4,13,'2017-12-30','Lorenz Blanda','DALAM PROSES','A-Club',950000,'-','2017-12-11 21:12:02','2017-12-11 21:12:02',999,999),(5,6,'2018-01-09','April Pagac','NO ANSWER','CAT',240000,'-','2017-12-11 21:12:02','2017-12-11 21:12:02',999,999);
/*!40000 ALTER TABLE `green_prospect_progresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_clients`
--

DROP TABLE IF EXISTS `master_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_clients` (
  `master_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `redclub_user_id` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `redclub_password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telephone_number` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birthdate` date DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `province` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `line_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bbm` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  PRIMARY KEY (`master_id`),
  UNIQUE KEY `master_clients_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=1000050 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_clients`
--

LOCK TABLES `master_clients` WRITE;
/*!40000 ALTER TABLE `master_clients` DISABLE KEYS */;
INSERT INTO `master_clients` VALUES (999999,'999999','password','MAGIC_SEED','999999','super@seed.com','1970-02-01','address999','city999','province999','g','line_id999','bbm999','whatsapp999','facebook999','2017-12-11 21:11:42','2017-12-11 21:11:42',999,999),(1000000,'4697621','password','Arne','614.623.3139 x36279','khalil.watsica@example.com','1937-03-16','7867 Spencer Plains\nRunolfsdottirfurt, NC 28728','73207 Tobin Squares Apt. 231\nTedbury, WI 34888-4110','730 Kozey Ports Suite 393\nElinormouth, WA 42319','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:43','2017-12-11 21:11:43',999,999),(1000001,'988','password','Barton','986.275.3338','rgislason@example.net','1983-11-05','85898 Mosciski Dale Suite 482\nPort Johnnieport, UT 27465','72547 Crooks Causeway Suite 243\nEast Stanford, WY 00209-6221','6694 Jonatan Squares\nFrancescaland, AL 72139','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:43','2017-12-11 21:11:43',999,999),(1000002,'826247690','password','Esteban','+13357152880','irving.corkery@example.com','1976-10-15','5978 Kreiger Rue Suite 331\nAbernathyton, KY 12290-4938','686 Hansen Parkway\nArvillaview, ND 16196','234 Howe Courts Apt. 068\nPietroburgh, MI 49645','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:43','2017-12-11 21:11:43',999,999),(1000003,'39','password','Lester','+1-846-320-3039','kjohnson@example.net','2009-04-29','499 Ankunding Field\nEast Josephberg, MI 97600','172 Jazlyn Orchard Apt. 882\nZanderhaven, AZ 11901','402 Rebeca Passage\nPacochaport, ID 27567-7192','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:43','2017-12-11 21:11:43',999,999),(1000004,'35121820','password','Emory','1-216-368-1755 x7002','lockman.wilma@example.net','1985-12-26','6676 Roma Lodge Apt. 705\nKyleefurt, NV 26856','504 Pollich Drive Suite 637\nWellingtonville, AK 86953','311 Isom Mission Suite 113\nPort Mabellefort, AZ 40465-4378','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:43','2017-12-11 21:11:43',999,999),(1000005,'581319709','password','Emerson','+14508751445','sean54@example.com','1941-09-03','9480 Buckridge Views\nCaseyburgh, UT 90685','390 Michale Lights\nLizethchester, ND 11342-9569','656 Moises Crossing\nSouth Cicero, NY 28662','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:43','2017-12-11 21:11:43',999,999),(1000006,'129','password','Obie','+1-687-246-7977','ypadberg@example.org','1945-04-01','5978 Rosetta Station\nWest Destinee, NH 10131','4059 Vincent Terrace Apt. 777\nWest Otis, GA 89381','1271 Remington Fork Apt. 494\nEast Leraport, AR 85831-3842','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:43','2017-12-11 21:11:43',999,999),(1000007,'14265','password','Ernesto','1-201-960-4417','christophe.goodwin@example.net','1939-06-13','221 Carter Orchard\nNew Karson, AZ 92954-1426','2323 Leilani Road Apt. 736\nNorth Sallieville, RI 40044','99552 Koss Manor\nNew Hertha, OK 64176','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:43','2017-12-11 21:11:43',999,999),(1000008,'8458165','password','Kayden','436.971.6174 x5881','craig.weimann@example.com','1947-04-03','4405 Bruen Manors Suite 466\nAdamsshire, PA 30109','4507 Rosie Parks Suite 531\nIrmachester, AK 60611','466 Arturo Flat\nSouth Sigridville, MA 21341','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:43','2017-12-11 21:11:43',999,999),(1000009,'345','password','Ayden','+17806404274','wyman.rebeka@example.com','2006-06-01','437 Kuhlman Drive\nNorth Maiafort, AK 65610-2781','151 Keyshawn Mews Suite 649\nSouth Addisonshire, NC 07370','2336 Duane Circles\nNorth Hailieborough, NC 73159-1681','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:43','2017-12-11 21:11:43',999,999),(1000010,'418','password','Chad','487-564-4824','murl42@example.org','1967-04-30','8267 Renner Circle Apt. 966\nDickiport, MN 55219-2679','66037 Kirlin Roads Suite 009\nKundeville, MI 96455-5340','10700 Olson Junctions Apt. 847\nSouth Stanfordbury, MI 11231-9372','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:43','2017-12-11 21:11:43',999,999),(1000011,'84','password','Barrett','1-834-629-5324 x15019','mekhi.yundt@example.net','2007-05-26','238 O\'Kon Tunnel Apt. 397\nSchmidtfort, CA 13112-9947','8838 Senger Route Apt. 466\nHarveyview, PA 62753','15323 Breitenberg Plains Suite 190\nLake Romainetown, DE 90754-1771','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:43','2017-12-11 21:11:43',999,999),(1000012,'58','password','Kieran','(387) 482-8364','zaria72@example.net','1950-10-28','2895 Hansen Springs\nNew Jorgeland, WI 21059-2246','506 Johnson Centers Suite 315\nSouth Francisview, UT 17227','1340 Myra Springs Apt. 898\nJastport, VT 44868-1918','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:43','2017-12-11 21:11:43',999,999),(1000013,'46','password','Mervin','(339) 869-6946 x232','grady.garrett@example.org','1987-11-18','278 Corwin Unions\nCrooksshire, AZ 27119-1956','885 Goodwin Knolls Apt. 780\nWittingmouth, IA 47030','4888 Mitchel Common Apt. 582\nNew Ryderview, VT 37729','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:43','2017-12-11 21:11:43',999,999),(1000014,'2654209','password','Vito','760-962-3328 x7559','maurice.hegmann@example.com','1944-02-18','8424 Eichmann Parks Apt. 116\nPort Camrenmouth, UT 05256-9459','27191 Bell Coves\nSouth Carlottaland, NY 98354-5897','167 Stacy Inlet\nShawnport, TN 19147','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:43','2017-12-11 21:11:43',999,999),(1000015,'94','password','Arturo','1-998-228-2493','amya64@example.org','1935-11-25','29930 Myah Cliff\nKertzmannmouth, OK 19378','7647 Price Trail\nKiehnberg, HI 86511','5909 DuBuque Lock Suite 118\nLake Brayanburgh, IN 74867','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:43','2017-12-11 21:11:43',999,999),(1000016,'98','password','Rex','1-290-590-5118','anya77@example.org','1950-03-22','6814 Gaston Wells Suite 514\nRippinbury, NM 84065','4989 Torp Square Suite 372\nNorth Marielaside, DE 38572-3474','84010 Hermiston Spur Suite 161\nNew Adalineville, PA 06863-2101','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:43','2017-12-11 21:11:43',999,999),(1000017,'39766087','password','Jaleel','1-758-253-0638 x291','vschaden@example.net','1957-06-22','80320 Russel Turnpike\nElroyview, OK 88763-0433','12030 Marian Curve Apt. 709\nEast Evieshire, AZ 49002','73993 Abraham Knoll\nEast Dustyside, OH 08651-5333','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:44','2017-12-11 21:11:44',999,999),(1000018,'29982','password','Gideon','750-348-3382','isom96@example.org','2015-11-01','6394 Paucek Haven\nEast Lorena, KS 99156','700 Retta Villages Suite 029\nLake Julio, NM 62925-6566','5649 Ernser Passage Apt. 578\nNorth Crystal, NM 71450-8901','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:44','2017-12-11 21:11:44',999,999),(1000019,'94','password','Seamus','1-863-753-4759','alison.rau@example.com','2015-07-26','522 Wintheiser Village\nSouth Gillianville, MI 41165','35893 Brenna Run Apt. 983\nKeelingmouth, NV 68328','28144 Eleazar Freeway Suite 252\nKirlinhaven, SD 13685-5018','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:44','2017-12-11 21:11:44',999,999),(1000020,'0','password','Enrico','681-750-6884','aferry@example.net','1970-06-24','912 Howell Keys Suite 139\nMartinamouth, NE 57660-9245','466 Heller Valleys\nEast Anthonyville, WY 91830-2476','4882 Jennifer Valleys Suite 643\nSouth Glenda, IN 23709','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:44','2017-12-11 21:11:44',999,999),(1000021,'52216325','password','Kurtis','+1-870-816-4779','mitchell.kristin@example.net','1929-04-11','1382 Minerva Cape Apt. 428\nChamplinborough, VT 13702','3674 Dibbert Turnpike\nValentinburgh, HI 51053-4935','3732 Von Trace\nPort Eleanorechester, WI 98897','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:44','2017-12-11 21:11:44',999,999),(1000022,'92','password','Justen','(653) 572-7592 x59372','amelia02@example.net','1968-03-06','365 Webster Highway Suite 592\nMackland, SC 39688-8192','4001 Lang Creek Suite 109\nJovanborough, VT 48766-8625','14886 Conn Trace Apt. 548\nThoraburgh, ND 80671','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:44','2017-12-11 21:11:44',999,999),(1000023,'200760212','password','Rex','663-785-5217','hazel36@example.org','1952-10-12','525 Sylvester Station\nHomenickshire, AZ 51076-2465','154 Alva Burgs Apt. 386\nClaudineton, IL 24839','55513 Geraldine Vista\nDockland, HI 49798-1713','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:44','2017-12-11 21:11:44',999,999),(1000024,'173466','password','Demario','+1.476.452.2541','hessel.yasmine@example.net','1933-09-05','645 Ella Summit\nWest Kayley, TN 21169-2540','460 Kirsten Stream\nGleasonside, LA 55120-2298','195 Bruen Fords\nBauchchester, RI 47377-0856','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:44','2017-12-11 21:11:44',999,999),(1000025,'537','password','Rocio','440-365-3951 x1099','markus.buckridge@example.org','1930-05-29','975 Barrows Harbors Apt. 096\nPort Jayne, OR 78609','3448 Orval Shoal Apt. 747\nPort Elisabethport, CT 69302','124 Larissa Creek\nWest Yazminport, PA 06067','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:44','2017-12-11 21:11:44',999,999),(1000026,'30','password','Jaleel','782-301-2905 x02287','wbode@example.net','1930-11-16','39503 Freeman Lake Suite 066\nJonastown, IA 99787','502 Koepp Branch Apt. 797\nEast Patriciaborough, OK 93927-3950','5191 Rafaela Estate\nNew Lempiside, DC 71014-9129','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:44','2017-12-11 21:11:44',999,999),(1000027,'4637','password','Kane','527.466.3631 x2742','kwhite@example.com','2007-02-02','24109 Windler Station Suite 145\nHuelfurt, UT 75635','370 Jast Land Apt. 630\nNorth Amanifort, DE 42702','9963 Leola Forge\nMortonmouth, MS 76959','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:44','2017-12-11 21:11:44',999,999),(1000028,'17873','password','Chauncey','(634) 746-0648','kiehn.maxime@example.net','1927-10-18','4721 Buddy Circle Apt. 798\nSouth Olaf, NH 74585','948 Alisa Shoals Suite 857\nSouth Eltonfort, IA 51456-1243','1276 Sheldon Port\nWalshshire, AK 62333-1474','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:44','2017-12-11 21:11:44',999,999),(1000029,'2261','password','Zackery','+19802268488','ayla.hessel@example.com','1950-04-28','924 Fisher Lane\nRowemouth, GA 37901','5229 Warren Via Apt. 591\nBaileychester, WV 70686-0925','4675 Rashawn Turnpike\nSouth Johnathon, NV 94922-7692','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:44','2017-12-11 21:11:44',999,999),(1000030,'73153204','password','Rogers','1-483-384-8618 x920','ramiro73@example.com','1929-04-19','792 Liliane Mountain Suite 411\nJordanmouth, WV 20621-6887','554 Schinner Square\nVonRuedenmouth, AZ 80516-1523','2148 Grant Way\nEast Susanaside, FL 82404','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:45','2017-12-11 21:11:45',999,999),(1000031,'9828424','password','Werner','1-342-918-0876','gaylord.alek@example.org','1932-10-20','917 Kylee Avenue Apt. 034\nWest German, VA 81295-0404','90161 Cremin Route Apt. 740\nEast Hiram, AK 08446-9964','56402 Declan Terrace Suite 464\nPort Albertaborough, KY 00964','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:45','2017-12-11 21:11:45',999,999),(1000032,'2959527','password','Keshaun','(835) 448-9675 x8881','joe55@example.com','1938-01-13','99158 Alessia Mountains\nPort Carey, CA 01186-4046','977 Lisette Meadow Apt. 556\nWest Timothy, GA 20611-8687','693 Cormier Fords\nLake Trystanstad, OR 83238','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:45','2017-12-11 21:11:45',999,999),(1000033,'304359699','password','Cameron','+1-402-886-7948','dolly.konopelski@example.org','1979-09-17','1499 Meggie Meadow Suite 120\nSouth Lily, NC 87576','587 Elva Roads\nLittleport, CA 66344','6014 Darrin Extension Suite 431\nRoweport, UT 97588','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:45','2017-12-11 21:11:45',999,999),(1000034,'9512','password','Ruben','(850) 214-1343 x9260','abdul.feil@example.net','1967-03-05','6573 Waylon Terrace Suite 960\nNorth Rachelbury, MT 13334-3502','992 Loy Stream\nWest Calebstad, FL 95979','971 Eleazar River\nProvidencistad, WV 40760','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:45','2017-12-11 21:11:45',999,999),(1000035,'611436237','password','Westley','895.469.0259 x0612','janis39@example.com','1983-04-27','1301 Bednar Landing\nPort Edwinville, NV 01141-4837','662 Rosamond Mill Suite 761\nJessland, AL 63746-0228','462 King Extension Apt. 701\nLake Zacheryview, IN 05616-0049','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:45','2017-12-11 21:11:45',999,999),(1000036,'7','password','Jayde','(390) 481-2803 x714','cremin.judy@example.com','1978-07-30','87634 Salma Pike\nWest Esmeraldaland, MA 26404-0817','1067 Durgan Lodge Suite 002\nSouth Cortneyberg, NY 63562-1177','451 Itzel Corner\nHuelsland, IN 49380-4122','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:45','2017-12-11 21:11:45',999,999),(1000037,'1724','password','Kenneth','(480) 984-6052 x22674','smitham.heather@example.org','1966-06-19','20568 Cassandre Isle Apt. 108\nZemlakborough, NM 91829','7209 Hulda Freeway\nWest Briceshire, FL 01397-7558','7395 Nolan Parkway\nEast Lelahhaven, MA 54724','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:45','2017-12-11 21:11:45',999,999),(1000038,'45148981','password','Damien','738.845.4081 x526','abbott.georgiana@example.org','1952-09-14','2913 Dickinson Haven\nSouth Janieberg, VA 42733-1852','931 D\'Amore Unions Apt. 920\nZboncakmouth, AK 49680-6294','6654 Sterling Creek Suite 826\nTheodorehaven, WA 02375','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:45','2017-12-11 21:11:45',999,999),(1000039,'6849616','password','Norbert','813.416.9038','vschneider@example.com','1968-03-09','5282 Tromp Land Apt. 094\nMackfurt, PA 31120-4278','6586 Raymundo Gateway Apt. 075\nPort Jovan, KY 15026-5126','63907 Lewis Ridge Suite 640\nRauton, OH 34132-9122','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:45','2017-12-11 21:11:45',999,999),(1000040,'18','password','Dorcas','574-550-9721 x293','kip.hudson@example.net','1933-05-18','511 Ruecker Haven\nOrrinberg, WV 40017','400 Champlin Squares Apt. 801\nNew Nicklaushaven, TX 55681','41876 Wilfredo Fork Suite 260\nNitzschemouth, CT 93412-3463','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:45','2017-12-11 21:11:45',999,999),(1000041,'9709414','password','Garett','(628) 769-7676 x44292','suzanne07@example.com','1972-11-04','19442 Hand Forges\nStokesbury, NM 07120-4944','67080 Allene Divide\nNew Troy, IL 33085-0995','169 Brown Extension Apt. 311\nLake Lesley, OK 21510','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:46','2017-12-11 21:11:46',999,999),(1000042,'8070205','password','Chaz','+1-887-317-0135','vallie.schimmel@example.org','2006-11-24','3987 Von Landing Apt. 217\nEast Kaylaton, AL 94043','42772 Sydnie Radial Apt. 205\nErynstad, MI 26721-7114','6496 Little Haven Apt. 845\nNorth Lavonneshire, VA 35258-3410','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:46','2017-12-11 21:11:46',999,999),(1000043,'861','password','Erin','(870) 870-3646 x923','joanne.pfeffer@example.org','1976-06-14','8330 Gracie Flat Apt. 664\nRogahnmouth, NE 62909','8284 Jon Square Suite 537\nKeeblerland, MA 02468-0627','473 Christopher Spring\nEast Delfinastad, AR 91462-4344','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:46','2017-12-11 21:11:46',999,999),(1000044,'952','password','Craig','+1.580.216.4479','davon.smitham@example.net','1998-04-24','6810 Damien Valley\nSouth Caitlynborough, LA 25490-8484','33885 Eusebio Mountains\nHansenfurt, ND 77737-2418','804 Runte Harbor Suite 861\nLake Duane, AR 03505-8954','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:46','2017-12-11 21:11:46',999,999),(1000045,'918610','password','Augustus','1-739-985-2753 x795','conroy.stephen@example.com','2016-08-16','25894 Anais Path\nLake Baby, WV 41933-7380','1915 Waelchi Throughway Suite 834\nXavierville, TN 94448-4943','75797 Schmidt Shoals Suite 586\nNorth Rogelioberg, KY 46009','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:46','2017-12-11 21:11:46',999,999),(1000046,'182217','password','Abelardo','1-624-727-6341','bartholome88@example.com','1989-10-08','9431 Daryl Brooks Apt. 529\nEast Trystan, CO 87694-9717','34901 West Neck Suite 626\nEast Fanny, SC 44823-7808','16966 Rogahn Keys Apt. 341\nNorth Alvahchester, WV 94290-8942','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:46','2017-12-11 21:11:46',999,999),(1000047,'95085','password','Harmon','+1-534-897-3635','lehner.raymond@example.net','2017-01-08','121 Bahringer Gateway Apt. 988\nSouth Rosario, ME 31291-1809','12320 Bailey Spurs Apt. 231\nEast Davionmouth, MA 73795','616 Hartmann Port\nJordyntown, IL 08953-9777','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:46','2017-12-11 21:11:46',999,999),(1000048,'31','password','Santos','1-680-526-9664 x84509','kunze.sallie@example.net','1992-09-20','1046 Dooley Dale\nNorth Hipolitohaven, FL 22342-5771','6580 Yundt Landing Suite 189\nWest Tristin, NE 17584','792 Jayne Knolls\nKuhicmouth, MN 90144-7388','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:46','2017-12-11 21:11:46',999,999),(1000049,'925552168','password','Chance','(318) 375-3352','kgutkowski@example.com','1950-09-24','95738 Amanda Cliff Suite 426\nPort Ray, ID 60158','26248 Mathew Turnpike Suite 006\nDeshaunstad, MO 06181','572 Bernhard Expressway Apt. 135\nWest Brandonfort, DC 62078','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-12-11 21:11:46','2017-12-11 21:11:46',999,999);
/*!40000 ALTER TABLE `master_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (15,'2014_10_12_000000_create_users_table',1),(16,'2014_10_12_100000_create_password_resets_table',1),(17,'2017_05_25_180154_create_master_clients_table',1),(18,'2017_05_25_182546_create_mrgs_table',1),(19,'2017_05_28_073539_create_mrg_accounts_table',1),(20,'2017_05_28_074839_create_cats_table',1),(21,'2017_05_28_080847_create_aclub_members_table',1),(22,'2017_05_28_082702_create_aclub_transactions_table',1),(23,'2017_05_31_055637_create_aclub_informations_table',1),(24,'2017_05_31_060052_create_uobs_table',1),(25,'2017_05_31_061811_create_ashop_transactions_table',1),(26,'2017_05_31_062812_create_green_prospect_clients_table',1),(27,'2017_05_31_062826_create_green_prospect_progresses_table',1),(28,'2017_11_01_032047_delete_sales_from_aclub_members',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mrg_accounts`
--

DROP TABLE IF EXISTS `mrg_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mrg_accounts` (
  `accounts_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `master_id` int(10) unsigned NOT NULL,
  `account_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sales_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  PRIMARY KEY (`accounts_number`),
  KEY `mrg_accounts_master_id_foreign` (`master_id`),
  CONSTRAINT `mrg_accounts_master_id_foreign` FOREIGN KEY (`master_id`) REFERENCES `mrgs` (`master_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mrg_accounts`
--

LOCK TABLES `mrg_accounts` WRITE;
/*!40000 ALTER TABLE `mrg_accounts` DISABLE KEYS */;
INSERT INTO `mrg_accounts` VALUES ('-10',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:50','2017-12-11 21:11:50',999,999),('-100',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:54','2017-12-11 21:11:54',999,999),('-11',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:50','2017-12-11 21:11:50',999,999),('-12',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:50','2017-12-11 21:11:50',999,999),('-13',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:50','2017-12-11 21:11:50',999,999),('-14',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:50','2017-12-11 21:11:50',999,999),('-15',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:50','2017-12-11 21:11:50',999,999),('-16',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:50','2017-12-11 21:11:50',999,999),('-17',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:50','2017-12-11 21:11:50',999,999),('-18',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:50','2017-12-11 21:11:50',999,999),('-19',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:50','2017-12-11 21:11:50',999,999),('-2',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:49','2017-12-11 21:11:49',999,999),('-20',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:50','2017-12-11 21:11:50',999,999),('-21',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:50','2017-12-11 21:11:50',999,999),('-22',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:50','2017-12-11 21:11:50',999,999),('-23',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:50','2017-12-11 21:11:50',999,999),('-24',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:50','2017-12-11 21:11:50',999,999),('-25',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:50','2017-12-11 21:11:50',999,999),('-26',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:50','2017-12-11 21:11:50',999,999),('-27',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:50','2017-12-11 21:11:50',999,999),('-28',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:50','2017-12-11 21:11:50',999,999),('-29',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:50','2017-12-11 21:11:50',999,999),('-3',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:49','2017-12-11 21:11:49',999,999),('-30',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:50','2017-12-11 21:11:50',999,999),('-31',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:50','2017-12-11 21:11:50',999,999),('-32',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:50','2017-12-11 21:11:50',999,999),('-33',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:51','2017-12-11 21:11:51',999,999),('-34',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:51','2017-12-11 21:11:51',999,999),('-35',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:51','2017-12-11 21:11:51',999,999),('-36',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:51','2017-12-11 21:11:51',999,999),('-37',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:51','2017-12-11 21:11:51',999,999),('-38',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:51','2017-12-11 21:11:51',999,999),('-39',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:51','2017-12-11 21:11:51',999,999),('-4',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:49','2017-12-11 21:11:49',999,999),('-40',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:51','2017-12-11 21:11:51',999,999),('-41',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:51','2017-12-11 21:11:51',999,999),('-42',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:51','2017-12-11 21:11:51',999,999),('-43',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:51','2017-12-11 21:11:51',999,999),('-44',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:51','2017-12-11 21:11:51',999,999),('-45',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:51','2017-12-11 21:11:51',999,999),('-46',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:51','2017-12-11 21:11:51',999,999),('-47',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:51','2017-12-11 21:11:51',999,999),('-48',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:51','2017-12-11 21:11:51',999,999),('-49',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:51','2017-12-11 21:11:51',999,999),('-5',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:50','2017-12-11 21:11:50',999,999),('-50',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:52','2017-12-11 21:11:52',999,999),('-51',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:52','2017-12-11 21:11:52',999,999),('-52',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:52','2017-12-11 21:11:52',999,999),('-53',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:52','2017-12-11 21:11:52',999,999),('-54',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:52','2017-12-11 21:11:52',999,999),('-55',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:52','2017-12-11 21:11:52',999,999),('-56',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:52','2017-12-11 21:11:52',999,999),('-57',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:52','2017-12-11 21:11:52',999,999),('-58',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:52','2017-12-11 21:11:52',999,999),('-59',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:52','2017-12-11 21:11:52',999,999),('-6',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:50','2017-12-11 21:11:50',999,999),('-60',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:52','2017-12-11 21:11:52',999,999),('-61',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:52','2017-12-11 21:11:52',999,999),('-62',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:52','2017-12-11 21:11:52',999,999),('-63',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:52','2017-12-11 21:11:52',999,999),('-64',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:52','2017-12-11 21:11:52',999,999),('-65',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:52','2017-12-11 21:11:52',999,999),('-66',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:52','2017-12-11 21:11:52',999,999),('-67',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:52','2017-12-11 21:11:52',999,999),('-68',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:52','2017-12-11 21:11:52',999,999),('-69',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:52','2017-12-11 21:11:52',999,999),('-7',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:50','2017-12-11 21:11:50',999,999),('-70',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:52','2017-12-11 21:11:52',999,999),('-71',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:52','2017-12-11 21:11:52',999,999),('-72',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:52','2017-12-11 21:11:52',999,999),('-73',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:52','2017-12-11 21:11:52',999,999),('-74',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:53','2017-12-11 21:11:53',999,999),('-75',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:53','2017-12-11 21:11:53',999,999),('-76',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:53','2017-12-11 21:11:53',999,999),('-77',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:53','2017-12-11 21:11:53',999,999),('-78',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:53','2017-12-11 21:11:53',999,999),('-79',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:53','2017-12-11 21:11:53',999,999),('-8',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:50','2017-12-11 21:11:50',999,999),('-80',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:53','2017-12-11 21:11:53',999,999),('-81',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:53','2017-12-11 21:11:53',999,999),('-82',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:53','2017-12-11 21:11:53',999,999),('-83',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:53','2017-12-11 21:11:53',999,999),('-84',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:53','2017-12-11 21:11:53',999,999),('-85',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:53','2017-12-11 21:11:53',999,999),('-86',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:53','2017-12-11 21:11:53',999,999),('-87',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:53','2017-12-11 21:11:53',999,999),('-88',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:53','2017-12-11 21:11:53',999,999),('-89',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:53','2017-12-11 21:11:53',999,999),('-9',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:50','2017-12-11 21:11:50',999,999),('-90',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2018-01-24 15:42:20','2017-12-11 21:11:53',999,999),('-91',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:53','2017-12-11 21:11:53',999,999),('-92',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:53','2017-12-11 21:11:53',999,999),('-93',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:53','2017-12-11 21:11:53',999,999),('-94',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:54','2017-12-11 21:11:54',999,999),('-95',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:54','2017-12-11 21:11:54',999,999),('-96',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:54','2017-12-11 21:11:54',999,999),('-97',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:54','2017-12-11 21:11:54',999,999),('-98',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2017-12-11 21:11:54','2017-12-11 21:11:54',999,999),('-99',999999,'MAGIC_SEED_ACCOUNT','MAGIC_SEED_SALES','2018-01-26 07:58:01','2017-12-11 21:11:54',999,999),('120',1000032,'Basic','Miss Cassandra Nitzsche V','2017-12-11 21:11:55','2017-12-11 21:11:55',999,999),('1243425',1000000,'Syariah','Poqweasd','2017-12-11 21:12:54','2017-12-11 21:12:54',0,0),('152',1000008,'Recreation','Rhianna Eichmann','2018-01-26 07:58:12','2017-12-11 21:11:55',999,999),('153',1000005,'Signature','Jason Robel','2018-01-26 07:58:08','2017-12-11 21:11:54',999,999),('213',1000008,'Syariah','Julia Trantow','2017-12-11 21:11:54','2017-12-11 21:11:54',999,999),('226',1000024,'Recreation','Dr. Marcella McGlynn','2018-01-26 07:58:31','2017-12-11 21:11:54',999,999),('258',1000040,'Signature','Krystina Satterfield II','2018-01-26 07:58:42','2017-12-11 21:11:54',999,999),('296',1000017,'Syariah','Miss Kathleen Russel','2018-01-26 07:58:23','2017-12-11 21:11:55',999,999),('297',1000017,'Recreation','Milan Waelchi','2017-12-11 21:11:54','2017-12-11 21:11:54',999,999),('349',1000048,'Syariah','Mrs. Magdalen Osinski DDS','2018-01-26 07:58:48','2017-12-11 21:11:55',999,999),('394',1000005,'Syariah','Dr. Geovanny Leffler II','2017-12-11 21:11:55','2017-12-11 21:11:55',999,999),('404',1000024,'Syariah','Willie Upton','2017-12-11 21:11:54','2017-12-11 21:11:54',999,999),('473',1000010,'Recreation','Fae Corwin I','2018-01-26 07:58:17','2017-12-11 21:11:54',999,999),('48',1000010,'Basic','Lue Hagenes MD','2017-12-11 21:11:55','2017-12-11 21:11:55',999,999),('526',1000024,'Syariah','Ms. Helga Zboncak','2017-12-11 21:11:54','2017-12-11 21:11:54',999,999),('565',1000008,'Basic','Virgil Rutherford','2017-12-11 21:11:55','2017-12-11 21:11:55',999,999),('589',1000020,'Recreation','Katrine Grady','2017-12-11 21:11:55','2017-12-11 21:11:55',999,999),('649',1000039,'Syariah','Dakota Zemlak','2017-12-11 21:11:54','2017-12-11 21:11:54',999,999),('873',1000034,'Syariah','Sim Collins','2017-12-11 21:11:54','2017-12-11 21:11:54',999,999),('944',1000048,'Signature','Graham Becker','2017-12-11 21:11:54','2017-12-11 21:11:54',999,999),('997',1000040,'Basic','Kendrick Orn MD','2017-12-11 21:11:54','2017-12-11 21:11:54',999,999);
/*!40000 ALTER TABLE `mrg_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mrgs`
--

DROP TABLE IF EXISTS `mrgs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mrgs` (
  `master_id` int(10) unsigned NOT NULL,
  `sumber_data` text COLLATE utf8_unicode_ci,
  `join_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  PRIMARY KEY (`master_id`),
  CONSTRAINT `mrgs_master_id_foreign` FOREIGN KEY (`master_id`) REFERENCES `master_clients` (`master_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mrgs`
--

LOCK TABLES `mrgs` WRITE;
/*!40000 ALTER TABLE `mrgs` DISABLE KEYS */;
INSERT INTO `mrgs` VALUES (999999,'-','1970-02-01','2018-02-06 11:54:38','2017-12-11 21:11:49',999,999),(1000000,'asd','0000-00-00','2018-02-06 11:54:59','2017-12-11 21:12:54',0,0),(1000005,'Prof. Fredrick Abernathy','2018-01-09','2017-12-11 21:11:48','2017-12-11 21:11:48',999,999),(1000008,'Prof. Jose Leffler','2017-12-16','2017-12-11 21:11:48','2017-12-11 21:11:48',999,999),(1000010,'Mrs. Nettie Quigley','2018-01-05','2017-12-11 21:11:48','2017-12-11 21:11:48',999,999),(1000017,'Cassie Carroll','2018-01-06','2017-12-11 21:11:48','2017-12-11 21:11:48',999,999),(1000020,'Vita O\'Connell','2017-12-31','2017-12-11 21:11:48','2017-12-11 21:11:48',999,999),(1000024,'Danika Cole','2017-12-19','2017-12-11 21:11:49','2017-12-11 21:11:49',999,999),(1000032,'Cade Pfeffer','2017-12-13','2017-12-11 21:11:48','2017-12-11 21:11:48',999,999),(1000034,'Javier Hegmann','2017-12-24','2017-12-11 21:11:49','2017-12-11 21:11:49',999,999),(1000039,'Oswaldo Grant IV','2018-01-06','2017-12-11 21:11:48','2017-12-11 21:11:48',999,999),(1000040,'Shaina Waelchi Sr.','2018-01-10','2017-12-11 21:11:48','2017-12-11 21:11:48',999,999),(1000048,'Sonya Lockman','2017-12-20','2017-12-11 21:11:48','2017-12-11 21:11:48',999,999);
/*!40000 ALTER TABLE `mrgs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uobs`
--

DROP TABLE IF EXISTS `uobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uobs` (
  `client_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `master_id` int(10) unsigned NOT NULL,
  `sales_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sumber_data` text COLLATE utf8_unicode_ci,
  `join_date` date DEFAULT NULL,
  `nomor_ktp` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tanggal_expired_ktp` date DEFAULT NULL,
  `nomor_npwp` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alamat_surat` text COLLATE utf8_unicode_ci,
  `saudara_tidak_serumah` text COLLATE utf8_unicode_ci,
  `nama_ibu_kandung` text COLLATE utf8_unicode_ci,
  `bank_pribadi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nomor_rekening_pribadi` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tanggal_rdi_done` date DEFAULT NULL,
  `rdi_bank` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nomor_rdi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tanggal_top_up` date DEFAULT NULL,
  `nominal_top_up` bigint(20) DEFAULT NULL,
  `tanggal_trading` date DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trading_via` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  PRIMARY KEY (`client_id`),
  KEY `uobs_master_id_foreign` (`master_id`),
  CONSTRAINT `uobs_master_id_foreign` FOREIGN KEY (`master_id`) REFERENCES `master_clients` (`master_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uobs`
--

LOCK TABLES `uobs` WRITE;
/*!40000 ALTER TABLE `uobs` DISABLE KEYS */;
INSERT INTO `uobs` VALUES ('10580',1000020,'Kendrick Cummings','-','2017-12-25','57966','2017-12-17','10981','77801 Hobart Pines Suite 455\nEast Alecfort, KS 23369','Gerhard Fadel','Loraine','BCA','50208','2017-12-15','-','91664','2018-01-08',900000,'2017-12-27','-','-','-','2017-12-11 21:11:48','2017-12-11 21:11:48',999,999),('2189',1000019,'Mr. Gage Mosciski V','-','2018-01-10','72799','2017-12-30','16178','336 Padberg Land\nStehrton, WA 34668','Jordane Harvey DDS','Ila','BCA','13947','2017-12-12','-','78885','2017-12-30',120000,'2017-12-26','-','-','-','2017-12-11 21:11:48','2017-12-11 21:11:48',999,999),('26429',1000030,'Miss Creola Emmerich','-','2017-12-17','18878','2018-01-04','7875','3662 Hermiston Run\nEast Marionmouth, OH 49622-2876','Nellie Collier','Jeanette','BCA','73893','2017-12-13','-','26906','2017-12-15',90000,'2018-01-05','-','-','-','2017-12-11 21:11:48','2017-12-11 21:11:48',999,999),('38032',1000048,'Brent Hauck PhD','-','2018-01-04','67047','2018-01-07','44605','128 Corkery Road Suite 547\nGoldnerport, NE 11015','Anna Larson','Leanne','BCA','66857','2017-12-15','-','92275','2017-12-31',830000,'2017-12-14','-','-','-','2017-12-11 21:11:47','2017-12-11 21:11:47',999,999),('39144',1000000,'Sydney Considine','-','2018-01-06','35439','2017-12-16','24208','31402 Goyette Circle Apt. 210\nToyland, LA 25360','Jacynthe Barrows V','Cassie','BCA','87370','2018-01-04','-','62568','2018-01-03',240000,'2018-01-06','-','-','-','2017-12-11 21:11:48','2017-12-11 21:11:48',999,999),('51466',1000008,'Hal Parker','-','2017-12-19','78443','2017-12-27','47869','888 Benton Path Apt. 799\nChasebury, LA 78155','Oran Hettinger Jr.','Dixie','BCA','31798','2017-12-30','-','83568','2017-12-30',840000,'2017-12-21','-','-','-','2017-12-11 21:11:48','2017-12-11 21:11:48',999,999),('60121',1000009,'Hailee McKenzie','-','2018-01-01','87972','2017-12-22','73931','153 Mauricio Brooks Apt. 199\nSydniview, MD 41988','Bernie Legros','Cayla','BCA','88540','2018-01-05','-','37432','2017-12-30',920000,'2017-12-29','-','-','-','2017-12-11 21:11:47','2017-12-11 21:11:47',999,999),('61288',1000005,'Brandy Conroy','-','2017-12-26','81064','2017-12-31','46564','8552 Hauck Court\nKayliestad, AZ 66872-0487','Miss Alessandra Boyle III','Julie','BCA','29916','2017-12-29','-','71430','2017-12-29',640000,'2017-12-12','-','-','-','2017-12-11 21:11:48','2017-12-11 21:11:48',999,999),('68897',1000022,'Ms. Roma Gutmann','-','2018-01-03','84015','2017-12-18','82925','3994 Sauer Ramp Apt. 621\nJeniferborough, UT 44936-8133','Domenic Brown','Valentine','BCA','82108','2018-01-06','-','70129','2018-01-02',450000,'2017-12-28','-','-','-','2017-12-11 21:11:48','2017-12-11 21:11:48',999,999),('74647',1000009,'Prof. Vanessa Murazik','-','2017-12-15','25878','2017-12-16','39152','414 Eryn Corners Suite 662\nWest Alessandraville, KY 03398','Mrs. Idella Schinner','Felicity','BCA','80652','2017-12-20','-','65420','2017-12-15',610000,'2017-12-13','-','-','-','2017-12-11 21:11:47','2017-12-11 21:11:47',999,999);
/*!40000 ALTER TABLE `uobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `no_handphone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` int(11) NOT NULL,
  `a_shop_auth` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'superadmin','superadmin','-','$2y$10$9VJT8CW.yTQ.2wy63pgugugnsq3jYC1Wh2/jgzJo1EVhrdPvoYBvG','-',0,1,'-','2017-12-11 21:11:16','2017-12-11 21:11:16'),(2,'Noelia','Deja','denesik.alvina@example.org','password','(568) 878-6849 x6718',1,1,'remember_token','2017-12-11 21:11:41','2017-12-11 21:11:41'),(3,'Sandrine','Alejandra','sipes.dannie@example.com','password','+12972485717',0,0,'remember_token','2017-12-11 21:11:41','2017-12-11 21:11:41'),(4,'Germaine','Brandy','edna91@example.com','password','+17434829368',1,0,'remember_token','2017-12-11 21:11:41','2017-12-11 21:11:41'),(5,'Leann','Candida','weissnat.newton@example.com','password','1-491-433-1316 x4071',3,0,'remember_token','2017-12-11 21:11:41','2017-12-11 21:11:41'),(6,'Albertha','Ruthie','ykuhic@example.com','password','1-232-679-0224',1,1,'remember_token','2017-12-11 21:11:41','2017-12-11 21:11:41'),(7,'Marjolaine','Barbara','eula92@example.com','password','(547) 588-7522 x6611',0,0,'remember_token','2017-12-11 21:11:41','2017-12-11 21:11:41'),(8,'Corine','Litzy','marshall40@example.com','password','+1-979-750-1644',1,0,'remember_token','2017-12-11 21:11:42','2017-12-11 21:11:42'),(9,'Treva','Etha','jimmy64@example.org','password','408-383-5457',2,0,'remember_token','2017-12-11 21:11:42','2017-12-11 21:11:42'),(10,'Jada','Helena','ralph81@example.net','password','(520) 417-4943',0,1,'remember_token','2017-12-11 21:11:42','2017-12-11 21:11:42'),(11,'Drew','Birdie','cbashirian@example.com','password','759-255-9174 x42010',1,0,'remember_token','2017-12-11 21:11:42','2017-12-11 21:11:42'),(12,'Nola','Frida','keaton.toy@example.org','password','1-879-870-1147 x14322',0,1,'remember_token','2017-12-11 21:11:42','2017-12-11 21:11:42'),(13,'Eudora','Antonia','igottlieb@example.net','password','850-560-7009',0,0,'remember_token','2017-12-11 21:11:42','2017-12-11 21:11:42'),(14,'Eulalia','Idell','reva29@example.com','password','+1-647-859-8236',2,1,'remember_token','2017-12-11 21:11:42','2017-12-11 21:11:42'),(15,'Rafaela','Wanda','gabriella.haley@example.org','password','+1 (678) 267-3108',2,0,'remember_token','2017-12-11 21:11:42','2017-12-11 21:11:42'),(16,'Jammie','Alize','lowell.crona@example.net','password','1-398-661-8268',0,1,'remember_token','2017-12-11 21:11:42','2017-12-11 21:11:42'),(17,'Lynn','Melisa','mikel.hilpert@example.net','password','(983) 506-6705',0,1,'remember_token','2017-12-11 21:11:42','2017-12-11 21:11:42'),(18,'Loren','Justina','igleason@example.net','password','(907) 588-4592 x83452',3,0,'remember_token','2017-12-11 21:11:42','2017-12-11 21:11:42'),(19,'Alvera','Ava','cgrant@example.com','password','794-891-4035 x7283',2,1,'remember_token','2017-12-11 21:11:42','2017-12-11 21:11:42'),(20,'Jazmyn','Margret','roob.abraham@example.com','password','994-682-9476',3,0,'remember_token','2017-12-11 21:11:42','2017-12-11 21:11:42'),(21,'Rhea','Asia','jbode@example.net','password','+1-485-344-9435',2,0,'remember_token','2017-12-11 21:11:42','2017-12-11 21:11:42'),(999,'seeder_dummy','seeder_dummy','seeder@dummy.com','password_seeder','-',-1,0,'-','2017-12-11 21:11:42','2017-12-11 21:11:42');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-02-06 19:00:09
