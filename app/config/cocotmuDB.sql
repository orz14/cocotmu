-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: ngetes_asw
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

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
-- Table structure for table `cocotan_tb`
--

DROP TABLE IF EXISTS `cocotan_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cocotan_tb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `teks` text NOT NULL,
  `img` varchar(100) NOT NULL,
  `time` varchar(25) NOT NULL,
  `suspend` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cocotan_tb`
--

LOCK TABLES `cocotan_tb` WRITE;
/*!40000 ALTER TABLE `cocotan_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `cocotan_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `komen_tb`
--

DROP TABLE IF EXISTS `komen_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `komen_tb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `komen` text NOT NULL,
  `time` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `komen_tb`
--

LOCK TABLES `komen_tb` WRITE;
/*!40000 ALTER TABLE `komen_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `komen_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `like_tb`
--

DROP TABLE IF EXISTS `like_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `like_tb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `like_tb`
--

LOCK TABLES `like_tb` WRITE;
/*!40000 ALTER TABLE `like_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `like_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_tb`
--

DROP TABLE IF EXISTS `login_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_tb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `tgl` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_tb`
--

LOCK TABLES `login_tb` WRITE;
/*!40000 ALTER TABLE `login_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_tb`
--

DROP TABLE IF EXISTS `users_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_tb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jk` varchar(15) NOT NULL,
  `wa` varchar(15) NOT NULL,
  `fp` varchar(100) NOT NULL,
  `verified` varchar(5) NOT NULL,
  `geek` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_tb`
--

LOCK TABLES `users_tb` WRITE;
/*!40000 ALTER TABLE `users_tb` DISABLE KEYS */;
INSERT INTO `users_tb` VALUES (1,'Oriz Wahyu N.','orz14','$2y$10$QiC/hTTc1d9IQ3KRf.yyhez0yXqK..FGtXOOu2MGybaBVgm2o./Da','Laki-laki','081228390894','profil-6343c4915515f.png','false','true'),(20,'Sandhika Galih','sandhikagalih','$2y$10$ONaZ7Beto3zDBGDoLxL3m.Z.xq2WY9gvSYJzE2IE9/ZXAEvig7EjK','Laki-laki','-','profil-635ff3c243bb5.png','true','false');
/*!40000 ALTER TABLE `users_tb` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-11-10 22:16:42
