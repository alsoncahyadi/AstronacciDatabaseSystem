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

-- Dump completed on 2018-03-22 10:44:03
