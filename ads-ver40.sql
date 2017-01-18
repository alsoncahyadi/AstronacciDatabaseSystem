-- MySQL dump 10.13  Distrib 5.7.15, for Win64 (x86_64)
--
-- Host: localhost    Database: ads
-- ------------------------------------------------------
-- Server version	5.7.15-log

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
-- Table structure for table `aclub`
--

DROP TABLE IF EXISTS `aclub`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aclub` (
  `all_pc_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `interest_and_hobby` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trading_experience_year` tinyint(4) DEFAULT NULL,
  `your_stock_future_broker` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `annual_income` int(11) DEFAULT NULL,
  `security_question` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `security_answer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keterangan` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `occupation` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_edited_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `all_pc_id_2` (`all_pc_id`),
  KEY `all_pc_id` (`all_pc_id`),
  CONSTRAINT `aclub_ibfk_1` FOREIGN KEY (`all_pc_id`) REFERENCES `master_client` (`all_pc_id`)
) ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aclub`
--

LOCK TABLES `aclub` WRITE;
/*!40000 ALTER TABLE `aclub` DISABLE KEYS */;
INSERT INTO `aclub` VALUES (100013,1234,'InterestandHobbysample',4,'Future',1000000,'Question sample','Answer sample','Status sample','Keterangan','Websitesample','Statesample','2017-01-13 16:33:15','Occupationsample','2017-01-13 16:33:15'),(100014,1235,'InterestandHobbysample',4,'Future',1000000,'Question sample','Answer sample','Status sample','Keterangan','Websitesample','Statesample','2017-01-13 17:14:28','Occupationsample','2017-01-13 17:14:28');
/*!40000 ALTER TABLE `aclub` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `aclub_expdate_future`
--

DROP TABLE IF EXISTS `aclub_expdate_future`;
/*!50001 DROP VIEW IF EXISTS `aclub_expdate_future`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `aclub_expdate_future` AS SELECT 
 1 AS `all_pc_id`,
 1 AS `fullname`,
 1 AS `user_id`,
 1 AS `registration_type`,
 1 AS `paket`,
 1 AS `expired_date_bonus`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `aclub_expdate_stock`
--

DROP TABLE IF EXISTS `aclub_expdate_stock`;
/*!50001 DROP VIEW IF EXISTS `aclub_expdate_stock`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `aclub_expdate_stock` AS SELECT 
 1 AS `all_pc_id`,
 1 AS `fullname`,
 1 AS `user_id`,
 1 AS `registration_type`,
 1 AS `paket`,
 1 AS `expired_date_bonus`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `aclub_last_important_date`
--

DROP TABLE IF EXISTS `aclub_last_important_date`;
/*!50001 DROP VIEW IF EXISTS `aclub_last_important_date`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `aclub_last_important_date` AS SELECT 
 1 AS `user_id`,
 1 AS `yellow_zone`,
 1 AS `expired_date_bonus`,
 1 AS `redzone`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `aclub_payment`
--

DROP TABLE IF EXISTS `aclub_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aclub_payment` (
  `registration_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nomor_pembayaran` int(11) NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `nominal_pembayaran` int(11) NOT NULL,
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `edited_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`registration_id`,`nomor_pembayaran`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `aclub_payment_ibfk_1` FOREIGN KEY (`registration_id`) REFERENCES `aclub_registration` (`registration_id`) ON DELETE NO ACTION,
  CONSTRAINT `aclub_payment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `aclub` (`user_id`) ON DELETE NO ACTION
) ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aclub_payment`
--

LOCK TABLES `aclub_payment` WRITE;
/*!40000 ALTER TABLE `aclub_payment` DISABLE KEYS */;
INSERT INTO `aclub_payment` VALUES (1,1234,1,'2017-01-13',8333,'2017-01-13 16:42:38','0000-00-00 00:00:00'),(1,1234,2,'2017-02-13',8333,'2017-01-13 16:42:38','0000-00-00 00:00:00'),(1,1234,3,'2017-03-13',8333,'2017-01-13 16:42:38','0000-00-00 00:00:00'),(1,1234,4,'2017-04-13',8333,'2017-01-13 16:42:38','0000-00-00 00:00:00'),(1,1234,5,'2017-05-13',8333,'2017-01-13 16:42:38','0000-00-00 00:00:00'),(1,1234,6,'2017-06-13',8333,'2017-01-13 16:42:38','0000-00-00 00:00:00'),(1,1234,7,'2017-07-13',8333,'2017-01-13 16:42:38','0000-00-00 00:00:00'),(1,1234,8,'2017-08-13',8333,'2017-01-13 16:42:38','0000-00-00 00:00:00'),(1,1234,9,'2017-09-13',8333,'2017-01-13 16:42:38','0000-00-00 00:00:00'),(1,1234,10,'2017-09-13',8333,'2017-01-13 16:42:38','0000-00-00 00:00:00'),(1,1234,11,'2017-11-13',8333,'2017-01-13 16:42:38','0000-00-00 00:00:00'),(1,1234,12,'2017-12-13',8333,'2017-01-13 16:42:38','0000-00-00 00:00:00'),(2,1234,1,'2017-01-15',100000,'2017-01-13 17:02:33','0000-00-00 00:00:00'),(3,1235,1,'2017-01-15',100000,'2017-01-13 17:14:41','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `aclub_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aclub_registration`
--

DROP TABLE IF EXISTS `aclub_registration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aclub_registration` (
  `registration_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sales_username` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `broker` varchar(7) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Value : [STOCK | FUTURE]',
  `paket` varchar(2) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Value : [ S|G|P ]',
  `registration_type` varchar(15) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Value : [Baru | Perpanjangan]',
  `registration_date` date NOT NULL,
  `jenis` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nominal` int(11) DEFAULT NULL,
  `percentage` int(11) DEFAULT NULL,
  `comission_for_sales` int(11) DEFAULT NULL,
  `paid` int(11) DEFAULT NULL,
  `paid_date` date DEFAULT NULL,
  `debt` int(11) DEFAULT NULL,
  `frekuensi` tinyint(4) DEFAULT NULL,
  `keterangan_ref` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `bulan_member` int(11) DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `bonus_member_day` int(11) DEFAULT NULL,
  `expired_date_bonus` date DEFAULT NULL,
  `added_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sumber_data` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_edited_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`registration_id`),
  KEY `user_id` (`user_id`),
  KEY `sales_username` (`sales_username`),
  CONSTRAINT `aclub_registration_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `aclub` (`user_id`) ON DELETE NO ACTION,
  CONSTRAINT `aclub_registration_ibfk_2` FOREIGN KEY (`sales_username`) REFERENCES `sales` (`sales_username`)
) ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aclub_registration`
--

LOCK TABLES `aclub_registration` WRITE;
/*!40000 ALTER TABLE `aclub_registration` DISABLE KEYS */;
INSERT INTO `aclub_registration` VALUES (1,1234,'username','Future','SP','Baru','2017-01-13','Jenis',100000,20,20000,10000,'2017-01-13',2000,NULL,NULL,'Message','2017-01-13',2,'2017-03-13',1,'2017-03-14','2017-01-13 16:42:38','Data','0000-00-00 00:00:00'),(2,1234,'username','Future','SS','Baru','2017-01-15','Jenis',100000,20,20000,10000,'2017-01-15',2000,NULL,NULL,'Message','2017-01-15',2,'2017-03-15',1,'2017-03-16','2017-01-13 17:02:33','Data','0000-00-00 00:00:00'),(3,1235,'username','Future','SS','Baru','2017-01-15','Jenis',100000,20,20000,10000,'2017-01-15',2000,NULL,NULL,'Message','2017-01-15',2,'2017-01-11',1,'2017-01-11','2017-01-13 17:14:41','Data','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `aclub_registration` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER check_insert_aclub_register_1 
BEFORE INSERT ON aclub_registration
FOR EACH ROW
    BEGIN
        IF (new.registration_type != 'Perpanjangan')
        AND (new.registration_type != 'Baru')
            THEN
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Wrong value for registration type. Value allowed : [Baru|Perpanjangan]'; 
        END IF;
        
        IF (new.broker != 'STOCK')
            AND (new.broker != 'FUTURE')
                THEN
                SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = 'Wrong value for registration type. Value allowed : [STOCK|FUTURE]'; 
            END IF;        

        IF (new.broker != 'STOCK')
            AND (new.broker != 'FUTURE')
                THEN
                SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = 'Wrong value for registration type. Value allowed : [STOCK|FUTURE]'; 
            END IF;     

        IF (new.paket != 'SS')
            AND (new.paket != 'SF')
            AND (new.paket != 'SP')
            AND (new.paket != 'FS')
            AND (new.paket != 'FF')
            AND (new.paket != 'FP')
                THEN
                SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = 'Wrong value for registration type. Value allowed : [SS|SF|SP|FS|FF|FP]'; 
            END IF; 
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Temporary view structure for view `assign_all`
--

DROP TABLE IF EXISTS `assign_all`;
/*!50001 DROP VIEW IF EXISTS `assign_all`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `assign_all` AS SELECT 
 1 AS `type`,
 1 AS `assign_id`,
 1 AS `id`,
 1 AS `sales_username`,
 1 AS `prospect_to`,
 1 AS `assign_time`,
 1 AS `assign_edited_time`,
 1 AS `admin_username`,
 1 AS `keterangan`,
 1 AS `last_edited_time`,
 1 AS `report`,
 1 AS `is_succes`,
 1 AS `report_time`,
 1 AS `fullname`,
 1 AS `no_hp`,
 1 AS `email`,
 1 AS `address`,
 1 AS `share_to_aclub`,
 1 AS `share_to_mrg`,
 1 AS `share_to_cat`,
 1 AS `share_to_uob`,
 1 AS `all_pc_id`,
 1 AS `green_grow_red_add_time`,
 1 AS `green_grow_red_edited_time`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `assign_green`
--

DROP TABLE IF EXISTS `assign_green`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assign_green` (
  `green_assign_id` int(11) NOT NULL AUTO_INCREMENT,
  `green_id` int(10) unsigned NOT NULL,
  `sales_username` varchar(40) NOT NULL,
  `prospect_to` varchar(10) NOT NULL COMMENT 'Values : [aclub|uob|cat|mrg]',
  `assign_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `admin_username` varchar(40) DEFAULT NULL,
  `keterangan` varchar(150) DEFAULT NULL,
  `last_edited_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `report` varchar(150) DEFAULT NULL,
  `is_succes` tinyint(1) DEFAULT NULL,
  `report_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `type` varchar(8) DEFAULT 'green',
  PRIMARY KEY (`green_assign_id`),
  KEY `green_id` (`green_id`),
  KEY `admin_username` (`admin_username`),
  KEY `sales_username` (`sales_username`),
  CONSTRAINT `assign_green_ibfk_1` FOREIGN KEY (`green_id`) REFERENCES `green` (`green_id`),
  CONSTRAINT `assign_green_ibfk_3` FOREIGN KEY (`sales_username`) REFERENCES `sales` (`sales_username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assign_green`
--

LOCK TABLES `assign_green` WRITE;
/*!40000 ALTER TABLE `assign_green` DISABLE KEYS */;
INSERT INTO `assign_green` VALUES (1,1,'username','CAT','2017-01-15 16:00:07','username','keterangan lainnya','0000-00-00 00:00:00','Banyak gaya pisan',1,'2017-01-15 16:00:07','green');
/*!40000 ALTER TABLE `assign_green` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER check_insert_assign_green
BEFORE INSERT ON assign_green
FOR EACH ROW
    BEGIN
        IF (new.prospect_to != 'CAT')
        AND (new.prospect_to != 'UOB')
        AND (new.prospect_to != 'A-Club')
        AND (new.prospect_to != 'MRG')
            THEN
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Wrong value for "prospect-to". Value allowed : [CAT|UOB|A-Club|MRG]'; 
        END IF;
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `assign_grow`
--

DROP TABLE IF EXISTS `assign_grow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assign_grow` (
  `grow_assign_id` int(11) NOT NULL AUTO_INCREMENT,
  `grow_id` int(10) unsigned NOT NULL,
  `sales_username` varchar(40) NOT NULL,
  `prospect_to` varchar(10) NOT NULL COMMENT 'Values : [aclub|uob|cat|mrg]',
  `assign_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `admin_username` varchar(40) DEFAULT NULL,
  `keterangan` varchar(150) DEFAULT NULL,
  `last_edited_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `report` varchar(150) DEFAULT NULL,
  `is_succes` tinyint(1) DEFAULT NULL,
  `report_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `type` varchar(8) DEFAULT 'grow',
  PRIMARY KEY (`grow_assign_id`),
  KEY `grow_id` (`grow_id`),
  KEY `admin_username` (`admin_username`),
  KEY `sales_username` (`sales_username`),
  CONSTRAINT `assign_grow_ibfk_1` FOREIGN KEY (`grow_id`) REFERENCES `grow` (`grow_id`),
  CONSTRAINT `assign_grow_ibfk_3` FOREIGN KEY (`sales_username`) REFERENCES `sales` (`sales_username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assign_grow`
--

LOCK TABLES `assign_grow` WRITE;
/*!40000 ALTER TABLE `assign_grow` DISABLE KEYS */;
INSERT INTO `assign_grow` VALUES (1,1,'username','CAT','2017-01-15 16:00:52','username','keterangan lainnya lagi','2017-01-15 15:48:21','Banyak gaya pisan',1,'2017-01-15 16:00:52','grow'),(2,1,'username','CAT','2017-01-15 15:39:00','username','keterangan','0000-00-00 00:00:00',NULL,NULL,'0000-00-00 00:00:00','grow'),(3,1,'username','CAT','2017-01-15 15:40:02','username','keterangan','0000-00-00 00:00:00',NULL,NULL,'0000-00-00 00:00:00','grow'),(4,1,'username','CAT','2017-01-15 15:40:34','username','keterangan','0000-00-00 00:00:00',NULL,NULL,'0000-00-00 00:00:00','grow');
/*!40000 ALTER TABLE `assign_grow` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER check_insert_assign_grow
BEFORE INSERT ON assign_grow
FOR EACH ROW
    BEGIN
        IF (new.prospect_to != 'CAT')
        AND (new.prospect_to != 'UOB')
        AND (new.prospect_to != 'A-Club')
        AND (new.prospect_to != 'MRG')
            THEN
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Wrong value for "prospect-to". Value allowed : [CAT|UOB|A-Club|MRG]'; 
        END IF;
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `assign_redclub`
--

DROP TABLE IF EXISTS `assign_redclub`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assign_redclub` (
  `redclub_assign_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `sales_username` varchar(40) NOT NULL,
  `prospect_to` varchar(10) NOT NULL COMMENT 'Values : [aclub|uob|cat|mrg]',
  `assign_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `admin_username` varchar(40) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `last_edited_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `report` varchar(150) DEFAULT NULL,
  `is_succes` tinyint(1) DEFAULT NULL,
  `report_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `type` varchar(8) DEFAULT 'redclub',
  PRIMARY KEY (`redclub_assign_id`),
  KEY `username` (`username`),
  KEY `admin_username` (`admin_username`),
  KEY `sales_username` (`sales_username`),
  CONSTRAINT `assign_redclub_ibfk_1` FOREIGN KEY (`username`) REFERENCES `redclub` (`username`),
  CONSTRAINT `assign_redclub_ibfk_3` FOREIGN KEY (`sales_username`) REFERENCES `sales` (`sales_username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assign_redclub`
--

LOCK TABLES `assign_redclub` WRITE;
/*!40000 ALTER TABLE `assign_redclub` DISABLE KEYS */;
INSERT INTO `assign_redclub` VALUES (1,'Ramos','username','CAT','2017-01-15 15:59:46','username','keterangan lainnya lagi','0000-00-00 00:00:00','Banyak gaya pisan',1,'2017-01-15 15:59:46','redclub'),(2,'Ramos','username','CAT','2017-01-15 15:31:30','username','keterangan','0000-00-00 00:00:00',NULL,NULL,'0000-00-00 00:00:00','redclub'),(3,'Ramos','username','CAT','2017-01-15 15:40:07','username','keterangan','0000-00-00 00:00:00',NULL,NULL,'0000-00-00 00:00:00','redclub'),(4,'Ramos','username','CAT','2017-01-15 15:40:22','username','keterangan lainnya','0000-00-00 00:00:00',NULL,NULL,'0000-00-00 00:00:00','redclub');
/*!40000 ALTER TABLE `assign_redclub` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER check_insert_assign_redclub
BEFORE INSERT ON assign_redclub
FOR EACH ROW
    BEGIN
        IF (new.prospect_to != 'CAT')
        AND (new.prospect_to != 'UOB')
        AND (new.prospect_to != 'A-Club')
        AND (new.prospect_to != 'MRG')
            THEN
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Wrong value for "prospect-to". Value allowed : [CAT|UOB|A-Club|MRG]'; 
        END IF;
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `cat`
--

DROP TABLE IF EXISTS `cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cat` (
  `all_pc_id` int(11) NOT NULL,
  `cat_user_id` int(11) NOT NULL,
  `cat_no_induk` int(11) NOT NULL,
  `cat_username` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `batch` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal_pendaftaran` date NOT NULL,
  `tanggal_kelas_berakhir` date NOT NULL,
  `sales_username` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`cat_user_id`),
  UNIQUE KEY `cat_no_induk` (`cat_no_induk`),
  KEY `all_pc_id` (`all_pc_id`),
  KEY `sales_username` (`sales_username`),
  CONSTRAINT `cat_ibfk_1` FOREIGN KEY (`all_pc_id`) REFERENCES `master_client` (`all_pc_id`),
  CONSTRAINT `cat_ibfk_2` FOREIGN KEY (`all_pc_id`) REFERENCES `master_client` (`all_pc_id`),
  CONSTRAINT `cat_ibfk_3` FOREIGN KEY (`sales_username`) REFERENCES `sales` (`sales_username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat`
--

LOCK TABLES `cat` WRITE;
/*!40000 ALTER TABLE `cat` DISABLE KEYS */;
INSERT INTO `cat` VALUES (100007,1231,123123123,'tia','tia123','CAT 1','2016-12-28','2016-12-28','username','2016-12-21 18:16:58','0000-00-00 00:00:00'),(100012,8145,88010113,'tia','tia123','CAT 1','2014-01-01','2014-01-01','Astronacci','2016-12-28 14:05:56','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `cat` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER after_cat_delete
    AFTER DELETE ON cat
    FOR EACH ROW
BEGIN
    UPDATE master_client
    SET 
        is_cat = false
    WHERE all_pc_id NOT IN (SELECT all_pc_id from cat);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `green`
--

DROP TABLE IF EXISTS `green`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `green` (
  `green_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `keterangan_perintah` varchar(50) DEFAULT NULL,
  `sumber` varchar(20) DEFAULT NULL,
  `sales_username` varchar(40) DEFAULT NULL,
  `progress` varchar(50) DEFAULT NULL,
  `is_aclub_stock` tinyint(1) NOT NULL DEFAULT '0',
  `is_aclub_future` tinyint(1) NOT NULL DEFAULT '0',
  `is_cat` tinyint(1) NOT NULL DEFAULT '0',
  `is_mrg_premiere` tinyint(1) NOT NULL DEFAULT '0',
  `is_UOB` tinyint(1) NOT NULL DEFAULT '0',
  `is_red_club` tinyint(1) NOT NULL DEFAULT '0',
  `share_to_aclub` tinyint(1) DEFAULT '0',
  `share_to_mrg` tinyint(1) DEFAULT '0',
  `share_to_cat` tinyint(1) DEFAULT '0',
  `share_to_uob` tinyint(1) DEFAULT '0',
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `edited_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`green_id`),
  KEY `sales_username` (`sales_username`),
  CONSTRAINT `green_ibfk_1` FOREIGN KEY (`sales_username`) REFERENCES `sales` (`sales_username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `green`
--

LOCK TABLES `green` WRITE;
/*!40000 ALTER TABLE `green` DISABLE KEYS */;
INSERT INTO `green` VALUES (1,'Ramos','08XX','Keterangan Perintah Ramos','Sumber Ramos',NULL,'Progres Ramos',0,0,0,0,0,0,0,0,0,0,'2016-12-25 18:37:11','0000-00-00 00:00:00'),(2,'Ramos','08XX','Keterangan Perintah Ramos','Sumber Ramos',NULL,'Progres Ramos',0,0,0,0,0,0,0,0,0,0,'2016-12-25 18:42:25','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `green` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grow`
--

DROP TABLE IF EXISTS `grow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grow` (
  `grow_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `share_to_aclub` tinyint(1) DEFAULT '0',
  `share_to_mrg` tinyint(1) DEFAULT '0',
  `share_to_cat` tinyint(1) DEFAULT '0',
  `share_to_uob` tinyint(1) DEFAULT '0',
  `all_pc_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `edited_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`grow_id`),
  UNIQUE KEY `all_pc_id_2` (`all_pc_id`),
  KEY `all_pc_id` (`all_pc_id`),
  CONSTRAINT `grow_ibfk_1` FOREIGN KEY (`all_pc_id`) REFERENCES `master_client` (`all_pc_id`),
  CONSTRAINT `grow_ibfk_2` FOREIGN KEY (`all_pc_id`) REFERENCES `master_client` (`all_pc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grow`
--

LOCK TABLES `grow` WRITE;
/*!40000 ALTER TABLE `grow` DISABLE KEYS */;
INSERT INTO `grow` VALUES (1,1,1,1,1,100001,'2017-01-13 04:55:36','0000-00-00 00:00:00'),(2,1,0,1,0,100004,'2017-01-13 04:55:43','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `grow` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laporan_pembayaran_cat`
--

DROP TABLE IF EXISTS `laporan_pembayaran_cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laporan_pembayaran_cat` (
  `cat_user_id` int(11) NOT NULL,
  `angsuran_ke` int(11) NOT NULL,
  `tanggal_pembayaran_angsuran` date NOT NULL,
  `pembayaran_angsuran` int(11) NOT NULL,
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `edited_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`cat_user_id`,`angsuran_ke`),
  CONSTRAINT `laporan_pembayaran_cat_ibfk_1` FOREIGN KEY (`cat_user_id`) REFERENCES `cat` (`cat_user_id`) ON DELETE NO ACTION
) ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laporan_pembayaran_cat`
--

LOCK TABLES `laporan_pembayaran_cat` WRITE;
/*!40000 ALTER TABLE `laporan_pembayaran_cat` DISABLE KEYS */;
/*!40000 ALTER TABLE `laporan_pembayaran_cat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maintenance_green`
--

DROP TABLE IF EXISTS `maintenance_green`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `maintenance_green` (
  `green_assign_id` int(11) NOT NULL,
  `follow_up` int(11) NOT NULL,
  `keterangan` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edit_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`green_assign_id`,`follow_up`),
  CONSTRAINT `maintenance_green_ibfk_1` FOREIGN KEY (`green_assign_id`) REFERENCES `assign_green` (`green_assign_id`)
) ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maintenance_green`
--

LOCK TABLES `maintenance_green` WRITE;
/*!40000 ALTER TABLE `maintenance_green` DISABLE KEYS */;
/*!40000 ALTER TABLE `maintenance_green` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maintenance_grow`
--

DROP TABLE IF EXISTS `maintenance_grow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `maintenance_grow` (
  `grow_assign_id` int(11) NOT NULL,
  `follow_up` int(11) NOT NULL,
  `keterangan` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edit_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`grow_assign_id`,`follow_up`),
  CONSTRAINT `maintenance_grow_ibfk_1` FOREIGN KEY (`grow_assign_id`) REFERENCES `assign_grow` (`grow_assign_id`)
) ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maintenance_grow`
--

LOCK TABLES `maintenance_grow` WRITE;
/*!40000 ALTER TABLE `maintenance_grow` DISABLE KEYS */;
/*!40000 ALTER TABLE `maintenance_grow` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maintenance_redclub`
--

DROP TABLE IF EXISTS `maintenance_redclub`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `maintenance_redclub` (
  `redclub_assign_id` int(11) NOT NULL,
  `follow_up` int(11) NOT NULL,
  `keterangan` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edit_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`redclub_assign_id`,`follow_up`),
  CONSTRAINT `maintenance_redclub_ibfk_1` FOREIGN KEY (`redclub_assign_id`) REFERENCES `assign_redclub` (`redclub_assign_id`)
) ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maintenance_redclub`
--

LOCK TABLES `maintenance_redclub` WRITE;
/*!40000 ALTER TABLE `maintenance_redclub` DISABLE KEYS */;
/*!40000 ALTER TABLE `maintenance_redclub` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_client`
--

DROP TABLE IF EXISTS `master_client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_client` (
  `all_pc_id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) NOT NULL,
  `is_aclub_stock` tinyint(1) NOT NULL DEFAULT '0',
  `is_aclub_future` tinyint(1) NOT NULL DEFAULT '0',
  `is_cat` tinyint(1) NOT NULL DEFAULT '0',
  `is_mrg_premiere` tinyint(1) NOT NULL DEFAULT '0',
  `is_UOB` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(14) NOT NULL DEFAULT '0',
  `birthdate` date DEFAULT NULL,
  `line_id` varchar(100) DEFAULT NULL,
  `bb_pin` char(8) DEFAULT NULL,
  `twitter` varchar(25) DEFAULT NULL,
  `address` varchar(100) NOT NULL DEFAULT '',
  `city` varchar(20) DEFAULT '',
  `marital_status` varchar(15) DEFAULT NULL,
  `jenis_kelamin` char(1) DEFAULT NULL,
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `no_telp` varchar(10) DEFAULT NULL,
  `provinsi` varchar(20) DEFAULT NULL,
  `facebook` varchar(40) DEFAULT NULL,
  `edited_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`all_pc_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=100015 CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_client`
--

LOCK TABLES `master_client` WRITE;
/*!40000 ALTER TABLE `master_client` DISABLE KEYS */;
INSERT INTO `master_client` VALUES (100000,'Person 0X',0,0,0,0,0,'xxx','xxx',NULL,NULL,NULL,NULL,'xxx','xxx',NULL,NULL,'2016-12-21 18:13:17',NULL,NULL,NULL,'0000-00-00 00:00:00'),(100001,'Person 1X',0,0,0,0,0,'budigunawan@handsome.com','085X20000',NULL,NULL,NULL,NULL,'Budi Indah','Cimanis',NULL,NULL,'2016-12-21 18:13:17',NULL,NULL,NULL,'0000-00-00 00:00:00'),(100002,'Person 2X',0,0,0,0,1,'budigunawan@tampan.com','085X20000','0000-00-00',NULL,NULL,NULL,'Budi Indah','Cimanis',NULL,'P','2016-12-21 18:13:17',NULL,NULL,NULL,'0000-00-00 00:00:00'),(100003,'Person 3X',0,0,0,1,0,'budigunawan@xxx.com','085X20000',NULL,NULL,NULL,NULL,'Budi Indah','Cimanis',NULL,NULL,'2016-12-21 18:13:17',NULL,NULL,NULL,'0000-00-00 00:00:00'),(100004,'Person 4X',0,0,0,0,0,'budigunawan@xxxx.com','085X20000',NULL,NULL,NULL,NULL,'Budi Indah','Cimanis',NULL,NULL,'2016-12-21 18:13:17',NULL,NULL,NULL,'0000-00-00 00:00:00'),(100005,'Person 5X',0,0,0,0,0,'Tia@gmail.com','81554865','0000-00-00',NULL,NULL,NULL,'JL. Nin aza dulu. Rt. 21.Rw.05, Salam','Jakarta',NULL,'P','2016-12-21 18:13:17',NULL,NULL,NULL,'0000-00-00 00:00:00'),(100006,'Person 6X',0,0,0,0,0,'Tia@gmail2.com','81554865','0000-00-00',NULL,NULL,NULL,'JL. Nin aza dulu. Rt. 21.Rw.05, Salam','Jakarta',NULL,'P','2016-12-21 18:13:17',NULL,NULL,NULL,'0000-00-00 00:00:00'),(100007,'Person 7X',0,0,1,0,0,'tia@tiatia.com','123123','2016-12-28',NULL,NULL,NULL,'Jakarta','Jakarta',NULL,'L','2016-12-21 18:13:17',NULL,NULL,NULL,'0000-00-00 00:00:00'),(100008,'Person 8X',0,0,0,0,0,'budigunawan@xxxxxx.com','085X20000',NULL,NULL,NULL,NULL,'Budi Indah','Cimanis',NULL,NULL,'2016-12-22 06:38:40',NULL,NULL,NULL,'0000-00-00 00:00:00'),(100009,'Person 9X',0,0,0,0,0,'ramos@ganteng.com','123123123','2016-12-23','asdasd','12341234','@ramosjanoah','Cimahi','Cimahi',NULL,'L','2016-12-23 11:05:39','123','Jawa Barat','Ramos Janoah','0000-00-00 00:00:00'),(100010,'Person 10X',0,0,0,0,0,'ramos@ganteng2.com','123123123','2016-12-23','asdasd','12341234','@ramosjanoah','Cimahi','Cimahi',NULL,'L','2016-12-23 11:06:14','123','Jawa Barat','Ramos Janoah','0000-00-00 00:00:00'),(100011,'Person 11X',0,0,0,0,0,'ramosjanoah@gmail.com','08XXXXX','0000-00-00','ramosjanoahline','pinbb123','Twitter Ramos','Cimahi','Cimahi',NULL,'L','2016-12-25 15:05:36','022-6XXXX','Jawa Barat','Facebook Ramos','0000-00-00 00:00:00'),(100012,'Person 12X',0,0,1,0,0,'tia@astronacci.com','0212','1933-02-02',NULL,NULL,NULL,'Jakarta','Jakartaaa',NULL,'P','2016-12-28 14:05:41',NULL,NULL,NULL,'0000-00-00 00:00:00'),(100013,'Person 13',1,0,0,0,0,'sample@sample.com','08XX','1990-04-08','lineIDsample','testtest','Twittersample','Jalan Sample no.0','Kota Sample',NULL,'L','2017-01-13 16:26:36','022-XXX','Provinsi Sample','Facebooksample','0000-00-00 00:00:00'),(100014,'Person 14X',0,0,0,0,0,'sample@sample2.com','08XX','1990-04-08','lineIDsample','testtest','Twittersample','Jalan Sample no.0','Kota Sample',NULL,'L','2017-01-13 17:14:28','022-XXX','Provinsi Sample','Facebooksample','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `master_client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mrg`
--

DROP TABLE IF EXISTS `mrg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mrg` (
  `all_pc_id` int(11) DEFAULT NULL,
  `account` int(11) NOT NULL AUTO_INCREMENT,
  `join_date` date DEFAULT NULL,
  `type` varchar(25) DEFAULT NULL,
  `sales_username` varchar(40) DEFAULT NULL,
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`account`),
  UNIQUE KEY `all_pc_id_2` (`all_pc_id`),
  KEY `all_pc_id` (`all_pc_id`),
  KEY `sales_username` (`sales_username`),
  CONSTRAINT `mrg_ibfk_1` FOREIGN KEY (`all_pc_id`) REFERENCES `master_client` (`all_pc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1004 CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mrg`
--

LOCK TABLES `mrg` WRITE;
/*!40000 ALTER TABLE `mrg` DISABLE KEYS */;
INSERT INTO `mrg` VALUES (100003,1003,'2016-01-01','wellwell','Budi Gunawati','2016-12-21 18:14:36','2016-12-28 15:48:51');
/*!40000 ALTER TABLE `mrg` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER after_mrg_delete
    AFTER DELETE ON mrg
    FOR EACH ROW
BEGIN
    UPDATE master_client
    SET 
        is_mrg_premiere = false
    WHERE all_pc_id NOT IN (SELECT all_pc_id from mrg);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'Product 1');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER after_insert_product
BEFORE INSERT ON product
FOR EACH ROW
    BEGIN
        INSERT INTO product_sale_log
        VALUES (NULL, 'insert', NOW(), 'product');
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER after_update_product
BEFORE UPDATE ON product
FOR EACH ROW
    BEGIN
        INSERT INTO product_sale_log
        VALUES (NULL, 'update', NOW(), 'product');
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `product_sale`
--

DROP TABLE IF EXISTS `product_sale`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_sale` (
  `purchase_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `total_pembayaran` int(11) NOT NULL,
  `nama_pembeli` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `all_pc_id` int(11) DEFAULT NULL,
  `sales_username` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sale_date` date DEFAULT NULL,
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`purchase_id`),
  KEY `all_pc_id` (`all_pc_id`),
  KEY `sales_username` (`sales_username`),
  CONSTRAINT `product_sale_ibfk_1` FOREIGN KEY (`all_pc_id`) REFERENCES `master_client` (`all_pc_id`),
  CONSTRAINT `product_sale_ibfk_2` FOREIGN KEY (`sales_username`) REFERENCES `sales` (`sales_username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_sale`
--

LOCK TABLES `product_sale` WRITE;
/*!40000 ALTER TABLE `product_sale` DISABLE KEYS */;
INSERT INTO `product_sale` VALUES (1,1,2,20000,'Ramos',NULL,NULL,'2017-01-11','2017-01-11 14:37:05','2017-01-11 14:38:37'),(2,1,2,20000,'Ramos',NULL,NULL,'2017-01-13','2017-01-13 15:32:16','0000-00-00 00:00:00'),(3,1,2,20000,'Ramos',NULL,NULL,'2017-01-13','2017-01-13 15:37:34','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `product_sale` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER after_insert_product_sale
BEFORE INSERT ON product_sale
FOR EACH ROW
    BEGIN
        INSERT INTO product_sale_log
        VALUES (NULL, 'insert', NOW(), 'product_sale');
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER after_update_product_sale
BEFORE UPDATE ON product_sale
FOR EACH ROW
    BEGIN
        INSERT INTO product_sale_log
        VALUES (NULL, 'update', NOW(), 'product_sale');
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `product_sale_log`
--

DROP TABLE IF EXISTS `product_sale_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_sale_log` (
  `username` varchar(40) DEFAULT NULL,
  `activity` varchar(10) DEFAULT NULL,
  `activity_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `table_name` varchar(40) DEFAULT NULL
) ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_sale_log`
--

LOCK TABLES `product_sale_log` WRITE;
/*!40000 ALTER TABLE `product_sale_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_sale_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `redclub`
--

DROP TABLE IF EXISTS `redclub`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `redclub` (
  `username` varchar(40) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `email` varchar(256) NOT NULL,
  `join_date` date DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `all_pc_id` int(11) DEFAULT NULL,
  `occupation` varchar(40) DEFAULT NULL,
  `jenis_kelamin` char(1) DEFAULT NULL,
  `status_perkawinan` varchar(15) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `kota` varchar(20) DEFAULT NULL,
  `line_id` varchar(100) DEFAULT NULL,
  `blackberry_pin` char(8) DEFAULT NULL,
  `annual_come` int(11) DEFAULT NULL,
  `country` varchar(40) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `interest` varchar(40) DEFAULT NULL,
  `hobby` varchar(40) DEFAULT NULL,
  `spesific` varchar(40) DEFAULT NULL,
  `your_stock_and_future_broker` varchar(40) DEFAULT NULL,
  `trading_experience_year` int(3) DEFAULT NULL,
  `trading_type` varchar(3) DEFAULT NULL COMMENT 'Values : [S/F/SF]',
  `security_question` varchar(100) DEFAULT NULL,
  `security_answer` varchar(100) DEFAULT NULL,
  `facebook` varchar(40) DEFAULT NULL,
  `share_to_aclub` tinyint(1) DEFAULT '0',
  `share_to_mrg` tinyint(1) DEFAULT '0',
  `share_to_cat` tinyint(1) DEFAULT '0',
  `share_to_uob` tinyint(1) DEFAULT '0',
  `added_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edit_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`username`),
  KEY `all_pc_id` (`all_pc_id`),
  CONSTRAINT `redclub_ibfk_1` FOREIGN KEY (`all_pc_id`) REFERENCES `master_client` (`all_pc_id`)
) ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `redclub`
--

LOCK TABLES `redclub` WRITE;
/*!40000 ALTER TABLE `redclub` DISABLE KEYS */;
INSERT INTO `redclub` VALUES ('Ramos','Firstname','Lastname','Email','2016-12-26','08XXX',NULL,'Occupation','L','Married','Cimahi','Cimahi','Line_ID','12341234',200000,'2016-12-26','0000-00-00','Interest','Hobby','Spesific','SFBroker',2,'Typ','Question?','Answer','Facebook',1,1,1,1,'2016-12-26 10:12:40','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `redclub` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales` (
  `sales_username` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `other_info` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `edited_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `no_hp` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`sales_username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` VALUES ('username','sales ramos','','2016-12-23 10:56:34','0000-00-00 00:00:00','','');
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uob`
--

DROP TABLE IF EXISTS `uob`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uob` (
  `all_pc_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `class` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nomor` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expired_date` date NOT NULL,
  `kategori` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bulan` int(11) DEFAULT NULL,
  `bank` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nomor_rekening` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `RDI_niaga` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `RDI_BCA` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trading_via` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `source` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sales_username` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`client_id`),
  KEY `all_pc_id` (`all_pc_id`),
  KEY `sales_username` (`sales_username`),
  CONSTRAINT `uob_ibfk_1` FOREIGN KEY (`all_pc_id`) REFERENCES `master_client` (`all_pc_id`),
  CONSTRAINT `uob_ibfk_2` FOREIGN KEY (`sales_username`) REFERENCES `sales` (`sales_username`)
) ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uob`
--

LOCK TABLES `uob` WRITE;
/*!40000 ALTER TABLE `uob` DISABLE KEYS */;
INSERT INTO `uob` VALUES (100002,1236,'AKTIF','01.6207.340761.1187','2013-01-01','Katgori1',7,'Mandiri','1234678910',NULL,'4581987827','BROKER','UOB','TRISAH','2016-12-21 18:13:55','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `uob` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER after_uob_delete
    AFTER DELETE ON UOB
    FOR EACH ROW
BEGIN
    UPDATE master_client
    SET 
        is_UOB = false
    WHERE all_pc_id NOT IN (SELECT all_pc_id from UOB);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `username` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `a_shop_auth` tinyint(1) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `no_hp` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fullname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER check_insert_users
AFTER INSERT ON users
FOR EACH ROW
    BEGIN
        IF (new.role = 5) THEN
            INSERT INTO sales 
            (sales_username,
            fullname,
            add_time,
            email,
            no_hp)
            VALUES
            (new.username, new.fullname, NOW(), new.email, new.no_hp);
        END IF;
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Dumping events for database 'ads'
--
/*!50106 SET @save_time_zone= @@TIME_ZONE */ ;
/*!50106 DROP EVENT IF EXISTS `update_is_aclub_future` */;
DELIMITER ;;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;;
/*!50003 SET character_set_client  = cp850 */ ;;
/*!50003 SET character_set_results = cp850 */ ;;
/*!50003 SET collation_connection  = cp850_general_ci */ ;;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;;
/*!50003 SET @saved_time_zone      = @@time_zone */ ;;
/*!50003 SET time_zone             = 'SYSTEM' */ ;;
/*!50106 CREATE*/ /*!50117 DEFINER=`root`@`localhost`*/ /*!50106 EVENT `update_is_aclub_future` ON SCHEDULE EVERY 1 DAY STARTS '2017-01-14 00:15:00' ON COMPLETION PRESERVE ENABLE DO UPDATE master_client
    SET is_aclub_future = false
    WHERE all_pc_id NOT IN 
        ( SELECT all_pc_id FROM aclub_expdate_future 
            WHERE expired_date_bonus > CURDATE()) */ ;;
/*!50003 SET time_zone             = @saved_time_zone */ ;;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;;
/*!50003 SET character_set_client  = @saved_cs_client */ ;;
/*!50003 SET character_set_results = @saved_cs_results */ ;;
/*!50003 SET collation_connection  = @saved_col_connection */ ;;
/*!50106 DROP EVENT IF EXISTS `update_is_aclub_stock` */;;
DELIMITER ;;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;;
/*!50003 SET character_set_client  = cp850 */ ;;
/*!50003 SET character_set_results = cp850 */ ;;
/*!50003 SET collation_connection  = cp850_general_ci */ ;;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;;
/*!50003 SET @saved_time_zone      = @@time_zone */ ;;
/*!50003 SET time_zone             = 'SYSTEM' */ ;;
/*!50106 CREATE*/ /*!50117 DEFINER=`root`@`localhost`*/ /*!50106 EVENT `update_is_aclub_stock` ON SCHEDULE EVERY 1 DAY STARTS '2017-01-14 00:15:00' ON COMPLETION PRESERVE ENABLE DO UPDATE master_client
    SET is_aclub_stock = false
    WHERE all_pc_id NOT IN 
        ( SELECT all_pc_id FROM aclub_expdate_stock 
            WHERE expired_date_bonus > CURDATE()) */ ;;
/*!50003 SET time_zone             = @saved_time_zone */ ;;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;;
/*!50003 SET character_set_client  = @saved_cs_client */ ;;
/*!50003 SET character_set_results = @saved_cs_results */ ;;
/*!50003 SET collation_connection  = @saved_col_connection */ ;;
DELIMITER ;
/*!50106 SET TIME_ZONE= @save_time_zone */ ;

--
-- Dumping routines for database 'ads'
--
/*!50003 DROP FUNCTION IF EXISTS `max_all_pc_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `max_all_pc_id`() RETURNS int(11)
BEGIN
        SET @count = (SELECT Max(all_pc_id) FROM master_client);
        RETURN(IFNULL(@count,0));
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `max_green_assign_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `max_green_assign_id`() RETURNS int(11)
BEGIN
        SET @max = (SELECT Max(green_assign_id) FROM assign_green);
        RETURN(IFNULL(@max,0));
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `max_green_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `max_green_id`() RETURNS int(11)
BEGIN
        SET @count = (SELECT Max(green_id) FROM green);
        RETURN(IFNULL(@count,0));    
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `max_grow_assign_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `max_grow_assign_id`() RETURNS int(11)
BEGIN
        SET @max = (SELECT Max(grow_assign_id) FROM assign_grow);
        RETURN(IFNULL(@max,0));
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `max_grow_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `max_grow_id`() RETURNS int(11)
BEGIN
        SET @count = (SELECT Max(grow_id) FROM grow);
        RETURN(IFNULL(@count,0));
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `max_product_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `max_product_id`() RETURNS int(11)
BEGIN
        SET @max = (SELECT Max(product_id) FROM product);
        RETURN(IFNULL(@max,0));
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `max_purchase_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `max_purchase_id`() RETURNS int(11)
BEGIN
        SET @max = (SELECT Max(purchase_id) FROM product_sale);
        RETURN(IFNULL(@max,0));
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `max_reclub_assign_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `max_reclub_assign_id`() RETURNS int(11)
BEGIN
        SET @max = (SELECT Max(redclub_assign_id) FROM assign_redclub);
        RETURN(IFNULL(@max,0));
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `max_regis_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `max_regis_id`() RETURNS int(11)
BEGIN
        SET @count = (SELECT Max(registration_id) FROM aclub_registration);
        RETURN(IFNULL(@count,0));
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `add_report_green` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_report_green`(
    IN var_green_assign_id  int,
    IN var_report    varchar(150),
    IN var_is_succes tinyint(1)
    )
BEGIN
        UPDATE assign_green
        SET
        report_time = NOW(),
        report = var_report,
        is_succes = var_is_succes
        WHERE green_assign_id = var_green_assign_id;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `add_report_grow` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_report_grow`(
    IN var_grow_assign_id  int,
    IN var_report    varchar(150),
    IN var_is_succes tinyint(1)
    )
BEGIN
        UPDATE assign_grow
        SET
        report_time = NOW(),
        report = var_report,
        is_succes = var_is_succes
        WHERE grow_assign_id = var_grow_assign_id;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `add_report_redclub` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_report_redclub`(
    IN var_redclub_assign_id  int,
    IN var_report    varchar(150),
    IN var_is_succes tinyint(1)
    )
BEGIN
        UPDATE assign_redclub
        SET
        report_time = NOW(),
        report = var_report,
        is_succes = var_is_succes
        WHERE redclub_assign_id = var_redclub_assign_id;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `add_username_to_log` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_username_to_log`(
    IN var_username varchar(40)
    )
BEGIN
        UPDATE product_sale_log 
        SET username = var_username
        ORDER BY activity_time DESC
        LIMIT 1;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_aclub` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_aclub`(
    IN var_user_id int
    )
BEGIN
        delete from aclub_payment where user_id = var_user_id;
        delete from aclub_registration where user_id = var_user_id;
        delete from aclub where user_id = var_user_id;        
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_aclub_registration` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_aclub_registration`(
    var_registration_id int(11)
)
BEGIN
        delete from aclub_registration
        WHERE registration_id = var_registration_id;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_aclub_registration_alt` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_aclub_registration_alt`(
    var_registration_id int(11)
)
BEGIN
        delete from aclub_registration
        WHERE registration_id = var_registration_id;

        delete from aclub_payment
        WHERE registration_id = var_registration_id;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_assign_green` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_assign_green`(IN var_green_assign_id   int(11))
BEGIN
    DELETE FROM assign_green WHERE green_assign_id = var_green_assign_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_assign_grow` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_assign_grow`(IN var_grow_assign_id    int)
BEGIN
    DELETE FROM assign_grow WHERE grow_assign_id = var_grow_assign_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_assign_redclub` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_assign_redclub`(IN var_username    varchar(40))
BEGIN
    DELETE FROM assign_redclub WHERE username = var_username;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_cat` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_cat`(
    IN var_cat_user_id int
    )
BEGIN
        delete from laporan_pembayaran_cat where cat_user_id = var_cat_user_id;
        delete from cat where cat_user_id = var_cat_user_id;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_green` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_green`(IN id int(10) unsigned)
begin
delete from green
where green_id = id;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_grow` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_grow`(IN id int(10) unsigned)
begin
delete from grow
where grow_id = id;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_laporan_pembayaran_cat` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_laporan_pembayaran_cat`(
    var_cat_user_id  int(11),
    var_angsuran_ke  int(11)
)
BEGIN
        delete from laporan_pembayaran_cat
        WHERE 
        cat_user_id = var_cat_user_id and
        angsuran_ke = var_angsuran_ke;    
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_mrg` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_mrg`(IN id int(11))
begin
delete from mrg 
where account = id;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_redclub` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_redclub`(IN user varchar(40))
begin
delete from redclub
where username = user;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_uob` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_uob`(IN id int(11))
begin
delete from uob 
where client_id = id;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `edit_aclub` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_aclub`(
        IN var_all_pc_id                 int(11),
        IN var_user_id                   int(11),
        IN var_interest_and_hobby        varchar(40),
        IN var_trading_experience_year   tinyint(4),
        IN var_your_stock_future_broker  varchar(20),
        IN var_annual_income             int(11),
        IN var_security_question         varchar(255),
        IN var_security_answer           varchar(255),
        IN var_status                    varchar(20),
        IN var_keterangan                varchar(100),
        IN var_website                   varchar(100),
        IN var_state                     varchar(20),
        IN var_occupation                varchar(50)
    )
BEGIN
        
        UPDATE aclub 
        SET
        user_id = var_user_id,
        interest_and_hobby = var_interest_and_hobby,
        trading_experience_year = var_trading_experience_year,
        your_stock_future_broker = var_your_stock_future_broker,
        annual_income = var_annual_income,
        security_question = var_security_question,
        security_answer = var_security_answer,
        status = var_status,
        keterangan = var_keterangan,
        website = var_website,
        state = var_state,
        occupation = var_occupation,
        last_edited_at = NOW()
        WHERE all_pc_id = var_all_pc_id;
        
        END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `edit_aclub_payment` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_aclub_payment`(
    IN var_registration_id    int(11),
    IN var_user_id            int(11),
    IN var_nomor_pembayaran   int(11),
    IN var_tanggal_pembayaran date,
    IN var_nominal_pembayaran int(11),
    IN var_edited_time        timestamp
)
BEGIN
    UPDATE aclub_payment 
    SET 
        user_id = var_user_id,
        tanggal_pembayaran = var_tanggal_pembayaran,
        nominal_pembayaran = var_nominal_pembayaran,
        edited_time = NOW()
    WHERE registration_id = var_registration_id and nomor_pembayaran = var_nomor_pembayaran;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `edit_aclub_registration` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_aclub_registration`(
    IN var_registration_id  int(11),
    IN var_user_id          int(11),
    IN var_sales_username   varchar(40),
    IN var_broker           varchar(7),
    IN var_paket            varchar(2),
    IN var_registration_type   varchar(15),
    IN var_registration_date   date,
    IN var_jenis            varchar(5),
    IN var_nominal          int(11),
    IN var_percentage       int(11),
    IN var_comission_for_sales int(11),
    IN var_paid             int(11),
    IN var_paid_date        date,
    IN var_debt             int(11),
    IN var_frekuensi        tinyint(4),
    IN var_keterangan_ref   varchar(50),
    IN var_message          varchar(100),
    IN var_start_date       date,
    IN var_bulan_member     int(11),
    IN var_bonus_member_day int(11),
    IN var_sumber_data      varchar(50),
    IN var_last_edited_time timestamp
)
BEGIN
    
    UPDATE aclub_registration
    SET 
        registration_id = var_registration_id,
        user_id = var_user_id,
        sales_username = var_sales_username,
        broker = var_broker,
        paket = var_paket,
        registration_type = var_registration_type,
        registration_date = var_registration_date,
        jenis = var_jenis,
        nominal = var_nominal,
        percentage = var_percentage,
        comission_for_sales = var_comission_for_sales,
        paid = var_paid,
        paid_date = var_paid_date,
        debt = var_debt,
        frekuensi = var_frekuensi,
        keterangan_ref = var_keterangan_ref,
        message = var_message,
        start_date = var_start_date,
        bulan_member = var_bulan_member,
        expired_date = DATE_ADD(var_start_date, INTERVAL bulan_member month),
        bonus_member_day = var_bonus_member_day,
        expired_date_bonus = DATE_ADD(DATE_ADD(var_start_date, INTERVAL bulan_member month), INTERVAL bonus_member day),
        sumber_data = var_sumber_data,
        last_edited_time = NOW()
    WHERE registration_id = var_registration_id;
    
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `edit_assign_green` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_assign_green`(
    IN var_green_assign_id  int,
    IN var_green_id         int(10) unsigned,
    IN var_sales_username   varchar(40),
    IN var_prospect_to      varchar(10),
    IN var_admin_username   varchar(40),
    IN var_keterangan       varchar(150)
    )
BEGIN
        UPDATE assign_green
        SET
        sales_username = var_sales_username,
        prospect_to = var_prospect_to,
        admin_username = var_admin_username,
        keterangan = var_keterangan
        WHERE green_assign_id = var_green_assign_id;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `edit_assign_grow` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_assign_grow`(
    IN var_grow_assign_id   int,
    IN var_grow_id          int(10) unsigned,
    IN var_sales_username   varchar(40),
    IN var_prospect_to      varchar(10),
    IN var_admin_username   varchar(40),
    IN var_keterangan       varchar(150)
    )
BEGIN
        UPDATE assign_grow
        SET
        sales_username = var_sales_username,
        prospect_to = var_prospect_to,
        admin_username = var_admin_username,
        keterangan = var_keterangan,
        last_edited_time = NOW()
        WHERE grow_assign_id = var_grow_assign_id;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `edit_assign_redclub` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_assign_redclub`(
    IN var_redclub_assign_id int,
    IN var_username         varchar(40),
    IN var_sales_username   varchar(40),
    IN var_prospect_to      varchar(10),
    IN var_admin_username   varchar(40),
    IN var_keterangan       varchar(150)
    )
BEGIN
        UPDATE assign_redclub
        SET
        sales_username = var_sales_username,
        prospect_to = var_prospect_to,
        admin_username = var_admin_username,
        keterangan = var_keterangan,
        last_edited_time = NOW()
        WHERE redclub_assign_id = var_redclub_assign_id;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `edit_cat` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_cat`(
    IN var_all_pc_id              int(11),
    IN var_cat_user_id            int(11),
    IN var_cat_no_induk           int(11),
    IN var_cat_username           varchar(40),
    IN var_password               varchar(255),
    IN var_batch                  varchar(10),
    IN var_tanggal_pendaftaran    date,
    IN var_tanggal_kelas_berakhir date,
    IN var_sales_username         varchar(40)
)
BEGIN 
    
    UPDATE cat 
    SET
    cat_user_id = var_cat_user_id,
    cat_no_induk = var_cat_no_induk,
    cat_username = var_cat_username,
    password = var_password,
    batch = var_batch,
    tanggal_pendaftaran = var_tanggal_pendaftaran,
    tanggal_kelas_berakhir = var_tanggal_kelas_berakhir,
    sales_username = var_sales_username,
    last_edited_time = NOW()
    WHERE all_pc_id = var_all_pc_id;
    
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `edit_green` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_green`(
    IN var_green_id            int(10) unsigned,
    IN var_fullname            varchar(50),
    IN var_no_hp               varchar(15),
    IN var_keterangan_perintah varchar(50),
    IN var_sumber              varchar(20),
    IN var_sales_username      varchar(40),
    IN var_progress            varchar(50),
    IN var_is_aclub_stock      tinyint(1),
    IN var_is_aclub_future     tinyint(1),
    IN var_is_cat              tinyint(1),
    IN var_is_mrg_premiere     tinyint(1),
    IN var_is_UOB              tinyint(1),
    IN var_is_red_club         tinyint(1),
    IN var_share_to_aclub      tinyint(1),
    IN var_share_to_mrg        tinyint(1),
    IN var_share_to_cat        tinyint(1),
    IN var_share_to_uob        tinyint(1)
)
BEGIN
        UPDATE green
        SET
        fullname = var_fullname,
        no_hp = var_no_hp,
        keterangan_perintah = var_keterangan_perintah,
        sumber = var_sumber,
        sales_username = var_sales_username,
        progress = var_progress,
        is_aclub_stock = var_is_aclub_stock,
        is_aclub_future = var_is_aclub_future,
        is_cat = var_is_cat,
        is_mrg_premiere = var_is_mrg_premiere,
        is_UOB = var_is_UOB,
        is_red_club = var_is_red_club,
        share_to_aclub = var_share_to_aclub,
        share_to_mrg = var_share_to_mrg,
        share_to_cat = var_share_to_cat,
        share_to_uob = var_share_to_uob,
        edited_time = NOW()
        WHERE
        green_id = var_green_id;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `edit_grow` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_grow`(
    IN var_grow_id         int(10) unsigned,
    IN var_share_to_aclub  tinyint(1),
    IN var_share_to_mrg    tinyint(1),
    IN var_share_to_cat    tinyint(1),
    IN var_share_to_uob    tinyint(1),
    IN var_all_pc_id       int(11)
)
BEGIN
    UPDATE grow
    SET
    share_to_aclub = var_share_to_aclub,
    share_to_mrg = var_share_to_mrg,
    share_to_cat = var_share_to_cat,
    share_to_uob = var_share_to_uob,
    all_pc_id = var_all_pc_id,
    edited_time = NOW()   
    WHERE all_pc_id = var_all_pc_id;
    
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `edit_laporan_pembayaran_cat` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_laporan_pembayaran_cat`(
    IN var_cat_user_id                 int(11),
    IN var_angsuran_ke                 int(11),
    IN var_tanggal_pembayaran_angsuran date,
    IN var_pembayaran_angsuran         int(11)
)
BEGIN
    
    UPDATE laporan_pembayaran_cat
    SET 
    angsuran_ke = var_angsuran_ke,
    tanggal_pembayaran_angsuran = var_tanggal_pembayaran_angsuran,
    pembayaran_angsuran = var_pembayaran_angsuran,
    edited_time = NOW()
    WHERE user_id = var_cat_user_id;
    
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `edit_master_client` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_master_client`(
    var_all_pc_id        int(11),
    var_fullname         varchar(100),
    var_email            varchar(100),
    var_no_hp            varchar(14),
    var_birthdate        date,
    var_line_id          varchar(100),
    var_bb_pin           char(8),
    var_twitter          varchar(25),
    var_address          varchar(100),
    var_city             varchar(20),
    var_marital_status   varchar(15),
    var_jenis_kelamin    char(1),
    var_no_telp          varchar(10),
    var_provinsi         varchar(20),
    var_facebook         varchar(40)
)
BEGIN
    UPDATE master_client 
    SET
    fullname = var_fullname,
    email = var_email,
    no_hp = var_no_hp,
    birthdate = var_birthdate,
    line_id = var_line_id,
    bb_pin = var_bb_pin,
    twitter = var_twitter,
    address = var_address,
    city = var_city,
    marital_status = var_marital_status,
    jenis_kelamin = var_jenis_kelamin,
    no_telp = var_no_telp,
    provinsi = var_provinsi,
    facebook = var_facebook,
    edited_time = NOW()
    WHERE all_pc_id = var_all_pc_id;
    
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `edit_mrg` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_mrg`(
    IN var_all_pc_id         int(11),
    IN var_account           int(11),
    IN var_join_date         date,
    IN var_type              varchar(25),
    IN var_sales_username    varchar(40)
)
BEGIN
    UPDATE mrg
    SET
    account = var_account,
    join_date = var_join_date,
    type = var_type,
    sales_username = var_sales_username,
    last_edited_time = NOW()
    WHERE all_pc_id = var_all_pc_id;
        
    
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `edit_product_sale` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_product_sale`(
     IN var_purchase_id      int(10) unsigned,
     IN var_product_id       int(11),
     IN var_jumlah           int(11),
     IN var_total_pembayaran int(11),
     IN var_nama_pembeli     varchar(50),
     IN var_all_pc_id        int(11),
     IN var_sales_username   varchar(40),
     IN var_sale_date        date
     )
BEGIN  
        UPDATE product_sale
        SET
        purchase_id = var_purchase_id,
        product_id = var_product_id,
        jumlah = var_jumlah,
        total_pembayaran = var_total_pembayaran,
        nama_pembeli = var_nama_pembeli,
        all_pc_id = var_all_pc_id,
        sales_username = var_sales_username,
        sale_date = var_sale_date,
        last_edited_time = NOW()
        WHERE purchase_id = var_purchase_id;
     END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `edit_redclub` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_redclub`(
    IN var_username                      varchar(40),
    IN var_firstname                     varchar(40),
    IN var_lastname                      varchar(40),
    IN var_email                         varchar(256),
    IN var_join_date                     date,
    IN var_no_hp                         varchar(15),
    IN var_all_pc_id                     int(11),
    IN var_occupation                    varchar(40),
    IN var_jenis_kelamin                 char(1),
    IN var_status_perkawinan             varchar(15),
    IN var_alamat                        varchar(100),
    IN var_kota                          varchar(20),
    IN var_line_id                       varchar(100),
    IN var_blackberry_pin                char(8),
    IN var_annual_come                   int(11),
    IN var_country                       varchar(40),
    IN var_birthdate                     date,
    IN var_interest                      varchar(40),
    IN var_hobby                         varchar(40),
    IN var_spesific                      varchar(40),
    IN var_your_stock_and_future_broker  varchar(40),
    IN var_trading_experience_year       int(3),
    IN var_trading_type                  varchar(3),
    IN var_security_question             varchar(100),
    IN var_security_answer               varchar(100),
    IN var_facebook                      varchar(40),
    IN var_share_to_aclub                tinyint(1),
    IN var_share_to_mrg                  tinyint(1),
    IN var_share_to_cat                  tinyint(1),
    IN var_share_to_uob                  tinyint(1)
    )
BEGIN
    UPDATE redclub
    SET 
        firstname = var_firstname,
        lastname = var_lastname,
        email = var_email,
        join_date = var_join_date,
        no_hp = var_no_hp,
        all_pc_id = var_all_pc_id,
        occupation = var_occupation,
        jenis_kelamin = var_jenis_kelamin,
        status_perkawinan = var_status_perkawinan,
        alamat = var_alamat,
        kota = var_kota,
        line_id = var_line_id,
        blackberry_pin = var_blackberry_pin,
        annual_come = var_annual_come,
        country = var_country,
        birthdate = var_birthdate,
        interest = var_interest,
        hobby = var_hobby,
        spesific = var_spesific,
        your_stock_and_future_broker = var_your_stock_and_future_broker,
        trading_experience_year = var_trading_experience_year,
        trading_type = var_trading_type,
        security_question = var_security_question,
        security_answer = var_security_answer,
        facebook = var_facebook,
        share_to_aclub = var_share_to_aclub,
        share_to_mrg = var_share_to_mrg,
        share_to_cat = var_share_to_cat,
        share_to_uob = var_share_to_uob,
        last_edit_time = NOW()
    WHERE username = var_username;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `edit_uob` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_uob`(
    IN var_all_pc_id        int(11),
    IN var_client_id        int(11),
    IN var_class            varchar(20),
    IN var_nomor            varchar(20),
    IN var_expired_date     date,
    IN var_kategori         varchar(20),
    IN var_bulan            int(11),
    IN var_bank             varchar(20),
    IN var_nomor_rekening   varchar(20),
    IN var_RDI_niaga        varchar(20),
    IN var_RDI_BCA          varchar(20),
    IN var_trading_via      varchar(20),
    IN var_source           varchar(20),
    IN var_sales_username   varchar(40)
)
BEGIN
    UPDATE uob
    SET
    client_id = var_client_id,
    class = var_class,
    nomor = var_nomor,
    expired_date = var_expired_date,
    kategori = var_kategori,
    bulan = var_bulan,
    bank = var_bank,
    nomor_rekening = var_nomor_rekening,
    RDI_niaga = var_RDI_niaga,
    RDI_BCA = var_RDI_BCA,
    trading_via = var_trading_via,
    source = var_source,
    sales_username = var_sales_username,
    last_edited_time = NOW()
    WHERE all_pc_id = var_all_pc_id;
    
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `inputaclub` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `inputaclub`(
        varRegistrationDate date, 
        varKodePaket varchar(2),
        varUserID int,
        varNama varchar(40),
        varNoHP varchar(14),
        varNoTelp varchar(10),
        varAlamat varchar(100),
        varKota varchar(20),
        varProvinsi varchar(20),
        varEmail varchar(100),
        varTanggalLahir date,
        varLineID varchar(100),
        varPinBB char(8),
        varFacebook varchar(40),
        varTwitter varchar(25),
        varJenisKelamin char(1),
        varWebsite varchar(100),
        varState varchar(20),
        varInterestHobby varchar(40),
        varTradingExperienceYear tinyint(4),
        varYourStockAndBroker varchar(20),
        varAnnualIncome int,
        varSalesUsername varchar(40),
        varStartDate date,
        varBulanMember int,
        varExpiredDate date,
        varBonusMember int,
        varExpiredDateBonus date,
        varRegistrationType varchar(15),
        varSumberData varchar(50),
        varBroker varchar(7),
        varMessage varchar(100),
        varKeterangan varchar(50),
        varStatus varchar(20),
        varSecurityQuestion varchar(255),
        varSecurityAnswer varchar(255),
        varOccupation varchar(50)
        )
BEGIN
        IF (LEFT(varKodePaket, 1) = 'S') THEN
            BEGIN
                INSERT INTO master_client
                (all_pc_id, fullname, no_hp, no_telp, address, city, provinsi, 
                email, birthdate, line_id, bb_pin, facebook, twitter, jenis_kelamin, is_aclub_stock)
                VALUES
                (max_all_pc_id() + 1, varNama, varNoHP, varNoTelp, varAlamat, varKota, varProvinsi, 
                varEmail, varTanggalLahir, varLineID, varPinBB, varFacebook, varTwitter, varJenisKelamin, true)
                ON DUPLICATE KEY UPDATE
                is_aclub_stock = true, 
                birthdate = varTanggalLahir, 
                jenis_kelamin = varJenisKelamin, 
                line_id =  varLineID,
                bb_pin = varPinBB,
                facebook = varFacebook,
                twitter = varTwitter,
                no_telp = varNoTelp,
                is_aclub_stock = true;
            END;
            ELSEIF (LEFT(varKodePaket, 1) = 'F') THEN
            BEGIN
                INSERT INTO master_client
                (all_pc_id, fullname, no_hp, no_telp, address, city, provinsi, 
                email, birthdate, line_id, bb_pin, facebook, twitter, jenis_kelamin, is_aclub_future)
                VALUES
                (max_all_pc_id() + 1, varNama, varNoHP, varNoTelp, varAlamat, varKota, varProvinsi, 
                varEmail, varTanggalLahir, varLineID, varPinBB, varFacebook, varTwitter, varJenisKelamin, true)
                ON DUPLICATE KEY UPDATE
                is_aclub_future = true, 
                birthdate = varTanggalLahir, 
                jenis_kelamin = varJenisKelamin, 
                line_id =  varLineID,
                bb_pin = varPinBB,
                facebook = varFacebook,
                twitter = varTwitter,
                no_telp = varNoTelp,
                is_aclub_future = true;            
            END;
        END IF;
    
        SET @pc_id = (SELECT all_pc_id FROM master_client
        WHERE email = varEmail);

        INSERT INTO aclub
        VALUES
        (@pc_id, varUserID, varInterestHobby, varTradingExperienceYear, 
        varYourStockAndBroker, varAnnualIncome, varSecurityQuestion, 
        varSecurityAnswer, varStatus, varKeterangan, varWebsite, 
        varState, NOW(), varOccupation)
        ON DUPLICATE KEY UPDATE
        interest_and_hobby = varInterestHobby,
        trading_experience_year = varTradingExperienceYear,
        your_stock_future_broker = varYourStockAndBroker,
        annual_income = varAnnualIncome, 
        status = varStatus,
        keterangan = varKeterangan,
        occupation = varOccupation; 
        
        INSERT INTO aclub_registration  
        (registration_id, user_id, sales_username, broker, paket, registration_type,
        registration_date, start_date, bulan_member, expired_date, bonus_member_day,
        expired_date_bonus, added_time, sumber_data)
        VALUES 
        (max_regis_id() + 1, varUserID,
        varSalesUsername, varBroker, varKodePaket, varRegistrationType, 
        varRegistrationDate, varStartDate, varBulanMember, varExpiredDate, 
        varBonusMember, varExpiredDateBonus, NOW(), varSumberData);
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `inputaclub_2` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `inputaclub_2`(
        varRegistrationDate date, 
        varKodePaket varchar(2),
        varUserID int,
        varNama varchar(40),
        varNoHP varchar(14),
        varNoTelp varchar(10),
        varAlamat varchar(100),
        varKota varchar(20),
        varProvinsi varchar(20),
        varEmail varchar(100),
        varTanggalLahir date,
        varLineID varchar(100),
        varPinBB char(8),
        varFacebook varchar(40),
        varTwitter varchar(25),
        varJenisKelamin char(1),
        varOccupation varchar(50),
        varWebsite varchar(100),
        varState varchar(20),
        varInterestHobby varchar(40),
        varTradingExperienceYear tinyint(4),
        varYourStockAndBroker varchar(20),
        varAnnualIncome int,
        varStatus varchar(20),
        varSecurityQuestion varchar(255),
        varSecurityAnswer varchar(255),
        varSalesUsername varchar(40),
        varRegistrationType varchar(15),
        varStartDate date,
        varBulanMember int,
        
        varBonusMember int,
        
        varSumberData varchar(50),
        varBroker varchar(7),
        varMessage varchar(100),
        varKeterangan varchar(50),
        varJenis varchar(5),
        varNominalMember int,
        varPercentage int, 
        
        varPaid int,
        varPaidDate date,
        varDebt int, 
        varFrekuensi tinyint(4)
        )
BEGIN
        IF (LEFT(varKodePaket, 1) = 'S') THEN
            BEGIN
                INSERT INTO master_client
                (all_pc_id, fullname, no_hp, no_telp, address, city, provinsi, 
                email, birthdate, line_id, bb_pin, facebook, twitter, jenis_kelamin, is_aclub_stock)
                VALUES
                (max_all_pc_id() + 1, varNama, varNoHP, varNoTelp, varAlamat, varKota, varProvinsi, 
                varEmail, varTanggalLahir, varLineID, varPinBB, varFacebook, varTwitter, varJenisKelamin, true)
                ON DUPLICATE KEY UPDATE
                is_aclub_stock = true, 
                line_id =  varLineID,
                bb_pin = varPinBB,
                facebook = varFacebook,
                twitter = varTwitter,
                no_telp = varNoTelp,
                is_aclub_stock = true;
            END;
            ELSEIF (LEFT(varKodePaket, 1) = 'F') THEN
            BEGIN
                INSERT INTO master_client
                (all_pc_id, fullname, no_hp, no_telp, address, city, provinsi, 
                email, birthdate, line_id, bb_pin, facebook, twitter, jenis_kelamin, is_aclub_future)
                VALUES
                (max_all_pc_id() + 1, varNama, varNoHP, varNoTelp, varAlamat, varKota, varProvinsi, 
                varEmail, varTanggalLahir, varLineID, varPinBB, varFacebook, varTwitter, varJenisKelamin, true)
                ON DUPLICATE KEY UPDATE
                is_aclub_future = true, 
                line_id =  varLineID,
                bb_pin = varPinBB,
                facebook = varFacebook,
                twitter = varTwitter,
                no_telp = varNoTelp,
                is_aclub_future = true;            
            END;
        END IF;
    
        SET @pc_id = (SELECT all_pc_id FROM master_client
        WHERE email = varEmail);

        INSERT INTO aclub
        VALUES
        (@pc_id, varUserID, varInterestHobby, varTradingExperienceYear, 
        varYourStockAndBroker, varAnnualIncome, varSecurityQuestion, 
        varSecurityAnswer, varStatus, varKeterangan, varWebsite, 
        varState, NOW(), varOccupation)
        ON DUPLICATE KEY UPDATE
        interest_and_hobby = varInterestHobby,
        trading_experience_year = varTradingExperienceYear,
        your_stock_future_broker = varYourStockAndBroker,
        annual_income = varAnnualIncome, 
        status = varStatus,
        keterangan = varKeterangan,
        occupation = varOccupation; 
        
        INSERT INTO aclub_registration  
        (registration_id, user_id, sales_username, 
        broker, paket, registration_type,
        registration_date, start_date, bulan_member, 
        expired_date, bonus_member_day, 
        expired_date_bonus, 
        added_time, sumber_data,
        nominal, percentage, comission_for_sales,
        paid, paid_date, Debt, message, jenis
        )
        VALUES 
        (max_regis_id() + 1, varUserID, varSalesUsername, 
        varBroker, varKodePaket, varRegistrationType, 
        varRegistrationDate, varStartDate, varBulanMember, 
        date_add(varStartDate, interval varBulanMember month), varBonusMember, 
        date_add(date_add(varStartDate, interval varBulanMember month), interval varBonusMember day), 
        NOW(), varSumberData,
        varNominalMember, varPercentage, ((varNominalMember*varPercentage)/100),
        varPaid, varPaidDate, varDebt, varMessage, varJenis);


        IF (SUBSTR(varKodePaket, 2, 1) = 'S') THEN
            BEGIN
                INSERT INTO aclub_payment
                VALUES 
                (max_regis_id(), varUserID, 1, varRegistrationDate, varNominalMember, NOW());
            END;
            ELSEIF (SUBSTR(varKodePaket, 2, 1) = 'F') THEN
            BEGIN
                INSERT INTO aclub_payment
                VALUES
                (max_regis_id(), varUserID, 1, varRegistrationDate, varNominalMember/6, NOW()),
                (max_regis_id(), varUserID, 2, DATE_ADD(varRegistrationDate,INTERVAL 1 month), varNominalMember/6, NOW()),
                (max_regis_id(), varUserID, 3, DATE_ADD(varRegistrationDate,INTERVAL 2 month), varNominalMember/6, NOW()),
                (max_regis_id(), varUserID, 4, DATE_ADD(varRegistrationDate,INTERVAL 3 month), varNominalMember/6, NOW()),
                (max_regis_id(), varUserID, 5, DATE_ADD(varRegistrationDate,INTERVAL 4 MONTH), varNominalMember/6, NOW()),
                (max_regis_id(), varUserID, 6, DATE_ADD(varRegistrationDate,INTERVAL 5 MONTH), varNominalMember/6, NOW());
            END;
            ELSEIF (SUBSTR(varKodePaket, 2, 1) = 'P') THEN
            BEGIN
                INSERT INTO aclub_payment
                VALUES
                (max_regis_id(), varUserID, 1, varRegistrationDate, varNominalMember/12, NOW()),
                (max_regis_id(), varUserID, 2, DATE_ADD(varRegistrationDate, INTERVAL 1 MONTH), varNominalMember/12, NOW()),
                (max_regis_id(), varUserID, 3, DATE_ADD(varRegistrationDate, INTERVAL 2 MONTH), varNominalMember/12, NOW()),
                (max_regis_id(), varUserID, 4, DATE_ADD(varRegistrationDate, INTERVAL 3 MONTH), varNominalMember/12, NOW()),
                (max_regis_id(), varUserID, 5, DATE_ADD(varRegistrationDate, INTERVAL 4 MONTH), varNominalMember/12, NOW()),
                (max_regis_id(), varUserID, 6, DATE_ADD(varRegistrationDate, INTERVAL 5 MONTH), varNominalMember/12, NOW()),
                (max_regis_id(), varUserID, 7, DATE_ADD(varRegistrationDate, INTERVAL 6 MONTH), varNominalMember/12, NOW()),
                (max_regis_id(), varUserID, 8, DATE_ADD(varRegistrationDate, INTERVAL 7 MONTH), varNominalMember/12, NOW()),
                (max_regis_id(), varUserID, 9, DATE_ADD(varRegistrationDate, INTERVAL 8 MONTH), varNominalMember/12, NOW()),
                (max_regis_id(), varUserID, 10, DATE_ADD(varRegistrationDate, INTERVAL 8 MONTH), varNominalMember/12, NOW()),
                (max_regis_id(), varUserID, 11, DATE_ADD(varRegistrationDate, INTERVAL 10 MONTH), varNominalMember/12, NOW()),
                (max_regis_id(), varUserID, 12, DATE_ADD(varRegistrationDate, INTERVAL 11 MONTH), varNominalMember/12, NOW());
            END;
        END IF;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `inputaclub_member` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `inputaclub_member`(
        varUserID int,
        varNama varchar(40),
        varNoHP varchar(14),
        varNoTelp varchar(10),
        varAlamat varchar(100),
        varKota varchar(20),
        varProvinsi varchar(20),
        varEmail varchar(100),
        varTanggalLahir date,
        varLineID varchar(100),
        varPinBB char(8),
        varFacebook varchar(40),
        varTwitter varchar(25),
        varJenisKelamin char(1),
        varOccupation varchar(50),
        varWebsite varchar(100),
        varState varchar(20),
        varInterestHobby varchar(40),
        varTradingExperienceYear tinyint(4),
        varYourStockAndBroker varchar(20),
        varAnnualIncome int,
        varStatus varchar(20),
        varKeterangan varchar(50),
        varSecurityQuestion varchar(255),
        varSecurityAnswer varchar(255)
        )
BEGIN
        INSERT INTO master_client
        (all_pc_id, fullname, no_hp, no_telp, address, city, provinsi, 
        email, birthdate, line_id, bb_pin, facebook, twitter, jenis_kelamin)
        VALUES
        (max_all_pc_id() + 1, varNama, varNoHP, varNoTelp, varAlamat, varKota, varProvinsi, 
        varEmail, varTanggalLahir, varLineID, varPinBB, varFacebook, varTwitter, varJenisKelamin)
        ON DUPLICATE KEY UPDATE
        line_id =  varLineID,
        bb_pin = varPinBB,
        facebook = varFacebook,
        twitter = varTwitter,
        no_telp = varNoTelp;
            
        SET @pc_id = (SELECT all_pc_id FROM master_client
        WHERE email = varEmail);

        INSERT INTO aclub
        VALUES
        (@pc_id, varUserID, varInterestHobby, varTradingExperienceYear, 
        varYourStockAndBroker, varAnnualIncome, varSecurityQuestion, 
        varSecurityAnswer, varStatus, varKeterangan, varWebsite, 
        varState, NOW(), varOccupation, NULL)
        ON DUPLICATE KEY UPDATE
        interest_and_hobby = varInterestHobby,
        trading_experience_year = varTradingExperienceYear,
        your_stock_future_broker = varYourStockAndBroker,
        annual_income = varAnnualIncome, 
        status = varStatus,
        keterangan = varKeterangan,
        occupation = varOccupation; 
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `inputaclub_registration` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `inputaclub_registration`(
        varUserID int,
        varRegistrationDate date, 
        varKodePaket varchar(2),
        varSalesUsername varchar(40),
        varRegistrationType varchar(15),
        varStartDate date,
        varBulanMember int,
        
        varBonusMember int,
        
        varSumberData varchar(50),
        varBroker varchar(7),
        varMessage varchar(100),
        varJenis varchar(5),
        varNominalMember int,
        varPercentage int, 
        
        varPaid int,
        varPaidDate date,
        varDebt int, 
        varFrekuensi tinyint(4)

    )
BEGIN
        SET @pc_id = (SELECT all_pc_id FROM 
        master_client natural join aclub
        WHERE (user_id = varUserID));

        IF (LEFT(varKodePaket, 1) = 'S') THEN
            BEGIN
                UPDATE master_client SET is_aclub_stock = true WHERE
                all_pc_id = @pc_id;
            END;
            ELSEIF (LEFT(varKodePaket, 1) = 'F') THEN
                UPDATE master_client SET is_aclub_future = true WHERE
                all_pc_id = @pc_id;
            BEGIN
            END;
        END IF;

        INSERT INTO aclub_registration  
        (registration_id, 
        user_id, 
        sales_username, 
        broker, 
        paket, 
        registration_type,
        registration_date, 
        start_date, 
        bulan_member, 
        expired_date, 
        bonus_member_day, 
        expired_date_bonus, 
        added_time, sumber_data,
        nominal, 
        percentage, 
        comission_for_sales,
        paid, 
        paid_date, 
        debt, 
        message, 
        jenis
        )
        VALUES 
        (max_regis_id() + 1, 
        varUserID, 
        varSalesUsername, 
        varBroker, 
        varKodePaket, 
        varRegistrationType, 
        varRegistrationDate, 
        varStartDate, 
        varBulanMember, 
        date_add(varStartDate, interval varBulanMember month), 
        varBonusMember, 
        date_add(date_add(varStartDate, interval varBulanMember month), interval varBonusMember day), 
        NOW(), varSumberData,
        varNominalMember, varPercentage, ((varNominalMember*varPercentage)/100),
        varPaid, varPaidDate, varDebt, varMessage, varJenis);
    
        IF (SUBSTR(varKodePaket, 2, 1) = 'S') THEN
            BEGIN
                INSERT INTO aclub_payment
                VALUES 
                (max_regis_id(), varUserID, 1, varRegistrationDate, varNominalMember, NOW(), 0);
            END;
            ELSEIF (SUBSTR(varKodePaket, 2, 1) = 'F') THEN
            BEGIN
                INSERT INTO aclub_payment
                VALUES
                (max_regis_id(), varUserID, 1, varRegistrationDate, varNominalMember/6, NOW(), 0),
                (max_regis_id(), varUserID, 2, DATE_ADD(varRegistrationDate,INTERVAL 1 month), varNominalMember/6, NOW(), 0),
                (max_regis_id(), varUserID, 3, DATE_ADD(varRegistrationDate,INTERVAL 2 month), varNominalMember/6, NOW(), 0),
                (max_regis_id(), varUserID, 4, DATE_ADD(varRegistrationDate,INTERVAL 3 month), varNominalMember/6, NOW(), 0),
                (max_regis_id(), varUserID, 5, DATE_ADD(varRegistrationDate,INTERVAL 4 MONTH), varNominalMember/6, NOW(), 0),
                (max_regis_id(), varUserID, 6, DATE_ADD(varRegistrationDate,INTERVAL 5 MONTH), varNominalMember/6, NOW(), 0);
            END;
            ELSEIF (SUBSTR(varKodePaket, 2, 1) = 'P') THEN
            BEGIN
                INSERT INTO aclub_payment
                VALUES
                (max_regis_id(), varUserID, 1, varRegistrationDate, varNominalMember/12, NOW(), 0),
                (max_regis_id(), varUserID, 2, DATE_ADD(varRegistrationDate, INTERVAL 1 MONTH), varNominalMember/12, NOW(), 0),
                (max_regis_id(), varUserID, 3, DATE_ADD(varRegistrationDate, INTERVAL 2 MONTH), varNominalMember/12, NOW(), 0),
                (max_regis_id(), varUserID, 4, DATE_ADD(varRegistrationDate, INTERVAL 3 MONTH), varNominalMember/12, NOW(), 0),
                (max_regis_id(), varUserID, 5, DATE_ADD(varRegistrationDate, INTERVAL 4 MONTH), varNominalMember/12, NOW(), 0),
                (max_regis_id(), varUserID, 6, DATE_ADD(varRegistrationDate, INTERVAL 5 MONTH), varNominalMember/12, NOW(), 0),
                (max_regis_id(), varUserID, 7, DATE_ADD(varRegistrationDate, INTERVAL 6 MONTH), varNominalMember/12, NOW(), 0),
                (max_regis_id(), varUserID, 8, DATE_ADD(varRegistrationDate, INTERVAL 7 MONTH), varNominalMember/12, NOW(), 0),
                (max_regis_id(), varUserID, 9, DATE_ADD(varRegistrationDate, INTERVAL 8 MONTH), varNominalMember/12, NOW(), 0),
                (max_regis_id(), varUserID, 10, DATE_ADD(varRegistrationDate, INTERVAL 8 MONTH), varNominalMember/12, NOW(), 0),
                (max_regis_id(), varUserID, 11, DATE_ADD(varRegistrationDate, INTERVAL 10 MONTH), varNominalMember/12, NOW(), 0),
                (max_regis_id(), varUserID, 12, DATE_ADD(varRegistrationDate, INTERVAL 11 MONTH), varNominalMember/12, NOW(), 0);
            END;
        END IF;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `inputCAT` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `inputCAT`(
    IN varSalesUsername varchar(40),
    IN varBATCH varchar(10),
    IN varUserID int, 
    IN varNoInduk int, 
    IN varPendaftaran date,
    IN varKelasBerakhir date, 
    IN varUserName varchar(40),
    IN varPassword varchar(40),
    IN varNama varchar(100), 
    IN varJK char(1),
    IN varEmail varchar(100), 
    IN varNoHP varchar(14), 
    IN varAlamat varchar(100), 
    IN varKota varchar(20),
    IN varTglLahir date
    )
BEGIN
        INSERT INTO master_client
        (all_pc_id, fullname, address, city, no_hp, email, birthdate, jenis_kelamin, is_cat) 
        VALUES 
        (max_all_pc_id() + 1, varNama, varAlamat, varKota, varNoHP, varEmail,
        varTglLahir, varJK, true)
        
        ON DUPLICATE KEY UPDATE
        is_cat = true, 
        birthdate = varTglLahir, 
        jenis_kelamin = varJK;

        SET @pc_id = (SELECT all_pc_id FROM master_client
        WHERE email = varEmail);
        
        INSERT INTO cat
        VALUES (@pc_id, varUserID, varNoInduk, varUserName, varPassword, 
        varBATCH, varPendaftaran, varKelasBerakhir, varSalesUsername, NOW(), 0)
        ON DUPLICATE KEY UPDATE
        all_pc_id = @pc_id;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `inputCAT_pembayaran` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `inputCAT_pembayaran`(
    IN varCat_user_id int,
    IN varAngsuran_ke int,
    IN varTanggal_pembayaran_angsuran date,
    IN varPembayaran_angsuran int
    )
BEGIN
    INSERT INTO laporan_pembayaran_cat 
    VALUES (varCat_user_id, varAngsuran_ke, varTanggal_pembayaran_angsuran, 
            varPembayaran_angsuran, CURDATE(), 0);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `inputMRG` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `inputMRG`( 
        IN varAccount int,
        IN varNama varchar(100), 
        IN varTanggalJoin date, 
        IN varAlamat varchar(100),
        IN varKota varchar(20),
        IN varTelepon varchar(14),
        IN varEmail varchar(100),
        IN varType varchar(25),
        IN varSales varchar(40))
BEGIN
    INSERT INTO master_client
    (all_pc_id,
    fullname, address, city, no_hp, email, is_mrg_premiere) 
        VALUES 
        (max_all_pc_id() + 1, varNama, varAlamat, varKota, varTelepon, varEmail, true)
        ON DUPLICATE KEY UPDATE
        is_mrg_premiere = true;

        SET @pc_id = (SELECT all_pc_id FROM master_client
        WHERE email = varEmail);
        

        INSERT INTO mrg 
        VALUES (@pc_id, varAccount, varTanggalJoin, 
        varType, varSales, NOW(), 0)
        ON DUPLICATE KEY UPDATE
        all_pc_id = @pc_id;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `inputUOB` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `inputUOB`( 
        IN varClient int,
        IN varNama varchar(100),
        IN varCLASS varchar(20),
        IN varNOMOR varchar(20), 
        IN varEXPIRED date,
        IN varAlamat varchar(100), 
        IN varKota varchar(20), 
        IN varTglLahir date, 
        IN varKategori varchar(20), 
        IN varBulan int, 
        IN varTelepon varchar(14), 
        IN varEmail varchar(100),
        IN varBank varchar(20), 
        IN varNomorRekening varchar(20),
        IN varJK char(1), 
        IN varRDINIAGA varchar(20),
        IN varRDIBCA varchar(20), 
        IN varTRADINGVIA varchar(20), 
        IN varSOURCE varchar(20), 
        IN varusername_sales varchar(40)
        )
BEGIN
        INSERT INTO master_client
        (all_pc_id, fullname, address, city, no_hp, email, birthdate, jenis_kelamin, is_UOB) 
        VALUES 
        (max_all_pc_id() + 1, varNama, varAlamat, varKota, varTelepon, varEmail,
        varTglLahir, varJK, true)
        
        ON DUPLICATE KEY UPDATE
        is_UOB = true, 
        birthdate = varTglLahir, 
        jenis_kelamin = varJK;

        SET @pc_id = (SELECT all_pc_id FROM master_client
        WHERE email = varEmail);
        
        INSERT INTO uob
        VALUES (@pc_id, varClient, varCLASS, varNOMOR, 
        varEXPIRED, varKategori, varBulan, varBank, varNomorRekening, varRDINIAGA, varRDIBCA, 
            varTRADINGVIA, varSOURCE, varusername_sales, NOW(), NULL)
        ON DUPLICATE KEY UPDATE
        all_pc_id = @pc_id;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `input_assign_green` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `input_assign_green`(
    IN var_green_id          int(10) unsigned,
    IN var_sales_username   varchar(40),
    IN var_prospect_to      varchar(10),
    IN var_admin_username   varchar(40),
    IN var_keterangan       varchar(150)
    )
BEGIN
        INSERT INTO assign_green(
        green_assign_id, green_id, sales_username, prospect_to,
        assign_time, admin_username, keterangan)
        VALUES
        (max_green_assign_id()+1, var_green_id, var_sales_username, var_prospect_to,
        NOW(), var_admin_username, var_keterangan
        );
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `input_assign_grow` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `input_assign_grow`(
    IN var_grow_id          int(10) unsigned,
    IN var_sales_username   varchar(40),
    IN var_prospect_to      varchar(10),
    IN var_admin_username   varchar(40),
    IN var_keterangan       varchar(150)
    )
BEGIN
        INSERT INTO assign_grow(
        grow_assign_id, grow_id, sales_username, prospect_to,
        assign_time, admin_username, keterangan)
        VALUES
        (max_grow_assign_id()+1, var_grow_id, var_sales_username, var_prospect_to,
        NOW(), var_admin_username, var_keterangan
        );
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `input_assign_redclub` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `input_assign_redclub`(
    IN var_username         varchar(40),
    IN var_sales_username   varchar(40),
    IN var_prospect_to      varchar(10),
    IN var_admin_username   varchar(40),
    IN var_keterangan       varchar(150)
    )
BEGIN
        INSERT INTO assign_redclub(
        redclub_assign_id, username, sales_username, prospect_to,
        assign_time, admin_username, keterangan)
        VALUES
        (max_reclub_assign_id()+1, var_username, var_sales_username, var_prospect_to,
        NOW(), var_admin_username, var_keterangan
        );
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `input_green` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `input_green`(
    IN varFullname varchar(50),	
    IN varNo_hp	varchar(15),
    IN varKeterangan_perintah varchar(100),	
    IN varSumber varchar(100),
    IN varProgress varchar(40),
    IN varSalesUsername varchar(40),
    IN varIsShareToaclub boolean,
    IN varIsShareToMRG boolean,
    IN varIsShareToCAT boolean,    
    IN varIsShareToUOB boolean
    )
BEGIN
        insert into green(fullname, no_hp, keterangan_perintah, sumber, progress,
        share_to_aclub, share_to_uob, share_to_mrg, share_to_cat) 
        values (varFullname, varNo_hp, varKeterangan_perintah, varSumber, varProgress,
        varIsShareToaclub, varIsShareToUOB, varIsShareToMRG, varIsShareToCAT);
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `input_grow` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `input_grow`(
    IN var_all_pc_id      int(11),
    IN var_share_to_aclub tinyint(1),
    IN var_share_to_mrg   tinyint(1),
    IN var_share_to_cat   tinyint(1),
    IN var_share_to_uob   tinyint(1))
BEGIN
        INSERT INTO grow
        (grow_id,
        share_to_aclub,
        share_to_mrg,
        share_to_cat,
        share_to_uob,
        all_pc_id,
        created_at)
        VALUES 
        (max_grow_id() + 1,
        var_share_to_aclub,
        var_share_to_mrg,
        var_share_to_cat,
        var_share_to_uob,
        var_all_pc_id,
        NOW())
        ON DUPLICATE KEY UPDATE
        all_pc_id = var_all_pc_id;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `input_product` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `input_product`(IN var_product_name  varchar(30))
BEGIN
        INSERT INTO product VALUES (max_product_id() + 1, var_product_name);
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `input_product_sale` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `input_product_sale`(
     IN var_product_id       int(11),
     IN var_jumlah           int(11),
     IN var_total_pembayaran int(11),
     IN var_nama_pembeli     varchar(50),
     IN var_all_pc_id        int(11),
     IN var_sales_username   varchar(40),
     IN var_sale_date        date
     )
BEGIN
        INSERT INTO product_sale
        (
         purchase_id,
         product_id,
         jumlah,
         total_pembayaran,
         nama_pembeli,
         all_pc_id,
         sales_username,
         sale_date,
         add_time
        )
        VALUES  
        (max_purchase_id() + 1,
        var_product_id,
        var_jumlah,
        var_total_pembayaran,
        var_nama_pembeli,
        var_all_pc_id,
        var_sales_username,
        var_sale_date,
        NOW()
        );
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `input_redclub` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `input_redclub`(
    IN var_username                     varchar(40),
    IN var_firstname                    varchar(40),
    IN var_lastname                     varchar(40),
    IN var_email                        varchar(256),
    IN var_join_date                    date,
    IN var_no_hp                        varchar(15),
    IN var_all_pc_id                    int(11),
    IN var_occupation                   varchar(40),
    IN var_jenis_kelamin                char(1),
    IN var_status_perkawinan            varchar(15),
    IN var_alamat                       varchar(100),
    IN var_kota                         varchar(20),
    IN var_line_id                      varchar(100),
    IN var_blackberry_pin               char(8),
    IN var_annual_come                  int(11),
    IN var_country                      varchar(40),
    IN var_birthdate                    date,
    IN var_interest                     varchar(40),
    IN var_hobby                        varchar(40),
    IN var_spesific                     varchar(40),
    IN var_your_stock_and_future_broker varchar(40),
    IN var_trading_experience_year      int(3),
    IN var_trading_type                 varchar(3),
    IN var_security_question            varchar(100),
    IN var_security_answer              varchar(100),
    IN var_facebook                     varchar(40),
    IN var_share_to_aclub               tinyint(1),
    IN var_share_to_mrg                 tinyint(1),
    IN var_share_to_cat                 tinyint(1),
    IN var_share_to_uob                 tinyint(1)
)
BEGIN
        Insert Into redclub
        VALUES 
        (var_username,
        var_firstname,
        var_lastname,
        var_email,
        var_join_date,
        var_no_hp,
        var_all_pc_id,
        var_occupation,
        var_jenis_kelamin,
        var_status_perkawinan,
        var_alamat,
        var_kota,
        var_line_id,
        var_blackberry_pin,
        var_annual_come,
        var_country,
        var_birthdate,
        var_interest,
        var_hobby,
        var_spesific,
        var_your_stock_and_future_broker,
        var_trading_experience_year,
        var_trading_type,
        var_security_question,
        var_security_answer,
        var_facebook,
        var_share_to_aclub,
        var_share_to_mrg,
        var_share_to_cat,
        var_share_to_uob, 
        NOW(), 
        0)
        ON DUPLICATE KEY UPDATE
        username = var_username;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `selectaclub_member` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `selectaclub_member`()
BEGIN
select * from aclub natural join master_client;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `selectaclub_member_and_zone` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `selectaclub_member_and_zone`()
BEGIN
SELECT *
FROM master_client natural join
(   SELECT 
        all_pc_id,
        aclub.user_id,
        interest_and_hobby,
        trading_experience_year,
        your_stock_future_broker,
        annual_income,
        security_question,
        security_answer,
        status,
        keterangan,
        website,
        state,
        created_at,
        occupation,
        yellow_zone,
        expired_date_bonus, 
        redzone
    FROM aclub left outer join aclub_last_important_date 
    ON (aclub.user_id = aclub_last_important_date.user_id)
) AS T;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `selectaclub_payment` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `selectaclub_payment`()
BEGIN
select * from aclub_registration natural join aclub_payment;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `selectaclub_registration` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `selectaclub_registration`()
BEGIN
select * from aclub natural join aclub_registration;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `select_aclub_alt1` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `select_aclub_alt1`()
BEGIN
        SELECT
        all_pc_id,
        fullname,
        user_id,
        registration_type,
        paket,
        expired_date_bonus
        FROM
        master_client natural join aclub natural join aclub_registration;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `select_assign` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `select_assign`(
    IN var_sales_username  varchar(40)
    )
BEGIN
        SELECT * FROM assign_all WHERE sales_username = var_sales_username;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `select_assign_green` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `select_assign_green`()
BEGIN
    SELECT 
     green.green_id as green_id,
     fullname ,
     no_hp,
     keterangan_perintah,
     sumber,
     progress,
     is_aclub_stock,
     is_aclub_future,
     is_cat,
     is_mrg_premiere,
     is_UOB,
     is_red_club,
     share_to_aclub,
     share_to_mrg,
     share_to_cat,
     share_to_uob,
     green.add_time as green_add_time,
     edited_time,
     green_assign_id,
     assign_green.sales_username as sales_username,
     prospect_to,
     assign_time,
     admin_username,
     keterangan,
     last_edited_time as assign_last_edited_time,
     is_succes,
     report_time, 
     report
    FROM green inner join assign_green on (green.green_id = assign_green.green_id);
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `select_assign_grow` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `select_assign_grow`()
BEGIN
    SELECT 
    grow_assign_id,
    grow.grow_id,
    sales_username,
    prospect_to,
    assign_time,
    admin_username,
    keterangan,
    last_edited_time as assign_grow_edit_time,
    fullname,
    is_aclub_stock,
    is_aclub_future,
    is_cat,
    is_mrg_premiere,
    is_UOB,
    email,
    no_hp,
    birthdate,
    line_id,
    bb_pin,
    twitter,
    address,
    city,
    marital_status,
    jenis_kelamin,
    master_client.add_time as master_client_add_time,
    no_telp,
    provinsi,
    facebook,
    edited_time as master_client_edit_time,
    share_to_aclub,
    share_to_mrg,
    share_to_cat,
    share_to_uob,
    all_pc_id,
    created_at as grow_add_time,
    edited_time as grow_edit_time,
     is_succes,
     report_time,
     report
    FROM master_client natural join grow INNER JOIN assign_grow ON (grow.grow_id = assign_grow.grow_id);
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `select_assign_redclub` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `select_assign_redclub`()
BEGIN
    SELECT
    redclub_assign_id,
    redclub.username as username,
    sales_username,
    prospect_to,
    assign_time,
    keterangan,
    admin_username,
    assign_redclub.last_edited_time assign_redclub_edit_time,
    firstname,
    lastname,
    email,
    join_date,
    no_hp,
    all_pc_id,
    occupation,
    jenis_kelamin,
    status_perkawinan,
    alamat,
    kota,
    line_id,
    blackberry_pin,
    annual_come,
    country,
    birthdate,
    interest,
    hobby,
    spesific,
    your_stock_and_future_broker,
    trading_experience_year,
    trading_type,
    security_question,
    security_answer,
    facebook,
    share_to_aclub,
    share_to_mrg,
    share_to_cat,
    share_to_uob,
    redclub.added_time as redclub_added_time,
    redclub.last_edit_time as redclub_edit_time,
    is_succes,
    report,
    report_time
    FROM redclub inner join assign_redclub on (redclub.username = assign_redclub.username);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `select_cat` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `select_cat`()
BEGIN 
        SELECT *
        FROM (SELECT * FROM master_client WHERE is_cat = true) as T
            INNER JOIN cat on (T.all_pc_id = cat.all_pc_id);
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `select_detail_aclub` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `select_detail_aclub`(
    IN var_all_pc_id int
    )
BEGIN
    SELECT * 
    FROM master_client natural join aclub
    WHERE all_pc_id = var_all_pc_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `select_detail_aclub_2` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `select_detail_aclub_2`(
    IN var_all_pc_id int
    )
BEGIN
    SELECT * 
    FROM aclub natural join aclub_registration
    WHERE all_pc_id = var_all_pc_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `select_detail_cat` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `select_detail_cat`(
    IN var_all_pc_id int
    )
BEGIN
    SELECT *, cat.add_time as cat_add_time
    FROM master_client inner join cat
    ON (master_client.all_pc_id = cat.all_pc_id) 
    WHERE master_client.all_pc_id = var_all_pc_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `select_detail_cat_2` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `select_detail_cat_2`(
    IN var_all_pc_id int
    )
BEGIN
    SELECT *, 
        cat.add_time as cat_add_time, 
        laporan_pembayaran_cat.add_time as lp_cat_add_time  
    FROM cat
    inner join laporan_pembayaran_cat 
    ON (cat.cat_user_id = laporan_pembayaran_cat.cat_user_id)
    WHERE cat.all_pc_id = var_all_pc_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `select_detail_mrg` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `select_detail_mrg`(
    IN var_all_pc_id int
    )
BEGIN
    SELECT * 
    FROM master_client inner join mrg
    ON (master_client.all_pc_id = mrg.all_pc_id)
    WHERE master_client.all_pc_id = var_all_pc_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `select_detail_uob` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `select_detail_uob`(
    IN var_all_pc_id int
    )
BEGIN
    SELECT * 
    FROM master_client inner join uob
    ON (master_client.all_pc_id = uob.all_pc_id)
    WHERE master_client.all_pc_id = var_all_pc_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `select_master_client` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `select_master_client`(IN var_pc_id int)
BEGIN
        SELECT * FROM master_client WHERE all_pc_id = var_pc_id;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `select_master_client_alt1` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `select_master_client_alt1`()
BEGIN
        SELECT 
        all_pc_id, 
        fullname, 
        email, 
        no_hp, 
        is_aclub_stock,
        is_aclub_future,
        is_cat,
        is_mrg_premiere,
        is_UOB
        FROM master_client;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `select_mrg` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `select_mrg`()
BEGIN 
        SELECT *
        FROM (SELECT * FROM master_client WHERE is_mrg_premiere = true) as T
            INNER JOIN mrg on (T.all_pc_id = mrg.all_pc_id);
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `select_uob` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `select_uob`()
BEGIN 
        SELECT *
        FROM (SELECT * FROM master_client WHERE is_uob = true) as T
            INNER JOIN uob on (T.all_pc_id = uob.all_pc_id);
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `testing` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `testing`()
BEGIN
        Declare var_id int;
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;


ALTER TABLE master_client CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE assign_green CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE assign_redclub CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE assign_grow CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE green CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE grow CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE redclub CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;

--
-- Final view structure for view `aclub_expdate_future`
--

/*!50001 DROP VIEW IF EXISTS `aclub_expdate_future`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = cp850 */;
/*!50001 SET character_set_results     = cp850 */;
/*!50001 SET collation_connection      = cp850_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `aclub_expdate_future` AS select `t`.`all_pc_id` AS `all_pc_id`,`t`.`fullname` AS `fullname`,`t`.`user_id` AS `user_id`,`t`.`registration_type` AS `registration_type`,`t`.`paket` AS `paket`,`t`.`expired_date_bonus` AS `expired_date_bonus` from (select `ads`.`master_client`.`all_pc_id` AS `all_pc_id`,`ads`.`master_client`.`fullname` AS `fullname`,`ads`.`aclub`.`user_id` AS `user_id`,`ads`.`aclub_registration`.`registration_type` AS `registration_type`,`ads`.`aclub_registration`.`paket` AS `paket`,`ads`.`aclub_registration`.`expired_date_bonus` AS `expired_date_bonus` from ((`ads`.`master_client` join `ads`.`aclub` on((`ads`.`master_client`.`all_pc_id` = `ads`.`aclub`.`all_pc_id`))) join `ads`.`aclub_registration` on((`ads`.`aclub`.`user_id` = `ads`.`aclub_registration`.`user_id`))) where (left(`ads`.`aclub_registration`.`paket`,1) = 'F') order by cast(`ads`.`aclub_registration`.`expired_date_bonus` as date) desc) `t` group by `t`.`user_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `aclub_expdate_stock`
--

/*!50001 DROP VIEW IF EXISTS `aclub_expdate_stock`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = cp850 */;
/*!50001 SET character_set_results     = cp850 */;
/*!50001 SET collation_connection      = cp850_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `aclub_expdate_stock` AS select `t`.`all_pc_id` AS `all_pc_id`,`t`.`fullname` AS `fullname`,`t`.`user_id` AS `user_id`,`t`.`registration_type` AS `registration_type`,`t`.`paket` AS `paket`,`t`.`expired_date_bonus` AS `expired_date_bonus` from (select `ads`.`master_client`.`all_pc_id` AS `all_pc_id`,`ads`.`master_client`.`fullname` AS `fullname`,`ads`.`aclub`.`user_id` AS `user_id`,`ads`.`aclub_registration`.`registration_type` AS `registration_type`,`ads`.`aclub_registration`.`paket` AS `paket`,`ads`.`aclub_registration`.`expired_date_bonus` AS `expired_date_bonus` from ((`ads`.`master_client` join `ads`.`aclub` on((`ads`.`master_client`.`all_pc_id` = `ads`.`aclub`.`all_pc_id`))) join `ads`.`aclub_registration` on((`ads`.`aclub`.`user_id` = `ads`.`aclub_registration`.`user_id`))) where (left(`ads`.`aclub_registration`.`paket`,1) = 'S') order by cast(`ads`.`aclub_registration`.`expired_date_bonus` as date) desc) `t` group by `t`.`user_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `aclub_last_important_date`
--

/*!50001 DROP VIEW IF EXISTS `aclub_last_important_date`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = cp850 */;
/*!50001 SET character_set_results     = cp850 */;
/*!50001 SET collation_connection      = cp850_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `aclub_last_important_date` AS select `aclub_registration`.`user_id` AS `user_id`,(`aclub_registration`.`expired_date_bonus` - interval 3 day) AS `yellow_zone`,max(`aclub_registration`.`expired_date_bonus`) AS `expired_date_bonus`,(`aclub_registration`.`expired_date_bonus` + interval 3 day) AS `redzone` from `aclub_registration` group by `aclub_registration`.`user_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `assign_all`
--

/*!50001 DROP VIEW IF EXISTS `assign_all`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = cp850 */;
/*!50001 SET character_set_results     = cp850 */;
/*!50001 SET collation_connection      = cp850_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `assign_all` AS select `assign_green`.`type` AS `type`,`assign_green`.`green_assign_id` AS `assign_id`,`green`.`green_id` AS `id`,`assign_green`.`sales_username` AS `sales_username`,`assign_green`.`prospect_to` AS `prospect_to`,`assign_green`.`assign_time` AS `assign_time`,`assign_green`.`last_edited_time` AS `assign_edited_time`,`assign_green`.`admin_username` AS `admin_username`,`assign_green`.`keterangan` AS `keterangan`,`assign_green`.`last_edited_time` AS `last_edited_time`,`assign_green`.`report` AS `report`,`assign_green`.`is_succes` AS `is_succes`,`assign_green`.`report_time` AS `report_time`,`green`.`fullname` AS `fullname`,`green`.`no_hp` AS `no_hp`,NULL AS `email`,NULL AS `address`,`green`.`share_to_aclub` AS `share_to_aclub`,`green`.`share_to_mrg` AS `share_to_mrg`,`green`.`share_to_cat` AS `share_to_cat`,`green`.`share_to_uob` AS `share_to_uob`,NULL AS `all_pc_id`,`green`.`add_time` AS `green_grow_red_add_time`,`green`.`edited_time` AS `green_grow_red_edited_time` from (`green` join `assign_green` on((`green`.`green_id` = `assign_green`.`green_id`))) union all select `assign_grow`.`type` AS `type`,`assign_grow`.`grow_assign_id` AS `assign_id`,`grow`.`grow_id` AS `id`,`assign_grow`.`sales_username` AS `sales_username`,`assign_grow`.`prospect_to` AS `prospect_to`,`assign_grow`.`assign_time` AS `assign_time`,`assign_grow`.`last_edited_time` AS `assign_edited_time`,`assign_grow`.`admin_username` AS `admin_username`,`assign_grow`.`keterangan` AS `keterangan`,`assign_grow`.`last_edited_time` AS `last_edited_time`,`assign_grow`.`report` AS `report`,`assign_grow`.`is_succes` AS `is_succes`,`assign_grow`.`report_time` AS `report_time`,`master_client`.`fullname` AS `fullname`,`master_client`.`no_hp` AS `no_hp`,`master_client`.`email` AS `email`,`master_client`.`address` AS `address`,`grow`.`share_to_aclub` AS `share_to_aclub`,`grow`.`share_to_mrg` AS `share_to_mrg`,`grow`.`share_to_cat` AS `share_to_cat`,`grow`.`share_to_uob` AS `share_to_uob`,`master_client`.`all_pc_id` AS `all_pc_id`,`grow`.`created_at` AS `green_grow_red_add_time`,`master_client`.`edited_time` AS `green_grow_red_edited_time` from ((`master_client` join `grow` on(((`master_client`.`all_pc_id` = `grow`.`all_pc_id`) and (`master_client`.`edited_time` = `grow`.`edited_time`)))) join `assign_grow` on((`grow`.`grow_id` = `assign_grow`.`grow_id`))) union all select `assign_redclub`.`type` AS `type`,`assign_redclub`.`redclub_assign_id` AS `assign_id`,`assign_redclub`.`username` AS `id`,`assign_redclub`.`sales_username` AS `sales_username`,`assign_redclub`.`prospect_to` AS `prospect_to`,`assign_redclub`.`assign_time` AS `assign_time`,`assign_redclub`.`last_edited_time` AS `assign_edited_time`,`assign_redclub`.`admin_username` AS `admin_username`,`assign_redclub`.`keterangan` AS `keterangan`,`assign_redclub`.`last_edited_time` AS `last_edited_time`,`assign_redclub`.`report` AS `report`,`assign_redclub`.`is_succes` AS `is_succes`,`assign_redclub`.`report_time` AS `report_time`,concat(`redclub`.`firstname`,' ',`redclub`.`lastname`) AS `fullname`,`redclub`.`no_hp` AS `no_hp`,`redclub`.`email` AS `email`,`redclub`.`alamat` AS `address`,`redclub`.`share_to_aclub` AS `share_to_aclub`,`redclub`.`share_to_mrg` AS `share_to_mrg`,`redclub`.`share_to_cat` AS `share_to_cat`,`redclub`.`share_to_uob` AS `share_to_uob`,`redclub`.`all_pc_id` AS `all_pc_id`,`redclub`.`added_time` AS `green_grow_red_add_time`,`redclub`.`last_edit_time` AS `green_grow_red_edited_time` from (`assign_redclub` join `redclub` on((`assign_redclub`.`username` = `redclub`.`username`))) */;
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

-- Dump completed on 2017-01-16  8:03:59

