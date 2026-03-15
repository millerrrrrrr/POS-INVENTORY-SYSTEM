-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: pos_inventory_system
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_category_unique` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Oil','2025-09-29 20:48:26','2025-09-29 20:48:26'),(2,'Nuts','2025-09-29 20:55:05','2025-09-29 20:55:05'),(3,'Decals','2025-09-29 20:55:08','2025-09-29 20:55:08'),(4,'Coolant','2025-09-29 21:03:58','2025-09-29 21:03:58'),(5,'Clutch Fluids','2025-09-29 21:04:11','2025-09-29 21:04:11'),(6,'Chain lubricants','2025-09-29 21:04:31','2025-09-29 21:04:31'),(7,'Bolts','2025-09-29 21:04:51','2025-09-29 21:04:51'),(8,'Washers','2025-09-29 21:04:54','2025-09-29 21:04:54'),(9,'Stickers','2025-09-29 21:05:02','2025-09-29 21:05:02'),(10,'Fairings','2025-09-29 21:05:08','2025-09-29 21:05:08'),(11,'fenders','2025-09-29 21:05:18','2025-09-30 02:56:04'),(12,'Mirrors','2025-09-29 21:05:32','2025-09-29 21:05:32'),(13,'Fuel Pumps','2025-09-29 21:05:37','2025-09-30 02:55:44'),(14,'Carburetors','2025-09-29 21:05:51','2025-09-29 21:05:51'),(15,'Fuel Injectors','2025-09-29 21:05:58','2025-09-29 21:05:58'),(16,'Air Filters','2025-09-29 21:06:16','2025-09-29 21:06:16'),(17,'Pistons','2025-09-30 02:43:42','2025-09-30 02:43:42'),(18,'Throttle cables','2025-09-30 02:45:30','2025-09-30 02:56:59'),(19,'Spark plugs','2025-09-30 02:47:50','2025-09-30 02:55:20'),(20,'exhaust pipes','2025-09-30 02:57:17','2025-09-30 02:57:17'),(23,'brake fluid','2026-03-03 04:26:16','2026-03-03 04:26:16'),(24,'Caliper','2026-03-03 04:28:13','2026-03-03 04:28:13'),(25,'Brake shoe','2026-03-03 04:29:24','2026-03-03 04:29:24'),(26,'Engine Oil','2026-03-03 04:30:38','2026-03-03 04:30:38'),(27,'gear oil','2026-03-03 04:31:28','2026-03-03 04:31:28'),(28,'Mags','2026-03-08 04:54:17','2026-03-08 04:54:17');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_09_30_043603_create_categories_table',2),(5,'2025_09_30_043749_create_categories_table',3),(6,'2025_11_05_012930_create_users_table',4),(7,'2025_12_01_034638_create_products_table',5),(8,'2025_12_08_062830_create_orders_table',6),(9,'2025_12_08_062914_create_order_items_table',6),(10,'2025_12_08_072219_update_order_date_to_datetime_in_orders_table',7),(11,'2025_12_08_153206_add_soft_deletes_to_orders_table',8),(12,'2026_02_19_125315_add_barcode_to_products_table',9),(13,'2026_02_20_114003_add_vat_to_orders_table',10);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (46,34,18,1,336.00,336.00,'2026-03-03 04:34:53','2026-03-03 04:34:53'),(47,34,19,1,672.00,672.00,'2026-03-03 04:34:53','2026-03-03 04:34:53'),(48,35,16,1,392.00,392.00,'2026-03-03 04:55:53','2026-03-03 04:55:53'),(49,35,17,1,672.00,672.00,'2026-03-03 04:55:53','2026-03-03 04:55:53'),(50,35,18,1,336.00,336.00,'2026-03-03 04:55:53','2026-03-03 04:55:53'),(51,35,19,1,672.00,672.00,'2026-03-03 04:55:53','2026-03-03 04:55:53'),(52,35,24,1,336.00,336.00,'2026-03-03 04:55:53','2026-03-03 04:55:53'),(53,35,23,1,672.00,672.00,'2026-03-03 04:55:53','2026-03-03 04:55:53'),(54,35,22,1,392.00,392.00,'2026-03-03 04:55:53','2026-03-03 04:55:53'),(55,36,16,1,392.00,392.00,'2026-03-03 05:22:02','2026-03-03 05:22:02'),(56,36,17,1,672.00,672.00,'2026-03-03 05:22:02','2026-03-03 05:22:02'),(57,36,18,1,336.00,336.00,'2026-03-03 05:22:02','2026-03-03 05:22:02'),(58,36,19,1,672.00,672.00,'2026-03-03 05:22:02','2026-03-03 05:22:02'),(59,36,20,1,448.00,448.00,'2026-03-03 05:22:02','2026-03-03 05:22:02'),(60,36,21,1,560.00,560.00,'2026-03-03 05:22:02','2026-03-03 05:22:02'),(61,36,22,1,392.00,392.00,'2026-03-03 05:22:02','2026-03-03 05:22:02'),(62,36,23,1,672.00,672.00,'2026-03-03 05:22:02','2026-03-03 05:22:02'),(63,36,24,1,336.00,336.00,'2026-03-03 05:22:02','2026-03-03 05:22:02'),(64,37,16,1,392.00,392.00,'2026-03-08 04:41:28','2026-03-08 04:41:28'),(65,38,16,1,392.00,392.00,'2026-03-08 05:09:07','2026-03-08 05:09:07'),(66,38,17,1,672.00,672.00,'2026-03-08 05:09:07','2026-03-08 05:09:07'),(67,38,18,1,336.00,336.00,'2026-03-08 05:09:07','2026-03-08 05:09:07'),(68,38,19,1,672.00,672.00,'2026-03-08 05:09:07','2026-03-08 05:09:07'),(69,38,20,1,448.00,448.00,'2026-03-08 05:09:07','2026-03-08 05:09:07'),(70,38,21,1,560.00,560.00,'2026-03-08 05:09:07','2026-03-08 05:09:07'),(71,38,22,1,392.00,392.00,'2026-03-08 05:09:07','2026-03-08 05:09:07'),(72,38,23,1,672.00,672.00,'2026-03-08 05:09:07','2026-03-08 05:09:07'),(73,38,24,1,336.00,336.00,'2026-03-08 05:09:07','2026-03-08 05:09:07'),(75,40,16,1,392.00,392.00,'2026-03-10 04:21:49','2026-03-10 04:21:49'),(76,40,23,2,672.00,1344.00,'2026-03-10 04:21:49','2026-03-10 04:21:49'),(77,40,17,1,672.00,672.00,'2026-03-10 04:21:49','2026-03-10 04:21:49'),(78,40,22,1,392.00,392.00,'2026-03-10 04:21:49','2026-03-10 04:21:49'),(79,41,16,2,392.00,784.00,'2026-03-10 04:23:09','2026-03-10 04:23:09'),(80,41,24,2,336.00,672.00,'2026-03-10 04:23:09','2026-03-10 04:23:09'),(81,41,21,1,560.00,560.00,'2026-03-10 04:23:09','2026-03-10 04:23:09'),(82,41,22,5,392.00,1960.00,'2026-03-10 04:23:09','2026-03-10 04:23:09');
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `total` decimal(10,2) NOT NULL,
  `cash` decimal(10,2) NOT NULL,
  `change` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `vat` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_with_vat` decimal(10,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (2,2350.00,5000.00,2650.00,'2025-12-08 00:00:00','2025-12-07 23:19:50','2025-12-08 08:10:49',NULL,0.00,0.00),(4,800.00,1000.00,200.00,'2025-12-08 15:26:22','2025-12-08 07:26:22','2025-12-08 08:09:06',NULL,0.00,0.00),(5,900.00,1000.00,100.00,'2026-02-20 10:45:53','2026-02-20 02:45:53','2026-02-20 02:45:53',NULL,0.00,0.00),(6,350.00,500.00,150.00,'2026-02-20 11:26:44','2026-02-20 03:26:44','2026-02-20 03:26:44',NULL,0.00,0.00),(7,0.00,500.00,500.00,'2026-02-20 11:29:50','2026-02-20 03:29:50','2026-02-20 03:57:20',NULL,0.00,0.00),(8,0.00,600.00,600.00,'2026-02-20 11:34:19','2026-02-20 03:34:19','2026-02-20 03:57:21',NULL,0.00,0.00),(9,350.00,400.00,50.00,'2026-02-20 11:37:10','2026-02-20 03:37:10','2026-02-20 03:37:10',NULL,0.00,0.00),(10,600.00,700.00,28.00,'2026-02-20 11:43:09','2026-02-20 03:43:09','2026-02-20 03:43:09',NULL,0.00,0.00),(11,350.00,400.00,8.00,'2026-02-20 11:46:34','2026-02-20 03:46:34','2026-02-20 03:57:21',NULL,0.00,0.00),(12,270.00,350.00,47.60,'2026-02-20 11:51:27','2026-02-20 03:51:27','2026-02-20 03:57:22',NULL,32.40,302.40),(13,810.00,1000.00,92.80,'2026-02-20 11:57:51','2026-02-20 03:57:51','2026-02-20 03:57:51',NULL,97.20,907.20),(14,900.00,1500.00,492.00,'2026-02-25 12:57:07','2026-02-25 04:57:07','2026-02-25 04:57:07',NULL,108.00,1008.00),(15,550.00,700.00,84.00,'2026-02-25 12:57:32','2026-02-25 04:57:32','2026-02-25 04:57:32',NULL,66.00,616.00),(16,550.00,700.00,84.00,'2026-02-25 12:59:08','2026-02-25 04:59:08','2026-02-25 04:59:08',NULL,66.00,616.00),(17,550.00,650.00,34.00,'2026-02-25 13:00:33','2026-02-25 05:00:33','2026-02-25 05:00:33',NULL,66.00,616.00),(18,80.00,100.00,10.40,'2026-02-25 13:06:42','2026-02-25 05:06:42','2026-02-25 05:06:42',NULL,9.60,89.60),(19,80.00,100.00,10.40,'2026-02-25 13:06:54','2026-02-25 05:06:54','2026-02-25 05:06:54',NULL,9.60,89.60),(20,80.00,100.00,10.40,'2026-02-25 13:07:59','2026-02-25 05:07:59','2026-02-25 05:07:59',NULL,9.60,89.60),(21,80.00,100.00,10.40,'2026-02-25 13:08:13','2026-02-25 05:08:13','2026-02-25 05:08:13',NULL,9.60,89.60),(22,80.00,100.00,10.40,'2026-02-25 13:11:30','2026-02-25 05:11:30','2026-02-25 05:11:30',NULL,9.60,89.60),(23,600.00,750.00,78.00,'2026-02-25 13:12:07','2026-02-25 05:12:07','2026-02-25 05:12:07',NULL,72.00,672.00),(24,270.00,500.00,197.60,'2026-02-25 13:12:37','2026-02-25 05:12:37','2026-02-25 05:12:37',NULL,32.40,302.40),(25,180.00,210.00,8.40,'2026-02-25 13:15:45','2026-02-25 05:15:45','2026-02-25 05:15:45',NULL,21.60,201.60),(26,2260.00,3000.00,468.80,'2026-02-25 13:17:51','2026-02-25 05:17:51','2026-02-25 05:17:51',NULL,271.20,2531.20),(27,3600.00,5000.00,968.00,'2026-02-25 13:46:54','2026-02-25 05:46:54','2026-02-25 05:46:54',NULL,432.00,4032.00),(28,1500.00,2000.00,320.00,'2026-02-26 11:33:39','2026-02-26 03:33:39','2026-02-26 03:33:39',NULL,180.00,1680.00),(29,1850.00,2500.00,428.00,'2026-03-03 11:40:48','2026-03-03 03:40:48','2026-03-03 03:40:48',NULL,222.00,2072.00),(30,900.00,1000.00,100.00,'2026-03-03 11:52:12','2026-03-03 03:52:12','2026-03-03 03:52:12',NULL,0.00,900.00),(31,900.00,1000.00,100.00,'2026-03-03 11:54:21','2026-03-03 03:54:21','2026-03-03 03:54:21',NULL,0.00,900.00),(32,448.00,500.00,52.00,'2026-03-03 11:57:25','2026-03-03 03:57:25','2026-03-03 03:57:25',NULL,0.00,448.00),(33,350.00,400.00,50.00,'2026-03-03 12:00:18','2026-03-03 04:00:18','2026-03-03 04:00:18',NULL,0.00,350.00),(34,1008.00,1050.00,42.00,'2026-03-03 12:34:53','2026-03-03 04:34:53','2026-03-03 04:34:53',NULL,0.00,1008.00),(35,3472.00,3500.00,28.00,'2026-03-03 12:55:53','2026-03-03 04:55:53','2026-03-10 03:52:53',NULL,0.00,3472.00),(36,4480.00,5000.00,520.00,'2026-03-03 13:22:01','2026-03-03 05:22:01','2026-03-10 03:52:54',NULL,0.00,4480.00),(37,392.00,400.00,8.00,'2026-03-08 12:41:28','2026-03-08 04:41:28','2026-03-10 04:01:48',NULL,0.00,392.00),(38,4480.00,4500.00,20.00,'2026-03-08 13:09:07','2026-03-08 05:09:07','2026-03-10 04:01:53',NULL,0.00,4480.00),(40,2800.00,3000.00,200.00,'2026-03-10 12:21:49','2026-03-10 04:21:49','2026-03-10 04:21:49',NULL,0.00,2800.00),(41,3976.00,4000.00,24.00,'2026-03-10 12:23:09','2026-03-10 04:23:09','2026-03-10 04:23:09',NULL,0.00,3976.00);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `barcode` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `purchasePrice` double NOT NULL,
  `salePrice` double NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_barcode_unique` (`barcode`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (16,NULL,'photos/products/zf8yh9Rj6g8ned0Zz8HjCaHfR6zIqRr2Oj01Rt4G.jpg','Shimano Air filter','Air Filters','for click',43,300,392,NULL,'2026-03-03 04:27:39','2026-03-10 04:23:09'),(17,NULL,'photos/products/tDRIRFPuaEV0nwjd7MBhsRzZqaEP8XeKRLFiwM7i.jpg','Domino Caliper','Caliper','for mio i125',26,500,672,NULL,'2026-03-03 04:28:41','2026-03-10 04:21:49'),(18,NULL,'photos/products/9c7QApDGzTW0CWoN0zjkPs6EhJ6em48g88NX3C6g.jpg','Prestone Brake fluid','brake fluid','for scooter',96,250,336,NULL,'2026-03-03 04:29:03','2026-03-10 04:01:53'),(19,NULL,'photos/products/PG1XDpczVIvu8VqnNdg0vR8XKxdHFHK7YpuUEAwS.jpg','Yamaha Brake Shoe','Brake shoe','for mio i125',46,550,672,NULL,'2026-03-03 04:29:52','2026-03-10 04:01:53'),(20,NULL,'photos/products/zDZ1vKERp8YtMLjCKfYcRpYLZcP191tue5iPle5F.jpg','ABRD Coolant','Coolant','for scooters',73,300,448,NULL,'2026-03-03 04:30:16','2026-03-10 04:01:53'),(21,NULL,'photos/products/TO0RDnfXujrSnZC8j8e0eh6T4yiGKyZEpIguDNL4.jpg','4T Engine Oil','Engine Oil','for scooters',57,450,560,NULL,'2026-03-03 04:31:01','2026-03-10 04:23:09'),(22,NULL,'photos/products/5QzYFXKGbkbgXVhvA6c7MMchS454iKgieqZrnQKO.jpg','Scooter Gear oil','gear oil','for scooters',41,300,392,NULL,'2026-03-03 04:31:56','2026-03-10 04:23:09'),(23,NULL,'photos/products/Hc5VV2H07yjEuHGGegb9WtJOvczCm20dj4iqvPpx.jpg','Hayabusa','Decals','for NMAX 155',25,500,672,NULL,'2026-03-03 04:32:47','2026-03-10 04:21:49'),(24,NULL,'photos/products/xYzCIynrvRaqubcHpaCUw2GEWxpsANVz3o8h0c2r.jpg','Speed Motto','Mirrors','for any',35,250,336,NULL,'2026-03-03 04:33:34','2026-03-10 04:23:09'),(25,NULL,'photos/products/9UOVuAATbBLDAEe2Rws9xbp6EGc8mskKYKIZKyCa.jpg','BomX','Mags','for mio i125',0,4000,5600,NULL,'2026-03-08 04:54:51','2026-03-10 03:58:43');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('CncdpeDzod0pTi5N9xctd64YzHda9GD5ZWodcT3X',7,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUWZZdmV1MG8ybUZRRDBjRThpNHBobmNid1RXUU1Yb1hma21QT25yUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91dGlsaXRpZXMvYmFja3VwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Nzt9',1773204903),('EUlfzl191B5X73qrqXZMl0biNzoEihzaWaEYevYe',7,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWkhGM0FHSm9CaHlhd1dlYk9qQ05yUFczcERocjZMWkhMNUxlelhlZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91dGlsaXRpZXMvYmFja3VwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Nzt9',1773207658);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (7,'owner','$2y$12$LRbu8sxsHCUX/xiDxHT4OuEawlGLZlcKildPn0Qc2fiW.VoyQpPMu','2026-03-09 03:41:44','2026-03-09 03:43:00');
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

-- Dump completed on 2026-03-11 13:41:00
