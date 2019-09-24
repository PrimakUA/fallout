-- MySQL dump 10.16  Distrib 10.1.37-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: fallout
-- ------------------------------------------------------
-- Server version	10.1.37-MariaDB

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
-- Table structure for table `characters`
--

DROP TABLE IF EXISTS `characters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `characters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) NOT NULL DEFAULT 'Your character ',
  `secondName` varchar(50) NOT NULL DEFAULT '',
  `gender` varchar(10) NOT NULL DEFAULT 'OHO',
  `age` int(3) NOT NULL DEFAULT '27',
  `strong` int(2) NOT NULL DEFAULT '1',
  `power` int(2) NOT NULL DEFAULT '1',
  `e` int(2) NOT NULL DEFAULT '1',
  `c` int(2) NOT NULL DEFAULT '1',
  `i` int(2) NOT NULL DEFAULT '1',
  `a` int(2) NOT NULL DEFAULT '1',
  `lucky` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `characters`
--

LOCK TABLES `characters` WRITE;
/*!40000 ALTER TABLE `characters` DISABLE KEYS */;
INSERT INTO `characters` VALUES (1,'Baba','Bobo','Femail',66,3,8,5,7,4,3,6),(2,'Elijah','Lee','Male',23,9,4,9,5,1,4,8),(3,'James','Brown','Male',23,8,1,4,1,7,9,10),(4,'Oliver','Wilson','Male',21,3,1,6,9,10,3,8),(5,'Daniel','Jackson','Male',47,1,5,8,1,5,10,10),(6,'James','Young','Male',37,7,1,10,1,8,3,10),(7,'Sofia','Thompson','Female',27,9,9,2,8,1,4,7),(8,'Liam','Moore','Male',49,9,2,3,10,10,4,2),(9,'Ethan','Thompson','Male',38,9,1,1,4,7,8,10),(12,'BlaBla','LaLa','Female',33,8,5,2,2,8,5,10),(13,'1111','2222','Male',13,10,7,4,2,1,8,8),(14,'Samuel','Harris','Male',20,1,4,6,3,6,10,10),(15,'Joseph','Lee','Male',33,10,1,6,5,8,2,8),(16,'Camila','Jackson','Female',30,1,8,8,7,2,6,8),(17,'Owen','Garcia','Male',25,10,5,4,6,1,8,6);
/*!40000 ALTER TABLE `characters` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-09-24 23:31:56
