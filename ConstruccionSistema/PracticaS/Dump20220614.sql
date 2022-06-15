-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: baseprueba_t
-- ------------------------------------------------------
-- Server version	10.4.6-MariaDB

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
-- Table structure for table `loggin`
--

DROP TABLE IF EXISTS `loggin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loggin` (
  `Id_Log` int(11) NOT NULL AUTO_INCREMENT,
  `User` varchar(45) NOT NULL,
  `Password` varchar(45) NOT NULL,
  `Tipo` varchar(45) DEFAULT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Apellido` varchar(45) DEFAULT NULL,
  `Logo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id_Log`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loggin`
--

LOCK TABLES `loggin` WRITE;
/*!40000 ALTER TABLE `loggin` DISABLE KEYS */;
INSERT INTO `loggin` VALUES (1,'User001','001','1','Luis','Garcia','../asset/images/Logo_1.png'),(2,'Admin001','001','2','Maria','Perez','../asset/images/Logo_2.jpg'),(3,'Admin002','002','1','Gabriela','Ortiz','../asset/images/Logo_3.png'),(4,'Admin003','003','2','Oscar','Chavez','../asset/images/Logo_4.jpg');
/*!40000 ALTER TABLE `loggin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visitaweb`
--

DROP TABLE IF EXISTS `visitaweb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visitaweb` (
  `Id_ConVis` int(11) NOT NULL AUTO_INCREMENT,
  `AccesoPag` varchar(45) NOT NULL,
  `AccesoCon` int(11) DEFAULT NULL,
  `AccesoDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Primer_Acceso` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id_ConVis`),
  UNIQUE KEY `Acceso_UNIQUE` (`AccesoPag`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitaweb`
--

LOCK TABLES `visitaweb` WRITE;
/*!40000 ALTER TABLE `visitaweb` DISABLE KEYS */;
INSERT INTO `visitaweb` VALUES (1,'Interfaz Administrador',7,'2022-06-11 19:25:59','2022-06-11 07:29:51'),(3,'Interfaz Supervisor',40,'2022-06-11 19:41:47','2022-06-11 07:30:08');
/*!40000 ALTER TABLE `visitaweb` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-14 23:44:32
