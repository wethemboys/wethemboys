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
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activities`
--

LOCK TABLES `activities` WRITE;
/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
INSERT INTO `activities` VALUES (1,'1','Earthworks','2016-07-26 00:00:00','2016-08-21 00:00:00','0',1,'0',100),(2,'1','Concrete Works','2016-08-22 00:00:00','2016-10-01 00:00:00','0',1,'0',100),(3,'1','Steel Works','2016-07-31 00:00:00','2016-08-21 00:00:00','0',0,'0',0),(4,'1','Framework','2016-07-31 00:00:00','2016-09-03 00:00:00','0',0,'0',0),(5,'1','Mansory Works','2016-07-31 00:00:00','2016-09-09 00:00:00','0',0,'0',0),(6,'1','Carpentry Works','2016-09-10 00:00:00','2016-10-10 00:00:00','0',0,'0',0),(7,'1','Roofing Works','2016-10-11 00:00:00','2016-10-22 00:00:00','0',0,'0',0),(8,'1','Pre-Fabricated Works','2016-10-23 00:00:00','2016-11-11 00:00:00','0',0,'0',0),(9,'1','Painting Works','2016-11-12 00:00:00','2016-12-05 00:00:00','0',0,'0',0),(10,'1','Plumbing','2016-07-31 00:00:00','2016-08-11 00:00:00','0',0,'0',0),(11,'1',' Electrical Works','2016-07-31 00:00:00','2016-08-09 00:00:00','0',0,'0',0),(16,'1','Additional Activity','0000-00-00 00:00:00','0000-00-00 00:00:00','',0,'',0),(17,'2','Earthworks','2016-07-29 00:00:00','2016-08-24 00:00:00','0',0,'0',25),(18,'2','Concrete Works','2016-08-25 00:00:00','2016-10-04 00:00:00','0',0,'0',0),(19,'2','Steel Works','2016-08-03 00:00:00','2016-08-24 00:00:00','0',0,'0',0),(20,'2','Framework','2016-08-03 00:00:00','2016-09-06 00:00:00','0',0,'0',0),(21,'2','Mansory Works','2016-08-03 00:00:00','2016-09-12 00:00:00','0',0,'0',0),(22,'2','Carpentry Works','2016-09-13 00:00:00','2016-10-13 00:00:00','0',0,'0',0),(23,'2','Roofing Works','2016-10-14 00:00:00','2016-10-25 00:00:00','0',0,'0',0),(24,'2','Pre-Fabricated Works','2016-10-26 00:00:00','2016-11-14 00:00:00','0',0,'0',0),(25,'2','Painting Works','2016-11-15 00:00:00','2016-12-08 00:00:00','0',0,'0',0),(26,'2','Plumbing','2016-08-03 00:00:00','2016-08-14 00:00:00','0',0,'0',0),(27,'2',' Electrical Works','2016-08-03 00:00:00','2016-08-12 00:00:00','0',0,'0',0),(28,'3','Earthworks','2016-07-31 00:00:00','2016-08-26 00:00:00','0',0,'0',0),(29,'3','Concrete Works','2016-08-27 00:00:00','2016-10-06 00:00:00','0',0,'0',0),(30,'3','Steel Works','2016-08-05 00:00:00','2016-08-26 00:00:00','0',0,'0',0),(31,'3','Framework','2016-08-05 00:00:00','2016-09-08 00:00:00','0',0,'0',0),(32,'3','Mansory Works','2016-08-05 00:00:00','2016-09-14 00:00:00','0',0,'0',0),(33,'3','Carpentry Works','2016-09-15 00:00:00','2016-10-15 00:00:00','0',0,'0',0),(34,'3','Roofing Works','2016-10-16 00:00:00','2016-10-27 00:00:00','0',0,'0',0),(35,'3','Pre-Fabricated Works','2016-10-28 00:00:00','2016-11-16 00:00:00','0',0,'0',0),(36,'3','Painting Works','2016-11-17 00:00:00','2016-12-10 00:00:00','0',0,'0',0),(37,'3','Plumbing','2016-08-05 00:00:00','2016-08-16 00:00:00','0',0,'0',0),(38,'3',' Electrical Works','2016-08-05 00:00:00','2016-08-14 00:00:00','0',0,'0',0),(39,'4','Earthworks','2016-07-31 00:00:00','2016-08-26 00:00:00','0',0,'0',0),(40,'4','Concrete Works','2016-08-27 00:00:00','2016-10-06 00:00:00','0',0,'0',0),(41,'4','Steel Works','2016-08-05 00:00:00','2016-08-26 00:00:00','0',0,'0',0),(42,'4','Framework','2016-08-05 00:00:00','2016-09-08 00:00:00','0',0,'0',0),(43,'4','Mansory Works','2016-08-05 00:00:00','2016-09-14 00:00:00','0',0,'0',0),(44,'4','Carpentry Works','2016-09-15 00:00:00','2016-10-15 00:00:00','0',0,'0',0),(45,'4','Roofing Works','2016-10-16 00:00:00','2016-10-27 00:00:00','0',0,'0',0),(46,'4','Pre-Fabricated Works','2016-10-28 00:00:00','2016-11-16 00:00:00','0',0,'0',0),(47,'4','Painting Works','2016-11-17 00:00:00','2016-12-10 00:00:00','0',0,'0',0),(48,'4','Plumbing','2016-08-05 00:00:00','2016-08-16 00:00:00','0',0,'0',0),(49,'4',' Electrical Works','2016-08-05 00:00:00','2016-08-14 00:00:00','0',0,'0',0);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (4,'1','2016-06-01 09:50:28','1','hello'),(5,'1','2016-06-01 09:50:58','2','hello'),(6,'1','2016-07-09 04:51:46','1','test');
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
) ENGINE=InnoDB AUTO_INCREMENT=387 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (68,'0','2016-07-29 15:19:22','late_task','{\"TaskName\":\"Footings\",\"ProjectName\":\"PROJECT A\",\"DelayDays\":\"8\"}','4','1','',9),(70,'0','2016-07-29 15:19:22','late_task','{\"TaskName\":\"Slabs\",\"ProjectName\":\"PROJECT A\",\"DelayDays\":\"2\"}','4','1','',12),(72,'0','2016-07-29 15:19:22','late_task','{\"TaskName\":\"Fixtures\",\"ProjectName\":\"PROJECT A\",\"DelayDays\":\"10\"}','4','1','',20),(74,'0','2016-07-29 15:19:22','late_task','{\"TaskName\":\"Fixtures and Boxes\",\"ProjectName\":\"PROJECT A\",\"DelayDays\":\"9\"}','4','1','',24),(76,'0','2016-07-29 15:19:22','late_task','{\"TaskName\":\"Fittings\",\"ProjectName\":\"PROJECT A\",\"DelayDays\":\"7\"}','4','1','',25),(78,'0','2016-07-29 15:19:22','late_task','{\"TaskName\":\"Wiring\",\"ProjectName\":\"PROJECT A\",\"DelayDays\":\"2\"}','4','1','',26),(80,'0','2016-07-29 15:19:23','late_task','{\"TaskName\":\"Enclosed Circuit Breaker\",\"ProjectName\":\"PROJECT A\",\"DelayDays\":\"10\"}','4','1','',27),(82,'0','2016-07-29 15:19:23','late_task','{\"TaskName\":\"Testing and Commissioning\",\"ProjectName\":\"PROJECT A\",\"DelayDays\":\"10\"}','4','1','',28),(84,'0','2016-07-29 15:19:23','late_task','{\"TaskName\":\"Task 1\",\"ProjectName\":\"PROJECT A\",\"DelayDays\":\"10\"}','4','1','',31),(96,'0','2016-07-31 09:16:57','late_task','{\"TaskName\":\"Clearing and Grubing\",\"ProjectName\":\"PROJECT A\",\"DelayDays\":\"18\"}','4','1','',1),(98,'0','2016-07-31 09:19:25','advance_activity','{\"ActivityName\":\"Excavation\",\"ProjectName\":\"PROJECT A\",\"AdvanceDays\":12}','4','1','',2),(100,'0','2016-07-31 09:22:02','advance_activity','{\"ActivityName\":\"Excavation\",\"ProjectName\":\"PROJECT A\",\"AdvanceDays\":12}','4','1','',2),(102,'0','2016-07-31 09:22:09','advance_activity','{\"ActivityName\":\"Excavation\",\"ProjectName\":\"PROJECT A\",\"AdvanceDays\":12}','4','1','',2),(104,'0','2016-07-31 09:22:31','advance_activity','{\"ActivityName\":\"Soil Poisoning\",\"ProjectName\":\"PROJECT A\",\"AdvanceDays\":5}','4','1','',3),(106,'0','2016-07-31 09:22:47','advance_activity','{\"ActivityName\":\"Gravel Bedding\",\"ProjectName\":\"PROJECT A\",\"AdvanceDays\":5}','4','1','',4),(108,'0','2016-07-31 09:23:55','advance_activity','{\"ActivityName\":\"Footings\",\"ProjectName\":\"PROJECT A\",\"AdvanceDays\":7}','4','1','',5),(110,'0','2016-07-31 09:24:18','advance_activity','{\"ActivityName\":\"Columns\",\"ProjectName\":\"PROJECT A\",\"AdvanceDays\":15}','4','1','',6),(112,'0','2016-07-31 09:26:15','advance_activity','{\"ActivityName\":\"Beams\",\"ProjectName\":\"PROJECT A\",\"AdvanceDays\":11}','4','1','',7),(114,'0','2016-07-31 09:26:20','advance_activity','{\"ActivityName\":\"Slabs\",\"ProjectName\":\"PROJECT A\",\"AdvanceDays\":8}','4','1','',8),(359,'0','2016-07-31 10:31:20','late_task','{\"TaskName\":\"Excavation\",\"ProjectName\":\"PROJECT B\",\"DelayDays\":\"4\"}','0','2','',34),(360,'0','2016-07-31 10:31:20','late_task','{\"TaskName\":\"Excavation\",\"ProjectName\":\"PROJECT B\",\"DelayDays\":\"4\"}','4','2','',34),(361,'0','2016-07-31 10:31:20','late_task','{\"TaskName\":\"Footings\",\"ProjectName\":\"PROJECT B\",\"DelayDays\":\"12\"}','0','2','',41),(362,'0','2016-07-31 10:31:20','late_task','{\"TaskName\":\"Footings\",\"ProjectName\":\"PROJECT B\",\"DelayDays\":\"12\"}','4','2','',41),(363,'0','2016-07-31 10:31:20','late_task','{\"TaskName\":\"Slabs\",\"ProjectName\":\"PROJECT B\",\"DelayDays\":\"6\"}','0','2','',44),(364,'0','2016-07-31 10:31:21','late_task','{\"TaskName\":\"Slabs\",\"ProjectName\":\"PROJECT B\",\"DelayDays\":\"6\"}','4','2','',44),(365,'0','2016-07-31 10:31:21','late_task','{\"TaskName\":\"Fixtures\",\"ProjectName\":\"PROJECT B\",\"DelayDays\":\"14\"}','0','2','',52),(366,'0','2016-07-31 10:31:21','late_task','{\"TaskName\":\"Fixtures\",\"ProjectName\":\"PROJECT B\",\"DelayDays\":\"14\"}','4','2','',52),(367,'0','2016-07-31 10:31:21','late_task','{\"TaskName\":\"Waterlines\",\"ProjectName\":\"PROJECT B\",\"DelayDays\":\"4\"}','0','2','',53),(368,'0','2016-07-31 10:31:21','late_task','{\"TaskName\":\"Waterlines\",\"ProjectName\":\"PROJECT B\",\"DelayDays\":\"4\"}','4','2','',53),(369,'0','2016-07-31 10:31:21','late_task','{\"TaskName\":\"Sanitary\",\"ProjectName\":\"PROJECT B\",\"DelayDays\":\"4\"}','0','2','',54),(370,'0','2016-07-31 10:31:21','late_task','{\"TaskName\":\"Sanitary\",\"ProjectName\":\"PROJECT B\",\"DelayDays\":\"4\"}','4','2','',54),(371,'0','2016-07-31 10:31:21','late_task','{\"TaskName\":\"Storm Drain\",\"ProjectName\":\"PROJECT B\",\"DelayDays\":\"4\"}','0','2','',55),(372,'0','2016-07-31 10:31:21','late_task','{\"TaskName\":\"Storm Drain\",\"ProjectName\":\"PROJECT B\",\"DelayDays\":\"4\"}','4','2','',55),(373,'0','2016-07-31 10:31:21','late_task','{\"TaskName\":\"Fixtures and Boxes\",\"ProjectName\":\"PROJECT B\",\"DelayDays\":\"13\"}','0','2','',56),(374,'0','2016-07-31 10:31:21','late_task','{\"TaskName\":\"Fixtures and Boxes\",\"ProjectName\":\"PROJECT B\",\"DelayDays\":\"13\"}','4','2','',56),(375,'0','2016-07-31 10:31:22','late_task','{\"TaskName\":\"Fittings\",\"ProjectName\":\"PROJECT B\",\"DelayDays\":\"11\"}','0','2','',57),(376,'0','2016-07-31 10:31:22','late_task','{\"TaskName\":\"Fittings\",\"ProjectName\":\"PROJECT B\",\"DelayDays\":\"11\"}','4','2','',57),(377,'0','2016-07-31 10:31:22','late_task','{\"TaskName\":\"Wiring\",\"ProjectName\":\"PROJECT B\",\"DelayDays\":\"6\"}','0','2','',58),(378,'0','2016-07-31 10:31:22','late_task','{\"TaskName\":\"Wiring\",\"ProjectName\":\"PROJECT B\",\"DelayDays\":\"6\"}','4','2','',58),(379,'0','2016-07-31 10:31:22','late_task','{\"TaskName\":\"Enclosed Circuit Breaker\",\"ProjectName\":\"PROJECT B\",\"DelayDays\":\"14\"}','0','2','',59),(380,'0','2016-07-31 10:31:22','late_task','{\"TaskName\":\"Enclosed Circuit Breaker\",\"ProjectName\":\"PROJECT B\",\"DelayDays\":\"14\"}','4','2','',59),(381,'0','2016-07-31 10:31:22','late_task','{\"TaskName\":\"Testing and Commissioning\",\"ProjectName\":\"PROJECT B\",\"DelayDays\":\"14\"}','0','2','',60),(382,'0','2016-07-31 10:31:22','late_task','{\"TaskName\":\"Testing and Commissioning\",\"ProjectName\":\"PROJECT B\",\"DelayDays\":\"14\"}','4','2','',60),(383,'0','2016-07-31 12:48:57','late_task','{\"TaskName\":\"Clearing and Grubing\",\"ProjectName\":\"PROJECT B\",\"DelayDays\":\"16\"}','0','2','',33),(384,'0','2016-07-31 12:48:57','late_task','{\"TaskName\":\"Clearing and Grubing\",\"ProjectName\":\"PROJECT B\",\"DelayDays\":\"16\"}','4','2','',33),(385,'0','2016-07-31 12:48:57','late_task','{\"TaskName\":\"Clearing and Grubing\",\"ProjectName\":\"Project C\",\"DelayDays\":\"18\"}','0','3','',61),(386,'0','2016-07-31 12:48:57','late_task','{\"TaskName\":\"Clearing and Grubing\",\"ProjectName\":\"Project C\",\"DelayDays\":\"18\"}','4','3','',61);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,'4','PROJECT A','2016-07-26 00:00:00','2016-12-07 00:00:00','0','26.666666666667','LOCATION A','3storeybuilding','90',''),(2,'4','PROJECT B','2016-07-29 00:00:00','2016-12-10 00:00:00','0','0','LOCATION B','2storeybuilding','90',''),(3,'4','Project C','2016-07-31 00:00:00','2016-12-12 00:00:00','0','0','location C','3storeybuilding','90',''),(4,'4','PROJECT D','2016-07-31 00:00:00','2016-12-12 00:00:00','0','0','LOCATION D','2storeybuilding','90','');
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
  PRIMARY KEY (`ResourceID`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resources`
--

LOCK TABLES `resources` WRITE;
/*!40000 ALTER TABLE `resources` DISABLE KEYS */;
INSERT INTO `resources` VALUES (1,'Foreman','manpower','100'),(2,'Labor','manpower','60'),(3,'Sickle','material','4000'),(4,'16mm Deformed Bar','material','300'),(5,'Mansory','manpower','300'),(6,'Operator (Heavy Equipment)','manpower','5'),(7,'Bags of Cement','material','0'),(8,'Cubic Meter Sand','material','0'),(9,'Cubic Meter Gravel','material','0'),(10,'Carpentry','manpower','0'),(11,'Welder','manpower','0'),(12,'Steel Man','manpower','0'),(13,'12mm Deformed Bar','material','0'),(14,'10mm Deformed Bar','material','0'),(15,'inches x 3 inches x 10 feet coco lumber','material','0'),(16,'4 ft x 8 ft plywood','material','0'),(17,'6 inches concrete hollow block','material','0'),(18,'4 inches concrete hollow block','material','0'),(19,'2 inches x 2 inches x 10 feet wood','material','0'),(20,'12 feet yero','material','0'),(21,'Nails','material','0'),(22,'C-Purlins 2 inches x 6 inches','material','0'),(23,'UPBC','material','0'),(24,'Roller','material','0'),(25,'tin semi-gloss','material','0'),(26,'Painter','manpower','0'),(27,'gallon acrycolor','material','0'),(28,'Paint Brush','material','0'),(29,'Gallon thinner','material','0'),(30,'Plumber','manpower','0'),(31,'Sink','material','0'),(32,'water closet','material','1'),(33,'Lavatory','material','0'),(34,'Urinal','material','0'),(35,'1 inch blue bbc','material','0'),(36,'1 /2 inch blue bbc','material','0'),(37,'3 /4 inches blue bbc','material','0'),(38,'4 inches orange pipe','material','0'),(39,'3 inches orange pipe','material','0'),(40,'2 inches orange pipe','material','0'),(41,'Cement Mixer','equipment','0'),(42,'Electrician','manpower','0'),(43,'3/4 inches orange pipe ','material','0'),(44,'1 inches orange pipe','material','0'),(45,'elbow','material','0'),(46,'box wire','material','0'),(47,'Breaker','material','0');
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
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` VALUES (1,'1','1','Clearing and Grubing','2016-07-09 00:00:00','2016-07-13 00:00:00','0000-00-00 00:00:00','2016-07-31 00:00:00','','','','',0,5,1,1,23,NULL,NULL,NULL,0),(2,'1','1','Excavation','2016-08-01 00:00:00','2016-08-12 00:00:00','0000-00-00 00:00:00','2016-07-31 00:00:00','','','','',1,12,1,0,0,NULL,NULL,NULL,0),(3,'1','1','Soil Poisoning','2016-08-01 00:00:00','2016-08-05 00:00:00','0000-00-00 00:00:00','2016-07-31 00:00:00','','','','',2,5,1,0,0,NULL,NULL,NULL,0),(4,'1','1','Gravel Bedding','2016-08-01 00:00:00','2016-08-05 00:00:00','0000-00-00 00:00:00','2016-07-31 00:00:00','','','','',3,5,1,0,0,NULL,NULL,NULL,0),(5,'1','2','Footings','2016-08-01 00:00:00','2016-08-07 00:00:00','0000-00-00 00:00:00','2016-07-31 00:00:00','','','','',4,7,1,0,0,NULL,NULL,NULL,0),(6,'1','2','Columns','2016-08-01 00:00:00','2016-08-15 00:00:00','0000-00-00 00:00:00','2016-07-31 00:00:00','','','','',5,15,1,0,0,NULL,NULL,NULL,0),(7,'1','2','Beams','2016-08-01 00:00:00','2016-08-11 00:00:00','0000-00-00 00:00:00','2016-07-31 00:00:00','','','','',6,11,1,0,0,NULL,NULL,NULL,0),(8,'1','2','Slabs','2016-08-01 00:00:00','2016-08-08 00:00:00','0000-00-00 00:00:00','2016-07-31 00:00:00','','','','',7,8,1,0,0,NULL,NULL,NULL,0),(9,'1','3','Footings','2016-08-01 00:00:00','2016-08-04 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,4,0,0,0,NULL,NULL,NULL,0),(10,'1','3','Columns','2016-08-01 00:00:00','2016-08-22 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,22,0,0,0,NULL,NULL,NULL,0),(11,'1','3','Beams','2016-08-01 00:00:00','2016-08-19 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,19,0,0,0,NULL,NULL,NULL,0),(12,'1','3','Slabs','2016-08-01 00:00:00','2016-08-10 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,10,0,0,0,NULL,NULL,NULL,0),(13,'1','4','Formworks and Scaffoldings','2016-08-01 00:00:00','2016-09-04 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,35,0,0,0,NULL,NULL,NULL,0),(14,'1','5','Mansory','2016-08-01 00:00:00','2016-09-10 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,41,0,0,0,NULL,NULL,NULL,0),(15,'1','6','Ceiling, Cabinets and Etc.','2016-09-11 00:00:00','2016-10-11 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',14,31,0,0,0,NULL,NULL,NULL,0),(16,'1','7','Roofing Materials, Trusses and etc.','2016-10-12 00:00:00','2016-10-23 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',15,12,0,0,0,NULL,NULL,NULL,0),(17,'1','8','Door','2016-10-24 00:00:00','2016-11-01 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',16,9,0,0,0,NULL,NULL,NULL,0),(18,'1','8','Windows','2016-11-02 00:00:00','2016-11-10 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',17,9,0,0,0,NULL,NULL,NULL,0),(19,'1','9','Exterior','2016-11-11 00:00:00','2016-12-04 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',18,24,0,0,0,NULL,NULL,NULL,0),(20,'1','10','Fixtures','2016-08-01 00:00:00','2016-08-02 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,2,0,0,0,NULL,NULL,NULL,0),(21,'1','10','Waterlines','2016-08-01 00:00:00','2016-08-12 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,12,0,0,0,NULL,NULL,NULL,0),(22,'1','10','Sanitary','2016-08-01 00:00:00','2016-08-12 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,12,0,0,0,NULL,NULL,NULL,0),(23,'1','10','Storm Drain','2016-08-01 00:00:00','2016-08-12 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,12,0,0,0,NULL,NULL,NULL,0),(24,'1','11','Fixtures and Boxes','2016-08-01 00:00:00','2016-08-03 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,3,0,0,0,NULL,NULL,NULL,0),(25,'1','11','Fittings','2016-08-01 00:00:00','2016-08-05 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,5,0,0,0,NULL,NULL,NULL,0),(26,'1','11','Wiring','2016-08-01 00:00:00','2016-08-10 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,10,0,0,0,NULL,NULL,NULL,0),(27,'1','11','Enclosed Circuit Breaker','2016-08-01 00:00:00','2016-08-02 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,2,0,0,0,NULL,NULL,NULL,0),(28,'1','11','Testing and Commissioning','2016-08-01 00:00:00','2016-08-02 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,2,0,0,0,NULL,NULL,NULL,0),(31,'1','16','Task 1','2016-08-01 00:00:00','2016-08-02 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,2,0,0,0,NULL,NULL,NULL,0),(32,'1','16','task 2','2016-08-01 00:00:00','2016-08-05 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',2,5,0,0,0,NULL,NULL,NULL,0),(33,'2','17','Clearing and Grubing','2016-07-09 00:00:00','2016-07-15 00:00:00','0000-00-00 00:00:00','2016-07-31 00:00:00','','','','',0,5,0,1,23,'Good day client,\n\nPlease be reminded that your presence is required to be at LOCATION B on 2016-07-29 for the Clearing and Grubing Task.\n\nThank you and looking forward to seeing you.\n\nAdministrator\nAdminboy',NULL,NULL,2),(34,'2','17','Excavation','2016-08-01 00:00:00','2016-08-12 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',33,12,0,0,0,'',NULL,NULL,0),(35,'2','17','Soil Poisoning','2016-08-13 00:00:00','2016-08-17 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',34,5,0,0,0,'',NULL,NULL,0),(36,'2','17','Gravel Bedding','2016-08-18 00:00:00','2016-08-22 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',35,5,0,0,0,'',NULL,NULL,0),(37,'2','18','Footings','2016-08-23 00:00:00','2016-08-29 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',36,7,0,0,0,'',NULL,NULL,0),(38,'2','18','Columns','2016-08-30 00:00:00','2016-09-13 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',37,15,0,0,0,'',NULL,NULL,0),(39,'2','18','Beams','2016-09-14 00:00:00','2016-09-24 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',38,11,0,0,0,'',NULL,NULL,0),(40,'2','18','Slabs','2016-09-25 00:00:00','2016-10-02 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',39,8,0,0,0,'',NULL,NULL,0),(41,'2','19','Footings','2016-08-01 00:00:00','2016-08-04 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',33,4,0,0,0,'',NULL,NULL,0),(42,'2','19','Columns','2016-08-01 00:00:00','2016-08-22 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',33,22,0,0,0,'',NULL,NULL,0),(43,'2','19','Beams','2016-08-01 00:00:00','2016-08-19 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',33,19,0,0,0,'',NULL,NULL,0),(44,'2','19','Slabs','2016-08-01 00:00:00','2016-08-10 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',33,10,0,0,0,'',NULL,NULL,0),(45,'2','20','Formworks and Scaffoldings','2016-08-01 00:00:00','2016-09-04 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',33,35,0,0,0,'',NULL,NULL,0),(46,'2','21','Mansory','2016-08-01 00:00:00','2016-09-10 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',33,41,0,0,0,'',NULL,NULL,0),(47,'2','22','Ceiling, Cabinets and Etc.','2016-09-11 00:00:00','2016-10-11 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',46,31,0,0,0,'',NULL,NULL,0),(48,'2','23','Roofing Materials, Trusses and etc.','2016-10-12 00:00:00','2016-10-23 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',47,12,0,0,0,'',NULL,NULL,0),(49,'2','24','Door','2016-10-24 00:00:00','2016-11-01 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',48,9,0,0,0,'',NULL,NULL,0),(50,'2','24','Windows','2016-11-02 00:00:00','2016-11-10 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',49,9,0,0,0,'',NULL,NULL,0),(51,'2','25','Exterior','2016-11-11 00:00:00','2016-12-04 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',50,24,0,0,0,'',NULL,NULL,0),(52,'2','26','Fixtures','2016-08-01 00:00:00','2016-08-02 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',33,2,0,0,0,'',NULL,NULL,0),(53,'2','26','Waterlines','2016-08-01 00:00:00','2016-08-12 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',33,12,0,0,0,'',NULL,NULL,0),(54,'2','26','Sanitary','2016-08-01 00:00:00','2016-08-12 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',33,12,0,0,0,'',NULL,NULL,0),(55,'2','26','Storm Drain','2016-08-01 00:00:00','2016-08-12 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',33,12,0,0,0,'',NULL,NULL,0),(56,'2','27','Fixtures and Boxes','2016-08-01 00:00:00','2016-08-03 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',33,3,0,0,0,'',NULL,NULL,0),(57,'2','27','Fittings','2016-08-01 00:00:00','2016-08-05 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',33,5,0,0,0,'',NULL,NULL,0),(58,'2','27','Wiring','2016-08-01 00:00:00','2016-08-10 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',33,10,0,0,0,'',NULL,NULL,0),(59,'2','27','Enclosed Circuit Breaker','2016-08-01 00:00:00','2016-08-02 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',33,2,0,0,0,'',NULL,NULL,0),(60,'2','27','Testing and Commissioning','2016-08-01 00:00:00','2016-08-02 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',33,2,0,0,0,'',NULL,NULL,0),(61,'3','28','Clearing and Grubing','2016-07-09 00:00:00','2016-07-13 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',0,5,0,0,0,'',NULL,NULL,0),(62,'3','28','Excavation','2016-08-05 00:00:00','2016-08-16 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',61,12,0,0,0,'',NULL,NULL,0),(63,'3','28','Soil Poisoning','2016-08-17 00:00:00','2016-08-21 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',62,5,0,0,0,'',NULL,NULL,0),(64,'3','28','Gravel Bedding','2016-08-22 00:00:00','2016-08-26 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',63,5,0,0,0,'',NULL,NULL,0),(65,'3','29','Footings','2016-08-27 00:00:00','2016-09-02 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',64,7,0,0,0,'',NULL,NULL,0),(66,'3','29','Columns','2016-09-03 00:00:00','2016-09-17 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',65,15,0,0,0,'',NULL,NULL,0),(67,'3','29','Beams','2016-09-18 00:00:00','2016-09-28 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',66,11,0,0,0,'',NULL,NULL,0),(68,'3','29','Slabs','2016-09-29 00:00:00','2016-10-06 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',67,8,0,0,0,'',NULL,NULL,0),(69,'3','30','Footings','2016-08-05 00:00:00','2016-08-08 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',61,4,0,0,0,'',NULL,NULL,0),(70,'3','30','Columns','2016-08-05 00:00:00','2016-08-26 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',61,22,0,0,0,'',NULL,NULL,0),(71,'3','30','Beams','2016-08-05 00:00:00','2016-08-24 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',61,19,0,0,0,'',NULL,NULL,0),(72,'3','30','Slabs','2016-08-05 00:00:00','2016-08-14 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',61,10,0,0,0,'',NULL,NULL,0),(73,'3','31','Formworks and Scaffoldings','2016-08-05 00:00:00','2016-09-08 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',61,35,0,0,0,'',NULL,NULL,0),(74,'3','32','Mansory','2016-08-05 00:00:00','2016-09-14 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',61,41,0,0,0,'',NULL,NULL,0),(75,'3','33','Ceiling, Cabinets and Etc.','2016-09-15 00:00:00','2016-10-15 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',74,31,0,0,0,'',NULL,NULL,0),(76,'3','34','Roofing Materials, Trusses and etc.','2016-10-16 00:00:00','2016-10-27 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',75,12,0,0,0,'',NULL,NULL,0),(77,'3','35','Door','2016-10-28 00:00:00','2016-11-06 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',76,9,0,0,0,'',NULL,NULL,0),(78,'3','35','Windows','2016-11-07 00:00:00','2016-11-16 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',77,9,0,0,0,'',NULL,NULL,0),(79,'3','36','Exterior','2016-11-17 00:00:00','2016-12-10 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',78,24,0,0,0,'',NULL,NULL,0),(80,'3','37','Fixtures','2016-08-05 00:00:00','2016-08-06 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',61,2,0,0,0,'',NULL,NULL,0),(81,'3','37','Waterlines','2016-08-05 00:00:00','2016-08-16 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',61,12,0,0,0,'',NULL,NULL,0),(82,'3','37','Sanitary','2016-08-05 00:00:00','2016-08-16 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',61,12,0,0,0,'',NULL,NULL,0),(83,'3','37','Storm Drain','2016-08-05 00:00:00','2016-08-16 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',61,12,0,0,0,'',NULL,NULL,0),(84,'3','38','Fixtures and Boxes','2016-08-05 00:00:00','2016-08-07 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',61,3,0,0,0,'',NULL,NULL,0),(85,'3','38','Fittings','2016-08-05 00:00:00','2016-08-09 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',61,5,0,0,0,'',NULL,NULL,0),(86,'3','38','Wiring','2016-08-05 00:00:00','2016-08-14 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',61,10,0,0,0,'',NULL,NULL,0),(87,'3','38','Enclosed Circuit Breaker','2016-08-05 00:00:00','2016-08-06 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',61,2,0,0,0,'',NULL,NULL,0),(88,'3','38','Testing and Commissioning','2016-08-05 00:00:00','2016-08-06 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',61,2,0,0,0,'',NULL,NULL,0),(89,'4','39','Clearing and Grubing','2016-07-31 00:00:00','2016-08-04 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',0,5,0,0,0,'',NULL,NULL,0),(90,'4','39','Excavation','2016-08-05 00:00:00','2016-08-16 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',89,12,0,0,0,'',NULL,NULL,0),(91,'4','39','Soil Poisoning','2016-08-17 00:00:00','2016-08-21 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',90,5,0,0,0,'',NULL,NULL,0),(92,'4','39','Gravel Bedding','2016-08-22 00:00:00','2016-08-26 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',91,5,0,0,0,'',NULL,NULL,0),(93,'4','40','Footings','2016-08-27 00:00:00','2016-09-02 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',92,7,0,0,0,'',NULL,NULL,0),(94,'4','40','Columns','2016-09-03 00:00:00','2016-09-17 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',93,15,0,0,0,'',NULL,NULL,0),(95,'4','40','Beams','2016-09-18 00:00:00','2016-09-28 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',94,11,0,0,0,'',NULL,NULL,0),(96,'4','40','Slabs','2016-09-29 00:00:00','2016-10-06 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',95,8,0,0,0,'',NULL,NULL,0),(97,'4','41','Footings','2016-08-05 00:00:00','2016-08-08 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',89,4,0,0,0,'',NULL,NULL,0),(98,'4','41','Columns','2016-08-05 00:00:00','2016-08-26 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',89,22,0,0,0,'',NULL,NULL,0),(99,'4','41','Beams','2016-08-05 00:00:00','2016-08-24 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',89,19,0,0,0,'',NULL,NULL,0),(100,'4','41','Slabs','2016-08-05 00:00:00','2016-08-14 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',89,10,0,0,0,'',NULL,NULL,0),(101,'4','42','Formworks and Scaffoldings','2016-08-05 00:00:00','2016-09-08 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',89,35,0,0,0,'',NULL,NULL,0),(102,'4','43','Mansory','2016-08-05 00:00:00','2016-09-14 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',89,41,0,0,0,'',NULL,NULL,0),(103,'4','44','Ceiling, Cabinets and Etc.','2016-09-15 00:00:00','2016-10-15 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',102,31,0,0,0,'',NULL,NULL,0),(104,'4','45','Roofing Materials, Trusses and etc.','2016-10-16 00:00:00','2016-10-27 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',103,12,0,0,0,'',NULL,NULL,0),(105,'4','46','Door','2016-10-28 00:00:00','2016-11-06 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',104,9,0,0,0,'',NULL,NULL,0),(106,'4','46','Windows','2016-11-07 00:00:00','2016-11-16 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',105,9,0,0,0,'',NULL,NULL,0),(107,'4','47','Exterior','2016-11-17 00:00:00','2016-12-10 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',106,24,0,0,0,'',NULL,NULL,0),(108,'4','48','Fixtures','2016-08-05 00:00:00','2016-08-06 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',89,2,0,0,0,'',NULL,NULL,0),(109,'4','48','Waterlines','2016-08-05 00:00:00','2016-08-16 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',89,12,0,0,0,'',NULL,NULL,0),(110,'4','48','Sanitary','2016-08-05 00:00:00','2016-08-16 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',89,12,0,0,0,'',NULL,NULL,0),(111,'4','48','Storm Drain','2016-08-05 00:00:00','2016-08-16 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',89,12,0,0,0,'',NULL,NULL,0),(112,'4','49','Fixtures and Boxes','2016-08-05 00:00:00','2016-08-07 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',89,3,0,0,0,'',NULL,NULL,0),(113,'4','49','Fittings','2016-08-05 00:00:00','2016-08-09 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',89,5,0,0,0,'',NULL,NULL,0),(114,'4','49','Wiring','2016-08-05 00:00:00','2016-08-14 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',89,10,0,0,0,'',NULL,NULL,0),(115,'4','49','Enclosed Circuit Breaker','2016-08-05 00:00:00','2016-08-06 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',89,2,0,0,0,'',NULL,NULL,0),(116,'4','49','Testing and Commissioning','2016-08-05 00:00:00','2016-08-06 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',89,2,0,0,0,'',NULL,NULL,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=454 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_resources`
--

LOCK TABLES `task_resources` WRITE;
/*!40000 ALTER TABLE `task_resources` DISABLE KEYS */;
INSERT INTO `task_resources` VALUES (1,1,1,1,1,0,0,1,0,NULL),(2,1,1,2,2,0,0,2,0,NULL),(3,1,1,3,3,0,0,3,0,NULL),(4,1,2,3,1,0,0,1,0,NULL),(5,1,2,4,3,0,0,3,0,NULL),(6,1,3,2,1,0,0,1,0,NULL),(7,1,4,2,2,0,0,2,0,NULL),(8,1,5,5,1,0,0,1,0,NULL),(9,1,5,2,3,0,0,3,0,NULL),(10,1,5,6,1,0,0,1,0,NULL),(11,1,5,7,49,0,0,49,0,NULL),(12,1,5,8,2,0,0,2,0,NULL),(13,1,5,9,4,0,0,4,0,NULL),(14,1,5,41,1,0,0,1,0,NULL),(15,1,6,10,3,0,0,3,0,NULL),(16,1,6,5,3,0,0,3,0,NULL),(17,1,6,2,5,0,0,5,0,NULL),(18,1,6,7,75,0,0,75,0,NULL),(19,1,6,8,5,0,0,5,0,NULL),(20,1,6,9,10,0,0,10,0,NULL),(21,1,7,10,5,0,0,5,0,NULL),(22,1,7,5,3,0,0,3,0,NULL),(23,1,7,2,5,0,0,5,0,NULL),(24,1,7,7,55,0,0,55,0,NULL),(25,1,7,8,5,0,0,5,0,NULL),(26,1,7,9,9,0,0,9,0,NULL),(27,1,8,5,2,0,0,2,0,NULL),(28,1,8,10,2,0,0,2,0,NULL),(29,1,8,2,4,0,0,4,0,NULL),(30,1,8,7,52,0,0,52,0,NULL),(31,1,8,8,5,0,0,5,0,NULL),(32,1,8,9,9,0,0,9,0,NULL),(33,1,9,11,1,0,0,1,0,NULL),(34,1,9,2,1,0,0,1,0,NULL),(35,1,9,4,25,0,0,25,0,NULL),(36,1,10,12,2,0,0,2,0,NULL),(37,1,10,2,1,0,0,1,0,NULL),(38,1,10,4,68,0,0,68,0,NULL),(39,1,10,13,145,0,0,145,0,NULL),(40,1,10,14,285,0,0,285,0,NULL),(41,1,11,12,2,0,0,2,0,NULL),(42,1,11,2,1,0,0,1,0,NULL),(43,1,11,4,57,0,0,57,0,NULL),(44,1,11,13,105,0,0,105,0,NULL),(45,1,11,14,150,0,0,150,0,NULL),(46,1,12,12,2,0,0,2,0,NULL),(47,1,12,2,1,0,0,1,0,NULL),(48,1,12,14,165,0,0,165,0,NULL),(49,1,13,2,3,0,0,3,0,NULL),(50,1,13,10,5,0,0,5,0,NULL),(51,1,13,15,1050,0,0,1050,0,NULL),(52,1,13,16,75,0,0,75,0,NULL),(53,1,14,5,5,0,0,5,0,NULL),(54,1,14,2,3,0,0,3,0,NULL),(55,1,14,17,1042,0,0,1042,0,NULL),(56,1,14,18,469,0,0,469,0,NULL),(57,1,15,12,2,0,0,2,0,NULL),(58,1,15,2,1,0,0,1,0,NULL),(59,1,15,16,56,0,0,56,0,NULL),(60,1,15,19,235,0,0,235,0,NULL),(61,1,16,10,5,0,0,5,0,NULL),(62,1,16,2,3,0,0,3,0,NULL),(63,1,16,20,17,0,0,17,0,NULL),(64,1,16,21,1292,0,0,1292,0,NULL),(65,1,16,22,138,0,0,138,0,NULL),(66,1,17,10,2,0,0,2,0,NULL),(67,1,17,2,2,0,0,2,0,NULL),(68,1,17,23,2,0,0,2,0,NULL),(69,1,18,10,2,0,0,2,0,NULL),(70,1,18,2,2,0,0,2,0,NULL),(71,1,18,23,14,0,0,14,0,NULL),(72,1,19,26,4,0,0,4,0,NULL),(73,1,19,24,10,0,0,10,0,NULL),(74,1,19,25,3,0,0,3,0,NULL),(75,1,19,27,1,0,0,1,0,NULL),(76,1,19,28,5,0,0,5,0,NULL),(77,1,19,29,3,0,0,3,0,NULL),(78,1,20,30,2,0,0,2,0,NULL),(79,1,20,2,1,0,0,1,0,NULL),(80,1,20,31,1,0,0,1,0,NULL),(81,1,20,32,22,0,0,22,0,NULL),(82,1,20,33,22,0,0,22,0,NULL),(83,1,20,34,22,0,0,22,0,NULL),(84,1,21,30,1,0,0,1,0,NULL),(85,1,21,2,1,0,0,1,0,NULL),(86,1,21,35,5,0,0,5,0,NULL),(87,1,21,36,20,0,0,20,0,NULL),(88,1,21,37,3,0,0,3,0,NULL),(89,1,22,30,1,0,0,1,0,NULL),(90,1,22,2,1,0,0,1,0,NULL),(91,1,22,38,4,0,0,4,0,NULL),(92,1,22,39,3,0,0,3,0,NULL),(93,1,22,40,2,0,0,2,0,NULL),(94,1,23,30,1,0,0,1,0,NULL),(95,1,23,2,1,0,0,1,0,NULL),(96,1,23,39,15,0,0,15,0,NULL),(97,1,24,42,1,0,0,1,0,NULL),(98,1,24,2,1,0,0,1,0,NULL),(99,1,24,43,3,0,0,3,0,NULL),(100,1,24,44,5,0,0,5,0,NULL),(101,1,25,42,2,0,0,2,0,NULL),(102,1,25,2,2,0,0,2,0,NULL),(103,1,25,45,100,0,0,100,0,NULL),(104,1,26,42,2,0,0,2,0,NULL),(105,1,26,2,2,0,0,2,0,NULL),(106,1,26,46,5,0,0,5,0,NULL),(107,1,27,42,1,0,0,1,0,NULL),(108,1,27,47,8,0,0,8,0,NULL),(109,1,28,42,1,0,0,1,0,NULL),(110,1,28,2,1,0,0,1,0,NULL),(111,1,29,21,5,0,0,5,0,NULL),(112,1,30,25,2,0,0,2,0,NULL),(113,1,31,21,5,0,0,5,0,NULL),(114,1,32,25,2,0,0,2,0,NULL),(115,2,33,1,1,0,0,1,0,NULL),(116,2,33,2,30,0,0,12,0,NULL),(117,2,33,3,3,0,0,3,0,NULL),(118,2,34,3,1,0,0,1,0,NULL),(119,2,34,4,3,0,0,3,0,NULL),(120,2,35,2,1,0,0,1,0,NULL),(121,2,36,2,2,0,0,2,0,NULL),(122,2,37,5,1,0,0,1,0,NULL),(123,2,37,2,3,0,0,3,0,NULL),(124,2,37,6,1,0,0,1,0,NULL),(125,2,37,7,49,0,0,49,0,NULL),(126,2,37,8,2,0,0,2,0,NULL),(127,2,37,9,4,0,0,4,0,NULL),(128,2,37,41,1,0,0,1,0,NULL),(129,2,38,10,3,0,0,3,0,NULL),(130,2,38,5,3,0,0,3,0,NULL),(131,2,38,2,5,0,0,5,0,NULL),(132,2,38,7,75,0,0,75,0,NULL),(133,2,38,8,5,0,0,5,0,NULL),(134,2,38,9,10,0,0,10,0,NULL),(135,2,39,10,5,0,0,5,0,NULL),(136,2,39,5,3,0,0,3,0,NULL),(137,2,39,2,5,0,0,5,0,NULL),(138,2,39,7,55,0,0,55,0,NULL),(139,2,39,8,5,0,0,5,0,NULL),(140,2,39,9,9,0,0,9,0,NULL),(141,2,40,5,2,0,0,2,0,NULL),(142,2,40,10,2,0,0,2,0,NULL),(143,2,40,2,4,0,0,4,0,NULL),(144,2,40,7,52,0,0,52,0,NULL),(145,2,40,8,5,0,0,5,0,NULL),(146,2,40,9,9,0,0,9,0,NULL),(147,2,41,11,1,0,0,1,0,NULL),(148,2,41,2,1,0,0,1,0,NULL),(149,2,41,4,25,0,0,25,0,NULL),(150,2,42,12,2,0,0,2,0,NULL),(151,2,42,2,1,0,0,1,0,NULL),(152,2,42,4,68,0,0,68,0,NULL),(153,2,42,13,145,0,0,145,0,NULL),(154,2,42,14,285,0,0,285,0,NULL),(155,2,43,12,2,0,0,2,0,NULL),(156,2,43,2,1,0,0,1,0,NULL),(157,2,43,4,57,0,0,57,0,NULL),(158,2,43,13,105,0,0,105,0,NULL),(159,2,43,14,150,0,0,150,0,NULL),(160,2,44,12,2,0,0,2,0,NULL),(161,2,44,2,1,0,0,1,0,NULL),(162,2,44,14,165,0,0,165,0,NULL),(163,2,45,2,3,0,0,3,0,NULL),(164,2,45,10,5,0,0,5,0,NULL),(165,2,45,15,1050,0,0,1050,0,NULL),(166,2,45,16,75,0,0,75,0,NULL),(167,2,46,5,5,0,0,5,0,NULL),(168,2,46,2,3,0,0,3,0,NULL),(169,2,46,17,1042,0,0,1042,0,NULL),(170,2,46,18,469,0,0,469,0,NULL),(171,2,47,12,2,0,0,2,0,NULL),(172,2,47,2,1,0,0,1,0,NULL),(173,2,47,16,56,0,0,56,0,NULL),(174,2,47,19,235,0,0,235,0,NULL),(175,2,48,10,5,0,0,5,0,NULL),(176,2,48,2,3,0,0,3,0,NULL),(177,2,48,20,17,0,0,17,0,NULL),(178,2,48,21,1292,0,0,1292,0,NULL),(179,2,48,22,138,0,0,138,0,NULL),(180,2,49,10,2,0,0,2,0,NULL),(181,2,49,2,2,0,0,2,0,NULL),(182,2,49,23,2,0,0,2,0,NULL),(183,2,50,10,2,0,0,2,0,NULL),(184,2,50,2,2,0,0,2,0,NULL),(185,2,50,23,14,0,0,14,0,NULL),(186,2,51,26,4,0,0,4,0,NULL),(187,2,51,24,10,0,0,10,0,NULL),(188,2,51,25,3,0,0,3,0,NULL),(189,2,51,27,1,0,0,1,0,NULL),(190,2,51,28,5,0,0,5,0,NULL),(191,2,51,29,3,0,0,3,0,NULL),(192,2,52,30,2,0,0,2,0,NULL),(193,2,52,2,1,0,0,1,0,NULL),(194,2,52,31,1,0,0,1,0,NULL),(195,2,52,32,22,0,0,22,0,NULL),(196,2,52,33,22,0,0,22,0,NULL),(197,2,52,34,22,0,0,22,0,NULL),(198,2,53,30,1,0,0,1,0,NULL),(199,2,53,2,1,0,0,1,0,NULL),(200,2,53,35,5,0,0,5,0,NULL),(201,2,53,36,20,0,0,20,0,NULL),(202,2,53,37,3,0,0,3,0,NULL),(203,2,54,30,1,0,0,1,0,NULL),(204,2,54,2,1,0,0,1,0,NULL),(205,2,54,38,4,0,0,4,0,NULL),(206,2,54,39,3,0,0,3,0,NULL),(207,2,54,40,2,0,0,2,0,NULL),(208,2,55,30,1,0,0,1,0,NULL),(209,2,55,2,1,0,0,1,0,NULL),(210,2,55,39,15,0,0,15,0,NULL),(211,2,56,42,1,0,0,1,0,NULL),(212,2,56,2,1,0,0,1,0,NULL),(213,2,56,43,3,0,0,3,0,NULL),(214,2,56,44,5,0,0,5,0,NULL),(215,2,57,42,2,0,0,2,0,NULL),(216,2,57,2,2,0,0,2,0,NULL),(217,2,57,45,100,0,0,100,0,NULL),(218,2,58,42,2,0,0,2,0,NULL),(219,2,58,2,2,0,0,2,0,NULL),(220,2,58,46,5,0,0,5,0,NULL),(221,2,59,42,1,0,0,1,0,NULL),(222,2,59,47,8,0,0,8,0,NULL),(223,2,60,42,1,0,0,1,0,NULL),(224,2,60,2,1,0,0,1,0,NULL),(225,1,1,32,2,0,0,2,1,1),(226,1,1,15,2,0,0,2,1,2),(227,1,2,45,5,0,0,5,1,3),(228,1,3,32,1,0,0,1,1,5),(229,1,3,24,2,0,0,2,1,6),(234,3,61,1,1,0,0,1,0,NULL),(235,3,61,2,2,0,0,2,0,NULL),(236,3,61,3,3,0,0,3,0,NULL),(237,3,62,3,1,0,0,1,0,NULL),(238,3,62,4,3,0,0,3,0,NULL),(239,3,63,2,1,0,0,1,0,NULL),(240,3,64,2,2,0,0,2,0,NULL),(241,3,65,5,1,0,0,1,0,NULL),(242,3,65,2,3,0,0,3,0,NULL),(243,3,65,6,1,0,0,1,0,NULL),(244,3,65,7,49,0,0,49,0,NULL),(245,3,65,8,2,0,0,2,0,NULL),(246,3,65,9,4,0,0,4,0,NULL),(247,3,65,41,1,0,0,1,0,NULL),(248,3,66,10,3,0,0,3,0,NULL),(249,3,66,5,3,0,0,3,0,NULL),(250,3,66,2,5,0,0,5,0,NULL),(251,3,66,7,75,0,0,75,0,NULL),(252,3,66,8,5,0,0,5,0,NULL),(253,3,66,9,10,0,0,10,0,NULL),(254,3,67,10,5,0,0,5,0,NULL),(255,3,67,5,3,0,0,3,0,NULL),(256,3,67,2,5,0,0,5,0,NULL),(257,3,67,7,55,0,0,55,0,NULL),(258,3,67,8,5,0,0,5,0,NULL),(259,3,67,9,9,0,0,9,0,NULL),(260,3,68,5,2,0,0,2,0,NULL),(261,3,68,10,2,0,0,2,0,NULL),(262,3,68,2,4,0,0,4,0,NULL),(263,3,68,7,52,0,0,52,0,NULL),(264,3,68,8,5,0,0,5,0,NULL),(265,3,68,9,9,0,0,9,0,NULL),(266,3,69,11,1,0,0,1,0,NULL),(267,3,69,2,1,0,0,1,0,NULL),(268,3,69,4,25,0,0,25,0,NULL),(269,3,70,12,2,0,0,2,0,NULL),(270,3,70,2,1,0,0,1,0,NULL),(271,3,70,4,68,0,0,68,0,NULL),(272,3,70,13,145,0,0,145,0,NULL),(273,3,70,14,285,0,0,285,0,NULL),(274,3,71,12,2,0,0,2,0,NULL),(275,3,71,2,1,0,0,1,0,NULL),(276,3,71,4,57,0,0,57,0,NULL),(277,3,71,13,105,0,0,105,0,NULL),(278,3,71,14,150,0,0,150,0,NULL),(279,3,72,12,2,0,0,2,0,NULL),(280,3,72,2,1,0,0,1,0,NULL),(281,3,72,14,165,0,0,165,0,NULL),(282,3,73,2,3,0,0,3,0,NULL),(283,3,73,10,5,0,0,5,0,NULL),(284,3,73,15,1050,0,0,1050,0,NULL),(285,3,73,16,75,0,0,75,0,NULL),(286,3,74,5,5,0,0,5,0,NULL),(287,3,74,2,3,0,0,3,0,NULL),(288,3,74,17,1042,0,0,1042,0,NULL),(289,3,74,18,469,0,0,469,0,NULL),(290,3,75,12,2,0,0,2,0,NULL),(291,3,75,2,1,0,0,1,0,NULL),(292,3,75,16,56,0,0,56,0,NULL),(293,3,75,19,235,0,0,235,0,NULL),(294,3,76,10,5,0,0,5,0,NULL),(295,3,76,2,3,0,0,3,0,NULL),(296,3,76,20,17,0,0,17,0,NULL),(297,3,76,21,1292,0,0,1292,0,NULL),(298,3,76,22,138,0,0,138,0,NULL),(299,3,77,10,2,0,0,2,0,NULL),(300,3,77,2,2,0,0,2,0,NULL),(301,3,77,23,2,0,0,2,0,NULL),(302,3,78,10,2,0,0,2,0,NULL),(303,3,78,2,2,0,0,2,0,NULL),(304,3,78,23,14,0,0,14,0,NULL),(305,3,79,26,4,0,0,4,0,NULL),(306,3,79,24,10,0,0,10,0,NULL),(307,3,79,25,3,0,0,3,0,NULL),(308,3,79,27,1,0,0,1,0,NULL),(309,3,79,28,5,0,0,5,0,NULL),(310,3,79,29,3,0,0,3,0,NULL),(311,3,80,30,2,0,0,2,0,NULL),(312,3,80,2,1,0,0,1,0,NULL),(313,3,80,31,1,0,0,1,0,NULL),(314,3,80,32,22,0,0,22,0,NULL),(315,3,80,33,22,0,0,22,0,NULL),(316,3,80,34,22,0,0,22,0,NULL),(317,3,81,30,1,0,0,1,0,NULL),(318,3,81,2,1,0,0,1,0,NULL),(319,3,81,35,5,0,0,5,0,NULL),(320,3,81,36,20,0,0,20,0,NULL),(321,3,81,37,3,0,0,3,0,NULL),(322,3,82,30,1,0,0,1,0,NULL),(323,3,82,2,1,0,0,1,0,NULL),(324,3,82,38,4,0,0,4,0,NULL),(325,3,82,39,3,0,0,3,0,NULL),(326,3,82,40,2,0,0,2,0,NULL),(327,3,83,30,1,0,0,1,0,NULL),(328,3,83,2,1,0,0,1,0,NULL),(329,3,83,39,15,0,0,15,0,NULL),(330,3,84,42,1,0,0,1,0,NULL),(331,3,84,2,1,0,0,1,0,NULL),(332,3,84,43,3,0,0,3,0,NULL),(333,3,84,44,5,0,0,5,0,NULL),(334,3,85,42,2,0,0,2,0,NULL),(335,3,85,2,2,0,0,2,0,NULL),(336,3,85,45,100,0,0,100,0,NULL),(337,3,86,42,2,0,0,2,0,NULL),(338,3,86,2,2,0,0,2,0,NULL),(339,3,86,46,5,0,0,5,0,NULL),(340,3,87,42,1,0,0,1,0,NULL),(341,3,87,47,8,0,0,8,0,NULL),(342,3,88,42,1,0,0,1,0,NULL),(343,3,88,2,1,0,0,1,0,NULL),(344,4,89,1,1,0,0,1,0,NULL),(345,4,89,2,2,0,0,2,0,NULL),(346,4,89,3,3,0,0,3,0,NULL),(347,4,90,3,1,0,0,1,0,NULL),(348,4,90,4,3,0,0,3,0,NULL),(349,4,91,2,1,0,0,1,0,NULL),(350,4,92,2,2,0,0,2,0,NULL),(351,4,93,5,1,0,0,1,0,NULL),(352,4,93,2,3,0,0,3,0,NULL),(353,4,93,6,1,0,0,1,0,NULL),(354,4,93,7,49,0,0,49,0,NULL),(355,4,93,8,2,0,0,2,0,NULL),(356,4,93,9,4,0,0,4,0,NULL),(357,4,93,41,1,0,0,1,0,NULL),(358,4,94,10,3,0,0,3,0,NULL),(359,4,94,5,3,0,0,3,0,NULL),(360,4,94,2,5,0,0,5,0,NULL),(361,4,94,7,75,0,0,75,0,NULL),(362,4,94,8,5,0,0,5,0,NULL),(363,4,94,9,10,0,0,10,0,NULL),(364,4,95,10,5,0,0,5,0,NULL),(365,4,95,5,3,0,0,3,0,NULL),(366,4,95,2,5,0,0,5,0,NULL),(367,4,95,7,55,0,0,55,0,NULL),(368,4,95,8,5,0,0,5,0,NULL),(369,4,95,9,9,0,0,9,0,NULL),(370,4,96,5,2,0,0,2,0,NULL),(371,4,96,10,2,0,0,2,0,NULL),(372,4,96,2,4,0,0,4,0,NULL),(373,4,96,7,52,0,0,52,0,NULL),(374,4,96,8,5,0,0,5,0,NULL),(375,4,96,9,9,0,0,9,0,NULL),(376,4,97,11,1,0,0,1,0,NULL),(377,4,97,2,1,0,0,1,0,NULL),(378,4,97,4,25,0,0,25,0,NULL),(379,4,98,12,2,0,0,2,0,NULL),(380,4,98,2,1,0,0,1,0,NULL),(381,4,98,4,68,0,0,68,0,NULL),(382,4,98,13,145,0,0,145,0,NULL),(383,4,98,14,285,0,0,285,0,NULL),(384,4,99,12,2,0,0,2,0,NULL),(385,4,99,2,1,0,0,1,0,NULL),(386,4,99,4,57,0,0,57,0,NULL),(387,4,99,13,105,0,0,105,0,NULL),(388,4,99,14,150,0,0,150,0,NULL),(389,4,100,12,2,0,0,2,0,NULL),(390,4,100,2,1,0,0,1,0,NULL),(391,4,100,14,165,0,0,165,0,NULL),(392,4,101,2,3,0,0,3,0,NULL),(393,4,101,10,5,0,0,5,0,NULL),(394,4,101,15,1050,0,0,1050,0,NULL),(395,4,101,16,75,0,0,75,0,NULL),(396,4,102,5,5,0,0,5,0,NULL),(397,4,102,2,3,0,0,3,0,NULL),(398,4,102,17,1042,0,0,1042,0,NULL),(399,4,102,18,469,0,0,469,0,NULL),(400,4,103,12,2,0,0,2,0,NULL),(401,4,103,2,1,0,0,1,0,NULL),(402,4,103,16,56,0,0,56,0,NULL),(403,4,103,19,235,0,0,235,0,NULL),(404,4,104,10,5,0,0,5,0,NULL),(405,4,104,2,3,0,0,3,0,NULL),(406,4,104,20,17,0,0,17,0,NULL),(407,4,104,21,1292,0,0,1292,0,NULL),(408,4,104,22,138,0,0,138,0,NULL),(409,4,105,10,2,0,0,2,0,NULL),(410,4,105,2,2,0,0,2,0,NULL),(411,4,105,23,2,0,0,2,0,NULL),(412,4,106,10,2,0,0,2,0,NULL),(413,4,106,2,2,0,0,2,0,NULL),(414,4,106,23,14,0,0,14,0,NULL),(415,4,107,26,4,0,0,4,0,NULL),(416,4,107,24,10,0,0,10,0,NULL),(417,4,107,25,3,0,0,3,0,NULL),(418,4,107,27,1,0,0,1,0,NULL),(419,4,107,28,5,0,0,5,0,NULL),(420,4,107,29,3,0,0,3,0,NULL),(421,4,108,30,2,0,0,2,0,NULL),(422,4,108,2,1,0,0,1,0,NULL),(423,4,108,31,1,0,0,1,0,NULL),(424,4,108,32,22,0,0,22,0,NULL),(425,4,108,33,22,0,0,22,0,NULL),(426,4,108,34,22,0,0,22,0,NULL),(427,4,109,30,1,0,0,1,0,NULL),(428,4,109,2,1,0,0,1,0,NULL),(429,4,109,35,5,0,0,5,0,NULL),(430,4,109,36,20,0,0,20,0,NULL),(431,4,109,37,3,0,0,3,0,NULL),(432,4,110,30,1,0,0,1,0,NULL),(433,4,110,2,1,0,0,1,0,NULL),(434,4,110,38,4,0,0,4,0,NULL),(435,4,110,39,3,0,0,3,0,NULL),(436,4,110,40,2,0,0,2,0,NULL),(437,4,111,30,1,0,0,1,0,NULL),(438,4,111,2,1,0,0,1,0,NULL),(439,4,111,39,15,0,0,15,0,NULL),(440,4,112,42,1,0,0,1,0,NULL),(441,4,112,2,1,0,0,1,0,NULL),(442,4,112,43,3,0,0,3,0,NULL),(443,4,112,44,5,0,0,5,0,NULL),(444,4,113,42,2,0,0,2,0,NULL),(445,4,113,2,2,0,0,2,0,NULL),(446,4,113,45,100,0,0,100,0,NULL),(447,4,114,42,2,0,0,2,0,NULL),(448,4,114,2,2,0,0,2,0,NULL),(449,4,114,46,5,0,0,5,0,NULL),(450,4,115,42,1,0,0,1,0,NULL),(451,4,115,47,8,0,0,8,0,NULL),(452,4,116,42,1,0,0,1,0,NULL),(453,4,116,2,1,0,0,1,0,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_resources_additional`
--

LOCK TABLES `task_resources_additional` WRITE;
/*!40000 ALTER TABLE `task_resources_additional` DISABLE KEYS */;
INSERT INTO `task_resources_additional` VALUES (1,0,1,0,0,0,0,0,'Add ko bakit'),(2,0,1,0,0,0,0,0,'Bagong reason'),(3,0,2,0,0,0,0,0,'kinulang e'),(4,0,2,0,0,0,0,0,'kulang ulit e'),(5,0,3,0,0,0,0,0,'kulang e '),(6,0,3,0,0,0,0,0,'kulang e');
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

-- Dump completed on 2016-07-31 20:53:16
