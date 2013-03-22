-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 21, 2013 at 07:21 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gdg_devplatform`
--

-- --------------------------------------------------------

--
-- Table structure for table `jobs_skillsets`
--

CREATE TABLE IF NOT EXISTS `jobs_skillsets` (
  `job_id` int(11) NOT NULL,
  `skillset_id` char(36) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`job_id`,`skillset_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs_skillsets`
--

INSERT INTO `jobs_skillsets` (`job_id`, `skillset_id`, `created`) VALUES
(1, '6d3c4990-23d4-11e2-a5fb-7f3382f33e5b', '2013-03-21 05:44:16'),
(2, '6d3c3ea0-23d4-11e2-a5fb-7f3382f33e5b', '2013-03-21 06:18:05');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
