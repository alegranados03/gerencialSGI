-- MySQL dump 10.16  Distrib 10.1.22-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: gerencialpan
-- ------------------------------------------------------
-- Server version	10.1.22-MariaDB

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
-- Table structure for table `gerencial_categoria`
--

DROP TABLE IF EXISTS `gerencial_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gerencial_categoria` (
  `id` int(10) unsigned NOT NULL,
  `nombre_categoria` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'nombre de la categoría',
  PRIMARY KEY (`id`),
  UNIQUE KEY `gerencial_categoria_nombre_categoria_unique` (`nombre_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gerencial_categoria`
--

LOCK TABLES `gerencial_categoria` WRITE;
/*!40000 ALTER TABLE `gerencial_categoria` DISABLE KEYS */;
INSERT INTO `gerencial_categoria` VALUES (10,'Bebidas Calientes'),(9,'Bebidas Frías'),(1,'Bolleria'),(2,'Empanadillas'),(3,'Gourmet'),(4,'Pan'),(8,'Pan Dulce'),(6,'Pastelería'),(7,'Repostería'),(5,'Tartas');
/*!40000 ALTER TABLE `gerencial_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gerencial_compra`
--

DROP TABLE IF EXISTS `gerencial_compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gerencial_compra` (
  `id` int(10) unsigned NOT NULL,
  `materia_prima_id` int(10) unsigned NOT NULL,
  `proveedor_id` int(10) unsigned NOT NULL COMMENT 'id del proveedor al que le compra la panaderia',
  `cantidad` int(11) NOT NULL,
  `costo_compra` decimal(8,2) NOT NULL COMMENT 'costo de adquisición de materia prima',
  `fecha_compra` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gerencial_compra_materia_prima_id_foreign` (`materia_prima_id`),
  KEY `gerencial_compra_proveedor_id_foreign` (`proveedor_id`),
  CONSTRAINT `gerencial_compra_materia_prima_id_foreign` FOREIGN KEY (`materia_prima_id`) REFERENCES `gerencial_materia_prima` (`id`),
  CONSTRAINT `gerencial_compra_proveedor_id_foreign` FOREIGN KEY (`proveedor_id`) REFERENCES `gerencial_proveedor` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gerencial_compra`
--

LOCK TABLES `gerencial_compra` WRITE;
/*!40000 ALTER TABLE `gerencial_compra` DISABLE KEYS */;
INSERT INTO `gerencial_compra` VALUES (1,1,1,100,8.50,'2019-02-20 16:34:40'),(2,2,3,100,8.50,'2019-02-20 16:34:40'),(3,3,2,100,8.50,'2019-02-20 16:34:40'),(4,3,3,100,8.50,'2019-02-20 16:34:40'),(5,3,3,100,8.50,'2019-02-20 16:34:40'),(6,4,3,100,8.50,'2019-02-20 16:34:40'),(7,3,4,100,8.50,'2019-02-20 16:34:40'),(8,3,4,100,8.50,'2019-02-20 16:34:40'),(9,5,5,100,8.50,'2019-02-20 16:34:40'),(10,2,2,100,8.50,'2019-02-20 16:34:40'),(11,1,1,100,8.50,'2019-02-20 16:34:40'),(12,1,1,100,8.50,'2019-02-20 16:34:40'),(13,1,1,100,8.50,'2019-02-20 16:34:40'),(14,1,1,100,8.50,'2019-02-20 16:34:40'),(15,2,7,100,8.50,'2019-02-20 16:34:40'),(16,1,1,100,8.50,'2019-02-20 16:34:40'),(17,1,1,100,8.50,'2019-02-20 16:34:40'),(18,3,7,100,8.50,'2019-02-20 16:34:40'),(19,1,4,100,8.50,'2019-02-20 16:34:40'),(20,4,3,100,8.50,'2019-02-20 16:34:40'),(21,1,1,100,8.50,'2018-12-20 16:34:40'),(22,1,2,100,8.50,'2018-12-20 16:34:40'),(23,1,1,100,8.50,'2018-12-20 16:34:40'),(24,1,1,100,8.50,'2018-12-20 16:34:40'),(25,1,1,100,8.50,'2018-12-20 16:34:40'),(26,1,1,100,8.50,'2018-12-20 16:34:40'),(27,1,1,100,8.50,'2018-12-20 16:34:40'),(28,1,1,100,8.50,'2018-12-20 16:34:40'),(29,1,1,100,8.50,'2018-12-20 16:34:40'),(30,1,1,100,8.50,'2018-12-20 16:34:40'),(31,1,3,100,8.50,'2019-01-20 16:34:40'),(32,1,4,100,8.50,'2019-01-20 16:34:40'),(33,1,5,100,8.50,'2019-01-20 16:34:40'),(34,1,7,100,8.50,'2019-01-20 16:34:40'),(35,1,7,100,8.50,'2019-01-20 16:34:40'),(36,1,2,100,8.50,'2019-01-20 16:34:40'),(37,1,1,100,8.50,'2019-01-20 16:34:40'),(38,1,5,100,8.50,'2019-01-20 16:34:40'),(39,1,1,100,8.50,'2019-01-20 16:34:40');
/*!40000 ALTER TABLE `gerencial_compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gerencial_detalle_orden`
--

DROP TABLE IF EXISTS `gerencial_detalle_orden`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gerencial_detalle_orden` (
  `id` int(10) unsigned NOT NULL,
  `orden_id` int(10) unsigned NOT NULL COMMENT 'referencia a la orden a la que pertenece',
  `producto_id` int(10) unsigned NOT NULL COMMENT 'id del producto que está en la orden',
  `cantidad_producto` int(11) NOT NULL COMMENT 'cantidad comprada',
  `total_parcial` decimal(8,2) NOT NULL COMMENT 'total parcial por detalle de la orden',
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `gerencial_detalle_orden_orden_id_foreign` (`orden_id`),
  KEY `gerencial_detalle_orden_producto_id_foreign` (`producto_id`),
  CONSTRAINT `gerencial_detalle_orden_orden_id_foreign` FOREIGN KEY (`orden_id`) REFERENCES `gerencial_orden` (`id`) ON DELETE CASCADE,
  CONSTRAINT `gerencial_detalle_orden_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `gerencial_producto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gerencial_detalle_orden`
--

LOCK TABLES `gerencial_detalle_orden` WRITE;
/*!40000 ALTER TABLE `gerencial_detalle_orden` DISABLE KEYS */;
INSERT INTO `gerencial_detalle_orden` VALUES (1,87,3,4,4.00,'2018-11-20 11:23:36'),(2,17,30,8,24.00,'2018-09-25 22:28:45'),(3,38,17,8,24.00,'2019-02-14 22:29:47'),(4,59,40,10,36.00,'2019-05-05 22:37:17'),(5,55,18,6,18.00,'2019-02-27 11:00:39'),(6,50,30,2,6.00,'2018-09-12 18:06:12'),(7,31,10,9,27.00,'2019-04-03 08:34:41'),(8,83,24,10,25.00,'2019-05-03 17:35:35'),(9,38,4,10,32.50,'2019-02-14 22:29:47'),(10,81,47,4,10.00,'2018-09-18 15:06:58'),(11,81,25,6,17.94,'2018-09-18 15:06:58'),(12,67,46,2,7.00,'2018-08-26 13:45:03'),(15,65,19,9,27.00,'2019-03-13 15:16:30'),(16,91,10,7,25.20,'2018-10-16 02:54:11'),(17,41,48,5,12.50,'2019-03-16 05:34:20'),(18,7,26,8,24.00,'2018-10-15 16:25:11'),(19,82,33,3,7.50,'2018-10-21 11:35:55'),(20,49,44,10,30.00,'2019-01-01 23:57:07'),(21,30,10,3,9.00,'2019-01-30 06:17:56'),(22,9,3,1,3.00,'2019-05-05 23:21:37'),(23,54,23,4,14.00,'2019-04-04 22:32:53'),(24,27,49,1,3.00,'2019-04-02 12:41:35'),(25,39,45,4,12.00,'2018-12-12 07:48:06'),(26,60,42,8,8.00,'2019-04-19 12:26:53'),(27,51,38,8,24.00,'2018-09-04 00:20:23'),(28,15,28,5,15.00,'2019-05-07 13:13:41'),(29,9,46,9,27.00,'2019-05-05 23:21:37'),(30,87,25,7,24.50,'2018-11-20 11:23:36'),(31,53,6,6,18.00,'2018-10-11 21:13:49'),(32,22,9,5,15.00,'2018-10-30 03:55:37'),(33,20,51,7,21.00,'2019-04-24 15:46:57'),(34,29,46,7,7.00,'2019-01-27 09:18:14'),(35,38,40,7,21.00,'2019-02-14 22:29:47'),(36,98,10,10,30.00,'2019-04-25 11:30:15'),(37,25,29,9,27.00,'2018-12-19 14:55:53'),(38,61,37,9,27.00,'2018-10-22 21:12:39'),(39,87,50,5,15.00,'2018-11-20 11:23:36'),(40,27,16,6,9.00,'2019-04-02 12:41:35'),(41,73,18,5,12.50,'2018-12-22 05:02:58'),(42,97,42,5,15.00,'2018-08-12 09:53:08'),(43,91,23,5,7.50,'2018-10-16 02:54:11'),(44,9,7,4,14.00,'2019-05-05 23:21:37'),(45,69,45,6,18.00,'2018-12-30 14:55:03'),(46,32,24,4,6.00,'2018-09-03 09:04:54'),(47,29,45,10,30.00,'2019-01-27 09:18:14'),(48,86,47,5,17.50,'2018-09-28 00:38:16'),(49,94,7,6,18.00,'2018-11-21 08:55:07'),(50,34,21,2,6.00,'2019-04-10 07:15:36'),(51,51,7,4,12.00,'2018-09-04 00:20:23'),(52,62,36,7,10.50,'2018-08-19 17:55:01'),(53,34,8,7,21.00,'2019-04-10 07:15:36'),(54,43,13,7,23.45,'2018-09-30 23:20:19'),(55,28,40,3,9.00,'2018-08-13 15:39:46'),(56,33,12,9,90.00,'2019-04-20 16:53:15'),(57,70,25,6,21.00,'2018-11-24 17:42:42'),(58,49,34,6,21.00,'2019-01-01 23:57:07'),(59,35,3,4,10.00,'2019-04-02 05:03:53'),(61,2,3,9,31.50,'2018-09-22 20:31:23'),(62,35,27,1,3.35,'2019-04-02 05:03:53'),(63,24,45,1,3.00,'2019-02-06 03:28:53'),(65,37,22,1,3.00,'2018-10-22 22:45:40'),(66,30,32,3,7.50,'2019-01-30 06:17:56'),(67,55,37,8,12.00,'2019-02-27 11:00:39'),(68,2,7,9,31.50,'2018-09-22 20:31:23'),(69,8,24,3,10.80,'2018-09-30 21:09:13'),(70,23,28,5,15.00,'2018-09-28 18:38:25'),(71,67,37,2,6.00,'2018-08-26 13:45:03'),(72,72,23,9,27.00,'2019-02-22 18:03:59'),(73,43,18,6,18.00,'2018-09-30 23:20:19'),(74,99,12,5,3.75,'2018-09-03 17:04:45'),(75,15,15,3,7.50,'2019-05-07 13:13:41'),(76,31,47,7,23.45,'2019-04-03 08:34:41'),(77,62,17,1,3.00,'2018-08-19 17:55:01'),(78,47,14,7,25.20,'2018-12-13 12:57:02'),(79,61,22,5,7.50,'2018-10-22 21:12:39'),(80,48,37,5,12.50,'2018-11-12 08:22:59'),(81,85,44,9,22.50,'2018-11-25 08:28:12'),(82,22,45,6,9.00,'2018-10-30 03:55:37'),(84,38,21,6,4.50,'2019-02-14 22:29:47'),(85,34,17,10,15.00,'2019-04-10 07:15:36'),(86,48,8,4,4.00,'2018-11-12 08:22:59'),(87,36,14,6,9.00,'2019-03-18 06:09:35'),(88,88,14,4,13.40,'2018-12-14 18:48:34'),(89,2,31,2,6.00,'2018-09-22 20:31:23'),(90,37,15,9,27.00,'2018-10-22 22:45:40'),(91,45,47,1,0.75,'2018-12-31 07:30:24'),(92,8,21,10,30.00,'2018-09-30 21:09:13'),(94,21,28,4,12.00,'2018-09-19 04:37:22'),(96,50,9,10,30.00,'2018-09-12 18:06:12'),(97,53,28,8,12.00,'2018-10-11 21:13:49'),(98,13,51,1,3.00,'2018-10-06 18:16:13'),(99,22,37,7,21.00,'2018-10-30 03:55:37'),(100,100,43,6,4.50,'2019-03-14 04:53:06'),(101,76,10,8,24.00,'2018-09-16 04:44:09'),(102,65,43,4,12.00,'2019-03-13 15:16:30'),(103,77,37,6,18.00,'2018-11-17 20:08:36'),(104,88,51,1,3.00,'2018-12-14 18:48:34'),(105,34,3,8,80.00,'2019-04-10 07:15:36'),(106,51,23,6,15.00,'2018-09-04 00:20:23'),(107,19,37,4,12.00,'2018-09-15 22:50:00'),(108,65,22,5,15.00,'2019-03-13 15:16:30'),(110,18,51,3,10.50,'2018-08-17 17:56:36'),(111,47,41,6,20.10,'2018-12-13 12:57:02'),(112,25,3,4,12.00,'2018-12-19 14:55:53'),(113,47,37,5,15.00,'2018-12-13 12:57:02'),(114,2,12,8,24.00,'2018-09-22 20:31:23'),(115,18,48,10,30.00,'2018-08-17 17:56:36'),(116,63,6,8,24.00,'2018-12-07 04:33:43'),(117,14,38,7,21.00,'2019-01-27 17:05:47'),(118,9,29,10,30.00,'2019-05-05 23:21:37'),(119,47,17,9,27.00,'2018-12-13 12:57:02'),(120,7,36,1,3.50,'2018-10-15 16:25:11'),(121,52,36,1,3.35,'2018-12-27 05:12:41'),(122,63,23,7,21.00,'2018-12-07 04:33:43'),(123,7,28,9,27.00,'2018-10-15 16:25:11'),(124,95,27,1,3.00,'2019-03-09 01:13:11'),(125,72,2,2,6.00,'2019-02-22 18:03:59'),(126,15,50,7,21.00,'2019-05-07 13:13:41'),(127,43,18,1,3.00,'2018-09-30 23:20:19'),(128,53,48,4,12.00,'2018-10-11 21:13:49'),(129,26,29,8,20.00,'2019-04-22 22:09:09'),(130,2,9,2,6.00,'2018-09-22 20:31:23'),(131,31,30,4,12.00,'2019-04-03 08:34:41'),(132,90,22,6,18.00,'2018-08-20 03:12:26'),(133,83,33,6,15.00,'2019-05-03 17:35:35'),(134,52,49,6,21.00,'2018-12-27 05:12:41'),(136,46,28,6,18.00,'2019-04-30 19:17:45'),(137,36,34,8,28.00,'2019-03-18 06:09:35'),(138,88,10,2,5.00,'2018-12-14 18:48:34'),(139,6,13,8,28.00,'2019-01-05 08:49:28'),(140,81,50,10,30.00,'2018-09-18 15:06:58'),(141,43,1,8,24.00,'2018-09-30 23:20:19'),(142,94,7,9,13.50,'2018-11-21 08:55:07'),(143,46,14,7,21.00,'2019-04-30 19:17:45'),(144,41,14,5,14.95,'2019-03-16 05:34:20'),(145,85,5,10,30.00,'2018-11-25 08:28:12'),(146,57,28,4,12.00,'2018-10-06 09:20:33'),(147,82,7,5,15.00,'2018-10-21 11:35:55'),(148,42,21,6,60.00,'2019-03-23 06:47:52'),(149,63,18,9,22.50,'2018-12-07 04:33:43'),(150,45,14,3,4.50,'2018-12-31 07:30:24');
/*!40000 ALTER TABLE `gerencial_detalle_orden` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gerencial_lote`
--

DROP TABLE IF EXISTS `gerencial_lote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gerencial_lote` (
  `id` int(10) unsigned NOT NULL,
  `producto_id` int(10) unsigned NOT NULL COMMENT 'id del producto que contiene el lote',
  `total` decimal(8,2) NOT NULL COMMENT 'valor del lote del producto',
  `proveedor_id` int(10) unsigned DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `gerencial_lote_producto_id_foreign` (`producto_id`),
  KEY `gerencial_lote_proveedor_id_foreign` (`proveedor_id`),
  CONSTRAINT `gerencial_lote_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `gerencial_producto` (`id`),
  CONSTRAINT `gerencial_lote_proveedor_id_foreign` FOREIGN KEY (`proveedor_id`) REFERENCES `gerencial_proveedor` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gerencial_lote`
--

LOCK TABLES `gerencial_lote` WRITE;
/*!40000 ALTER TABLE `gerencial_lote` DISABLE KEYS */;
INSERT INTO `gerencial_lote` VALUES (1,46,7.50,1,'2018-10-11 01:22:05'),(2,31,7.50,1,'2019-02-12 17:49:29'),(3,45,7.50,1,'2019-02-25 01:43:07'),(4,29,7.50,1,'2019-03-30 05:09:35'),(5,34,7.50,1,'2018-11-24 10:36:33'),(6,1,7.50,1,'2018-09-05 01:04:26'),(7,21,7.50,1,'2018-09-02 16:35:24'),(8,33,7.50,1,'2018-12-01 23:37:32'),(9,37,7.50,1,'2018-11-07 21:25:45'),(10,13,7.50,1,'2018-09-08 06:52:42'),(11,12,7.50,1,'2018-12-07 06:53:59'),(12,32,7.50,1,'2019-03-10 05:52:44'),(13,11,7.50,1,'2019-01-13 05:07:05'),(14,46,7.50,1,'2019-01-15 10:59:31'),(15,14,7.50,1,'2019-01-25 12:23:26'),(16,9,7.50,1,'2018-09-24 13:33:49'),(17,30,7.50,1,'2018-08-30 04:50:52'),(18,32,7.50,1,'2019-01-24 02:28:46'),(19,17,7.50,1,'2018-09-11 06:36:46'),(20,15,7.50,1,'2019-05-02 22:01:24'),(21,27,7.50,1,'2018-11-17 14:17:57'),(22,28,7.50,1,'2018-11-23 10:45:55'),(23,6,7.50,1,'2018-10-13 23:22:54'),(24,42,7.50,1,'2018-10-04 12:55:14'),(25,2,7.50,1,'2019-04-16 14:32:24'),(26,37,7.50,1,'2019-02-27 14:08:03'),(27,7,7.50,1,'2019-03-07 18:06:03'),(28,27,7.50,1,'2018-11-24 14:55:08'),(29,17,7.50,1,'2019-04-14 22:30:06'),(30,51,7.50,1,'2018-08-12 19:25:08'),(31,35,7.50,1,'2019-02-05 22:46:32'),(32,27,7.50,1,'2019-01-12 13:55:36'),(33,21,7.50,1,'2018-12-13 09:52:46'),(34,15,7.50,1,'2018-12-27 20:18:16'),(35,51,7.50,1,'2018-11-07 19:40:27'),(36,37,7.50,1,'2018-11-03 01:31:16'),(37,33,7.50,1,'2018-12-20 06:38:04'),(38,29,7.50,1,'2018-10-19 16:07:47'),(39,27,7.50,1,'2018-10-27 05:05:31'),(40,11,7.50,1,'2019-02-02 13:17:53'),(41,20,7.50,1,'2019-03-03 07:23:10'),(42,48,7.50,1,'2018-11-18 06:04:06'),(43,45,7.50,1,'2018-08-14 07:24:35'),(44,18,7.50,1,'2019-03-09 20:15:34'),(45,30,7.50,1,'2018-11-02 10:00:23'),(46,1,7.50,1,'2019-03-01 23:42:14'),(47,32,7.50,1,'2019-03-22 01:18:15'),(48,49,7.50,1,'2019-03-22 23:49:08'),(49,32,7.50,1,'2019-03-03 14:50:07'),(50,3,7.50,1,'2018-09-18 16:15:06'),(51,15,7.50,1,'2019-03-23 20:21:16'),(52,39,7.50,1,'2018-11-05 06:20:48'),(53,40,7.50,1,'2019-02-01 04:24:42'),(54,26,7.50,1,'2018-09-19 23:29:46'),(55,10,7.50,1,'2019-04-05 10:16:56'),(56,8,7.50,1,'2018-11-04 15:29:27'),(57,36,7.50,1,'2018-12-19 17:06:01'),(58,50,7.50,1,'2018-11-10 19:00:05'),(59,47,7.50,1,'2018-12-18 04:10:01'),(60,39,7.50,1,'2019-02-16 11:31:55'),(61,40,7.50,1,'2019-02-04 20:00:11'),(62,10,7.50,1,'2018-11-29 06:28:13'),(63,2,7.50,1,'2019-02-20 14:32:38'),(64,44,7.50,1,'2018-10-29 15:39:09'),(65,16,7.50,1,'2018-08-26 02:08:23'),(66,31,7.50,1,'2018-10-29 06:42:02'),(67,34,7.50,1,'2018-08-17 13:04:02'),(68,1,7.50,1,'2018-09-10 00:02:30'),(69,15,7.50,1,'2018-12-02 01:39:11'),(70,17,7.50,1,'2019-01-31 01:47:03'),(71,51,7.50,1,'2019-03-30 18:46:27'),(72,9,7.50,1,'2018-10-26 23:00:25'),(73,51,7.50,1,'2018-12-04 10:25:35'),(74,50,7.50,1,'2019-01-21 21:36:38'),(75,23,7.50,1,'2019-04-07 00:54:37'),(76,50,7.50,1,'2019-01-06 20:58:36'),(77,48,7.50,1,'2018-10-27 14:00:38'),(78,11,7.50,1,'2018-10-04 04:41:50'),(79,17,7.50,1,'2019-03-04 02:08:29'),(80,10,7.50,1,'2018-11-19 01:35:59'),(81,14,7.50,1,'2019-05-04 11:14:56'),(82,3,7.50,1,'2018-12-16 23:36:45'),(83,31,7.50,1,'2018-08-20 05:15:58'),(84,6,7.50,1,'2019-02-05 20:24:53'),(85,13,7.50,1,'2018-08-16 14:47:23'),(86,31,7.50,1,'2019-04-26 05:20:16'),(87,19,7.50,1,'2019-04-21 07:05:24'),(88,17,7.50,1,'2019-02-10 01:06:24'),(89,34,7.50,1,'2018-12-08 10:04:37'),(90,29,7.50,1,'2019-01-23 16:27:26'),(91,44,7.50,1,'2019-01-10 13:30:32'),(92,30,7.50,1,'2018-10-23 12:14:36'),(93,27,7.50,1,'2018-12-30 02:05:22'),(94,51,7.50,1,'2019-02-17 23:17:45'),(95,12,7.50,1,'2018-11-23 19:42:25'),(96,14,7.50,1,'2018-09-23 11:30:48'),(97,20,7.50,1,'2019-02-05 02:40:30'),(98,44,7.50,1,'2018-11-23 18:23:12'),(99,10,7.50,1,'2019-01-19 12:57:12'),(100,49,7.50,1,'2019-04-16 09:48:28');
/*!40000 ALTER TABLE `gerencial_lote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gerencial_materia_prima`
--

DROP TABLE IF EXISTS `gerencial_materia_prima`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gerencial_materia_prima` (
  `id` int(10) unsigned NOT NULL,
  `nombre_materia` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'nombre de la materia prima',
  `cantidad` int(11) NOT NULL COMMENT 'cantidad actual de materia prima',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gerencial_materia_prima`
--

LOCK TABLES `gerencial_materia_prima` WRITE;
/*!40000 ALTER TABLE `gerencial_materia_prima` DISABLE KEYS */;
INSERT INTO `gerencial_materia_prima` VALUES (1,'harina',100),(2,'masa',100),(3,'queso',100),(4,'leche',100),(5,'huevos',100);
/*!40000 ALTER TABLE `gerencial_materia_prima` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gerencial_orden`
--

DROP TABLE IF EXISTS `gerencial_orden`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gerencial_orden` (
  `id` int(10) unsigned NOT NULL COMMENT 'id de las ordenes, vienen registradas desde sistema transaccional',
  `tipo_orden` enum('LOCAL','EN LINEA') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Donde se registró la compra, si en la tienda en linea o local',
  `user_id` int(10) unsigned NOT NULL COMMENT 'referencia al usuario registrado en el sistema transaccional',
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `gerencial_orden_user_id_foreign` (`user_id`),
  CONSTRAINT `gerencial_orden_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `gerencial_usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gerencial_orden`
--

LOCK TABLES `gerencial_orden` WRITE;
/*!40000 ALTER TABLE `gerencial_orden` DISABLE KEYS */;
INSERT INTO `gerencial_orden` VALUES (2,'LOCAL',12,'2018-09-22 20:31:23'),(6,'LOCAL',9,'2019-01-05 08:49:28'),(7,'EN LINEA',5,'2018-10-15 16:25:11'),(8,'EN LINEA',12,'2018-09-30 21:09:13'),(9,'LOCAL',9,'2019-05-05 23:21:37'),(13,'EN LINEA',15,'2018-10-06 18:16:13'),(14,'EN LINEA',15,'2019-01-27 17:05:47'),(15,'EN LINEA',16,'2019-05-07 13:13:41'),(17,'EN LINEA',9,'2018-09-25 22:28:45'),(18,'EN LINEA',3,'2018-08-17 17:56:36'),(19,'EN LINEA',11,'2018-09-15 22:50:00'),(20,'EN LINEA',6,'2019-04-24 15:46:57'),(21,'LOCAL',7,'2018-09-19 04:37:22'),(22,'EN LINEA',14,'2018-10-30 03:55:37'),(23,'EN LINEA',3,'2018-09-28 18:38:25'),(24,'EN LINEA',12,'2019-02-06 03:28:53'),(25,'EN LINEA',4,'2018-12-19 14:55:53'),(26,'EN LINEA',5,'2019-04-22 22:09:09'),(27,'EN LINEA',1,'2019-04-02 12:41:35'),(28,'LOCAL',1,'2018-08-13 15:39:46'),(29,'EN LINEA',16,'2019-01-27 09:18:14'),(30,'EN LINEA',4,'2019-01-30 06:17:56'),(31,'EN LINEA',3,'2019-04-03 08:34:41'),(32,'EN LINEA',8,'2018-09-03 09:04:54'),(33,'EN LINEA',4,'2019-04-20 16:53:15'),(34,'LOCAL',16,'2019-04-10 07:15:36'),(35,'LOCAL',16,'2019-04-02 05:03:53'),(36,'EN LINEA',5,'2019-03-18 06:09:35'),(37,'LOCAL',14,'2018-10-22 22:45:40'),(38,'LOCAL',1,'2019-02-14 22:29:47'),(39,'EN LINEA',7,'2018-12-12 07:48:06'),(41,'EN LINEA',8,'2019-03-16 05:34:20'),(42,'EN LINEA',2,'2019-03-23 06:47:52'),(43,'EN LINEA',5,'2018-09-30 23:20:19'),(45,'EN LINEA',14,'2018-12-31 07:30:24'),(46,'LOCAL',12,'2019-04-30 19:17:45'),(47,'EN LINEA',7,'2018-12-13 12:57:02'),(48,'LOCAL',5,'2018-11-12 08:22:59'),(49,'LOCAL',11,'2019-01-01 23:57:07'),(50,'EN LINEA',15,'2018-09-12 18:06:12'),(51,'LOCAL',4,'2018-09-04 00:20:23'),(52,'LOCAL',11,'2018-12-27 05:12:41'),(53,'LOCAL',6,'2018-10-11 21:13:49'),(54,'LOCAL',16,'2019-04-04 22:32:53'),(55,'LOCAL',7,'2019-02-27 11:00:39'),(57,'LOCAL',4,'2018-10-06 09:20:33'),(59,'EN LINEA',6,'2019-05-05 22:37:17'),(60,'EN LINEA',8,'2019-04-19 12:26:53'),(61,'LOCAL',10,'2018-10-22 21:12:39'),(62,'LOCAL',3,'2018-08-19 17:55:01'),(63,'LOCAL',8,'2018-12-07 04:33:43'),(65,'LOCAL',14,'2019-03-13 15:16:30'),(67,'LOCAL',11,'2018-08-26 13:45:03'),(69,'EN LINEA',5,'2018-12-30 14:55:03'),(70,'LOCAL',11,'2018-11-24 17:42:42'),(72,'EN LINEA',5,'2019-02-22 18:03:59'),(73,'EN LINEA',5,'2018-12-22 05:02:58'),(76,'EN LINEA',7,'2018-09-16 04:44:09'),(77,'LOCAL',10,'2018-11-17 20:08:36'),(81,'LOCAL',13,'2018-09-18 15:06:58'),(82,'LOCAL',16,'2018-10-21 11:35:55'),(83,'EN LINEA',1,'2019-05-03 17:35:35'),(85,'LOCAL',14,'2018-11-25 08:28:12'),(86,'LOCAL',4,'2018-09-28 00:38:16'),(87,'EN LINEA',6,'2018-11-20 11:23:36'),(88,'EN LINEA',13,'2018-12-14 18:48:34'),(90,'EN LINEA',6,'2018-08-20 03:12:26'),(91,'LOCAL',8,'2018-10-16 02:54:11'),(94,'LOCAL',4,'2018-11-21 08:55:07'),(95,'LOCAL',16,'2019-03-09 01:13:11'),(97,'EN LINEA',6,'2018-08-12 09:53:08'),(98,'EN LINEA',10,'2019-04-25 11:30:15'),(99,'EN LINEA',6,'2018-09-03 17:04:45'),(100,'LOCAL',1,'2019-03-14 04:53:06');
/*!40000 ALTER TABLE `gerencial_orden` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gerencial_pago`
--

DROP TABLE IF EXISTS `gerencial_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gerencial_pago` (
  `id` int(10) unsigned NOT NULL,
  `orden_id` int(10) unsigned NOT NULL COMMENT 'referencia a la orden',
  `tipo_pago` enum('Efectivo','Tarjeta Crédito','PayPal') COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_cancelar` decimal(8,2) NOT NULL,
  `fecha_pago` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'fecha en que se realizó el pago',
  PRIMARY KEY (`id`),
  KEY `gerencial_pago_orden_id_foreign` (`orden_id`),
  CONSTRAINT `gerencial_pago_orden_id_foreign` FOREIGN KEY (`orden_id`) REFERENCES `gerencial_orden` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gerencial_pago`
--

LOCK TABLES `gerencial_pago` WRITE;
/*!40000 ALTER TABLE `gerencial_pago` DISABLE KEYS */;
INSERT INTO `gerencial_pago` VALUES (1,24,'Efectivo',3.00,'2019-02-06 03:28:53'),(3,49,'Tarjeta Crédito',51.00,'2019-01-01 23:57:07'),(4,7,'Efectivo',54.50,'2018-10-15 16:25:11'),(5,53,'Tarjeta Crédito',42.00,'2018-10-11 21:13:49'),(6,8,'PayPal',40.80,'2018-09-30 21:09:13'),(7,65,'PayPal',54.00,'2019-03-13 15:16:30'),(9,91,'Efectivo',32.70,'2018-10-16 02:54:11'),(11,25,'Tarjeta Crédito',39.00,'2018-12-19 14:55:53'),(12,43,'PayPal',68.45,'2018-09-30 23:20:19'),(13,42,'Tarjeta Crédito',60.00,'2019-03-23 06:47:52'),(14,17,'Tarjeta Crédito',24.00,'2018-09-25 22:28:45'),(15,41,'Efectivo',27.45,'2019-03-16 05:34:20'),(16,73,'PayPal',12.50,'2018-12-22 05:02:58'),(17,85,'PayPal',52.50,'2018-11-25 08:28:12'),(20,82,'Efectivo',22.50,'2018-10-21 11:35:55'),(21,15,'Tarjeta Crédito',43.50,'2019-05-07 13:13:41'),(24,83,'PayPal',40.00,'2019-05-03 17:35:35'),(25,54,'Efectivo',14.00,'2019-04-04 22:32:53'),(28,38,'PayPal',82.00,'2019-02-14 22:29:47'),(29,35,'Efectivo',13.35,'2019-04-02 05:03:53'),(32,20,'Efectivo',21.00,'2019-04-24 15:46:57'),(33,48,'PayPal',16.50,'2018-11-12 08:22:59'),(34,100,'Tarjeta Crédito',4.50,'2019-03-14 04:53:06'),(35,22,'Tarjeta Crédito',45.00,'2018-10-30 03:55:37'),(36,36,'PayPal',37.00,'2019-03-18 06:09:35'),(37,59,'PayPal',36.00,'2019-05-05 22:37:17'),(40,34,'Tarjeta Crédito',122.00,'2019-04-10 07:15:36'),(41,37,'PayPal',30.00,'2018-10-22 22:45:40'),(42,45,'PayPal',5.25,'2018-12-31 07:30:24'),(43,69,'Efectivo',18.00,'2018-12-30 14:55:03'),(44,47,'Tarjeta Crédito',87.30,'2018-12-13 12:57:02'),(45,97,'Tarjeta Crédito',15.00,'2018-08-12 09:53:08'),(46,33,'Tarjeta Crédito',90.00,'2019-04-20 16:53:15'),(47,81,'Efectivo',57.94,'2018-09-18 15:06:58'),(50,57,'PayPal',12.00,'2018-10-06 09:20:33'),(51,13,'PayPal',3.00,'2018-10-06 18:16:13'),(52,39,'Efectivo',12.00,'2018-12-12 07:48:06'),(53,52,'Efectivo',24.35,'2018-12-27 05:12:41'),(54,76,'PayPal',24.00,'2018-09-16 04:44:09'),(55,31,'PayPal',62.45,'2019-04-03 08:34:41'),(56,60,'Tarjeta Crédito',8.00,'2019-04-19 12:26:53'),(58,95,'Tarjeta Crédito',3.00,'2019-03-09 01:13:11'),(59,94,'PayPal',31.50,'2018-11-21 08:55:07'),(61,90,'PayPal',18.00,'2018-08-20 03:12:26'),(62,21,'PayPal',12.00,'2018-09-19 04:37:22'),(63,51,'Tarjeta Crédito',51.00,'2018-09-04 00:20:23'),(64,88,'Tarjeta Crédito',21.40,'2018-12-14 18:48:34'),(65,2,'Efectivo',99.00,'2018-09-22 20:31:23'),(66,23,'Efectivo',15.00,'2018-09-28 18:38:25'),(67,62,'Tarjeta Crédito',13.50,'2018-08-19 17:55:01'),(68,70,'PayPal',21.00,'2018-11-24 17:42:42'),(69,18,'Tarjeta Crédito',40.50,'2018-08-17 17:56:36'),(70,72,'Tarjeta Crédito',33.00,'2019-02-22 18:03:59'),(71,32,'PayPal',6.00,'2018-09-03 09:04:54'),(72,19,'Tarjeta Crédito',12.00,'2018-09-15 22:50:00'),(73,63,'Efectivo',67.50,'2018-12-07 04:33:43'),(74,67,'PayPal',13.00,'2018-08-26 13:45:03'),(76,61,'Efectivo',34.50,'2018-10-22 21:12:39'),(77,29,'Efectivo',37.00,'2019-01-27 09:18:14'),(79,77,'Efectivo',18.00,'2018-11-17 20:08:36'),(80,27,'Efectivo',12.00,'2019-04-02 12:41:35'),(81,46,'Tarjeta Crédito',39.00,'2019-04-30 19:17:45'),(82,28,'PayPal',9.00,'2018-08-13 15:39:46'),(83,86,'Tarjeta Crédito',17.50,'2018-09-28 00:38:16'),(86,50,'Efectivo',36.00,'2018-09-12 18:06:12'),(88,26,'Tarjeta Crédito',20.00,'2019-04-22 22:09:09'),(92,9,'PayPal',74.00,'2019-05-05 23:21:37'),(93,30,'Tarjeta Crédito',16.50,'2019-01-30 06:17:56'),(94,55,'Efectivo',30.00,'2019-02-27 11:00:39'),(96,14,'PayPal',21.00,'2019-01-27 17:05:47'),(97,98,'PayPal',30.00,'2019-04-25 11:30:15'),(98,87,'Efectivo',43.50,'2018-11-20 11:23:36'),(99,99,'PayPal',3.75,'2018-09-03 17:04:45'),(100,6,'Tarjeta Crédito',28.00,'2019-01-05 08:49:28');
/*!40000 ALTER TABLE `gerencial_pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gerencial_producto`
--

DROP TABLE IF EXISTS `gerencial_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gerencial_producto` (
  `id` int(10) unsigned NOT NULL,
  `nombre_producto` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'nombre del producto',
  `categoria_id` int(10) unsigned NOT NULL COMMENT 'categoria a la que pertenece',
  `precio` decimal(8,2) NOT NULL COMMENT 'precio de venta',
  PRIMARY KEY (`id`),
  UNIQUE KEY `gerencial_producto_nombre_producto_unique` (`nombre_producto`),
  KEY `gerencial_producto_categoria_id_foreign` (`categoria_id`),
  CONSTRAINT `gerencial_producto_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `gerencial_categoria` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gerencial_producto`
--

LOCK TABLES `gerencial_producto` WRITE;
/*!40000 ALTER TABLE `gerencial_producto` DISABLE KEYS */;
INSERT INTO `gerencial_producto` VALUES (1,'3 Leches con turrón',7,3.00),(2,'3 Leches de caramelo',7,3.00),(3,'Banana Cream Pie',6,3.00),(4,'Pastel de Fresa',6,3.00),(5,'Pastel de Toffe',6,3.35),(6,'capuccino mousse',10,3.25),(7,'Cardenalito con fresas',6,2.99),(8,'Creme Brulee',5,3.60),(9,'Pie de Manzana',6,3.35),(10,'Flan Cubano',7,3.00),(11,'Fresas con Crema',7,3.00),(12,'Kahlua',9,10.00),(13,'Macadamia Nut Pie',6,3.00),(14,'Mousse de Chocolate',6,3.00),(15,'Cheesecake de Oreo',6,3.00),(16,'Pie de Higo',6,3.00),(17,'Tartaleta de Fresa',5,3.00),(18,'Tartaleta de manzana',5,3.00),(19,'Tartaleta de melocotón',5,3.00),(20,'Tartaleta lemoncello',5,3.00),(21,'Tartaleta tropical',5,3.00),(22,'Tiramisu',7,3.00),(23,'Torta Chilena',7,3.00),(24,'Zebra de caramelo',7,3.00),(25,'Tartaleta de banano',5,3.00),(26,'Tartaleta de limón',5,3.00),(27,'Caramel Latte Frio',9,3.00),(28,'Vainilla latte Frio',9,3.00),(29,'Te frío natural',9,3.00),(30,'Horchata',9,3.00),(31,'Frozen de Horchata',9,3.00),(32,'Coca Cola',9,1.50),(33,'Fanta ',9,1.50),(34,'Tropical Fresa',9,1.50),(35,'Kolashampan',9,1.00),(36,'Jugo de naranja',9,2.50),(37,'Limonada Natural',9,2.50),(38,'Rosa de Jamaica',9,2.50),(39,'Limonada con soda',9,2.50),(40,'Jugo de zanahoria',9,2.50),(41,'Frozen de fresa',9,3.00),(42,'Smoothie Banana-fresa',9,3.00),(43,'Piña colada',9,3.00),(44,'Café Americano',10,3.50),(45,'Café Latte',10,3.50),(46,'Capuccino Moccha',10,3.50),(47,'Capuccino Royal',10,3.50),(48,'Te Caliente',10,3.50),(49,'Vainilla latte',10,3.50),(50,'Pan Francés',4,1.00),(51,'Semita',8,0.75);
/*!40000 ALTER TABLE `gerencial_producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gerencial_proveedor`
--

DROP TABLE IF EXISTS `gerencial_proveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gerencial_proveedor` (
  `id` int(10) unsigned NOT NULL,
  `nombre_proveedor` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'nombre de proveedor relacionado a la empresa',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gerencial_proveedor`
--

LOCK TABLES `gerencial_proveedor` WRITE;
/*!40000 ALTER TABLE `gerencial_proveedor` DISABLE KEYS */;
INSERT INTO `gerencial_proveedor` VALUES (1,'Distribuidora Chavarría'),(2,'Coca Cola Company'),(3,'Casa Ganuza'),(4,'Industrias La constancia'),(5,'Molsa S.A de C.V'),(6,'Distribuidora Finca La Granja '),(7,'Espiga S.A de C.V');
/*!40000 ALTER TABLE `gerencial_proveedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gerencial_usuario`
--

DROP TABLE IF EXISTS `gerencial_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gerencial_usuario` (
  `id` int(10) unsigned NOT NULL COMMENT 'id del usuario registrado en el sistema transaccional',
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `es_cliente` tinyint(1) NOT NULL COMMENT 'identifica si el usuario es un cliente',
  `sexo` enum('M','F') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'M=> Masculino F=> Femenino',
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha en que se registró el usuario',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gerencial_usuario`
--

LOCK TABLES `gerencial_usuario` WRITE;
/*!40000 ALTER TABLE `gerencial_usuario` DISABLE KEYS */;
INSERT INTO `gerencial_usuario` VALUES (1,'admin',0,'M','2019-05-09 18:58:19'),(2,'Lester Prosacco II',1,'M','2019-05-09 18:58:19'),(3,'Mr. Kaleigh Thompson IV',1,'M','2019-05-09 18:58:19'),(4,'Prof. Russel Daugherty',1,'M','2019-05-09 18:58:19'),(5,'Dr. Myron Larson',1,'M','2019-05-09 18:58:19'),(6,'Luciano Steuber',1,'M','2019-05-09 18:58:19'),(7,'Prof. June Barton',1,'M','2019-05-09 18:58:19'),(8,'Brisa Auer V',1,'M','2019-05-09 18:58:19'),(9,'Mrs. Elza Gutkowski',1,'M','2019-05-09 18:58:19'),(10,'Blaze Jacobs',1,'M','2019-05-09 18:58:19'),(11,'Domenico Walsh',1,'M','2019-05-09 18:58:19'),(12,'Maximilian Hayes',1,'M','2019-05-09 18:58:19'),(13,'Cicero Rutherford',1,'M','2019-05-09 18:58:19'),(14,'Arely Gorczany',1,'M','2019-05-09 18:58:19'),(15,'Natalia Emmerich',1,'M','2019-05-09 18:58:19'),(16,'Briana Schmidt',1,'M','2019-05-09 18:58:19');
/*!40000 ALTER TABLE `gerencial_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historial_actividad`
--

DROP TABLE IF EXISTS `historial_actividad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historial_actividad` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL COMMENT 'id del usuario del sistema al que está relacionada la actividad',
  `registro_etl` enum('True','False') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'False' COMMENT 'identifica si la actividad es del sistema ETL (estado True) o de un usuario del sistema gerencial (estado False)',
  `comentario_de_actividad` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Registra la acción que ha realizado el usuario',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `historial_actividad_user_id_foreign` (`user_id`),
  CONSTRAINT `historial_actividad_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial_actividad`
--

LOCK TABLES `historial_actividad` WRITE;
/*!40000 ALTER TABLE `historial_actividad` DISABLE KEYS */;
INSERT INTO `historial_actividad` VALUES (3,NULL,'True','REVISION DE LLAVES DESACTIVADA','2019-05-25 04:50:19',NULL),(4,NULL,'True','LIMPIANDO TABLAS DE LA BD GERENCIAL','2019-05-25 04:50:19',NULL),(5,NULL,'True','REVISION DE LLAVES ACTIVADA','2019-05-25 04:50:22',NULL),(6,NULL,'True','CARGANDO DATOS EN BD GERENCIAL','2019-05-25 04:50:22',NULL),(7,NULL,'True','DATOS CARGADOS EN BD GERENCIAL','2019-05-25 04:50:22',NULL),(11,NULL,'True','REVISION DE LLAVES DESACTIVADA','2019-05-25 04:51:47',NULL),(12,NULL,'True','LIMPIANDO TABLAS DE LA BD GERENCIAL','2019-05-25 04:51:47',NULL),(13,NULL,'True','REVISION DE LLAVES ACTIVADA','2019-05-25 04:51:50',NULL),(14,NULL,'True','CARGANDO DATOS EN BD GERENCIAL','2019-05-25 04:51:51',NULL),(15,NULL,'True','DATOS CARGADOS EN BD GERENCIAL','2019-05-25 04:51:51',NULL),(17,1,'False','Ejecutó el comando de restauración de base de datos, utilizó el respaldo de nombre: backup_panaderia__Sun 05262019_18-41-42.sql','2019-05-27 05:15:10',NULL),(18,1,'False','Accedió a la pantalla de Registrar un nuevo usuario.','2019-06-01 19:32:59',NULL),(19,1,'False','Registró al nuevo usuario de correo: go13005@ues.edu.sv','2019-06-01 19:33:12',NULL),(20,4,'False','Ingresó a la vista de editar contraseña','2019-06-01 20:09:01',NULL),(21,1,'False','Accedió a la pantalla de editar usuario.','2019-06-01 20:09:19',NULL),(22,1,'False','Editó datos al usuario de correo: go13005@ues.edu.sv','2019-06-01 20:09:21',NULL),(23,2,'False','Accedió a la pantalla de Reporte de ventas realizadas en la tienda en linea agrupados por genero.','2019-06-02 02:57:41',NULL),(26,NULL,'True','REVISION DE LLAVES DESACTIVADA','2019-06-06 05:25:42',NULL),(27,NULL,'True','LIMPIANDO TABLAS DE LA BD GERENCIAL','2019-06-06 05:25:42',NULL),(28,NULL,'True','REVISION DE LLAVES ACTIVADA','2019-06-06 05:25:44',NULL),(29,NULL,'True','CARGANDO DATOS EN BD GERENCIAL','2019-06-06 05:25:44',NULL),(30,NULL,'True','DATOS CARGADOS EN BD GERENCIAL','2019-06-06 05:25:45',NULL),(32,1,'False','Entró a la vista de opciones avanzadas','2019-06-06 05:35:11',NULL),(33,1,'False','Realizó un nuevo respaldo de la base de datos','2019-06-06 05:35:13',NULL),(34,1,'False','Entró a la vista de opciones avanzadas','2019-06-06 05:39:48',NULL),(35,1,'False','Realizó un nuevo respaldo de la base de datos','2019-06-06 05:39:50',NULL);
/*!40000 ALTER TABLE `historial_actividad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2015_01_20_084450_create_roles_table',1),(4,'2015_01_20_084525_create_role_user_table',1),(5,'2015_01_24_080208_create_permissions_table',1),(6,'2015_01_24_080433_create_permission_role_table',1),(7,'2015_12_04_003040_add_special_role_column',1),(8,'2017_10_17_170735_create_permission_user_table',1),(9,'2019_04_11_041548_create_gerencial_usuarios_table',1),(10,'2019_04_11_041658_create_gerencial_ordenes_table',1),(11,'2019_04_11_041725_create_gerencial_pagos_table',1),(12,'2019_04_11_041808_create_gerencial_categorias_table',1),(13,'2019_04_11_041809_create_gerencial_productos_table',1),(14,'2019_04_11_041855_create_gerencial_detalle_orden_table',1),(15,'2019_04_11_041856_create_gerencial_materia_prima_table',1),(16,'2019_04_11_041901_create_gerencial_proveedores_table',1),(17,'2019_04_11_041902_create_gerencial_lotes_table',1),(18,'2019_04_11_042025_create_gerencial_compras_table',1),(19,'2019_04_12_023244_create_historial_actividad_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('go13005@ues.edu.sv','$2y$10$dQ2q7PsyEBqEkxgHRDvCju2jJGBbBljcpqDd0xOcHGSJK9tIn6WtS','2019-06-01 19:57:23');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,1,2,NULL,NULL),(2,2,2,NULL,NULL),(3,2,3,NULL,NULL);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_user`
--

DROP TABLE IF EXISTS `permission_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_user_permission_id_index` (`permission_id`),
  KEY `permission_user_user_id_index` (`user_id`),
  CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_user`
--

LOCK TABLES `permission_user` WRITE;
/*!40000 ALTER TABLE `permission_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'Inicio estratégico','home.estrategico','Permiso para ver inicio estratégico','2019-05-25 04:49:51','2019-05-25 04:49:51'),(2,'Inicio táctico','home.tactico','Permiso para ver inicio táctico','2019-05-25 04:49:51','2019-05-25 04:49:51');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_role_id_index` (`role_id`),
  KEY `role_user_user_id_index` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1,1,NULL,NULL),(2,2,2,NULL,NULL),(3,3,3,NULL,NULL),(4,3,4,'2019-06-01 19:33:12','2019-06-01 19:33:12');
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `special` enum('all-access','no-access') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrador','admin','Rol de Administrador','2019-05-25 04:49:51','2019-05-25 04:49:51','all-access'),(2,'Usuario Estrategico','estrategico','Rol de Usuario Estrategico','2019-05-25 04:49:51','2019-05-25 04:49:51',NULL),(3,'Usuario Táctico','tactico','Rol de Usuario Táctico','2019-05-25 04:49:51','2019-05-25 04:49:51',NULL),(4,'Suspendido','suspendido','Sin acceso','2019-05-25 04:49:51','2019-05-25 04:49:51','no-access');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `primer_nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `segundo_nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `primer_apellido` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `segundo_apellido` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrador','Administrador','Administrador','Administrador','panonline503@gmail.com','panaderialila','$2y$10$qR1APTPr1zTFL/iFaUiclOtAdXznfvCG52/rxW6mzbojkJKRnCjOm',1,'ljAWHaOGOzXm2EpjMGmVYas9JrPHi0Ilk2dQugWu5XShQ9k2VwIV2w5lPFe9','2019-05-25 04:49:52','2019-05-25 04:49:52'),(2,'Estrategico','Estrategico','Estrategico','Estrategico','estra@estra.com','estrategico','$2y$10$a9qlQ/A7iEOW8IeYVWFCUeKoVgaqbSM6lkHqEcM280y6uNZKtS4VS',1,'88VxVO8gortAf3QDgo8UvVZh9pLefJKaUwE0o3ur29hvT6Y2ZsH8Vt4yd7jo','2019-05-25 04:49:52','2019-05-25 04:49:52'),(3,'Táctico','Táctico','Táctico','Táctico','tact@tact.com','tactico','$2y$10$D82Lg/ulycGOitn94EChfeA35pqltnTPWodhL9YbD4NV75wlTOco2',1,NULL,'2019-05-25 04:49:52','2019-05-25 04:49:52'),(4,'Alejandro','Stefano','Granados','Orellana','go13005@ues.edu.sv','AleASGO1619','$2y$10$GKHRdFdiyoBozNDm.wa/dejxFdkl19W1vUaSm3LoayWJq5lN2WByS',1,'RBYXTUsqNe8dhAZ6VZdTy0eNHogswN6EsyuZmwFjTcv2cEHCeag7UI4JWUtf','2019-06-01 19:33:12','2019-06-01 20:09:21');
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

-- Dump completed on 2019-06-05 23:39:51
