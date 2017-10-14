-- MySQL dump 10.13  Distrib 5.7.19, for Linux (x86_64)
--
-- Host: localhost    Database: ads
-- ------------------------------------------------------
-- Server version	5.7.19-0ubuntu0.16.04.1

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
INSERT INTO `aclub_informations` VALUES (100003,'Tianna Larson','-','2017-09-27 01:50:40','2017-09-27 01:50:40',999,999),(100004,'Novella Collins','-','2017-09-27 01:50:41','2017-09-27 01:50:41',999,999),(100006,'Maxime Reinger','-','2017-09-27 01:50:41','2017-09-27 01:50:41',999,999),(100009,'Newton Boehm DVM','-','2017-09-27 01:50:40','2017-09-27 01:50:40',999,999),(100011,'Prof. Lilyan Hand','-','2017-09-27 01:50:40','2017-09-27 01:50:40',999,999),(100014,'Howard Deckow','-','2017-09-27 01:50:41','2017-09-27 01:50:41',999,999),(100032,'Dr. Jaeden Hegmann','-','2017-09-27 01:50:41','2017-09-27 01:50:41',999,999),(100038,'Conner Bartoletti','-','2017-09-27 01:50:40','2017-09-27 01:50:40',999,999),(100041,'Gabriella Green','-','2017-09-27 01:50:40','2017-09-27 01:50:40',999,999),(100044,'Meggie Stracke','-','2017-09-27 01:50:41','2017-09-27 01:50:41',999,999);
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
INSERT INTO `aclub_members` VALUES ('107',100004,'F','2017-09-27 01:50:41','2017-09-27 01:50:41',999,999),('119',100044,'R','2017-09-27 01:50:41','2017-09-27 01:50:41',999,999),('220',100011,'S','2017-09-27 01:50:41','2017-09-27 01:50:41',999,999),('260',100004,'F','2017-09-27 01:50:41','2017-09-27 01:50:41',999,999),('644',100041,'F','2017-09-27 01:50:41','2017-09-27 01:50:41',999,999),('657',100003,'F','2017-09-27 01:50:41','2017-09-27 01:50:41',999,999),('786',100032,'R','2017-09-27 01:50:41','2017-09-27 01:50:41',999,999),('867',100011,'S','2017-09-27 01:50:41','2017-09-27 01:50:41',999,999),('943',100044,'F','2017-09-27 01:50:41','2017-09-27 01:50:41',999,999),('958',100006,'S','2017-09-27 01:50:41','2017-09-27 01:50:41',999,999);
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
  `kode` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nominal` bigint(20) NOT NULL,
  `start_date` date NOT NULL,
  `expired_date` date NOT NULL,
  `masa_tenggang` date NOT NULL,
  `yellow_zone` date NOT NULL,
  `red_zone` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  PRIMARY KEY (`transaction_id`),
  KEY `aclub_transactions_user_id_foreign` (`user_id`),
  CONSTRAINT `aclub_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `aclub_members` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aclub_transactions`
--

LOCK TABLES `aclub_transactions` WRITE;
/*!40000 ALTER TABLE `aclub_transactions` DISABLE KEYS */;
INSERT INTO `aclub_transactions` VALUES (1,'943','2017-10-19','SS','Baru',50000,'2018-02-03','2017-11-05','2017-12-05','2018-01-04','2018-02-03','2017-09-27 01:50:41','2017-09-27 01:50:41',999,999),(2,'867','2017-10-06','FS','Baru',380000,'2018-01-30','2017-11-01','2017-12-01','2017-12-31','2018-01-30','2017-09-27 01:50:41','2017-09-27 01:50:41',999,999),(3,'119','2017-10-02','SS','Tidak Aktif',940000,'2018-02-17','2017-11-19','2017-12-19','2018-01-18','2018-02-17','2017-09-27 01:50:41','2017-09-27 01:50:41',999,999),(4,'786','2017-09-30','FS','Baru',50000,'2018-02-05','2017-11-07','2017-12-07','2018-01-06','2018-02-05','2017-09-27 01:50:41','2017-09-27 01:50:41',999,999),(5,'107','2017-10-17','FS','Perpanjang',970000,'2018-02-01','2017-11-03','2017-12-03','2018-01-02','2018-02-01','2017-09-27 01:50:41','2017-09-27 01:50:41',999,999),(6,'220','2017-10-01','RS','Perpanjang',570000,'2018-02-06','2017-11-08','2017-12-08','2018-01-07','2018-02-06','2017-09-27 01:50:41','2017-09-27 01:50:41',999,999),(7,'644','2017-10-23','SS','Baru',340000,'2018-02-10','2017-11-12','2017-12-12','2018-01-11','2018-02-10','2017-09-27 01:50:42','2017-09-27 01:50:42',999,999),(8,'260','2017-10-08','SS','Perpanjang',0,'2018-02-07','2017-11-09','2017-12-09','2018-01-08','2018-02-07','2017-09-27 01:50:42','2017-09-27 01:50:42',999,999),(9,'958','2017-09-30','FS','Perpanjang',20000,'2018-01-29','2017-10-31','2017-11-30','2017-12-30','2018-01-29','2017-09-27 01:50:42','2017-09-27 01:50:42',999,999),(10,'657','2017-10-22','SS','Baru',230000,'2018-02-18','2017-11-20','2017-12-20','2018-01-19','2018-02-18','2017-09-27 01:50:42','2017-09-27 01:50:42',999,999);
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
  `product_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nominal` bigint(20) NOT NULL,
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
INSERT INTO `ashop_transactions` VALUES (1,100047,'Others','Product42',80000,'2017-09-27 01:50:39','2017-09-27 01:50:39',999,999),(2,100050,'Event','Product80',730000,'2017-09-27 01:50:40','2017-09-27 01:50:40',999,999),(3,100048,'Video','Product70',150000,'2017-09-27 01:50:40','2017-09-27 01:50:40',999,999),(4,100026,'Others','Product6',130000,'2017-09-27 01:50:40','2017-09-27 01:50:40',999,999),(5,100042,'Seasonal Report','Product96',470000,'2017-09-27 01:50:40','2017-09-27 01:50:40',999,999),(6,100027,'Others','Product68',640000,'2017-09-27 01:50:40','2017-09-27 01:50:40',999,999),(7,100021,'Event','Product66',390000,'2017-09-27 01:50:40','2017-09-27 01:50:40',999,999),(8,100007,'Video','Product40',330000,'2017-09-27 01:50:40','2017-09-27 01:50:40',999,999),(9,100036,'Event','Product78',500000,'2017-09-27 01:50:40','2017-09-27 01:50:40',999,999),(10,100039,'Seasonal Report','Product28',460000,'2017-09-27 01:50:40','2017-09-27 01:50:40',999,999),(11,100035,'Video','Product12',770000,'2017-09-27 01:50:40','2017-09-27 01:50:40',999,999),(12,100040,'Others','Product61',160000,'2017-09-27 01:50:40','2017-09-27 01:50:40',999,999),(13,100029,'Seasonal Report','Product55',360000,'2017-09-27 01:50:40','2017-09-27 01:50:40',999,999),(14,100045,'Event','Product50',70000,'2017-09-27 01:50:40','2017-09-27 01:50:40',999,999),(15,100049,'Event','Product77',230000,'2017-09-27 01:50:40','2017-09-27 01:50:40',999,999),(16,100008,'E-Book','Product45',980000,'2017-09-27 01:50:40','2017-09-27 01:50:40',999,999),(17,100024,'Event','Product20',610000,'2017-09-27 01:50:40','2017-09-27 01:50:40',999,999),(18,100013,'Others','Product10',330000,'2017-09-27 01:50:40','2017-09-27 01:50:40',999,999),(19,100030,'Seasonal Report','Product27',840000,'2017-09-27 01:50:40','2017-09-27 01:50:40',999,999),(20,100001,'Video','Product64',720000,'2017-09-27 01:50:40','2017-09-27 01:50:40',999,999);
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
  `sales` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
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
INSERT INTO `cats` VALUES ('12441','Mr. Mac Bosco III',100034,'3','Morgan Price','-','2017-10-07',0,'2017-10-13',0,'2017-10-05','2017-10-12','2017-10-17','-','-','2017-09-27 01:50:36','2017-09-27 01:50:36',999,999),('20398','Cierra Wilkinson DDS',100021,'3','Ruthie Kozey','-','2017-10-15',0,'2017-10-05',0,'2017-10-13','2017-10-03','2017-10-07','-','-','2017-09-27 01:50:36','2017-09-27 01:50:36',999,999),('22334','Logan Stroman',100009,'7','Dallin Sauer','-','2017-10-11',0,'2017-10-07',0,'2017-10-15','2017-10-08','2017-10-12','-','-','2017-09-27 01:50:36','2017-09-27 01:50:36',999,999),('32275','Larissa Altenwerth',100027,'2','Asha Corwin','-','2017-10-06',0,'2017-10-11',0,'2017-10-21','2017-10-19','2017-10-24','-','-','2017-09-27 01:50:36','2017-09-27 01:50:36',999,999),('37272','Vergie Emard V',100019,'7','Prof. Tristin Daniel IV','-','2017-10-08',0,'2017-10-20',0,'2017-10-25','2017-10-27','2017-10-23','-','-','2017-09-27 01:50:36','2017-09-27 01:50:36',999,999),('38793','Nasir Ziemann',100028,'4','Saige Gulgowski','-','2017-10-18',0,'2017-10-16',0,'2017-10-15','2017-10-22','2017-10-06','-','-','2017-09-27 01:50:36','2017-09-27 01:50:36',999,999),('45208','Ms. Jazmyn Cartwright Jr.',100007,'7','Jackie Farrell','-','2017-10-19',0,'2017-09-27',0,'2017-10-21','2017-10-25','2017-09-29','-','-','2017-09-27 01:50:36','2017-09-27 01:50:36',999,999),('49936','Lauryn Rempel DDS',100016,'3','Maverick Ritchie','-','2017-10-25',0,'2017-10-23',0,'2017-10-08','2017-10-17','2017-10-02','-','-','2017-09-27 01:50:36','2017-09-27 01:50:36',999,999),('51114','Jeanette Jacobi',100049,'3','Kirk DuBuque','-','2017-10-22',0,'2017-09-29',0,'2017-10-13','2017-10-08','2017-10-18','-','-','2017-09-27 01:50:36','2017-09-27 01:50:36',999,999),('54652','Prof. Janick Carter',100029,'2','Clint Okuneva','-','2017-10-18',0,'2017-10-01',0,'2017-10-17','2017-10-26','2017-10-04','-','-','2017-09-27 01:50:36','2017-09-27 01:50:36',999,999),('56237','Dr. Arvilla Morissette MD',100049,'1','Braden Waters','-','2017-09-30',0,'2017-10-19',0,'2017-10-05','2017-10-12','2017-10-14','-','-','2017-09-27 01:50:37','2017-09-27 01:50:37',999,999),('63550','Preston Ullrich',100026,'5','Trevor Hudson','-','2017-09-30',0,'2017-10-18',0,'2017-10-24','2017-10-08','2017-10-20','-','-','2017-09-27 01:50:36','2017-09-27 01:50:36',999,999),('67862','Kaylee Satterfield',100040,'1','Kathryne Kreiger','-','2017-10-13',0,'2017-10-11',0,'2017-10-01','2017-10-22','2017-10-22','-','-','2017-09-27 01:50:36','2017-09-27 01:50:36',999,999),('68752','Cruz Schoen',100005,'5','Reece Weber','-','2017-10-06',0,'2017-10-11',0,'2017-10-26','2017-10-19','2017-10-22','-','-','2017-09-27 01:50:36','2017-09-27 01:50:36',999,999),('7099','Mr. Fletcher Pagac III',100037,'3','Curt Hansen','-','2017-10-21',0,'2017-10-07',0,'2017-10-25','2017-10-25','2017-10-05','-','-','2017-09-27 01:50:36','2017-09-27 01:50:36',999,999),('71031','Miss Nakia Ernser MD',100012,'9','Shakira O\'Conner','-','2017-10-21',0,'2017-10-24',0,'2017-10-07','2017-10-25','2017-10-25','-','-','2017-09-27 01:50:36','2017-09-27 01:50:36',999,999),('82861','Dr. Kadin Kris DDS',100011,'8','Thea Heaney','-','2017-10-04',0,'2017-10-16',0,'2017-10-04','2017-10-16','2017-10-15','-','-','2017-09-27 01:50:36','2017-09-27 01:50:36',999,999),('88640','Torrance Pfeffer',100003,'9','Mrs. Corrine Wolff','-','2017-10-02',0,'2017-10-08',0,'2017-10-06','2017-10-23','2017-09-27','-','-','2017-09-27 01:50:36','2017-09-27 01:50:36',999,999),('91527','Prof. Devon Roberts',100039,'8','Zaria Morar','-','2017-10-12',0,'2017-09-30',0,'2017-10-26','2017-10-13','2017-10-08','-','-','2017-09-27 01:50:36','2017-09-27 01:50:36',999,999),('95934','Antonina Hickle',100043,'3','Laurie Hilpert','-','2017-10-21',0,'2017-10-26',0,'2017-10-14','2017-10-07','2017-10-12','-','-','2017-09-27 01:50:37','2017-09-27 01:50:37',999,999);
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
  `interest` text COLLATE utf8_unicode_ci NOT NULL,
  `pemberi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sumber_data` text COLLATE utf8_unicode_ci NOT NULL,
  `keterangan_perintah` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  PRIMARY KEY (`green_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `green_prospect_clients`
--

LOCK TABLES `green_prospect_clients` WRITE;
/*!40000 ALTER TABLE `green_prospect_clients` DISABLE KEYS */;
INSERT INTO `green_prospect_clients` VALUES (1,'2017-10-13','Cloyd Kozey Sr.','734-987-5838 x95884','adah.ratke@example.org','Interest46','Reuben Ernser','Beth Haag','keterangan_perintah40','2017-09-27 01:50:42','2017-09-27 01:50:42',999,999),(2,'2017-10-19','Cristina Miller IV','383.903.4451 x424','kosinski@example.net','Interest34','Prof. Sigrid Schmidt','Dr. Jerald Lakin','keterangan_perintah60','2017-09-27 01:50:42','2017-09-27 01:50:42',999,999),(3,'2017-10-01','Carolyne Kuhn','614.554.9194 x0684','oma69@example.org','Interest77','Amina Langosh','Nelda Effertz','keterangan_perintah53','2017-09-27 01:50:42','2017-09-27 01:50:42',999,999),(4,'2017-09-28','Wilma Rippin IV','(930) 846-7663','wiza.sigurd@example.com','Interest11','Herminia Schroeder I','Felipe Kiehn','keterangan_perintah93','2017-09-27 01:50:42','2017-09-27 01:50:42',999,999),(5,'2017-10-03','Dr. Ellie Kihn','462-207-2443 x5340','nfadel@example.net','Interest50','Dr. Jesus Powlowski PhD','Prof. Nikita DuBuque III','keterangan_perintah60','2017-09-27 01:50:42','2017-09-27 01:50:42',999,999),(6,'2017-10-15','Dr. Kyla Stiedemann PhD','602.836.0333 x86185','darion57@example.org','Interest96','Cole Roob','Prof. Pasquale Graham DDS','keterangan_perintah6','2017-09-27 01:50:42','2017-09-27 01:50:42',999,999),(7,'2017-10-10','Douglas Hilpert','746-921-4925','eduardo.bauch@example.net','Interest0','Rafael Pacocha','Marco Prohaska','keterangan_perintah77','2017-09-27 01:50:42','2017-09-27 01:50:42',999,999),(8,'2017-10-22','Rigoberto Mraz IV','965-615-8108 x181','ramiro23@example.com','Interest27','Bria O\'Keefe','Mrs. Antonetta Lind MD','keterangan_perintah62','2017-09-27 01:50:42','2017-09-27 01:50:42',999,999),(9,'2017-10-06','Athena Waelchi','(853) 890-6339 x33732','khintz@example.com','Interest54','Carmine Hilll','Dr. Stone Streich','keterangan_perintah34','2017-09-27 01:50:42','2017-09-27 01:50:42',999,999),(10,'2017-10-18','Marguerite Zieme','456-579-9995 x28185','drake.howe@example.org','Interest28','Ms. Caterina Kreiger IV','Emmie Kunze DVM','keterangan_perintah47','2017-09-27 01:50:42','2017-09-27 01:50:42',999,999);
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
  `date` date NOT NULL,
  `sales_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nama_product` text COLLATE utf8_unicode_ci NOT NULL,
  `nominal` bigint(20) NOT NULL,
  `keterangan` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  PRIMARY KEY (`progress_id`),
  KEY `green_prospect_progresses_green_id_foreign` (`green_id`),
  CONSTRAINT `green_prospect_progresses_green_id_foreign` FOREIGN KEY (`green_id`) REFERENCES `green_prospect_clients` (`green_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `green_prospect_progresses`
--

LOCK TABLES `green_prospect_progresses` WRITE;
/*!40000 ALTER TABLE `green_prospect_progresses` DISABLE KEYS */;
INSERT INTO `green_prospect_progresses` VALUES (1,4,'2017-10-11','Rylee Feeney','NO GOAL','UOB',710000,'-','2017-09-27 01:50:42','2017-09-27 01:50:42',999,999),(2,3,'2017-10-06','Jana Von','IN PROGRESS','UOB',140000,'-','2017-09-27 01:50:42','2017-09-27 01:50:42',999,999),(3,5,'2017-10-20','Mr. Ewell Kozey','NO GOAL','MRG',520000,'-','2017-09-27 01:50:42','2017-09-27 01:50:42',999,999),(4,7,'2017-10-09','Hermann O\'Conner','NO GOAL','CAT',370000,'-','2017-09-27 01:50:42','2017-09-27 01:50:42',999,999),(5,6,'2017-10-12','Allan Glover','GOAL-JOIN','A-CLUB',30000,'-','2017-09-27 01:50:42','2017-09-27 01:50:42',999,999),(6,2,'2017-10-08','Courtney Cormier','NO ANSWER','A-CLUB',930000,'-','2017-09-27 01:50:42','2017-09-27 01:50:42',999,999),(7,9,'2017-10-11','Mr. Otho Kuhic','NO ANSWER','UOB',790000,'-','2017-09-27 01:50:42','2017-09-27 01:50:42',999,999),(8,10,'2017-10-09','Sim Williamson','IN PROGRESS','A-CLUB',290000,'-','2017-09-27 01:50:42','2017-09-27 01:50:42',999,999),(9,1,'2017-10-15','Bryon Dare IV','GOAL-JOIN','MRG',660000,'-','2017-09-27 01:50:42','2017-09-27 01:50:42',999,999),(10,8,'2017-10-20','Dr. Darryl Toy DDS','GOAL-BUY','A-CLUB',780000,'-','2017-09-27 01:50:42','2017-09-27 01:50:42',999,999);
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
) ENGINE=InnoDB AUTO_INCREMENT=100051 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_clients`
--

LOCK TABLES `master_clients` WRITE;
/*!40000 ALTER TABLE `master_clients` DISABLE KEYS */;
INSERT INTO `master_clients` VALUES (100001,'431260','password','Karson','+1-438-317-4635','vbins@example.com','1924-04-04','53300 Mark Spur\nMillerfort, SD 17628','774 Alejandrin Drives Suite 390\nSouth Justushaven, GA 58446-9280','832 Skyla Mountains Apt. 588\nGutkowskimouth, IA 04158-0701','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:34','2017-09-27 01:50:34',999,999),(100002,'985738','password','Manuel','(964) 681-7559','dschulist@example.com','1951-05-24','784 Brekke Trafficway\nLennastad, GA 17543-5722','4972 Denesik Garden Suite 829\nPort Perry, KY 32484-9500','844 Colten Wall\nLake Maximilliashire, NC 52814','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:34','2017-09-27 01:50:34',999,999),(100003,'413','password','Jarvis','608.497.2817','nitzsche.malcolm@example.org','2010-06-27','3347 Cremin Valley\nOkeymouth, NV 77528-3279','667 O\'Conner Landing Suite 932\nToneyburgh, NM 16402-7071','715 Brown Street\nPort Malindaport, MN 12190','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:34','2017-09-27 01:50:34',999,999),(100004,'514717','password','Presley','748.606.4018 x042','urban.mraz@example.com','1989-06-23','307 Raynor Forges\nO\'Keefeland, SC 14959','612 Hartmann Gateway Apt. 037\nNew Blake, NH 67120-7672','5708 Shannon Stream Suite 948\nWest Narciso, NH 11600-1119','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:34','2017-09-27 01:50:34',999,999),(100005,'5375','password','Brycen','608-835-6361 x9426','donnie33@example.com','1929-08-12','22548 Larkin Glen\nNew Maximillian, WV 84572','878 Alaina Dale Suite 443\nClarechester, OK 55769-6977','1931 Kendrick Ridge\nWest Orville, PA 53490','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:34','2017-09-27 01:50:34',999,999),(100006,'748462240','password','Judson','(326) 929-7842 x2837','irving.rippin@example.com','1976-10-12','221 Alvis Mount\nLyrichaven, ID 50516-7829','672 Ciara Locks\nSouth Joanychester, PA 67107-2737','194 Borer Manors\nHayeschester, IA 05513','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:34','2017-09-27 01:50:34',999,999),(100007,'759','password','Thomas','(605) 737-6416 x6889','rweissnat@example.net','1972-01-12','4273 Reynolds Cliffs\nPort Jadon, FL 83291','98328 Lockman Ridges\nDillonberg, AR 47577','529 Joana Pass Suite 724\nLockmanberg, VT 44600-3317','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:34','2017-09-27 01:50:34',999,999),(100008,'313911304','password','Joseph','+1-367-252-6658','orval.thompson@example.org','2015-10-25','97894 Whitney River\nElmoremouth, VT 43947-5982','70232 Shanahan Isle\nNew Gaetanofurt, NC 78087','887 Feest Neck Suite 574\nLake Maryshire, WY 77968','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:34','2017-09-27 01:50:34',999,999),(100009,'205','password','Chesley','1-789-221-5418','rkrajcik@example.com','1960-11-28','86852 Hahn Pine Apt. 623\nLake Ron, SD 97259-1907','8349 Ceasar Harbors Suite 785\nNew Johnson, MD 62925','16867 Shanon Inlet\nLaviniafort, ID 02094','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:34','2017-09-27 01:50:34',999,999),(100010,'35996679','password','Edd','475-576-9898 x2286','leonor.jacobi@example.com','1962-04-05','397 Stanton Street Suite 528\nWest Yazmin, GA 21983-6576','122 Farrell Street\nNew Gunner, SD 75382-5950','85800 Mayer Mount Apt. 012\nWest Kane, WV 26151','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:34','2017-09-27 01:50:34',999,999),(100011,'0','password','Easton','+1-846-551-3073','johns.jabari@example.org','1931-08-05','37438 Steve Manor\nBrockside, WA 09714-2266','666 Marquardt Spur Apt. 526\nAbbotthaven, SC 93370','51811 Zemlak Crescent Suite 094\nWest Malika, NE 53909','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:34','2017-09-27 01:50:34',999,999),(100012,'6','password','Camren','+18625619975','leatha.okon@example.org','1957-05-01','78527 Lang Motorway\nMantehaven, TX 84350','902 Abigail Brook\nNew Franzton, MT 50175','45363 Greyson Union Suite 904\nMarkshaven, LA 40696-5657','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:34','2017-09-27 01:50:34',999,999),(100013,'5','password','Judge','+15516597114','mante.liliana@example.net','1981-07-16','792 Sophie Curve Apt. 285\nQuentinmouth, RI 71181','8231 Adelia Club Apt. 538\nBreanneburgh, MS 48893-8038','49548 Zoey Radial\nWest Jayson, SC 16996-2015','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:34','2017-09-27 01:50:34',999,999),(100014,'43016247','password','Brian','+1 (979) 872-2150','robel.jacinthe@example.org','1951-02-16','405 Morar Corners\nMadisynfort, WI 79091','30801 Hessel Stream Apt. 417\nLake Teresa, TN 50763-4572','50430 Kozey Union Suite 421\nPollichbury, WI 68063','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:34','2017-09-27 01:50:34',999,999),(100015,'194','password','Pete','546.200.4641 x66729','kirsten72@example.com','1940-12-09','433 Angel Fork\nRobertsfort, IL 52954','79067 Schroeder Course\nWest Delores, ME 25762','4534 Windler Pines Suite 364\nEast Soledad, WY 93664-8397','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:34','2017-09-27 01:50:34',999,999),(100016,'38297','password','Rowan','(831) 332-0452 x409','muller.keeley@example.org','1986-04-23','51487 Prohaska Forge Apt. 944\nSouth Delta, NY 39251-0161','320 Caden Drive\nNew Tom, ID 33976-1790','835 Wintheiser Creek Suite 771\nNew Skyemouth, MI 73909-6090','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:34','2017-09-27 01:50:34',999,999),(100017,'832812244','password','Loy','+1-923-552-7223','donny19@example.com','2001-11-18','242 Brenden Spurs Apt. 519\nNorth Rupert, KY 42813-2743','74424 Ebba Lane Suite 338\nWest Connerview, NH 89304','4592 Zaria Trail\nStromanside, HI 96081','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:34','2017-09-27 01:50:34',999,999),(100018,'151508683','password','Kayleigh','(598) 561-7870 x646','ratke.cierra@example.net','2002-10-18','549 Flossie Ranch\nWilkinsonton, IN 73728-8313','94432 Terry Island\nMarkstown, MD 35048','466 Nikolaus Corners Suite 149\nEast Alysha, NM 55181','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:34','2017-09-27 01:50:34',999,999),(100019,'268','password','Stephon','1-857-783-7104 x55199','vschaefer@example.net','1935-09-30','2501 Jairo Meadows Apt. 197\nJaidenland, NM 81902','1744 Elwin Views\nEast Genesis, LA 78766','853 Aurelio Mountains Apt. 615\nJaneview, SC 38998','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:35','2017-09-27 01:50:35',999,999),(100020,'81','password','Kiel','659.845.4840','hilll.era@example.org','1940-02-25','9130 Douglas Lane Suite 869\nNew Jefferychester, WY 76063','5917 Chaim Extensions\nSouth Eileenland, WI 00059-4733','5805 Wilkinson Alley\nXanderland, ND 08097','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:35','2017-09-27 01:50:35',999,999),(100021,'579496063','password','Osvaldo','1-754-331-7386 x51652','romaguera.chasity@example.net','1946-12-15','84133 Ernser Common\nPort Helenetown, AK 44697-8759','72994 Rowe Walk Apt. 621\nCruickshankmouth, AR 17232-8616','2686 Klocko Parkways\nWehnertown, MN 86326-3619','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:35','2017-09-27 01:50:35',999,999),(100022,'930','password','Porter','+18124153787','grayson.mccullough@example.com','1970-09-14','70242 Anderson Walk\nEinarberg, MS 98208','64541 Shields Street Apt. 817\nAaronville, WA 50232','96648 Moore Squares Suite 305\nErnsertown, CT 75375','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:35','2017-09-27 01:50:35',999,999),(100023,'42000963','password','Emerald','1-473-797-6157','stracke.odie@example.com','1956-08-05','483 Jerome Shores Suite 814\nLefflertown, ND 98969-4578','1550 Cartwright Stravenue Apt. 629\nErdmanport, MA 71467-9100','75553 Denesik Burg Suite 170\nBrainchester, MS 62739','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:35','2017-09-27 01:50:35',999,999),(100024,'9','password','Lon','608-752-5507 x6284','mohr.beverly@example.com','2013-10-23','46361 Enrique Springs\nNorth Francisca, SD 82127-7405','86527 Schmeler Lock\nGreenfeldershire, SD 60088-8498','8318 Patricia Pike\nLake Candido, TN 73362-2179','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:35','2017-09-27 01:50:35',999,999),(100025,'348057','password','Lyric','+1.665.975.0886','cindy47@example.org','1995-02-28','3487 Elyse Vista Apt. 374\nGutkowskifurt, TX 68914-7973','7860 Jaren Estate Apt. 262\nDonnellyborough, AK 64700-1230','39933 Marlin Shoal\nPort Meghanstad, ID 28536','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:35','2017-09-27 01:50:35',999,999),(100026,'80103388','password','Donny','+1-781-798-7874','granville.hessel@example.net','2002-03-04','375 Hansen Camp Suite 952\nSouth Julius, NH 15239-3184','526 Wilderman Stream Suite 236\nSouth Brando, PA 44043','53003 Kutch Park\nNorth Kileystad, OR 09952-7245','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:35','2017-09-27 01:50:35',999,999),(100027,'58839657','password','Dorian','(580) 533-6494 x844','hunter.kshlerin@example.com','1966-05-03','6150 Hertha Flat\nBeerbury, PA 08152','82834 Favian Point\nBentonchester, DC 92251','8995 Florine Drive\nEast Jaquanhaven, IA 25143','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:35','2017-09-27 01:50:35',999,999),(100028,'88291497','password','Harrison','+1.729.992.3542','madge.corkery@example.net','1968-12-25','332 Hollis Knolls\nLake Judefurt, KS 54498-5754','9962 Schiller Knoll Suite 249\nFadelview, MO 25496','2211 Jarret Path Suite 388\nWest Hannah, MI 17544','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:35','2017-09-27 01:50:35',999,999),(100029,'718237299','password','Waino','675-413-5766 x28996','brady02@example.com','2003-04-28','7093 Jarod Lake Suite 885\nShawnamouth, UT 25290','468 Ritchie Street Suite 144\nAmyaburgh, ME 38169','9675 Ansel Oval\nWest Modesta, PA 51150','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:35','2017-09-27 01:50:35',999,999),(100030,'0','password','Frankie','628-395-9129','ethan45@example.com','1937-11-04','236 Wiza Station\nSouth Oswaldfurt, DE 38426-5328','390 Anabel Forges\nKaiabury, NJ 36386','510 Della Mountains\nBrandtfort, WA 19289-6899','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:35','2017-09-27 01:50:35',999,999),(100031,'70261','password','Godfrey','(928) 487-7252 x00285','bborer@example.org','1955-01-18','3517 Ledner Ville\nNorvalhaven, NY 22155','26776 Parker Springs\nSantinoburgh, AL 49354-5843','74629 Abdul Fork Suite 090\nNikoport, KS 08517-2564','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:35','2017-09-27 01:50:35',999,999),(100032,'69322','password','Horace','1-526-805-6763 x240','hand.elwyn@example.com','1926-12-21','68439 Keven Lane Apt. 272\nNorth Meganefort, PA 97363-9760','66141 Etha Junction Apt. 961\nKeeblerstad, NV 87264-6721','762 Borer Motorway\nNorth Heather, ND 18011','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:35','2017-09-27 01:50:35',999,999),(100033,'5','password','Moses','(927) 758-4749 x766','brian19@example.net','1949-10-20','39810 Enos Tunnel Apt. 670\nEast Rocky, OK 47124-3425','5832 Violette Stravenue Suite 727\nPort Hilmaberg, WV 88162-7941','645 Harvey Bypass Suite 517\nPort Demetrius, TN 34285','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:35','2017-09-27 01:50:35',999,999),(100034,'75895239','password','Curtis','764.731.4820 x738','lupe.beier@example.org','1964-05-14','6358 Geovanny Village\nWest Immanuelmouth, NY 84874-0525','64109 Smith Lights\nNorth Emilio, ME 58127-7555','285 Kuhic Ridges\nSouth Kiantown, IL 59466-4854','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:35','2017-09-27 01:50:35',999,999),(100035,'6','password','Oran','307-761-4581 x8885','xtowne@example.net','1959-07-11','205 Alivia Branch Suite 315\nProsaccochester, VA 58697-3228','1896 Murphy Shores\nWest Ayana, ND 74341-1104','4814 Joany Drive Apt. 506\nEast Lillianamouth, NE 93064','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:35','2017-09-27 01:50:35',999,999),(100036,'97009','password','Guy','476-355-2587 x506','shania.okuneva@example.org','2007-03-26','66432 Sporer Row Apt. 933\nLegrosfort, MI 61438','87518 Kerluke Wall Suite 296\nPort Casperview, TX 08117','77292 Rashad Parkway\nLake Retta, OR 44833-6381','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:35','2017-09-27 01:50:35',999,999),(100037,'94767','password','Blair','1-781-585-4245 x90517','carolyne.hamill@example.com','1958-12-14','36944 Anissa Light Suite 951\nMallieville, OH 58152','7110 Powlowski Key Suite 494\nJohnstonmouth, ND 81299-5727','65886 Ondricka Island\nNew Kaylie, AL 55799-3671','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:35','2017-09-27 01:50:35',999,999),(100038,'86380029','password','Raul','936-328-4318','mariah.moen@example.com','1977-05-26','813 Weber Vista Apt. 454\nShakiraton, VT 66118-3496','6889 Maximus Turnpike Apt. 122\nColeberg, WV 38374','871 Eve Views\nNitzschemouth, RI 41932','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:35','2017-09-27 01:50:35',999,999),(100039,'8','password','Willy','286.551.8537','alva58@example.net','1978-05-07','90048 Gerhard Courts\nSchadenburgh, IN 90436','75853 Bernhard Expressway\nNew Candido, SC 32112-4199','1378 Lebsack Viaduct Suite 708\nWest Marysetown, ID 36669-9244','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:35','2017-09-27 01:50:35',999,999),(100040,'7402','password','Wilfredo','497.608.2475','hand.vicente@example.com','1982-09-08','683 Heathcote Loaf Apt. 139\nRennerchester, MA 86248-1193','568 Skye Creek\nLake Rheastad, WI 24336-8028','1404 Patsy Union\nNew Zolaburgh, ME 14691','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:35','2017-09-27 01:50:35',999,999),(100041,'466216652','password','Jordyn','748.512.0689','king.sabryna@example.net','1957-09-08','43809 Jazlyn Field\nLake Allan, NE 61248-9385','797 Reba Via Suite 532\nSouth Aylin, CA 81105-4794','10846 Mallory River Apt. 577\nHintzburgh, OR 76486','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:35','2017-09-27 01:50:35',999,999),(100042,'31','password','Dedric','614.314.2049 x62044','cyril.gottlieb@example.com','2004-04-11','29073 Abbey Junctions Suite 564\nNicolasborough, VT 03165-4721','612 Astrid Gateway\nNew Rosina, AL 74716','36851 Marjolaine Shores\nLake Domenica, MS 16439','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:35','2017-09-27 01:50:35',999,999),(100043,'77331','password','Conner','1-294-627-5332','lemke.hallie@example.net','1940-10-28','4909 Cade Run Suite 271\nAbbottchester, NH 77387-0414','82180 Kuvalis Park\nSouth Constancestad, SC 66540-9327','70299 Aimee Parkway Suite 910\nSouth Desmond, LA 25992','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:35','2017-09-27 01:50:35',999,999),(100044,'6705','password','Delbert','543-820-1231','jacynthe92@example.com','1977-05-18','2961 Ledner Valleys\nDickistad, WI 58108','5283 Cleta Corners Apt. 053\nLenorabury, IN 55995','58841 Gibson Glens\nGoodwinshire, NV 08456-7577','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:35','2017-09-27 01:50:35',999,999),(100045,'2247838','password','Jordon','470-986-6679 x63972','dell90@example.org','2002-01-19','978 Bella Hill\nLittleville, WA 12216','9647 Dietrich Neck Apt. 617\nWest Ivastad, CT 25372','49926 Rozella Hollow Apt. 222\nNovellamouth, CA 98545-9509','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:35','2017-09-27 01:50:35',999,999),(100046,'644153573','password','Everardo','(390) 327-9910 x1186','tcronin@example.com','1930-11-06','2506 Tressa Spring\nKylermouth, IN 10488-6892','206 Ramona Dale\nEast Monserrate, SD 75848-3651','329 Flavie Ports\nNorth Nyahaven, SD 09769','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:35','2017-09-27 01:50:35',999,999),(100047,'5586','password','King','1-863-205-0216','bdurgan@example.net','1992-05-03','47924 Wolff Camp Suite 465\nNikolausside, DC 45643-3014','26166 Mayert Crossroad Apt. 109\nCelestineport, IA 28470-9382','7653 Jackeline Island\nCristinaberg, ND 08235-8808','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:35','2017-09-27 01:50:35',999,999),(100048,'346944844','password','Miguel','+1.480.600.7008','michele.ohara@example.org','1939-02-11','1717 Blanche Fort\nGorczanyport, PA 19692-5873','896 Marcos Course\nNorth Lillychester, VA 32200-3617','770 Cole Plaza Apt. 971\nEast Lesleyview, ID 84589','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:36','2017-09-27 01:50:36',999,999),(100049,'730','password','Abraham','(674) 261-3762','qwilkinson@example.net','2007-08-12','50717 Adell Coves Apt. 678\nPort Vadafurt, UT 49400','150 Turcotte Crossroad\nAdriennebury, VT 22453-0352','3037 Morar Spurs Apt. 490\nPort Zane, VA 93039','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:36','2017-09-27 01:50:36',999,999),(100050,'2769','password','Nathanial','1-820-645-4804 x17607','laurine.doyle@example.org','1990-09-09','76295 Schultz Manor Suite 748\nEast Jodyport, OK 34441-2896','7528 Murazik Turnpike Suite 930\nNew Caliton, ME 26642','22501 Frederik Views\nWest Elyssa, ID 82949','M','line_id_example','bbm_id_example','whatsapp_example','facebook_example','2017-09-27 01:50:36','2017-09-27 01:50:36',999,999);
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
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (79,'2014_10_12_000000_create_users_table',1),(80,'2014_10_12_100000_create_password_resets_table',1),(81,'2017_05_25_180154_create_master_clients_table',1),(82,'2017_05_25_182546_create_mrgs_table',1),(83,'2017_05_28_073539_create_mrg_accounts_table',1),(84,'2017_05_28_074839_create_cats_table',1),(85,'2017_05_28_080847_create_aclub_members_table',1),(86,'2017_05_28_082702_create_aclub_transactions_table',1),(87,'2017_05_31_055637_create_aclub_informations_table',1),(88,'2017_05_31_060052_create_uobs_table',1),(89,'2017_05_31_061811_create_ashop_transactions_table',1),(90,'2017_05_31_062812_create_green_prospect_clients_table',1),(91,'2017_05_31_062826_create_green_prospect_progresses_table',1);
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
  `account_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `sales_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
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
INSERT INTO `mrg_accounts` VALUES ('0',100037,'Basic','Kamille Muller','2017-09-27 01:50:39','2017-09-27 01:50:39',999,999),('242',100033,'Syariah','Liana Hayes','2017-09-27 01:50:39','2017-09-27 01:50:39',999,999),('338',100043,'Signature','Niko Kutch PhD','2017-09-27 01:50:39','2017-09-27 01:50:39',999,999),('352',100005,'Recreation','Kamille Sawayn II','2017-09-27 01:50:39','2017-09-27 01:50:39',999,999),('38',100002,'Recreation','Leonard Wilderman','2017-09-27 01:50:39','2017-09-27 01:50:39',999,999),('4',100022,'Recreation','Flavio Kohler','2017-09-27 01:50:38','2017-09-27 01:50:38',999,999),('407',100002,'Recreation','Mrs. Kiarra Hand','2017-09-27 01:50:38','2017-09-27 01:50:38',999,999),('442',100016,'Basic','Miss Eveline Herzog','2017-09-27 01:50:39','2017-09-27 01:50:39',999,999),('460',100016,'Signature','Lauren Pagac','2017-09-27 01:50:39','2017-09-27 01:50:39',999,999),('483',100028,'Syariah','Mrs. Gregoria Walsh MD','2017-09-27 01:50:39','2017-09-27 01:50:39',999,999),('518',100012,'Signature','Lacey Anderson','2017-09-27 01:50:39','2017-09-27 01:50:39',999,999),('574',100022,'Syariah','Mr. Louisa Hilpert','2017-09-27 01:50:39','2017-09-27 01:50:39',999,999),('650',100016,'Signature','Taurean Doyle','2017-09-27 01:50:39','2017-09-27 01:50:39',999,999),('691',100005,'Recreation','Geovanny Corkery','2017-09-27 01:50:39','2017-09-27 01:50:39',999,999),('703',100028,'Basic','Golden Harris PhD','2017-09-27 01:50:39','2017-09-27 01:50:39',999,999),('836',100010,'Syariah','Montana Cole','2017-09-27 01:50:39','2017-09-27 01:50:39',999,999),('837',100034,'Syariah','Kylee Yundt','2017-09-27 01:50:39','2017-09-27 01:50:39',999,999),('847',100034,'Syariah','Mr. Elvis Fay','2017-09-27 01:50:39','2017-09-27 01:50:39',999,999),('881',100005,'Signature','Evie Bergstrom','2017-09-27 01:50:39','2017-09-27 01:50:39',999,999),('976',100002,'Signature','Dr. Muriel Barrows','2017-09-27 01:50:39','2017-09-27 01:50:39',999,999);
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
INSERT INTO `mrgs` VALUES (100002,'Duncan Waters','2017-10-15','2017-09-27 01:50:38','2017-09-27 01:50:38',999,999),(100005,'Viva Dicki III','2017-10-02','2017-09-27 01:50:38','2017-09-27 01:50:38',999,999),(100010,'Missouri Stokes','2017-10-01','2017-09-27 01:50:38','2017-09-27 01:50:38',999,999),(100012,'Kaleb Ruecker','2017-10-17','2017-09-27 01:50:38','2017-09-27 01:50:38',999,999),(100015,'Rosendo Feil','2017-10-25','2017-09-27 01:50:38','2017-09-27 01:50:38',999,999),(100016,'Mr. Emory Bayer DVM','2017-10-11','2017-09-27 01:50:38','2017-09-27 01:50:38',999,999),(100017,'Haylee Walker PhD','2017-10-04','2017-09-27 01:50:38','2017-09-27 01:50:38',999,999),(100018,'Markus Green','2017-10-17','2017-09-27 01:50:38','2017-09-27 01:50:38',999,999),(100019,'Walker Hodkiewicz','2017-10-10','2017-09-27 01:50:38','2017-09-27 01:50:38',999,999),(100020,'Dr. Rowan Kris','2017-10-13','2017-09-27 01:50:38','2017-09-27 01:50:38',999,999),(100022,'Marlee Jast','2017-10-08','2017-09-27 01:50:38','2017-09-27 01:50:38',999,999),(100023,'Breanne Steuber IV','2017-10-26','2017-09-27 01:50:38','2017-09-27 01:50:38',999,999),(100025,'Pearl Fisher','2017-09-30','2017-09-27 01:50:38','2017-09-27 01:50:38',999,999),(100028,'Mr. Lorenzo Stiedemann MD','2017-10-13','2017-09-27 01:50:38','2017-09-27 01:50:38',999,999),(100031,'Jesus Osinski','2017-10-06','2017-09-27 01:50:38','2017-09-27 01:50:38',999,999),(100033,'Jaylon Jenkins','2017-10-02','2017-09-27 01:50:38','2017-09-27 01:50:38',999,999),(100034,'Marcelino Haag','2017-10-18','2017-09-27 01:50:38','2017-09-27 01:50:38',999,999),(100037,'Ursula Rutherford','2017-09-29','2017-09-27 01:50:38','2017-09-27 01:50:38',999,999),(100043,'Dr. Americo Glover','2017-10-22','2017-09-27 01:50:38','2017-09-27 01:50:38',999,999),(100046,'Velma Stamm','2017-10-16','2017-09-27 01:50:38','2017-09-27 01:50:38',999,999);
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
  `sales_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sumber_data` text COLLATE utf8_unicode_ci NOT NULL,
  `join_date` date NOT NULL,
  `nomor_ktp` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal_expired_ktp` date NOT NULL,
  `nomor_npwp` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `alamat_surat` text COLLATE utf8_unicode_ci NOT NULL,
  `saudara_tidak_serumah` text COLLATE utf8_unicode_ci NOT NULL,
  `nama_ibu_kandung` text COLLATE utf8_unicode_ci NOT NULL,
  `bank_pribadi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nomor_rekening_pribadi` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal_rdi_done` date NOT NULL,
  `rdi_bank` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nomor_rdi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal_top_up` date NOT NULL,
  `nominal_top_up` bigint(20) NOT NULL,
  `tanggal_trading` date NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `trading_via` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8_unicode_ci NOT NULL,
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
INSERT INTO `uobs` VALUES ('14883',100026,'Kobe Prohaska','-','2017-10-08','92674','2017-10-09','5215','317 Gleichner Courts Suite 473\nNew Christinafurt, OH 80778-1461','Alessia Roob','Joanne','BCA','53179','2017-10-22','-','40414','2017-10-13',640000,'2017-10-07','-','-','-','2017-09-27 01:50:37','2017-09-27 01:50:37',999,999),('1519',100016,'Samara Reinger','-','2017-10-03','94962','2017-10-04','28551','47824 Stanton Park\nSouth Luciusmouth, CO 93298','Lue Hilpert','Lilly','BCA','16126','2017-10-02','-','6641','2017-10-09',820000,'2017-10-21','-','-','-','2017-09-27 01:50:37','2017-09-27 01:50:37',999,999),('25437',100041,'Kelsi Swift','-','2017-09-30','11585','2017-10-21','59376','478 Ullrich Mall\nMurphymouth, AZ 65516','Maria Swift I','Kali','BCA','61459','2017-10-20','-','41464','2017-10-22',530000,'2017-10-04','-','-','-','2017-09-27 01:50:37','2017-09-27 01:50:37',999,999),('29809',100019,'Terry Block','-','2017-10-16','11409','2017-10-21','81980','5898 Mona Spur Suite 913\nJeramytown, VA 64904','Mr. Deshawn Jones','Melba','BCA','42601','2017-10-15','-','50008','2017-10-15',650000,'2017-09-29','-','-','-','2017-09-27 01:50:37','2017-09-27 01:50:37',999,999),('42011',100006,'Evelyn Dare','-','2017-10-12','63261','2017-10-19','90184','8765 Mayert Crossing Apt. 576\nAdolphmouth, NC 05271','Lauren Sipes','Maia','BCA','11786','2017-10-04','-','36968','2017-10-12',430000,'2017-10-15','-','-','-','2017-09-27 01:50:37','2017-09-27 01:50:37',999,999),('45383',100001,'Eusebio Stracke','-','2017-10-10','37637','2017-10-05','2960','73586 Muhammad Walk\nJammiefort, RI 46378-1173','Alvena Brakus','Lue','BCA','74627','2017-10-22','-','40001','2017-10-13',80000,'2017-10-09','-','-','-','2017-09-27 01:50:38','2017-09-27 01:50:38',999,999),('4599',100003,'Mrs. Evelyn Mohr III','-','2017-10-05','13011','2017-10-25','35153','338 DuBuque Brook\nBorermouth, KS 44482','Brannon Friesen','Freeda','BCA','47848','2017-10-17','-','19168','2017-10-15',660000,'2017-10-03','-','-','-','2017-09-27 01:50:37','2017-09-27 01:50:37',999,999),('46932',100039,'Angie Vandervort','-','2017-10-17','93430','2017-10-09','97528','7875 Becker Cliff\nGrimeschester, TX 42429-9117','Jarrett Grimes IV','Isabel','BCA','67372','2017-10-04','-','76761','2017-10-14',160000,'2017-10-13','-','-','-','2017-09-27 01:50:37','2017-09-27 01:50:37',999,999),('47952',100002,'Dr. Elizabeth Jast MD','-','2017-10-13','35937','2017-10-09','25653','919 Rowe Square Suite 713\nSouth Natalia, WA 67744-7577','Jessika Lueilwitz','Trisha','BCA','75276','2017-10-17','-','27990','2017-10-24',270000,'2017-10-18','-','-','-','2017-09-27 01:50:37','2017-09-27 01:50:37',999,999),('49456',100037,'Camila Armstrong','-','2017-10-24','81067','2017-10-15','42161','79085 Medhurst Plains Apt. 717\nNorth Hunter, MI 79805','Dr. Destini Pfeffer','Vesta','BCA','5955','2017-10-08','-','45624','2017-10-19',980000,'2017-10-05','-','-','-','2017-09-27 01:50:37','2017-09-27 01:50:37',999,999),('52858',100046,'Ted McDermott Jr.','-','2017-10-12','29398','2017-10-17','36206','9556 Edison Route Apt. 724\nMcCulloughton, OK 79151-3703','Sierra Predovic','Mabel','BCA','49466','2017-10-19','-','35403','2017-09-30',470000,'2017-10-07','-','-','-','2017-09-27 01:50:37','2017-09-27 01:50:37',999,999),('54269',100029,'Evangeline Konopelski','-','2017-10-15','4562','2017-09-30','45652','13079 Margarita Shoal\nBreitenbergbury, NE 58865','Lafayette Wyman III','Nola','BCA','39141','2017-10-12','-','58619','2017-10-01',600000,'2017-10-24','-','-','-','2017-09-27 01:50:37','2017-09-27 01:50:37',999,999),('57022',100002,'Prof. Sandy Bernhard PhD','-','2017-10-27','25077','2017-10-17','6384','8022 Little Divide Apt. 084\nEast Daytonburgh, MN 62014-4285','Dr. Carlo Kozey DDS','Annette','BCA','51836','2017-10-09','-','8844','2017-10-19',340000,'2017-10-14','-','-','-','2017-09-27 01:50:37','2017-09-27 01:50:37',999,999),('64172',100006,'Misael Feil','-','2017-10-27','74448','2017-10-14','50943','579 Fisher Lights Apt. 089\nMarvinton, AL 65524-0817','Ms. Maia Torp II','Marlen','BCA','94857','2017-10-17','-','53669','2017-09-29',210000,'2017-10-16','-','-','-','2017-09-27 01:50:37','2017-09-27 01:50:37',999,999),('7208',100013,'Ollie Buckridge','-','2017-10-23','73695','2017-10-12','96507','76462 Kunde Manors\nFraneckibury, OK 42536-9232','Prof. Brody Howe','Francesca','BCA','41945','2017-10-26','-','43048','2017-10-21',110000,'2017-10-25','-','-','-','2017-09-27 01:50:37','2017-09-27 01:50:37',999,999),('78640',100028,'Vivien Dooley PhD','-','2017-10-11','48559','2017-10-11','40732','4921 Cierra Courts Apt. 348\nSouth Tyshawn, NJ 14302','Meagan Barrows','Norene','BCA','99019','2017-10-26','-','88772','2017-09-27',870000,'2017-10-21','-','-','-','2017-09-27 01:50:37','2017-09-27 01:50:37',999,999),('84999',100028,'Lon Daugherty','-','2017-09-30','17834','2017-10-10','93808','99601 Eveline Motorway\nTomshire, FL 47991-2186','Ms. Tatyana Breitenberg','Helena','BCA','72406','2017-10-03','-','70480','2017-10-19',800000,'2017-10-10','-','-','-','2017-09-27 01:50:37','2017-09-27 01:50:37',999,999),('89383',100010,'Nichole Leffler','-','2017-10-20','71296','2017-10-16','50455','28555 Rath Turnpike\nMelvinchester, IL 14419','Kaia Lowe','Zella','BCA','45491','2017-10-22','-','60224','2017-10-01',500000,'2017-10-27','-','-','-','2017-09-27 01:50:37','2017-09-27 01:50:37',999,999),('89485',100005,'Tyrell Casper DVM','-','2017-10-27','344','2017-10-07','65960','258 Zemlak Meadows\nBalistrerifort, AL 53708','Mr. Kole Doyle Jr.','Aniyah','BCA','8618','2017-10-09','-','27688','2017-10-25',40000,'2017-10-17','-','-','-','2017-09-27 01:50:37','2017-09-27 01:50:37',999,999),('89974',100047,'Prof. Marina Ward IV','-','2017-10-06','64913','2017-10-24','77876','205 Robel Hills\nNew Casimer, KS 34986','Tiffany Schneider','Yadira','BCA','68137','2017-09-29','-','77282','2017-09-28',690000,'2017-10-20','-','-','-','2017-09-27 01:50:37','2017-09-27 01:50:37',999,999);
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
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `no_handphone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
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
INSERT INTO `users` VALUES (1,'superadmin','superadmin','-','$2y$10$PeGbTSZQ9NDiKbt.Yeomkue1DACk7HZ0Q4DmSWJ43mLSESYlpwEVS','-',0,1,'-','2017-09-27 01:50:17','2017-09-27 01:50:17'),(2,'Elna','Skyla','jruecker@example.net','password','330.908.6928',3,0,'remember_token','2017-09-27 01:50:33','2017-09-27 01:50:33'),(3,'Flo','Muriel','qgoldner@example.com','password','1-525-696-3963 x1137',3,0,'remember_token','2017-09-27 01:50:33','2017-09-27 01:50:33'),(4,'Edythe','Ora','alva.glover@example.org','password','1-686-666-5322 x978',3,0,'remember_token','2017-09-27 01:50:33','2017-09-27 01:50:33'),(5,'Mozell','Earline','idell.okon@example.org','password','972-733-2148 x7074',2,0,'remember_token','2017-09-27 01:50:33','2017-09-27 01:50:33'),(6,'Jody','Bettye','jtreutel@example.org','password','(450) 281-0590',1,0,'remember_token','2017-09-27 01:50:33','2017-09-27 01:50:33'),(7,'Annamarie','Madge','duane65@example.net','password','+1 (838) 517-2931',1,0,'remember_token','2017-09-27 01:50:33','2017-09-27 01:50:33'),(8,'Rosalia','Elisa','dwisozk@example.com','password','(808) 730-1781 x7625',0,0,'remember_token','2017-09-27 01:50:33','2017-09-27 01:50:33'),(9,'Brandy','Donna','dklocko@example.com','password','+1-905-506-1196',3,0,'remember_token','2017-09-27 01:50:33','2017-09-27 01:50:33'),(10,'Lulu','Marlene','richard33@example.com','password','220.620.4336 x5501',3,0,'remember_token','2017-09-27 01:50:33','2017-09-27 01:50:33'),(11,'Adaline','Nicolette','beth74@example.org','password','969.880.6653 x35720',1,0,'remember_token','2017-09-27 01:50:33','2017-09-27 01:50:33'),(12,'Vida','Astrid','sohara@example.org','password','(905) 358-9817',1,0,'remember_token','2017-09-27 01:50:33','2017-09-27 01:50:33'),(13,'Prudence','Dolores','herman.donavon@example.net','password','(779) 640-2428 x5795',3,0,'remember_token','2017-09-27 01:50:33','2017-09-27 01:50:33'),(14,'Margaretta','Albina','huels.nicola@example.com','password','1-931-675-3938',3,0,'remember_token','2017-09-27 01:50:33','2017-09-27 01:50:33'),(15,'Marcella','Serena','kelly72@example.org','password','827.978.4469',3,0,'remember_token','2017-09-27 01:50:33','2017-09-27 01:50:33'),(16,'Robyn','Jane','cayla76@example.com','password','(375) 688-0926 x375',2,0,'remember_token','2017-09-27 01:50:33','2017-09-27 01:50:33'),(17,'Brandi','Isabell','ima.strosin@example.org','password','+15893244864',1,0,'remember_token','2017-09-27 01:50:33','2017-09-27 01:50:33'),(18,'Calista','Hannah','wkertzmann@example.net','password','+1-909-820-3949',2,0,'remember_token','2017-09-27 01:50:33','2017-09-27 01:50:33'),(19,'Lucile','Alessandra','evandervort@example.org','password','(951) 762-2201',3,0,'remember_token','2017-09-27 01:50:33','2017-09-27 01:50:33'),(20,'Corrine','Brittany','ihoppe@example.net','password','+17895155179',0,0,'remember_token','2017-09-27 01:50:34','2017-09-27 01:50:34'),(21,'Nina','Nyasia','ondricka.napoleon@example.net','password','265.257.3723',1,0,'remember_token','2017-09-27 01:50:34','2017-09-27 01:50:34'),(999,'seeder_dummy','seeder_dummy','seeder@dummy.com','password_seeder','-',-1,0,'-','2017-09-27 01:50:34','2017-09-27 01:50:34');
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

-- Dump completed on 2017-10-03  8:38:01
