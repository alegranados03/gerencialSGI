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
) ENGINE=InnoDB AUTO_INCREMENT=263 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial_actividad`
--

LOCK TABLES `historial_actividad` WRITE;
/*!40000 ALTER TABLE `historial_actividad` DISABLE KEYS */;
INSERT INTO `historial_actividad` VALUES (3,NULL,'True','REVISION DE LLAVES DESACTIVADA','2019-05-25 04:50:19',NULL),(4,NULL,'True','LIMPIANDO TABLAS DE LA BD GERENCIAL','2019-05-25 04:50:19',NULL),(5,NULL,'True','REVISION DE LLAVES ACTIVADA','2019-05-25 04:50:22',NULL),(6,NULL,'True','CARGANDO DATOS EN BD GERENCIAL','2019-05-25 04:50:22',NULL),(7,NULL,'True','DATOS CARGADOS EN BD GERENCIAL','2019-05-25 04:50:22',NULL),(11,NULL,'True','REVISION DE LLAVES DESACTIVADA','2019-05-25 04:51:47',NULL),(12,NULL,'True','LIMPIANDO TABLAS DE LA BD GERENCIAL','2019-05-25 04:51:47',NULL),(13,NULL,'True','REVISION DE LLAVES ACTIVADA','2019-05-25 04:51:50',NULL),(14,NULL,'True','CARGANDO DATOS EN BD GERENCIAL','2019-05-25 04:51:51',NULL),(15,NULL,'True','DATOS CARGADOS EN BD GERENCIAL','2019-05-25 04:51:51',NULL),(17,1,'False','Ejecutó el comando de restauración de base de datos, utilizó el respaldo de nombre: backup_panaderia__Sun 05262019_18-41-42.sql','2019-05-27 05:15:10',NULL),(18,1,'False','Accedió a la pantalla de Registrar un nuevo usuario.','2019-06-01 19:32:59',NULL),(19,1,'False','Registró al nuevo usuario de correo: go13005@ues.edu.sv','2019-06-01 19:33:12',NULL),(20,4,'False','Ingresó a la vista de editar contraseña','2019-06-01 20:09:01',NULL),(21,1,'False','Accedió a la pantalla de editar usuario.','2019-06-01 20:09:19',NULL),(22,1,'False','Editó datos al usuario de correo: go13005@ues.edu.sv','2019-06-01 20:09:21',NULL),(23,2,'False','Accedió a la pantalla de Reporte de ventas realizadas en la tienda en linea agrupados por genero.','2019-06-02 02:57:41',NULL),(26,NULL,'True','REVISION DE LLAVES DESACTIVADA','2019-06-06 05:25:42',NULL),(27,NULL,'True','LIMPIANDO TABLAS DE LA BD GERENCIAL','2019-06-06 05:25:42',NULL),(28,NULL,'True','REVISION DE LLAVES ACTIVADA','2019-06-06 05:25:44',NULL),(29,NULL,'True','CARGANDO DATOS EN BD GERENCIAL','2019-06-06 05:25:44',NULL),(30,NULL,'True','DATOS CARGADOS EN BD GERENCIAL','2019-06-06 05:25:45',NULL),(32,1,'False','Entró a la vista de opciones avanzadas','2019-06-06 05:35:11',NULL),(33,1,'False','Realizó un nuevo respaldo de la base de datos','2019-06-06 05:35:13',NULL),(34,1,'False','Entró a la vista de opciones avanzadas','2019-06-06 05:39:48',NULL),(35,1,'False','Realizó un nuevo respaldo de la base de datos','2019-06-06 05:39:50',NULL),(36,2,'False','Accedió a la pantalla de Reporte de Ingresos por venta por producto.','2019-06-07 02:04:38',NULL),(37,2,'False','Solicitó generar un Reporte de Ingresos por venta por producto desde\r\n        2018-06-29 hasta 2019-06-06.','2019-06-07 02:15:42',NULL),(38,1,'False','Accedió a la pantalla de editar usuario.','2019-06-08 01:30:56',NULL),(39,1,'False','Accedió a la pantalla de editar usuario.','2019-06-08 01:31:01',NULL),(40,2,'False','Accedió a la pantalla de Reporte de Ingresos por venta por producto.','2019-06-08 01:44:27',NULL),(41,2,'False','Solicitó generar un Reporte de Ingresos por venta por producto desde\r\n        2018-07-05 hasta 2019-06-06.','2019-06-08 01:44:57',NULL),(42,2,'False','Solicitó generar un Reporte de Ingresos por venta por producto desde\r\n        2018-07-05 hasta 2019-06-06.','2019-06-08 01:45:35',NULL),(43,2,'False','Solicitó generar un Reporte de Ingresos por venta por producto desde\r\n        2018-07-05 hasta 2019-06-06.','2019-06-08 01:45:35',NULL),(44,2,'False','Accedió a la pantalla de Reporte de ventas hechas en local por intervalos de monto.','2019-06-08 01:50:31',NULL),(45,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-11-23 hasta 2019-06-06.','2019-06-08 01:51:35',NULL),(46,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-11-23 hasta 2019-06-06.','2019-06-08 01:51:54',NULL),(47,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-11-23 hasta 2019-06-06.','2019-06-08 01:52:03',NULL),(48,2,'False','Accedió a la pantalla de Reporte de ventas hechas en local por intervalos de monto.','2019-06-08 01:52:16',NULL),(49,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-11-20 hasta 2019-06-06.','2019-06-08 01:52:30',NULL),(50,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-11-20 hasta 2019-06-06.','2019-06-08 01:55:52',NULL),(51,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-11-20 hasta 2019-06-06.','2019-06-08 01:55:58',NULL),(52,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-11-20 hasta 2019-06-06.','2019-06-08 01:56:20',NULL),(53,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-11-20 hasta 2019-06-06.','2019-06-08 02:09:35',NULL),(54,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-11-20 hasta 2019-06-06.','2019-06-08 02:12:15',NULL),(55,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-11-20 hasta 2019-06-06.','2019-06-08 02:12:19',NULL),(56,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-11-20 hasta 2019-06-06.','2019-06-08 02:12:22',NULL),(57,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-11-20 hasta 2019-06-06.','2019-06-08 02:12:23',NULL),(58,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-11-20 hasta 2019-06-06.','2019-06-08 02:12:30',NULL),(59,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-11-20 hasta 2019-06-06.','2019-06-08 02:12:36',NULL),(60,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-11-20 hasta 2019-06-06.','2019-06-08 02:12:49',NULL),(61,2,'False','Accedió a la pantalla de Reporte de ingresos de venta por intervalos de horas.','2019-06-08 02:33:53',NULL),(62,2,'False','Solicitó generar un Reporte de ingresos de venta por intervalos de horas desde\r\n          2018-07-20 hasta 2019-06-06.','2019-06-08 02:34:18',NULL),(63,2,'False','Solicitó generar un Reporte de ingresos de venta por intervalos de horas desde\r\n          2018-07-20 hasta 2019-06-06.','2019-06-08 02:34:26',NULL),(64,2,'False','Solicitó generar un Reporte de ingresos de venta por intervalos de horas desde\r\n          2018-07-20 hasta 2019-06-06.','2019-06-08 02:34:26',NULL),(65,2,'False','Solicitó generar un Reporte de ingresos de venta por intervalos de horas desde\r\n          2018-07-20 hasta 2019-06-06.','2019-06-08 02:34:40',NULL),(66,2,'False','Solicitó generar un Reporte de ingresos de venta por intervalos de horas desde\r\n          2018-07-20 hasta 2019-06-06.','2019-06-08 02:34:56',NULL),(67,2,'False','Solicitó generar un Reporte de ingresos de venta por intervalos de horas desde\r\n          2018-07-20 hasta 2019-06-06.','2019-06-08 02:34:56',NULL),(68,2,'False','Solicitó generar un Reporte de ingresos de venta por intervalos de horas desde\r\n          2018-07-20 hasta 2019-06-06.','2019-06-08 02:34:57',NULL),(69,2,'False','Accedió a la pantalla de Reporte de ingresos de venta por intervalos de horas.','2019-06-08 02:35:11',NULL),(70,2,'False','Solicitó generar un Reporte de ingresos de venta por intervalos de horas desde\r\n          2018-02-05 hasta 2019-06-06.','2019-06-08 02:35:32',NULL),(71,2,'False','Solicitó generar un Reporte de ingresos de venta por intervalos de horas desde\r\n          2018-02-05 hasta 2019-06-06.','2019-06-08 02:38:00',NULL),(72,2,'False','Solicitó generar un Reporte de ingresos de venta por intervalos de horas desde\r\n          2018-02-05 hasta 2019-06-06.','2019-06-08 02:38:08',NULL),(73,2,'False','Accedió a la pantalla de Reporte de ingresos de venta por intervalos de horas.','2019-06-08 02:38:51',NULL),(74,2,'False','Solicitó generar un Reporte de ingresos de venta por intervalos de horas desde\r\n          2018-05-20 hasta 2019-06-06.','2019-06-08 02:39:09',NULL),(75,2,'False','Solicitó generar un Reporte de ingresos de venta por intervalos de horas desde\r\n          2018-05-20 hasta 2019-06-06.','2019-06-08 02:39:10',NULL),(76,2,'False','Solicitó generar un Reporte de ingresos de venta por intervalos de horas desde\r\n          2018-05-20 hasta 2019-06-06.','2019-06-08 02:39:21',NULL),(77,2,'False','Accedió a la pantalla de Reporte de ventas hechas en local por intervalos de monto.','2019-06-08 02:40:04',NULL),(78,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 02:40:27',NULL),(79,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 02:41:06',NULL),(80,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 02:41:06',NULL),(81,2,'False','Accedió a la pantalla de Reporte de ventas hechas en local por intervalos de monto.','2019-06-08 02:41:07',NULL),(82,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-05-05.','2019-06-08 02:41:23',NULL),(83,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-05-05.','2019-06-08 02:41:24',NULL),(84,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-05-05.','2019-06-08 02:41:24',NULL),(85,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-05-05.','2019-06-08 02:41:45',NULL),(86,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-05-05.','2019-06-08 02:42:28',NULL),(87,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-05-05.','2019-06-08 02:43:44',NULL),(88,2,'False','Accedió a la pantalla de Reporte de ventas hechas en local por intervalos de monto.','2019-06-08 02:43:50',NULL),(89,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 02:44:03',NULL),(90,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 02:44:04',NULL),(91,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 02:44:04',NULL),(92,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 02:44:04',NULL),(93,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 02:44:05',NULL),(94,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 02:44:05',NULL),(95,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 02:44:05',NULL),(96,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 02:44:05',NULL),(97,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 02:44:05',NULL),(98,2,'False','Accedió a la pantalla de Reporte de ventas hechas en local por intervalos de monto.','2019-06-08 02:44:19',NULL),(99,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 02:44:30',NULL),(100,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 02:44:32',NULL),(101,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 02:44:33',NULL),(102,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 02:44:36',NULL),(103,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 02:44:37',NULL),(104,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 02:44:37',NULL),(105,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 02:44:37',NULL),(106,2,'False','Accedió a la pantalla de Reporte de ventas hechas en local por intervalos de monto.','2019-06-08 02:44:50',NULL),(107,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 02:44:59',NULL),(108,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 02:45:57',NULL),(109,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 02:45:57',NULL),(110,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 02:45:58',NULL),(111,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 02:45:58',NULL),(112,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 02:45:58',NULL),(113,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 02:46:01',NULL),(114,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 02:46:10',NULL),(115,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 02:47:04',NULL),(116,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 02:47:07',NULL),(117,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 02:48:00',NULL),(118,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 02:48:28',NULL),(119,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 02:49:10',NULL),(120,2,'False','Accedió a la pantalla de Reporte de ingresos de venta por intervalos de horas.','2019-06-08 02:49:37',NULL),(121,2,'False','Solicitó generar un Reporte de ingresos de venta por intervalos de horas desde\r\n          2018-05-05 hasta 2019-06-06.','2019-06-08 02:50:11',NULL),(122,2,'False','Solicitó generar un Reporte de ingresos de venta por intervalos de horas desde\r\n          2018-05-05 hasta 2019-06-06.','2019-06-08 02:50:18',NULL),(123,2,'False','Solicitó generar un Reporte de ingresos de venta por intervalos de horas desde\r\n          2018-05-05 hasta 2019-06-06.','2019-06-08 02:50:26',NULL),(124,2,'False','Accedió a la pantalla de Reporte de costos de adquisicion de materia prima.','2019-06-08 02:52:21',NULL),(125,2,'False','Solicitó generar un Reporte de costos de adquisicion de materia prima desde\r\n         2018-07-05 hasta 2019-06-06.','2019-06-08 02:52:37',NULL),(126,2,'False','Solicitó generar un Reporte de costos de adquisicion de materia prima desde\r\n         2018-07-05 hasta 2019-06-06.','2019-06-08 02:52:43',NULL),(127,2,'False','Solicitó generar un Reporte de costos de adquisicion de materia prima desde\r\n         2018-07-05 hasta 2019-06-06.','2019-06-08 02:52:48',NULL),(128,2,'False','Accedió a la pantalla de Reporte de personas que mas compran en la tienda en linea.','2019-06-08 02:55:02',NULL),(129,2,'False','Solicitó generar un Reporte de personas que mas compran en la tienda en linea desde\r\n                 2018-07-05 hasta 2019-06-06.','2019-06-08 02:55:17',NULL),(130,2,'False','Solicitó generar un Reporte de personas que mas compran en la tienda en linea desde\r\n                 2018-07-05 hasta 2019-06-06.','2019-06-08 02:55:42',NULL),(131,2,'False','Accedió a la pantalla de Reporte de ingresos por venta por categoria.','2019-06-08 03:03:42',NULL),(132,2,'False','Solicitó generar un Reporte de ingresos por venta por categoria desde\r\n        2018-05-05 hasta 2019-06-06.','2019-06-08 03:03:56',NULL),(133,2,'False','Solicitó generar un Reporte de ingresos por venta por categoria desde\r\n        2018-05-05 hasta 2019-06-06.','2019-06-08 03:04:05',NULL),(134,2,'False','Solicitó generar un Reporte de ingresos por venta por categoria desde\r\n        2018-05-05 hasta 2019-06-06.','2019-06-08 03:04:08',NULL),(135,2,'False','Solicitó generar un Reporte de ingresos por venta por categoria desde\r\n        2018-05-05 hasta 2019-06-06.','2019-06-08 03:04:19',NULL),(136,2,'False','Accedió a la pantalla de Reporte de ganancia bruta por categoria.','2019-06-08 03:05:38',NULL),(137,2,'False','Solicitó generar un Reporte de ganancia bruta por categoria desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 03:05:49',NULL),(138,2,'False','Solicitó generar un Reporte de ganancia bruta por categoria desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 03:05:53',NULL),(139,2,'False','Solicitó generar un Reporte de ganancia bruta por categoria desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 03:05:54',NULL),(140,2,'False','Accedió a la pantalla de Reporte de Costos de Materia Prima por Proveedor.','2019-06-08 03:07:56',NULL),(141,2,'False','Solicitó generar un Reporte de Costos de Materia Prima por Proveedor desde\r\n       2018-05-05 hasta 2019-06-06.','2019-06-08 03:08:16',NULL),(142,2,'False','Solicitó generar un Reporte de Costos de Materia Prima por Proveedor desde\r\n       2018-05-05 hasta 2019-06-06.','2019-06-08 03:08:18',NULL),(143,2,'False','Solicitó generar un Reporte de Costos de Materia Prima por Proveedor desde\r\n       2018-05-05 hasta 2019-06-06.','2019-06-08 03:08:18',NULL),(144,2,'False','Solicitó generar un Reporte de Costos de Materia Prima por Proveedor desde\r\n       2018-05-05 hasta 2019-06-06.','2019-06-08 03:08:21',NULL),(145,2,'False','Accedió a la pantalla de Reporte de Preferencia de pago de los clientes.','2019-06-08 03:09:23',NULL),(146,2,'False','Solicitó generar un Reporte de Preferencia de pago de los clientes desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 03:09:51',NULL),(147,2,'False','Solicitó generar un Reporte de Preferencia de pago de los clientes desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 03:09:54',NULL),(148,2,'False','Solicitó generar un Reporte de Preferencia de pago de los clientes desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 03:09:56',NULL),(149,2,'False','Accedió a la pantalla de Reporte de ventas realizadas en la tienda en linea agrupados por genero.','2019-06-08 03:11:50',NULL),(150,2,'False','Solicitó generar un Reporte de ventas realizadas en la tienda en linea agrupados por genero desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 03:12:02',NULL),(151,2,'False','Solicitó generar un Reporte de ventas realizadas en la tienda en linea agrupados por genero desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 03:12:08',NULL),(152,2,'False','Solicitó generar un Reporte de ventas realizadas en la tienda en linea agrupados por genero desde\r\n         2018-05-05 hasta 2019-06-06.','2019-06-08 03:12:12',NULL),(153,2,'False','Accedió a la pantalla de Reporte de ventas hechas en local por intervalos de monto.','2019-06-08 05:08:19',NULL),(154,2,'False','Accedió a la pantalla de Reporte de ingresos de venta por intervalos de horas.','2019-06-08 05:11:32',NULL),(155,2,'False','Accedió a la pantalla de Reporte de costos de adquisicion de materia prima.','2019-06-08 05:13:56',NULL),(156,2,'False','Accedió a la pantalla de Reporte de personas que mas compran en la tienda en linea.','2019-06-08 05:15:40',NULL),(157,2,'False','Accedió a la pantalla de Reporte de ingresos por venta por categoria.','2019-06-08 05:17:57',NULL),(158,2,'False','Accedió a la pantalla de Reporte de ganancia bruta por categoria.','2019-06-08 05:21:28',NULL),(159,2,'False','Accedió a la pantalla de Reporte de Costos de Materia Prima por Proveedor.','2019-06-08 05:22:48',NULL),(160,2,'False','Accedió a la pantalla de Reporte de Preferencia de pago de los clientes.','2019-06-08 05:24:44',NULL),(161,2,'False','Accedió a la pantalla de Reporte de ventas realizadas en la tienda en linea agrupados por genero.','2019-06-08 05:25:32',NULL),(162,2,'False','Accedió a la pantalla de Reporte de ingresos por venta por categoria.','2019-06-08 18:04:49',NULL),(163,2,'False','Solicitó generar un Reporte de ingresos por venta por categoria desde\r\n        2018-08-12 hasta 2019-05-22.','2019-06-08 18:05:18',NULL),(164,2,'False','Solicitó generar un Reporte en pdf de ingresos por venta por categoria desde\r\n        2018-08-12 hasta 2019-05-22.','2019-06-08 18:05:22',NULL),(165,2,'False','Accedió a la pantalla de Reporte de ganancia bruta por categoria.','2019-06-08 18:05:35',NULL),(166,2,'False','Accedió a la pantalla de Reporte de Costos de Materia Prima por Proveedor.','2019-06-08 18:05:36',NULL),(167,2,'False','Accedió a la pantalla de Reporte de Preferencia de pago de los clientes.','2019-06-08 18:05:37',NULL),(168,2,'False','Accedió a la pantalla de Reporte de ventas realizadas en la tienda en linea agrupados por genero.','2019-06-08 18:05:37',NULL),(169,2,'False','Solicitó generar un Reporte de ganancia bruta por categoria desde\r\n         2018-08-12 hasta 2019-05-22.','2019-06-08 18:05:52',NULL),(170,2,'False','Solicitó generar un Reporte en pdf de ganancia bruta por categoria desde\r\n        2018-08-12 hasta 2019-05-22.','2019-06-08 18:05:54',NULL),(171,2,'False','Solicitó generar un Reporte de Costos de Materia Prima por Proveedor desde\r\n       2018-08-12 hasta 2019-05-22.','2019-06-08 18:06:03',NULL),(172,2,'False','Solicitó generar un Reporte en pdf de Ingresos por venta por producto desde\r\n        2018-08-12 hasta 2019-05-22.','2019-06-08 18:06:05',NULL),(173,2,'False','Solicitó generar un Reporte de Preferencia de pago de los clientes desde\r\n         2018-08-12 hasta 2019-05-22.','2019-06-08 18:06:21',NULL),(174,2,'False','Solicitó generar un Reporte en pdf de Preferencia de pago de los clientes desde\r\n          2018-08-12 hasta 2019-05-22.','2019-06-08 18:06:23',NULL),(175,2,'False','Solicitó generar un Reporte de ventas realizadas en la tienda en linea agrupados por genero desde\r\n         2018-08-12 hasta 2019-05-22.','2019-06-08 18:06:36',NULL),(176,2,'False','Solicitó generar un Reporte en pdf de ventas realizadas en la tienda en linea agrupados por genero desde\r\n        2018-08-12 hasta 2019-05-22.','2019-06-08 18:08:19',NULL),(177,2,'False','Solicitó generar un Reporte de ventas realizadas en la tienda en linea agrupados por genero desde\r\n         2018-08-12 hasta 2019-05-22.','2019-06-08 18:08:25',NULL),(178,2,'False','Solicitó generar un Reporte en pdf de ventas realizadas en la tienda en linea agrupados por genero desde\r\n        2018-08-12 hasta 2019-05-22.','2019-06-08 18:08:30',NULL),(179,2,'False','Solicitó generar un archivo de nombre Reporte de ingresos por venta por categoria..xlsx','2019-06-08 18:10:51',NULL),(180,2,'False','Accedió a la pantalla de Reporte de ingresos por venta por categoria.','2019-06-08 18:11:05',NULL),(181,2,'False','Accedió a la pantalla de Reporte de ganancia bruta por categoria.','2019-06-08 18:11:05',NULL),(182,2,'False','Accedió a la pantalla de Reporte de Costos de Materia Prima por Proveedor.','2019-06-08 18:11:06',NULL),(183,2,'False','Accedió a la pantalla de Reporte de Preferencia de pago de los clientes.','2019-06-08 18:11:07',NULL),(184,2,'False','Solicitó generar un Reporte de ingresos por venta por categoria desde\r\n        2018-08-12 hasta 2019-05-22.','2019-06-08 18:11:17',NULL),(185,2,'False','Solicitó generar un Reporte de ganancia bruta por categoria desde\r\n         2018-08-12 hasta 2019-05-22.','2019-06-08 18:11:25',NULL),(186,2,'False','Solicitó generar un Reporte de Costos de Materia Prima por Proveedor desde\r\n       2018-08-12 hasta 2019-05-22.','2019-06-08 18:11:34',NULL),(187,2,'False','Solicitó generar un Reporte de Preferencia de pago de los clientes desde\r\n         2018-08-12 hasta 2019-05-22.','2019-06-08 18:12:07',NULL),(188,2,'False','Solicitó generar un archivo de nombre Reporte de ingresos por venta por categoria..xlsx','2019-06-08 18:12:23',NULL),(189,2,'False','Solicitó generar un archivo de nombre Reporte de ganancia bruta por categoria..xlsx','2019-06-08 18:12:25',NULL),(190,2,'False','Solicitó generar un archivo de nombre Reporte de Costos de Materia Prima por Proveedor..xlsx','2019-06-08 18:12:27',NULL),(191,2,'False','Solicitó generar un archivo de nombre Reporte de Preferencia de pago de los clientes..xlsx','2019-06-08 18:12:29',NULL),(192,2,'False','Solicitó generar un archivo de nombre Reporte de ingresos por venta por categoria..xlsx','2019-06-08 18:13:14',NULL),(193,2,'False','Solicitó generar un archivo de nombre Reporte de ingresos por venta por categoria..xlsx','2019-06-08 18:13:16',NULL),(194,2,'False','Solicitó generar un archivo de nombre Reporte de ganancia bruta por categoria..xlsx','2019-06-08 18:13:18',NULL),(195,2,'False','Solicitó generar un archivo de nombre Reporte de Costos de Materia Prima por Proveedor..xlsx','2019-06-08 18:13:20',NULL),(196,2,'False','Solicitó generar un archivo de nombre Reporte de Preferencia de pago de los clientes..xlsx','2019-06-08 18:13:21',NULL),(197,2,'False','Solicitó generar un archivo de nombre Reporte de ingresos por venta por categoria..xlsx','2019-06-08 18:13:52',NULL),(198,2,'False','Solicitó generar un archivo de nombre Reporte de ingresos por venta por categoria..xlsx','2019-06-08 18:13:56',NULL),(199,2,'False','Accedió a la pantalla de Reporte de ventas realizadas en la tienda en linea agrupados por genero.','2019-06-08 18:14:31',NULL),(200,2,'False','Solicitó generar un Reporte de ventas realizadas en la tienda en linea agrupados por genero desde\r\n         2018-08-12 hasta 2019-05-22.','2019-06-08 18:14:46',NULL),(201,2,'False','Solicitó generar un archivo de nombre Reporte de ventas realizadas en la tienda en línea agrupados por género..xlsx','2019-06-08 18:14:48',NULL),(202,2,'False','Solicitó generar un archivo de nombre Reporte de Costos de Materia Prima por Proveedor..xlsx','2019-06-08 18:15:01',NULL),(203,2,'False','Solicitó generar un archivo de nombre Reporte de Preferencia de pago de los clientes..xlsx','2019-06-08 18:15:04',NULL),(204,2,'False','Solicitó generar un archivo de nombre Reporte de ganancia bruta por categoria..xlsx','2019-06-08 18:15:17',NULL),(205,2,'False','Accedió a la pantalla de Reporte de Ingresos por venta por producto.','2019-06-08 18:24:28',NULL),(206,2,'False','Accedió a la pantalla de Reporte de ventas hechas en local por intervalos de monto.','2019-06-08 18:24:31',NULL),(207,2,'False','Accedió a la pantalla de Reporte de ventas hechas en linea por intervalos de monto.','2019-06-08 18:24:31',NULL),(208,2,'False','Accedió a la pantalla de Reporte de ingresos de venta por intervalos de horas.','2019-06-08 18:24:32',NULL),(209,2,'False','Accedió a la pantalla de Reporte de costos de adquisicion de materia prima.','2019-06-08 18:24:32',NULL),(210,2,'False','Accedió a la pantalla de Reporte de personas que mas compran en la tienda en linea.','2019-06-08 18:24:33',NULL),(211,2,'False','Solicitó generar un Reporte de ventas hechas en local por intervalos de monto desde\r\n         2018-08-12 hasta 2019-05-22.','2019-06-08 18:24:46',NULL),(212,2,'False','Solicitó generar un Reporte de ventas hechas en linea por intervalos de monto desde\r\n        2018-08-12 hasta 2019-05-22.','2019-06-08 18:25:09',NULL),(213,2,'False','Solicitó generar un Reporte de ingresos de venta por intervalos de horas desde\r\n          2018-08-12 hasta 2019-05-22.','2019-06-08 18:25:25',NULL),(214,2,'False','Solicitó generar un Reporte de costos de adquisicion de materia prima desde\r\n         2018-08-12 hasta 2019-05-22.','2019-06-08 18:25:40',NULL),(215,2,'False','Solicitó generar un Reporte de personas que mas compran en la tienda en linea desde\r\n                 2018-08-12 hasta 2019-05-22.','2019-06-08 18:26:18',NULL),(216,2,'False','Solicitó generar un Reporte de Ingresos por venta por producto desde\r\n        2018-08-12 hasta 2019-05-22.','2019-06-08 18:26:35',NULL),(217,2,'False','Solicitó generar un Reporte en pdf de Ingresos por venta por producto desde\r\n        2018-08-12 hasta 2019-05-22.','2019-06-08 18:26:44',NULL),(218,2,'False','Solicitó generar un Reporte en pdf de ventas hechas en linea por intervalos de monto desde\r\n        2018-08-12 hasta 2019-05-22.','2019-06-08 18:26:47',NULL),(219,2,'False','Solicitó generar un Reporte en pdf de ingresos de venta por intervalos de horas desde\r\n        2018-08-12 hasta 2019-05-22.','2019-06-08 18:26:51',NULL),(220,2,'False','Solicitó generar un Reporte en pdf de costos de adquisicion de materia prima desde\r\n          2018-08-12 hasta 2019-05-22.','2019-06-08 18:26:54',NULL),(221,2,'False','Solicitó generar un Reporte en pdf de personas que mas compran en la tienda en linea desde\r\n          2018-08-12 hasta 2019-05-22.','2019-06-08 18:26:56',NULL),(222,2,'False','Solicitó generar un archivo de nombre Reporte de Ingresos por venta por producto..xlsx','2019-06-08 18:26:59',NULL),(223,2,'False','Solicitó generar un archivo de nombre Reporte de ventas hechas en local por intervalos de monto..xlsx','2019-06-08 18:27:04',NULL),(224,2,'False','Solicitó generar un archivo de nombre Reporte de ventas hechas en linea por intervalos de monto..xlsx','2019-06-08 18:27:07',NULL),(225,2,'False','Solicitó generar un archivo de nombre Reporte de ingresos de venta por intervalos de horas..xlsx','2019-06-08 18:27:49',NULL),(226,2,'False','Solicitó generar un archivo de nombre Reporte de costos de adquisición de materia prima..xlsx','2019-06-08 18:27:52',NULL),(227,2,'False','Solicitó generar un archivo de nombre Reporte de personas que mas compran en la tienda en linea..xlsx','2019-06-08 18:27:56',NULL),(228,2,'False','Solicitó generar un Reporte en pdf de ventas hechas en linea por intervalos de monto desde\r\n                 2018-08-12 hasta 2019-05-22.','2019-06-08 18:30:07',NULL),(229,2,'False','Accedió a la pantalla de Reporte de Ingresos por venta por producto.','2019-06-08 18:45:14',NULL),(230,2,'False','Accedió a la pantalla de Reporte de ventas hechas en local por intervalos de monto.','2019-06-08 18:45:15',NULL),(231,2,'False','Accedió a la pantalla de Reporte de ventas hechas en linea por intervalos de monto.','2019-06-08 18:45:15',NULL),(232,2,'False','Accedió a la pantalla de Reporte de ingresos de venta por intervalos de horas.','2019-06-08 18:45:17',NULL),(233,2,'False','Accedió a la pantalla de Reporte de costos de adquisicion de materia prima.','2019-06-08 18:45:17',NULL),(234,2,'False','Accedió a la pantalla de Reporte de personas que mas compran en la tienda en linea.','2019-06-08 18:45:18',NULL),(235,2,'False','Accedió a la pantalla de Reporte de ingresos por venta por categoria.','2019-06-08 18:46:06',NULL),(236,2,'False','Accedió a la pantalla de Reporte de ganancia bruta por categoria.','2019-06-08 18:46:10',NULL),(237,2,'False','Accedió a la pantalla de Reporte de Costos de Materia Prima por Proveedor.','2019-06-08 18:46:11',NULL),(238,2,'False','Accedió a la pantalla de Reporte de Preferencia de pago de los clientes.','2019-06-08 18:46:11',NULL),(239,2,'False','Accedió a la pantalla de Reporte de ventas realizadas en la tienda en linea agrupados por genero.','2019-06-08 18:46:12',NULL),(240,2,'False','Accedió a la pantalla de Reporte de ventas hechas en local por intervalos de monto.','2019-06-09 18:01:25',NULL),(241,2,'False','Accedió a la pantalla de Reporte de ingresos de venta por intervalos de horas.','2019-06-09 18:13:06',NULL),(242,2,'False','Accedió a la pantalla de Reporte de ventas realizadas en la tienda en linea agrupados por genero.','2019-06-09 18:40:49',NULL),(243,2,'False','Accedió a la pantalla de Reporte de personas que mas compran en la tienda en linea.','2019-06-09 18:40:54',NULL),(244,2,'False','Solicitó generar un Reporte de personas que mas compran en la tienda en linea desde\r\n                 2018-08-10 hasta 2019-06-05.','2019-06-09 18:41:08',NULL),(245,2,'False','Solicitó generar un Reporte de personas que mas compran en la tienda en linea desde\r\n                 2018-08-10 hasta 2019-06-05.','2019-06-09 18:41:13',NULL),(246,2,'False','Solicitó generar un Reporte de personas que mas compran en la tienda en linea desde\r\n                 2018-08-10 hasta 2019-06-05.','2019-06-09 18:41:16',NULL),(247,2,'False','Solicitó generar un Reporte de personas que mas compran en la tienda en linea desde\r\n                 2018-08-10 hasta 2019-06-05.','2019-06-09 18:41:22',NULL),(248,2,'False','Solicitó generar un Reporte de personas que mas compran en la tienda en linea desde\r\n                 2018-08-10 hasta 2019-06-05.','2019-06-09 18:41:27',NULL),(249,2,'False','Solicitó generar un Reporte de personas que mas compran en la tienda en linea desde\r\n                 2018-08-10 hasta 2019-06-05.','2019-06-09 18:41:28',NULL),(250,2,'False','Solicitó generar un Reporte de personas que mas compran en la tienda en linea desde\r\n                 2018-08-10 hasta 2019-06-05.','2019-06-09 18:41:50',NULL),(251,1,'False','Entró a la vista de opciones avanzadas','2019-06-09 20:13:14',NULL),(252,1,'False','Accedió a la pantalla de Registrar un nuevo usuario.','2019-06-09 20:13:21',NULL),(253,2,'False','Accedió a la pantalla de Reporte de Ingresos por venta por producto.','2019-06-12 04:57:20',NULL),(254,2,'False','Solicitó generar un Reporte de Ingresos por venta por producto desde\r\n        2017-12-19 hasta 2017-12-27.','2019-06-12 04:57:33',NULL),(255,2,'False','Accedió a la pantalla de Reporte de ganancia bruta por categoria.','2019-06-12 04:57:55',NULL),(256,2,'False','Solicitó generar un Reporte de ganancia bruta por categoria desde\r\n         2017-12-19 hasta 2017-12-22.','2019-06-12 04:58:11',NULL),(257,2,'False','Accedió a la pantalla de Reporte de ingresos de venta por intervalos de horas.','2019-06-12 04:58:19',NULL),(258,2,'False','Accedió a la pantalla de Reporte de ventas realizadas en la tienda en linea agrupados por genero.','2019-06-12 04:58:22',NULL),(259,2,'False','Solicitó generar un Reporte de ventas realizadas en la tienda en linea agrupados por genero desde\r\n         2017-12-19 hasta 2017-12-22.','2019-06-12 04:58:37',NULL),(260,2,'False','Solicitó generar un Reporte de ventas realizadas en la tienda en linea agrupados por genero desde\r\n         2017-12-19 hasta 2017-12-22.','2019-06-12 04:58:44',NULL),(261,1,'False','Entró a la vista de opciones avanzadas','2019-06-15 01:18:51',NULL),(262,1,'False','Realizó un nuevo respaldo de la base de datos','2019-06-15 01:18:55',NULL);
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
INSERT INTO `password_resets` VALUES ('go13005@ues.edu.sv','$2y$10$.WNPP2pPvt5y42VMbDk7.uIo2KgXzsQw3CEiRH93HlnY62Gt3YcHq','2019-06-08 01:34:54');
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
INSERT INTO `users` VALUES (1,'Administrador','Administrador','Administrador','Administrador','panonline503@gmail.com','panaderialila','$2y$10$qR1APTPr1zTFL/iFaUiclOtAdXznfvCG52/rxW6mzbojkJKRnCjOm',1,'ajxU6BvVU5LDdTxUJBW9pxojNtivxtAFwiGBumuVFII0GowJcolelIRvIRlc','2019-05-25 04:49:52','2019-05-25 04:49:52'),(2,'Estrategico','Estrategico','Estrategico','Estrategico','estra@estra.com','estrategico','$2y$10$a9qlQ/A7iEOW8IeYVWFCUeKoVgaqbSM6lkHqEcM280y6uNZKtS4VS',1,'I7ru8nXI1JHnCVmZ0b7YAkufpFV1MRqrvpkN92byo1F6ctKyKo3Nehafzzsl','2019-05-25 04:49:52','2019-05-25 04:49:52'),(3,'Táctico','Táctico','Táctico','Táctico','tact@tact.com','tactico','$2y$10$D82Lg/ulycGOitn94EChfeA35pqltnTPWodhL9YbD4NV75wlTOco2',1,NULL,'2019-05-25 04:49:52','2019-05-25 04:49:52'),(4,'Alejandro','Stefano','Granados','Orellana','go13005@ues.edu.sv','AleASGO1619','$2y$10$5MdUqL139uo.c2CG0JEzkuKoLeyIwRRb80CQCyAIkY17eeWJMeHQy',1,'x4GI4QD4WloUGsUfrdby3HwTPqqkjxShjkQDrXUOl8jjKBnwLdZkUlnoymL4','2019-06-01 19:33:12','2019-06-08 01:33:33');
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

-- Dump completed on 2019-06-14 19:19:01
