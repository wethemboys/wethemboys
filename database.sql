CREATE DATABASE  IF NOT EXISTS `evypms` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `evypms`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win32 (AMD64)
--
-- Host: 127.0.0.1    Database: evypms
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.13-MariaDB

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
-- Table structure for table `activities`
--

DROP TABLE IF EXISTS `activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activities` (
  `ActivityID` int(11) NOT NULL AUTO_INCREMENT,
  `ProjectID` longtext NOT NULL,
  `Name` longtext NOT NULL,
  `StartDate` datetime NOT NULL,
  `EndDate` datetime NOT NULL,
  `Weight` longtext NOT NULL,
  `Done` tinyint(1) NOT NULL,
  `ClientNeeded` longtext NOT NULL,
  `Progress` int(5) DEFAULT '0',
  PRIMARY KEY (`ActivityID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activities`
--

LOCK TABLES `activities` WRITE;
/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
/*!40000 ALTER TABLE `activities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activities_resources`
--

DROP TABLE IF EXISTS `activities_resources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activities_resources` (
  `ActResID` int(11) NOT NULL AUTO_INCREMENT,
  `ProjectID` longtext NOT NULL,
  `ActivityID` longtext NOT NULL,
  `ResourceID` longtext NOT NULL,
  `Quantity` longtext NOT NULL,
  `Type` longtext NOT NULL,
  `Used` longtext NOT NULL,
  `Remaining` longtext NOT NULL,
  PRIMARY KEY (`ActResID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activities_resources`
--

LOCK TABLES `activities_resources` WRITE;
/*!40000 ALTER TABLE `activities_resources` DISABLE KEYS */;
/*!40000 ALTER TABLE `activities_resources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `CommentID` int(11) NOT NULL AUTO_INCREMENT,
  `ProjectID` longtext NOT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UserID` longtext NOT NULL,
  `Data` longtext NOT NULL,
  PRIMARY KEY (`CommentID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files` (
  `FileID` int(11) NOT NULL AUTO_INCREMENT,
  `ProjectID` longtext NOT NULL,
  `UserID` longtext NOT NULL,
  `Name` longtext NOT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Type` longtext NOT NULL,
  `Filename` longtext NOT NULL,
  PRIMARY KEY (`FileID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` VALUES (3,'1','1','Screen Shot 2016-04-15 at 9.57.36 PM.png','2016-06-01 09:47:48','image/png','574eaf4417b381574eaf4417b3e.png');
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `NotificationID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` longtext NOT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Type` longtext NOT NULL,
  `RequestData` longtext NOT NULL,
  `ToUser` longtext NOT NULL,
  `ProjectID` longtext NOT NULL,
  `ActivityID` longtext NOT NULL,
  `TaskID` int(3) DEFAULT NULL,
  PRIMARY KEY (`NotificationID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `ProjectID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` longtext NOT NULL,
  `Name` longtext NOT NULL,
  `StartDate` datetime NOT NULL,
  `EndDate` datetime NOT NULL,
  `Status` longtext NOT NULL,
  `Progress` longtext NOT NULL,
  `Location` longtext NOT NULL,
  `ProjectType` varchar(45) NOT NULL,
  `LotSize` varchar(45) DEFAULT NULL,
  `OtherSize` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ProjectID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reason`
--

DROP TABLE IF EXISTS `reason`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reason` (
  `ReasonID` int(11) NOT NULL AUTO_INCREMENT,
  `ProjectID` int(11) NOT NULL,
  `TaskID` int(11) NOT NULL,
  `ActivityID` int(11) NOT NULL,
  `ResourceID` int(11) NOT NULL,
  `TaskResID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Type` int(1) NOT NULL DEFAULT '0',
  `Used` int(11) NOT NULL DEFAULT '0',
  `Remaining` int(11) NOT NULL,
  `Reason` longtext,
  PRIMARY KEY (`ReasonID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reason`
--

LOCK TABLES `reason` WRITE;
/*!40000 ALTER TABLE `reason` DISABLE KEYS */;
/*!40000 ALTER TABLE `reason` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resources`
--

DROP TABLE IF EXISTS `resources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resources` (
  `ResourceID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` longtext NOT NULL,
  `Type` longtext NOT NULL,
  `Price` longtext NOT NULL,
  `Quantity` int(4) DEFAULT NULL,
  PRIMARY KEY (`ResourceID`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resources`
--

LOCK TABLES `resources` WRITE;
/*!40000 ALTER TABLE `resources` DISABLE KEYS */;
INSERT INTO `resources` VALUES (1,'Foreman','manpower','100',3),(2,'Labor','manpower','60',32),(3,'Sickle','material','4000',0),(4,'16mm Deformed Bar','material','300',0),(5,'Mansory','manpower','300',29),(6,'Operator (Heavy Equipment)','manpower','5',4),(7,'Bags of Cement','material','0',0),(8,'Cubic Meter Sand','material','0',0),(9,'Cubic Meter Gravel','material','0',0),(10,'Carpentry','manpower','0',20),(11,'Welder','manpower','0',10),(12,'Steel Man','manpower','0',15),(13,'12mm Deformed Bar','material','0',0),(14,'10mm Deformed Bar','material','0',0),(15,'inches x 3 inches x 10 feet coco lumber','material','0',0),(16,'4 ft x 8 ft plywood','material','0',0),(17,'6 inches concrete hollow block','material','0',0),(18,'4 inches concrete hollow block','material','0',0),(19,'2 inches x 2 inches x 10 feet wood','material','0',0),(20,'12 feet yero','material','0',0),(21,'Nails','material','0',0),(22,'C-Purlins 2 inches x 6 inches','material','0',0),(23,'UPBC','material','0',0),(24,'Roller','material','0',0),(25,'tin semi-gloss','material','0',0),(26,'Painter','manpower','0',15),(27,'gallon acrycolor','material','0',0),(28,'Paint Brush','material','0',0),(29,'Gallon thinner','material','0',0),(30,'Plumber','manpower','0',6),(31,'Sink','material','0',0),(32,'water closet','material','1',0),(33,'Lavatory','material','0',0),(34,'Urinal','material','0',0),(35,'1 inch blue bbc','material','0',0),(36,'1 /2 inch blue bbc','material','0',0),(37,'3 /4 inches blue bbc','material','0',0),(38,'4 inches orange pipe','material','0',0),(39,'3 inches orange pipe','material','0',0),(40,'2 inches orange pipe','material','0',0),(41,'Cement Mixer','equipment','0',5),(42,'Electrician','manpower','0',10),(43,'3/4 inches orange pipe ','material','0',0),(44,'1 inches orange pipe','material','0',0),(45,'elbow','material','0',0),(46,'box wire','material','0',0),(47,'Breaker','material','0',0);
/*!40000 ALTER TABLE `resources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task` (
  `TaskID` int(11) NOT NULL AUTO_INCREMENT,
  `ProjectID` longtext NOT NULL,
  `ActivityID` longtext NOT NULL,
  `Name` longtext NOT NULL,
  `StartDate` datetime NOT NULL,
  `EndDate` datetime NOT NULL,
  `ActualStartDate` datetime NOT NULL,
  `ActualEndDate` datetime NOT NULL,
  `Weight` longtext NOT NULL,
  `Percentage` longtext NOT NULL,
  `Budget` longtext NOT NULL,
  `ActualCost` longtext NOT NULL,
  `Parent` int(11) DEFAULT NULL,
  `Days` int(3) DEFAULT NULL,
  `Done` int(1) DEFAULT '0',
  `ClientNeeded` int(1) DEFAULT '0',
  `ActualDays` int(3) DEFAULT '0',
  `Message` longtext,
  `PreStartDate` datetime DEFAULT NULL,
  `PreEndDate` datetime DEFAULT NULL,
  `AdditionalDays` int(3) DEFAULT '0',
  PRIMARY KEY (`TaskID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_checklist`
--

DROP TABLE IF EXISTS `task_checklist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_checklist` (
  `TaskCLID` int(11) NOT NULL AUTO_INCREMENT,
  `ProjectID` longtext NOT NULL,
  `ActivityID` longtext NOT NULL,
  `TaskID` longtext NOT NULL,
  `Name` longtext NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `EndDate` datetime NOT NULL,
  `ActualEndDate` datetime NOT NULL,
  PRIMARY KEY (`TaskCLID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_checklist`
--

LOCK TABLES `task_checklist` WRITE;
/*!40000 ALTER TABLE `task_checklist` DISABLE KEYS */;
/*!40000 ALTER TABLE `task_checklist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_resources`
--

DROP TABLE IF EXISTS `task_resources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_resources` (
  `TaskResID` int(11) NOT NULL AUTO_INCREMENT,
  `ProjectID` int(11) NOT NULL,
  `TaskID` int(11) NOT NULL,
  `ResourceID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Type` int(1) NOT NULL DEFAULT '0',
  `Used` int(11) NOT NULL DEFAULT '0',
  `Remaining` int(11) NOT NULL,
  `Additional` int(11) NOT NULL DEFAULT '0',
  `TaskAddID` int(11) DEFAULT NULL,
  PRIMARY KEY (`TaskResID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_resources`
--

LOCK TABLES `task_resources` WRITE;
/*!40000 ALTER TABLE `task_resources` DISABLE KEYS */;
/*!40000 ALTER TABLE `task_resources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_resources_additional`
--

DROP TABLE IF EXISTS `task_resources_additional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_resources_additional` (
  `TaskAddID` int(11) NOT NULL AUTO_INCREMENT,
  `ProjectID` int(11) NOT NULL,
  `TaskID` int(11) NOT NULL,
  `ResourceID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Type` int(1) NOT NULL DEFAULT '0',
  `Used` int(11) NOT NULL DEFAULT '0',
  `Remaining` int(11) NOT NULL,
  `Reason` longtext,
  PRIMARY KEY (`TaskAddID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_resources_additional`
--

LOCK TABLES `task_resources_additional` WRITE;
/*!40000 ALTER TABLE `task_resources_additional` DISABLE KEYS */;
/*!40000 ALTER TABLE `task_resources_additional` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` longtext NOT NULL,
  `Username` longtext NOT NULL,
  `Password` longtext NOT NULL,
  `Type` longtext NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Adminboy','admin','2c08e8f5884750a7b99f6f2f342fc638db25ff31','admin'),(2,'feihl','feihl','2c08e8f5884750a7b99f6f2f342fc638db25ff31','client'),(3,'asd','asd','7e1913bb41fa854cca1df5ef6c80a0858c8e7d13','manager'),(4,'client','client','dd258be91aa6a0f2fb947c7e629fbde3e1850328','client');
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

-- Dump completed on 2016-08-03 22:01:42
