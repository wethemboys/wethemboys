CREATE DATABASE  IF NOT EXISTS `evypms` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `evypms`;
-- MySQL dump 10.13  Distrib 5.5.44, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: evypms
-- ------------------------------------------------------
-- Server version	5.5.44-0ubuntu0.12.04.1

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
  PRIMARY KEY (`ActivityID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activities`
--

LOCK TABLES `activities` WRITE;
/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
INSERT INTO `activities` VALUES (1,'1','Earthworks','2016-07-26 00:00:00','2016-08-21 00:00:00','0',0,'0'),(2,'1','Concrete Works','2016-08-22 00:00:00','2016-10-01 00:00:00','0',0,'0'),(3,'1','Steel Works','2016-07-31 00:00:00','2016-08-21 00:00:00','0',0,'0'),(4,'1','Framework','2016-07-31 00:00:00','2016-09-03 00:00:00','0',0,'0'),(5,'1','Mansory Works','2016-07-31 00:00:00','2016-09-09 00:00:00','0',0,'0'),(6,'1','Carpentry Works','2016-09-10 00:00:00','2016-10-10 00:00:00','0',0,'0'),(7,'1','Roofing Works','2016-10-11 00:00:00','2016-10-22 00:00:00','0',0,'0'),(8,'1','Pre-Fabricated Works','2016-10-23 00:00:00','2016-11-11 00:00:00','0',0,'0'),(9,'1','Painting Works','2016-11-12 00:00:00','2016-12-05 00:00:00','0',0,'0'),(10,'1','Plumbing','2016-07-31 00:00:00','2016-08-11 00:00:00','0',0,'0'),(11,'1',' Electrical Works','2016-07-31 00:00:00','2016-08-09 00:00:00','0',0,'0'),(16,'1','Additional Activity','0000-00-00 00:00:00','0000-00-00 00:00:00','',0,'');
/*!40000 ALTER TABLE `activities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task` (
  `TaskID` int(11) NOT NULL,
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
  PRIMARY KEY (`TaskID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` VALUES (1,'1','1','Clearing and Grubing','2016-07-26 00:00:00','2016-07-30 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',0,5,0,0,0),(2,'1','1','Excavation','2016-07-31 00:00:00','2016-08-11 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,12,0,0,0),(3,'1','1','Soil Poisoning','2016-08-12 00:00:00','2016-08-16 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',2,5,0,0,0),(4,'1','1','Gravel Bedding','2016-08-17 00:00:00','2016-08-21 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',3,5,0,0,0),(5,'1','2','Footings','2016-08-22 00:00:00','2016-08-28 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',4,7,0,0,0),(6,'1','2','Columns','2016-08-29 00:00:00','2016-09-12 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',5,15,0,0,0),(7,'1','2','Beams','2016-09-13 00:00:00','2016-09-23 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',6,11,0,0,0),(8,'1','2','Slabs','2016-09-24 00:00:00','2016-10-01 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',7,8,0,0,0),(9,'1','3','Footings','2016-07-31 00:00:00','2016-08-03 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,4,0,0,0),(10,'1','3','Columns','2016-07-31 00:00:00','2016-08-21 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,22,0,0,0),(11,'1','3','Beams','2016-07-31 00:00:00','2016-08-19 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,19,0,0,0),(12,'1','3','Slabs','2016-07-31 00:00:00','2016-08-09 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,10,0,0,0),(13,'1','4','Formworks and Scaffoldings','2016-07-31 00:00:00','2016-09-03 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,35,0,0,0),(14,'1','5','Mansory','2016-07-31 00:00:00','2016-09-09 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,41,0,0,0),(15,'1','6','Ceiling, Cabinets and Etc.','2016-09-10 00:00:00','2016-10-10 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',14,31,0,0,0),(16,'1','7','Roofing Materials, Trusses and etc.','2016-10-11 00:00:00','2016-10-22 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',15,12,0,0,0),(17,'1','8','Door','2016-10-23 00:00:00','2016-11-01 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',16,9,0,0,0),(18,'1','8','Windows','2016-11-02 00:00:00','2016-11-11 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',17,9,0,0,0),(19,'1','9','Exterior','2016-11-12 00:00:00','2016-12-05 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',18,24,0,0,0),(20,'1','10','Fixtures','2016-07-31 00:00:00','2016-08-01 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,2,0,0,0),(21,'1','10','Waterlines','2016-07-31 00:00:00','2016-08-11 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,12,0,0,0),(22,'1','10','Sanitary','2016-07-31 00:00:00','2016-08-11 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,12,0,0,0),(23,'1','10','Storm Drain','2016-07-31 00:00:00','2016-08-11 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,12,0,0,0),(24,'1','11','Fixtures and Boxes','2016-07-31 00:00:00','2016-08-02 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,3,0,0,0),(25,'1','11','Fittings','2016-07-31 00:00:00','2016-08-04 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,5,0,0,0),(26,'1','11','Wiring','2016-07-31 00:00:00','2016-08-09 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,10,0,0,0),(27,'1','11','Enclosed Circuit Breaker','2016-07-31 00:00:00','2016-08-01 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,2,0,0,0),(28,'1','11','Testing and Commissioning','2016-07-31 00:00:00','2016-08-01 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,2,0,0,0),(31,'1','16','Task 1','2016-07-31 00:00:00','2016-08-03 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,2,0,0,0),(32,'1','16','task 2','2016-08-12 00:00:00','2016-08-18 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',2,5,0,0,0);
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
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
  PRIMARY KEY (`TaskResID`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_resources`
--

LOCK TABLES `task_resources` WRITE;
/*!40000 ALTER TABLE `task_resources` DISABLE KEYS */;
INSERT INTO `task_resources` VALUES (1,1,1,1,1,0,0,1),(2,1,1,2,2,0,0,2),(3,1,1,3,3,0,0,3),(4,1,2,3,1,0,0,1),(5,1,2,4,3,0,0,3),(6,1,3,2,1,0,0,1),(7,1,4,2,2,0,0,2),(8,1,5,5,1,0,0,1),(9,1,5,2,3,0,0,3),(10,1,5,6,1,0,0,1),(11,1,5,7,49,0,0,49),(12,1,5,8,2,0,0,2),(13,1,5,9,4,0,0,4),(14,1,5,41,1,0,0,1),(15,1,6,10,3,0,0,3),(16,1,6,5,3,0,0,3),(17,1,6,2,5,0,0,5),(18,1,6,7,75,0,0,75),(19,1,6,8,5,0,0,5),(20,1,6,9,10,0,0,10),(21,1,7,10,5,0,0,5),(22,1,7,5,3,0,0,3),(23,1,7,2,5,0,0,5),(24,1,7,7,55,0,0,55),(25,1,7,8,5,0,0,5),(26,1,7,9,9,0,0,9),(27,1,8,5,2,0,0,2),(28,1,8,10,2,0,0,2),(29,1,8,2,4,0,0,4),(30,1,8,7,52,0,0,52),(31,1,8,8,5,0,0,5),(32,1,8,9,9,0,0,9),(33,1,9,11,1,0,0,1),(34,1,9,2,1,0,0,1),(35,1,9,4,25,0,0,25),(36,1,10,12,2,0,0,2),(37,1,10,2,1,0,0,1),(38,1,10,4,68,0,0,68),(39,1,10,13,145,0,0,145),(40,1,10,14,285,0,0,285),(41,1,11,12,2,0,0,2),(42,1,11,2,1,0,0,1),(43,1,11,4,57,0,0,57),(44,1,11,13,105,0,0,105),(45,1,11,14,150,0,0,150),(46,1,12,12,2,0,0,2),(47,1,12,2,1,0,0,1),(48,1,12,14,165,0,0,165),(49,1,13,2,3,0,0,3),(50,1,13,10,5,0,0,5),(51,1,13,15,1050,0,0,1050),(52,1,13,16,75,0,0,75),(53,1,14,5,5,0,0,5),(54,1,14,2,3,0,0,3),(55,1,14,17,1042,0,0,1042),(56,1,14,18,469,0,0,469),(57,1,15,12,2,0,0,2),(58,1,15,2,1,0,0,1),(59,1,15,16,56,0,0,56),(60,1,15,19,235,0,0,235),(61,1,16,10,5,0,0,5),(62,1,16,2,3,0,0,3),(63,1,16,20,17,0,0,17),(64,1,16,21,1292,0,0,1292),(65,1,16,22,138,0,0,138),(66,1,17,10,2,0,0,2),(67,1,17,2,2,0,0,2),(68,1,17,23,2,0,0,2),(69,1,18,10,2,0,0,2),(70,1,18,2,2,0,0,2),(71,1,18,23,14,0,0,14),(72,1,19,26,4,0,0,4),(73,1,19,24,10,0,0,10),(74,1,19,25,3,0,0,3),(75,1,19,27,1,0,0,1),(76,1,19,28,5,0,0,5),(77,1,19,29,3,0,0,3),(78,1,20,30,2,0,0,2),(79,1,20,2,1,0,0,1),(80,1,20,31,1,0,0,1),(81,1,20,32,22,0,0,22),(82,1,20,33,22,0,0,22),(83,1,20,34,22,0,0,22),(84,1,21,30,1,0,0,1),(85,1,21,2,1,0,0,1),(86,1,21,35,5,0,0,5),(87,1,21,36,20,0,0,20),(88,1,21,37,3,0,0,3),(89,1,22,30,1,0,0,1),(90,1,22,2,1,0,0,1),(91,1,22,38,4,0,0,4),(92,1,22,39,3,0,0,3),(93,1,22,40,2,0,0,2),(94,1,23,30,1,0,0,1),(95,1,23,2,1,0,0,1),(96,1,23,39,15,0,0,15),(97,1,24,42,1,0,0,1),(98,1,24,2,1,0,0,1),(99,1,24,43,3,0,0,3),(100,1,24,44,5,0,0,5),(101,1,25,42,2,0,0,2),(102,1,25,2,2,0,0,2),(103,1,25,45,100,0,0,100),(104,1,26,42,2,0,0,2),(105,1,26,2,2,0,0,2),(106,1,26,46,5,0,0,5),(107,1,27,42,1,0,0,1),(108,1,27,47,8,0,0,8),(109,1,28,42,1,0,0,1),(110,1,28,2,1,0,0,1),(111,1,29,21,5,0,0,5),(112,1,30,25,2,0,0,2),(113,1,31,21,5,0,0,5),(114,1,32,25,2,0,0,2);
/*!40000 ALTER TABLE `task_resources` ENABLE KEYS */;
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
  PRIMARY KEY (`NotificationID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,'0','2016-06-01 09:46:54','late_activity','{\"ActivityName\":\"asdasda\",\"ProjectName\":\"Cool Test\",\"DelayDays\":\"6\"}','0','1','1'),(2,'0','2016-06-01 09:46:54','late_activity','{\"ActivityName\":\"asdasda\",\"ProjectName\":\"Cool Test\",\"DelayDays\":\"6\"}','2','1','1'),(3,'1','2016-06-01 09:50:28','add_comment','{\"do\":\"add_comment\",\"projectid\":\"1\",\"commentdata\":\"hello\"}','0','',''),(4,'1','2016-06-01 09:50:28','add_comment','{\"do\":\"add_comment\",\"projectid\":\"1\",\"commentdata\":\"hello\"}','2','',''),(5,'2','2016-06-01 09:50:58','add_comment','{\"do\":\"add_comment\",\"projectid\":\"1\",\"commentdata\":\"hello\"}','0','',''),(6,'2','2016-06-01 09:50:58','add_comment','{\"do\":\"add_comment\",\"projectid\":\"1\",\"commentdata\":\"hello\"}','2','',''),(7,'2','2016-06-01 09:51:38','change_request','{\"ProjectName\":\"Cool Test\",\"subject\":\"Housing\",\"message\":\"Paki ayos yung gawa niyo king ina niyo\"}','0','1',''),(8,'1','2016-07-09 04:51:46','add_comment','{\"do\":\"add_comment\",\"projectid\":\"1\",\"commentdata\":\"test\"}','0','',''),(9,'1','2016-07-09 04:51:46','add_comment','{\"do\":\"add_comment\",\"projectid\":\"1\",\"commentdata\":\"test\"}','2','',''),(10,'0','2016-07-12 13:12:24','advance_activity','{\"ActivityName\":\"asd\",\"ProjectName\":\"dasdsa\",\"AdvanceDays\":\"1\"}','0','2','3'),(11,'0','2016-07-12 13:12:24','advance_activity','{\"ActivityName\":\"asd\",\"ProjectName\":\"dasdsa\",\"AdvanceDays\":\"1\"}','2','2','3'),(14,'0','2016-07-27 06:54:01','late_activity','{\"ActivityName\":\"Additional Activity\",\"ProjectName\":\"PROJECT A\",\"DelayDays\":null}','0','1','16'),(15,'0','2016-07-27 06:54:01','late_activity','{\"ActivityName\":\"Additional Activity\",\"ProjectName\":\"PROJECT A\",\"DelayDays\":null}','4','1','16');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,'4','PROJECT A','2016-07-26 00:00:00','2016-12-07 00:00:00','0','0','LOCATION A','3storeybuilding','90','');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
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
INSERT INTO `resources` VALUES (1,'Foreman','manpower','100'),(2,'Labor','manpower','60'),(3,'Sickle','material','4000'),(4,'16mm Deformed Bar','material','300'),(5,'Mansory','manpower','300'),(6,'Operator (Heavy Equipment)','manpower','5'),(7,'Bags of Cement','material','0'),(8,'Cubic Meter Sand','material','0'),(9,'Cubic Meter Gravel','material','0'),(10,'Carpentry','manpower','0'),(11,'Welder','manpower','0'),(12,'Steel Man','manpower','0'),(13,'12mm Deformed Bar','material','0'),(14,'10mm Deformed Bar','material','0'),(15,'inches x 3 inches x 10 feet coco lumber','material','0'),(16,'4 ft x 8 ft plywood','material','0'),(17,'6 inches concrete hollow block','material','0'),(18,'4 inches concrete hollow block','material','0'),(19,'2 inches x 2 inches x 10 feet wood','material','0'),(20,'12 feet yero','material','0'),(21,'Nails','material','0'),(22,'C-Purlins 2 inches x 6 inches','material','0'),(23,'UPBC','material','0'),(24,'Roller','material','0'),(25,'tin semi-gloss','material','0'),(26,'Painter','manpower','0'),(27,'gallon acrycolor','material','0'),(28,'Paint Brush','material','0'),(29,'Gallon thinner','material','0'),(30,'Plumber','manpower','0'),(31,'Sink','material','0'),(32,'water closet','material','0'),(33,'Lavatory','material','0'),(34,'Urinal','material','0'),(35,'1 inch blue bbc','material','0'),(36,'1 /2 inch blue bbc','material','0'),(37,'3 /4 inches blue bbc','material','0'),(38,'4 inches orange pipe','material','0'),(39,'3 inches orange pipe','material','0'),(40,'2 inches orange pipe','material','0'),(41,'Cement Mixer','equipment','0'),(42,'Electrician','manpower','0'),(43,'3/4 inches orange pipe ','material','0'),(44,'1 inches orange pipe','material','0'),(45,'elbow','material','0'),(46,'box wire','material','0'),(47,'Breaker','material','0');
/*!40000 ALTER TABLE `resources` ENABLE KEYS */;
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

--
-- Dumping events for database 'evypms'
--

--
-- Dumping routines for database 'evypms'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-07-27 16:46:02
