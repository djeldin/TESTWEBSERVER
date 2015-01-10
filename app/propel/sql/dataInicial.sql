-- MySQL dump 10.13  Distrib 5.5.40, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: TSWS
-- ------------------------------------------------------
-- Server version	5.5.40-0ubuntu1-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE = @@TIME_ZONE */;
/*!40103 SET TIME_ZONE = '+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS = @@UNIQUE_CHECKS, UNIQUE_CHECKS = 0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0 */;
/*!40101 SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES = @@SQL_NOTES, SQL_NOTES = 0 */;

--
-- Table structure for table `WS`
--

DROP TABLE IF EXISTS `WS`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `WS` (
  `id`       INT(11) NOT NULL AUTO_INCREMENT,
  `telefono` VARCHAR(100)     DEFAULT NULL,
  `status`   VARCHAR(100)     DEFAULT NULL,
  `marca`    VARCHAR(100)     DEFAULT NULL,
  `modelo`   VARCHAR(100)     DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE =InnoDB
  AUTO_INCREMENT =24
  DEFAULT CHARSET =latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `WS`
--

LOCK TABLES `WS` WRITE;
/*!40000 ALTER TABLE `WS` DISABLE KEYS */;
INSERT INTO `WS` VALUES (1, '10', 'ACTIVO', 'LG', 'MODEL 1'), (2, '11', 'ACTIVO', 'LG', 'MODEL 2'),
  (3, '12', 'INACTIVO', 'LG', 'MODEL 3'), (4, '13', 'BAJA', 'LG', 'MODEL 4'), (5, '14', 'ACTIVO', 'LG', 'MODEL 5'),
  (6, '15', 'BAJA', 'LG', 'MODEL 6'), (7, '16', 'ACTIVO', 'APPLE', 'IPHONE 1'),
  (8, '17', 'ACTIVO', 'APPLE', 'IPHONE 2'), (9, '18', 'ACTIVO', 'APPLE', 'IPHONE 3'),
  (10, '19', 'ACTIVO', 'APPLE', 'IPHONE 4'), (11, '20', 'BAJA', 'APPLE', 'IPHONE 5'),
  (12, '21', 'ACTIVO', 'SAMGSUNG', 'GALAXY S1'), (13, '22', 'BAJA', 'SAMGSUNG', 'GALAXY S2'),
  (14, '23', 'INACTIVO', 'SAMGSUN', 'GALAXY S3'), (15, '24', 'BAJA', 'SAMGSUN', 'GALAXY S4'),
  (16, '25', 'ACTIVO', 'SAMGSUN', 'GALAXY S5'), (17, '26', 'ACTIVO', 'ACER', 'PHONE 1'),
  (18, '27', 'ACTIVO', 'ACER', 'PHONE 2'), (19, '28', 'ACTIVO', 'LENOVO', 'PHONE 0'),
  (20, '29', 'ACTIVO', 'LENOVO', 'PHONE 1'), (21, '30', 'ACTIVO', 'LENOVO', 'PHONE 2'), (22, NULL, NULL, NULL, NULL),
  (23, '60', 'ACTIVO', 'APPLE', 'IPHONE 6');
/*!40000 ALTER TABLE `WS` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE = @OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE = @OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES = @OLD_SQL_NOTES */;

-- Dump completed on 2015-01-09 20:50:50
