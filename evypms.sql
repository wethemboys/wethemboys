-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 01, 2016 at 12:07 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

create database `evypms`;
use `evypms`;
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evypms`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `ActivityID` int(11) NOT NULL,
  `ProjectID` longtext NOT NULL,
  `Name` longtext NOT NULL,
  `StartDate` datetime NOT NULL,
  `EndDate` datetime NOT NULL,
  `Weight` longtext NOT NULL,
  `Done` tinyint(1) NOT NULL,
  `ClientNeeded` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`ActivityID`, `ProjectID`, `Name`, `StartDate`, `EndDate`, `Weight`, `Done`, `ClientNeeded`) VALUES
(1, '1', 'asdasda', '2016-05-01 00:00:00', '2016-05-26 00:00:00', '50', 1, '0'),
(2, '1', 'safsdgsg', '2016-05-10 00:00:00', '2016-06-30 00:00:00', '50', 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `activities_resources`
--

CREATE TABLE `activities_resources` (
  `ActResID` int(11) NOT NULL,
  `ProjectID` longtext NOT NULL,
  `ActivityID` longtext NOT NULL,
  `ResourceID` longtext NOT NULL,
  `Quantity` longtext NOT NULL,
  `Type` longtext NOT NULL,
  `Used` longtext NOT NULL,
  `Remaining` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `CommentID` int(11) NOT NULL,
  `ProjectID` longtext NOT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UserID` longtext NOT NULL,
  `Data` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`CommentID`, `ProjectID`, `TimeStamp`, `UserID`, `Data`) VALUES
(4, '1', '2016-06-01 09:50:28', '1', 'hello'),
(5, '1', '2016-06-01 09:50:58', '2', 'hello');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `FileID` int(11) NOT NULL,
  `ProjectID` longtext NOT NULL,
  `UserID` longtext NOT NULL,
  `Name` longtext NOT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Type` longtext NOT NULL,
  `Filename` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`FileID`, `ProjectID`, `UserID`, `Name`, `TimeStamp`, `Type`, `Filename`) VALUES
(3, '1', '1', 'Screen Shot 2016-04-15 at 9.57.36 PM.png', '2016-06-01 09:47:48', 'image/png', '574eaf4417b381574eaf4417b3e.png');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `NotificationID` int(11) NOT NULL,
  `UserID` longtext NOT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Type` longtext NOT NULL,
  `RequestData` longtext NOT NULL,
  `ToUser` longtext NOT NULL,
  `ProjectID` longtext NOT NULL,
  `ActivityID` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`NotificationID`, `UserID`, `TimeStamp`, `Type`, `RequestData`, `ToUser`, `ProjectID`, `ActivityID`) VALUES
(1, '0', '2016-06-01 09:46:54', 'late_activity', '{"ActivityName":"asdasda","ProjectName":"Cool Test","DelayDays":"6"}', '0', '1', '1'),
(2, '0', '2016-06-01 09:46:54', 'late_activity', '{"ActivityName":"asdasda","ProjectName":"Cool Test","DelayDays":"6"}', '2', '1', '1'),
(3, '1', '2016-06-01 09:50:28', 'add_comment', '{"do":"add_comment","projectid":"1","commentdata":"hello"}', '0', '', ''),
(4, '1', '2016-06-01 09:50:28', 'add_comment', '{"do":"add_comment","projectid":"1","commentdata":"hello"}', '2', '', ''),
(5, '2', '2016-06-01 09:50:58', 'add_comment', '{"do":"add_comment","projectid":"1","commentdata":"hello"}', '0', '', ''),
(6, '2', '2016-06-01 09:50:58', 'add_comment', '{"do":"add_comment","projectid":"1","commentdata":"hello"}', '2', '', ''),
(7, '2', '2016-06-01 09:51:38', 'change_request', '{"ProjectName":"Cool Test","subject":"Housing","message":"Paki ayos yung gawa niyo king ina niyo"}', '0', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `ProjectID` int(11) NOT NULL,
  `UserID` longtext NOT NULL,
  `Name` longtext NOT NULL,
  `StartDate` datetime NOT NULL,
  `EndDate` datetime NOT NULL,
  `Status` longtext NOT NULL,
  `Progress` longtext NOT NULL,
  `Location` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`ProjectID`, `UserID`, `Name`, `StartDate`, `EndDate`, `Status`, `Progress`, `Location`) VALUES
(1, '2', 'Cool Test', '2016-05-01 00:00:00', '2016-06-30 00:00:00', '1', '100', '');

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `ResourceID` int(11) NOT NULL,
  `Name` longtext NOT NULL,
  `Type` longtext NOT NULL,
  `Price` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`ResourceID`, `Name`, `Type`, `Price`) VALUES
(1, 'cement', 'materials', '100'),
(2, 'graba', 'materials', '60'),
(3, 'bulldozer', 'equipment', '4000');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

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
  `ActualCost` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `task_checklist`
--

CREATE TABLE `task_checklist` (
  `TaskCLID` int(11) NOT NULL,
  `ProjectID` longtext NOT NULL,
  `ActivityID` longtext NOT NULL,
  `TaskID` longtext NOT NULL,
  `Name` longtext NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `EndDate` datetime NOT NULL,
  `ActualEndDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Name` longtext NOT NULL,
  `Username` longtext NOT NULL,
  `Password` longtext NOT NULL,
  `Type` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Name`, `Username`, `Password`, `Type`) VALUES
(1, 'Adminboy', 'admin', '2c08e8f5884750a7b99f6f2f342fc638db25ff31', 'admin'),
(2, 'feihl', 'feihl', '2c08e8f5884750a7b99f6f2f342fc638db25ff31', 'client');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`ActivityID`);

--
-- Indexes for table `activities_resources`
--
ALTER TABLE `activities_resources`
  ADD PRIMARY KEY (`ActResID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`CommentID`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`FileID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`NotificationID`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`ProjectID`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`ResourceID`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`TaskID`);

--
-- Indexes for table `task_checklist`
--
ALTER TABLE `task_checklist`
  ADD PRIMARY KEY (`TaskCLID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `ActivityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `activities_resources`
--
ALTER TABLE `activities_resources`
  MODIFY `ActResID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `FileID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `NotificationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `ProjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `ResourceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `TaskID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `task_checklist`
--
ALTER TABLE `task_checklist`
  MODIFY `TaskCLID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
