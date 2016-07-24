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
use evypms;
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
INSERT INTO `activities` VALUES (1,'1','asdasda','2016-05-01 00:00:00','2016-05-26 00:00:00','50',1,'0'),(2,'1','safsdgsg','2016-05-10 00:00:00','2016-06-30 00:00:00','50',1,'0'),(3,'2','asd','2016-07-13 00:00:00','2016-07-21 00:00:00','100',1,'0'),(4,'3','asd','2016-07-12 00:00:00','2016-07-13 00:00:00','50',1,'0'),(5,'3','eeqweqeq','2016-07-14 00:00:00','2016-07-18 00:00:00','50',1,'0'),(6,'4','Earthworks','2016-07-24 00:00:00','2016-08-28 00:00:00','0',0,'0'),(7,'4','Concrete Works','2016-08-28 00:00:00','2016-10-16 00:00:00','0',0,'0'),(8,'4','Steel Works','2016-07-31 00:00:00','2016-08-24 00:00:00','0',0,'0'),(9,'4','Framework','2016-07-31 00:00:00','2016-09-06 00:00:00','0',0,'0'),(10,'4','Mansory Works','2016-07-31 00:00:00','2016-09-12 00:00:00','0',0,'0'),(11,'4','Carpentry Works','2016-09-12 00:00:00','2016-10-15 00:00:00','0',0,'0'),(12,'4','Roofing Works','2016-10-15 00:00:00','2016-10-29 00:00:00','0',0,'0'),(13,'4','Pre-Fabricated Works','2016-10-29 00:00:00','2016-11-20 00:00:00','0',0,'0'),(14,'4','Painting Works','2016-11-20 00:00:00','2016-12-16 00:00:00','0',0,'0'),(15,'4','Plumbing','2016-07-31 00:00:00','2016-08-14 00:00:00','0',0,'0'),(16,'4',' Electrical Works','2016-07-31 00:00:00','2016-08-12 00:00:00','0',0,'0');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activities_resources`
--

LOCK TABLES `activities_resources` WRITE;
/*!40000 ALTER TABLE `activities_resources` DISABLE KEYS */;
INSERT INTO `activities_resources` VALUES (1,'3','4','15','3','0','0','3'),(2,'3','4','6','2','0','0','2'),(3,'3','5','29','2','0','0','2'),(4,'3','5','12','2','0','0','2'),(5,'3','5','25','1','0','0','1');
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
  PRIMARY KEY (`NotificationID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,'0','2016-06-01 09:46:54','late_activity','{\"ActivityName\":\"asdasda\",\"ProjectName\":\"Cool Test\",\"DelayDays\":\"6\"}','0','1','1'),(2,'0','2016-06-01 09:46:54','late_activity','{\"ActivityName\":\"asdasda\",\"ProjectName\":\"Cool Test\",\"DelayDays\":\"6\"}','2','1','1'),(3,'1','2016-06-01 09:50:28','add_comment','{\"do\":\"add_comment\",\"projectid\":\"1\",\"commentdata\":\"hello\"}','0','',''),(4,'1','2016-06-01 09:50:28','add_comment','{\"do\":\"add_comment\",\"projectid\":\"1\",\"commentdata\":\"hello\"}','2','',''),(5,'2','2016-06-01 09:50:58','add_comment','{\"do\":\"add_comment\",\"projectid\":\"1\",\"commentdata\":\"hello\"}','0','',''),(6,'2','2016-06-01 09:50:58','add_comment','{\"do\":\"add_comment\",\"projectid\":\"1\",\"commentdata\":\"hello\"}','2','',''),(7,'2','2016-06-01 09:51:38','change_request','{\"ProjectName\":\"Cool Test\",\"subject\":\"Housing\",\"message\":\"Paki ayos yung gawa niyo king ina niyo\"}','0','1',''),(8,'1','2016-07-09 04:51:46','add_comment','{\"do\":\"add_comment\",\"projectid\":\"1\",\"commentdata\":\"test\"}','0','',''),(9,'1','2016-07-09 04:51:46','add_comment','{\"do\":\"add_comment\",\"projectid\":\"1\",\"commentdata\":\"test\"}','2','',''),(10,'0','2016-07-12 13:12:24','advance_activity','{\"ActivityName\":\"asd\",\"ProjectName\":\"dasdsa\",\"AdvanceDays\":\"1\"}','0','2','3'),(11,'0','2016-07-12 13:12:24','advance_activity','{\"ActivityName\":\"asd\",\"ProjectName\":\"dasdsa\",\"AdvanceDays\":\"1\"}','2','2','3');
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
INSERT INTO `projects` VALUES (1,'2','Cool Test','2016-05-01 00:00:00','2016-06-30 00:00:00','1','100','','',NULL,NULL),(2,'2','dasdsa','2016-07-12 00:00:00','2016-07-28 00:00:00','0','56.25','','',NULL,NULL),(3,'2','zdad','2016-07-06 00:00:00','2016-07-28 00:00:00','0','54.545454545455','','',NULL,NULL),(4,'2','1','2016-07-24 00:00:00','2016-12-18 00:00:00','0','1.453488372093','1','2storeybuilding','90','');
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
  `taskcol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`TaskID`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` VALUES (1,'4','6','Clearing and Grubing','2016-07-24 00:00:00','2016-07-28 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',0,5,1,NULL),(2,'4','6','Excavation','2016-07-29 00:00:00','2016-08-14 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,12,0,NULL),(3,'4','6','Soil Poisoning','2016-08-14 00:00:00','2016-08-21 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',2,5,0,NULL),(4,'4','6','Gravel Bedding','2016-08-21 00:00:00','2016-08-28 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',3,5,0,NULL),(5,'4','7','Footings','2016-08-28 00:00:00','2016-09-06 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',4,7,0,NULL),(6,'4','7','Columns','2016-09-06 00:00:00','2016-09-23 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',5,15,0,NULL),(7,'4','7','Beams','2016-09-23 00:00:00','2016-10-06 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',6,11,0,NULL),(8,'4','7','Slabs','2016-10-06 00:00:00','2016-10-16 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',7,8,0,NULL),(9,'4','8','Footings','2016-07-31 00:00:00','2016-08-06 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,4,0,NULL),(10,'4','8','Columns','2016-07-31 00:00:00','2016-08-24 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,22,0,NULL),(11,'4','8','Beams','2016-07-31 00:00:00','2016-08-21 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,19,0,NULL),(12,'4','8','Slabs','2016-07-31 00:00:00','2016-08-12 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,10,0,NULL),(13,'4','9','Formworks and Scaffoldings','2016-07-31 00:00:00','2016-09-06 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,35,0,NULL),(14,'4','10','Mansory','2016-07-31 00:00:00','2016-09-12 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,41,0,NULL),(15,'4','11','Ceiling, Cabinets and Etc.','2016-09-12 00:00:00','2016-10-15 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',14,31,0,NULL),(16,'4','12','Roofing Materials, Trusses and etc.','2016-10-15 00:00:00','2016-10-29 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',15,12,0,NULL),(17,'4','13','Door','2016-10-29 00:00:00','2016-11-09 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',16,9,0,NULL),(18,'4','13','Windows','2016-11-09 00:00:00','2016-11-20 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',17,9,0,NULL),(19,'4','14','Exterior','2016-11-20 00:00:00','2016-12-16 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',18,24,0,NULL),(20,'4','15','Fixtures','2016-07-31 00:00:00','2016-08-04 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,2,0,NULL),(21,'4','15','Waterlines','2016-07-31 00:00:00','2016-08-14 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,12,0,NULL),(22,'4','15','Sanitary','2016-07-31 00:00:00','2016-08-14 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,12,0,NULL),(23,'4','15','Storm Drain','2016-07-31 00:00:00','2016-08-14 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,12,0,NULL),(24,'4','16','Fixtures and Boxes','2016-07-31 00:00:00','2016-08-05 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,3,0,NULL),(25,'4','16','Fittings','2016-07-31 00:00:00','2016-08-07 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,5,0,NULL),(26,'4','16','Wiring','2016-07-31 00:00:00','2016-08-12 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,10,0,NULL),(27,'4','16','Enclosed Circuit Breaker','2016-07-31 00:00:00','2016-08-04 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,2,0,NULL),(28,'4','16','Testing and Commissioning','2016-07-31 00:00:00','2016-08-04 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','','','','',1,2,0,NULL);
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
  PRIMARY KEY (`TaskResID`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_resources`
--

LOCK TABLES `task_resources` WRITE;
/*!40000 ALTER TABLE `task_resources` DISABLE KEYS */;
INSERT INTO `task_resources` VALUES (1,4,1,1,1,0,0,1),(2,4,1,2,2,0,0,2),(3,4,1,3,3,0,0,3),(4,4,2,3,1,0,0,1),(5,4,2,4,3,0,0,3),(6,4,3,2,1,0,0,1),(7,4,4,2,2,0,0,2),(8,4,5,5,1,0,0,1),(9,4,5,2,3,0,0,3),(10,4,5,6,1,0,0,1),(11,4,5,7,49,0,0,49),(12,4,5,8,2,0,0,2),(13,4,5,9,4,0,0,4),(14,4,5,41,1,0,0,1),(15,4,6,10,3,0,0,3),(16,4,6,5,3,0,0,3),(17,4,6,2,5,0,0,5),(18,4,6,7,75,0,0,75),(19,4,6,8,5,0,0,5),(20,4,6,9,10,0,0,10),(21,4,7,10,5,0,0,5),(22,4,7,5,3,0,0,3),(23,4,7,2,5,0,0,5),(24,4,7,7,55,0,0,55),(25,4,7,8,5,0,0,5),(26,4,7,9,9,0,0,9),(27,4,8,5,2,0,0,2),(28,4,8,10,2,0,0,2),(29,4,8,2,4,0,0,4),(30,4,8,7,52,0,0,52),(31,4,8,8,5,0,0,5),(32,4,8,9,9,0,0,9),(33,4,9,11,1,0,0,1),(34,4,9,2,1,0,0,1),(35,4,9,4,25,0,0,25),(36,4,10,12,2,0,0,2),(37,4,10,2,1,0,0,1),(38,4,10,4,68,0,0,68),(39,4,10,13,145,0,0,145),(40,4,10,14,285,0,0,285),(41,4,11,12,2,0,0,2),(42,4,11,2,1,0,0,1),(43,4,11,4,57,0,0,57),(44,4,11,13,105,0,0,105),(45,4,11,14,150,0,0,150),(46,4,12,12,2,0,0,2),(47,4,12,2,1,0,0,1),(48,4,12,14,165,0,0,165),(49,4,13,2,3,0,0,3),(50,4,13,10,5,0,0,5),(51,4,13,15,1050,0,0,1050),(52,4,13,16,75,0,0,75),(53,4,14,5,5,0,0,5),(54,4,14,2,3,0,0,3),(55,4,14,17,1042,0,0,1042),(56,4,14,18,469,0,0,469),(57,4,15,12,2,0,0,2),(58,4,15,2,1,0,0,1),(59,4,15,16,56,0,0,56),(60,4,15,19,235,0,0,235),(61,4,16,10,5,0,0,5),(62,4,16,2,3,0,0,3),(63,4,16,20,17,0,0,17),(64,4,16,21,1292,0,0,1292),(65,4,16,22,138,0,0,138),(66,4,17,10,2,0,0,2),(67,4,17,2,2,0,0,2),(68,4,17,23,2,0,0,2),(69,4,18,10,2,0,0,2),(70,4,18,2,2,0,0,2),(71,4,18,23,14,0,0,14),(72,4,19,26,4,0,0,4),(73,4,19,24,10,0,0,10),(74,4,19,25,3,0,0,3),(75,4,19,27,1,0,0,1),(76,4,19,28,5,0,0,5),(77,4,19,29,3,0,0,3),(78,4,20,30,2,0,0,2),(79,4,20,2,1,0,0,1),(80,4,20,31,1,0,0,1),(81,4,20,32,22,0,0,22),(82,4,20,33,22,0,0,22),(83,4,20,34,22,0,0,22),(84,4,21,30,1,0,0,1),(85,4,21,2,1,0,0,1),(86,4,21,35,5,0,0,5),(87,4,21,36,20,0,0,20),(88,4,21,37,3,0,0,3),(89,4,22,30,1,0,0,1),(90,4,22,2,1,0,0,1),(91,4,22,38,4,0,0,4),(92,4,22,39,3,0,0,3),(93,4,22,40,2,0,0,2),(94,4,23,30,1,0,0,1),(95,4,23,2,1,0,0,1),(96,4,23,39,15,0,0,15),(97,4,24,42,1,0,0,1),(98,4,24,2,1,0,0,1),(99,4,24,43,3,0,0,3),(100,4,24,44,5,0,0,5),(101,4,25,42,2,0,0,2),(102,4,25,2,2,0,0,2),(103,4,25,45,100,0,0,100),(104,4,26,42,2,0,0,2),(105,4,26,2,2,0,0,2),(106,4,26,46,5,0,0,5),(107,4,27,42,1,0,0,1),(108,4,27,47,8,0,0,8),(109,4,28,42,1,0,0,1),(110,4,28,2,1,0,0,1);
/*!40000 ALTER TABLE `task_resources` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Adminboy','admin','2c08e8f5884750a7b99f6f2f342fc638db25ff31','admin'),(2,'feihl','feihl','2c08e8f5884750a7b99f6f2f342fc638db25ff31','client');
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

-- Dump completed on 2016-07-24 20:17:48
