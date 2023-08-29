-- MySQL dump 10.13  Distrib 8.0.34, for Linux (x86_64)
--
-- Host: localhost    Database: realstate_crud
-- ------------------------------------------------------
-- Server version	8.0.34

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `properties`
--

DROP TABLE IF EXISTS `properties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `properties` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(60) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `description` longtext,
  `rooms` int DEFAULT NULL,
  `wc` int DEFAULT NULL,
  `parking_lot` int DEFAULT NULL,
  `create_at` date DEFAULT NULL,
  `seller_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_properties_sellers_idx` (`seller_id`),
  CONSTRAINT `fk_properties_sellers` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `properties`
--

LOCK TABLES `properties` WRITE;
/*!40000 ALTER TABLE `properties` DISABLE KEYS */;
INSERT INTO `properties` VALUES (7,'ElisCasa',234.00,'657788d5b6c06ef659157bdabc2ea7a3.jpg','asdfasdfasdfa sdfa sdfa sdfasd fasd fasd asdf asdf asdfasdf',2,3,4,'2023-08-23',1),(8,'Casa con piscina',123412.00,'780dbfc9a01694aac328fce95aac40f3.jpg','asdfa a├▒lkfak ajdfadfjfjpoweijeljeajsd falkjdfl├▒j asdfj',3,2,3,'2023-08-23',2),(9,'EfrainCasa',2000000.00,'801e267d14b7c0ea56eaf303cfa70718.jpg','La casita sencilla de Efrain para vacaciones con piscina',3,4,5,'2023-08-23',2),(36,'Efrain2',2.00,'9b2952ac0171ab77c87d68b6d2c3171c.jpg','asdfasdf asd fa sdf asdfa sfs dsaf asd asdfasd asd asd ',3,2,1,'2023-08-24',3),(37,'Actualizado2',2.00,'f9379b5d1b32a28d68a887c957a7ae06.jpg','222222222222222222222222222222222222222222222222222222222222222',2,2,2,'2023-08-24',3),(38,'Mi casa',3.00,'61fb7589e96a79108cdbca2b6dee51aa.jpg','asdfasdfasdfdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd',2,3,2,'2023-08-24',4);
/*!40000 ALTER TABLE `properties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sellers`
--

DROP TABLE IF EXISTS `sellers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sellers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sellers`
--

LOCK TABLES `sellers` WRITE;
/*!40000 ALTER TABLE `sellers` DISABLE KEYS */;
INSERT INTO `sellers` VALUES (1,'Armando Esteban','Quito','5551234567'),(2,'Elsa','Pato','5551234567'),(3,'Luz','Rojas','5551234567'),(4,'Susana','Oria','5551234567'),(8,'Alan','Brito','1231312343'),(9,'Elsa','Polindo','3839198234');
/*!40000 ALTER TABLE `sellers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` char(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'correo@correo.com','$2y$10$VxBrGW7.7nFoj.g5cDLCZOrsd9Yzw.KgY1Z8bnWFOlFLdwRA5BcZG');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'realstate_crud'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-08-27 20:03:10
