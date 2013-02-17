-- MySQL dump 10.13  Distrib 5.5.25a, for osx10.6 (i386)
--
-- Host: localhost    Database: gdg_devplatform
-- ------------------------------------------------------
-- Server version	5.5.25a

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
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feed_id` int(11) NOT NULL DEFAULT '1',
  `name` varchar(255) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `hash` char(32) NOT NULL,
  `description` text NOT NULL,
  `article_type` smallint(6) NOT NULL DEFAULT '0',
  `published` smallint(6) NOT NULL DEFAULT '0',
  `date_published` datetime NOT NULL,
  `external_link` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `sort_order` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `slug` (`slug`),
  KEY `published` (`published`),
  KEY `article_type` (`article_type`),
  KEY `feed_id` (`feed_id`),
  KEY `created` (`created`,`sort_order`),
  KEY `hash` (`hash`),
  KEY `id_2` (`id`,`sort_order`)
) ENGINE=MyISAM AUTO_INCREMENT=460 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (451,13,'API Jobs from Macys.com, Emergent One and State','api-jobs-from-macys-com-emergent-one-and-state','2e3da63585c254c013fa4591edb31264','<a href=\"http://www.api-jobs.com\"><img class=\"imgRight\" title=\"API Jobs\" src=\"http://blog.programmableweb.com/wp-content/logo-twitter.png\" alt=\"API Jobs\" width=\"70\" height=\"70\" /></a> This week we have three openings that all put equal weight on the developer experience side of APIs as much as the APIs themselves. Building a great developer portal is a key part of any public API strategy and these positions at State, Macys.com and Emergent One reinforce this.',0,1,'2013-02-08 20:00:14','http://feedproxy.google.com/~r/ProgrammableWeb/~3/45EZY-fMRhU/','2013-02-09 12:00:24','2013-02-09 12:00:24',1),(452,13,'API Spotlight: O*net, Refill, and the ParkMe API','api-spotlight-o-net-refill-and-the-parkme-api','647a9a4fcb5752000ceb1e4706bc10bb','<a href=\"http://www.programmableweb.com/api/parkme\"><img class=\"imgRight\" src=\"http://www.programmableweb.com/images/apis/at9619.png\" alt=\"ParkMe\" /></a>Of the many APIs we published this week, ten were highlighted on the blog by our team of writers. In this post, we’ll shine a spotlight on those ten, which included the <a href=\"http://www.programmableweb.com/api/parkme\">ParkMe API</a>. ParkMe utilizes heat mapping to help users find empty parking spots in busy cities. For cold/blue heat signatures mean less activity where as red/hot means more activity. Depending on the area, these colors could mean open or taken spots. The ParkMe API simply allows developers to integrate the ParkMe functionality with their applications. ',0,1,'2013-02-08 18:00:15','http://feedproxy.google.com/~r/ProgrammableWeb/~3/pg5nv_m-ROE/','2013-02-09 12:00:24','2013-02-09 12:00:24',2),(453,13,'White House Announces Release of We The People API and Open Data Day Hackathon','white-house-announces-release-of-we-the-people-api-and-open-data-day-hackathon','b7c984446f1d9d25b18f5e34ff71ac62','<img src=\"http://blog.programmableweb.com/wp-content/whitehouse-logo.png\" alt=\"The White House\" class=\"imgRight\" /><a href=\"http://www.whitehouse.gov/\">The White House</a> has <a href=\"http://www.whitehouse.gov/blog/2013/02/05/announcing-we-people-20-and-white-house-hackathon\">announced</a> that Petitions 2.0, the platform code for the <a href=\"https://petitions.whitehouse.gov/\">We the People</a> website, is now in development and includes an API that will be released to the public in the coming months. The first set of API calls will be read-only and will be released in March 2013.',0,1,'2013-02-08 17:00:51','http://feedproxy.google.com/~r/ProgrammableWeb/~3/Am1paR4doio/','2013-02-09 12:00:24','2013-02-09 12:00:24',3),(454,13,'Wholesaler Continental Clothing’s API: EarthPositive Clothes to Make an Impression','wholesaler-continental-clothing-s-api-earthpositive-clothes-to-make-an-impression','2e6628cdd65e67b5fe479112ab3f764e','<a href=\"http://www.programmableweb.com/api/continental-clothing\"><img class=\"imgRight\" src=\"http://www.programmableweb.com/images/apis/at9508.png\" alt=\"Continental Clothing\" /></a>The <a href=\"http://www.programmableweb.com/api/continental-clothing\">Continental Clothing API</a> handles HTTP and SOAP calls returning XML or JSON, according to its <a href=\"http://api.continentalclothing.com/doc\">documentation</a>. It allows its retailers to import the catalog line onto their sites. Continental designs and manufactures eco friendly largely organic clothes, including blank hoodies, Tees, and other garments. These are then sold to retailers who add their own silk screen designs. Among its most interesting customers is <a href=\"http://www.heavyeco.com/#!the-story/c3l3\">HeavyEco</a>, that uses prison labor (and pays for it) to put tattoo impressions on shirts in Eastern Europe, and who donates 50% of profits to NGOs helping orphanages and homeless children. Other customers include the music touring business, and fashion companies looking to create a global presence.',0,1,'2013-02-08 16:00:23','http://feedproxy.google.com/~r/ProgrammableWeb/~3/q6SnByPoeuo/','2013-02-09 12:00:24','2013-02-09 12:00:24',4),(455,13,'OneMusicAPI Simplifies Music Metadata Collection','onemusicapi-simplifies-music-metadata-collection','0b82a4c86260411e4cf02e26987c15ed','<img src=\"http://blog.programmableweb.com/wp-content/logo_navbar.png\" alt=\"\" title=\"\" width=\"153\" height=\"20\" img align=\"right\" size-full wp-image-47017\" /><a href=\"http://www.elstensoftware.com/\">Elsten software</a>, digital music organizer, has announced <a href=\"http://www.onemusicapi.com/\">OneMusicAPI</a>. Proclaimed to be \"OneMusicAPI to rule them all,\" the API acts as a music metadata aggregator that pulls from multiple sources across the web through a single interface. Elsten founder and OneMusicAPI creator, Dan Gravell, found keeping pace with constant changes from individual sources became too tedious a process to adequately organize music.',0,1,'2013-02-07 20:30:08','http://feedproxy.google.com/~r/ProgrammableWeb/~3/KdO_90ysUaI/','2013-02-09 12:00:24','2013-02-09 12:00:24',5),(456,13,'Today in APIs: Walgreens Refill API, Facebook Video Channel, and 12 New APIs','today-in-apis-walgreens-refill-api-facebook-video-channel-and-12-new-apis','7184135be1a494b14fd844da3716f08d','<a href=\"http://www.programmableweb.com/api/walgreens-pharmacy-prescription-refill\"><img class=\"imgRight\" src=\"http://www.programmableweb.com/images/apis/at9695.png\" alt=\"Walgreens Pharmacy Prescription Refill\" /></a>The Walgreens API is not there yet but has potential. Facebook starts a developer video channel. Plus: Rome2rio grants free access to its API, the evolution of the hackathon, and 12 new APIs.',0,1,'2013-02-07 19:18:54','http://feedproxy.google.com/~r/ProgrammableWeb/~3/DuzxVOtcU8g/','2013-02-09 12:00:24','2013-02-09 12:00:24',6),(457,13,'Coming in May: Amazon Coins, a New Virtual Currency for Kindle Fire','coming-in-may-amazon-coins-a-new-virtual-currency-for-kindle-fire','1411c812d25aa0c2b3665e5f1a036fe2','<img src=\"http://www.programmableweb.com/images/apis/at12.png\" alt=\"Amazon Web Services\" class=\"imgRight\" />Earlier this week, ProgrammableWeb <a href=\"http://blog.programmableweb.com/2013/02/04/amazon-ups-game-with-in-app-purchasing-api-for-mac-and-pc-apps/\">reported</a> that <a href=\"http://www.amazon.com/\">Amazon</a> has released an In-App Purchasing API for applications and games developed for Mac and PC platforms. A Kindle Fire In-App Purchasing API has been available in the <a href=\"http://www.programmableweb.com/api/amazon-mobile-app\">Amazon Mobile App SDK</a> since early last year. Amazon has now <a href=\"http://www.businesswire.com/news/home/20130205006173/en/Introducing-Amazon-Coins\">announced</a> that another tool will be made available for developers to monetize games and applications; Amazon Coins, a new virtual currency for Kindle Fire that will be launched in the U.S. this May.  ',0,1,'2013-02-07 18:00:04','http://feedproxy.google.com/~r/ProgrammableWeb/~3/_wykaH6ycF4/','2013-02-09 12:00:24','2013-02-09 12:00:24',7),(458,13,'The Jive APIs: Social Intranet For Business and Customers','the-jive-apis-social-intranet-for-business-and-customers','c28c77343c677c6c80ee2a619df93f43','<a href=\"http://www.programmableweb.com/api/jive\"><img class=\"imgRight\" src=\"http://www.programmableweb.com/images/apis/at9577.png\" alt=\"Jive\" /></a>Jive is bringing the social intranet to business and has <a href=\"http://www.programmableweb.com/api/jive\">Javascript and REST APIs</a>. Think Facebook for internal corporate connectivity. Among its many enhancements that \"<a href=\"http://www.jivesoftware.com/social-business/solutions/social-intranet/\">Jive</a> turns your company into an engine of innovation. It breaks down silos, makes it much easier for people to connect and share insights, and ensures that the best ideas rise to the top.\"',0,1,'2013-02-07 16:00:54','http://feedproxy.google.com/~r/ProgrammableWeb/~3/gWxgZMv4kHQ/','2013-02-09 12:00:24','2013-02-09 12:00:24',8),(459,13,'Today in APIs: New Event Discovery App, Urban Airship Lands $25M, and 7 New APIs','today-in-apis-new-event-discovery-app-urban-airship-lands-25m-and-7-new-apis','6f2352c61e76c07c922b80fd8af56657','<img src=\"http://blog.programmableweb.com/wp-content/2013-02-06-12.07.21-pm-150x78.png\" alt=\"\" width=\"130\" height=\"64\" align=\"right\" />Instagram\'s data is used in a new way by event discovery app \"Now\". Urban Airship lands backing to the tune of $25 Million. Plus: Facebook\'s solution to upcoming breaking changes may be broken, the Goldilocks Question and your API analytics, and 7 new APIs.',0,1,'2013-02-06 20:19:05','http://feedproxy.google.com/~r/ProgrammableWeb/~3/D5-8c09sjZA/','2013-02-09 12:00:24','2013-02-09 12:00:24',9);
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feeds`
--

DROP TABLE IF EXISTS `feeds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feeds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(500) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `published` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `published` (`published`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feeds`
--

LOCK TABLES `feeds` WRITE;
/*!40000 ALTER TABLE `feeds` DISABLE KEYS */;
INSERT INTO `feeds` VALUES (1,'DevHub',NULL,'2013-02-09 11:04:10',2),(6,'Jenkov Tutorials','http://feeds2.feedburner.com/jenkov-com','2013-02-09 11:04:24',1),(7,'Vogella.com','http://feeds.feedburner.com/EclipseAndJava','2013-02-09 11:06:56',1),(8,'SiliconAfrica','http://www.siliconafrica.com/feed/','2013-02-09 11:46:04',1),(9,'PHP - Daniweb.com','http://www.daniweb.com/rss/pull/17','2013-02-09 11:41:02',1),(10,'JS DHTML - Daniweb','http://www.daniweb.com/rss/pull/117','2013-02-09 11:56:43',1),(11,'WebDesign','http://www.daniweb.com/rss/pull/15','2013-02-09 11:56:47',1),(12,'TutorialsPoint','http://feeds.feedburner.com/SharedTutorials','2013-02-09 11:43:54',1),(13,'ProgrammableWeb','http://feeds2.feedburner.com/ProgrammableWeb','2013-02-09 11:59:22',1);
/*!40000 ALTER TABLE `feeds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qc_votes`
--

DROP TABLE IF EXISTS `qc_votes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qc_votes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` char(36) NOT NULL,
  `question_comment_id` char(36) NOT NULL,
  `vote_type` tinyint(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `qc_votes_FKIndex1` (`user_id`),
  KEY `qc_votes_FKIndex2` (`question_comment_id`),
  CONSTRAINT `qc_votes_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `qc_votes_ibfk_4` FOREIGN KEY (`question_comment_id`) REFERENCES `question_comments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `qc_votes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `qc_votes_ibfk_2` FOREIGN KEY (`question_comment_id`) REFERENCES `question_comments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qc_votes`
--

LOCK TABLES `qc_votes` WRITE;
/*!40000 ALTER TABLE `qc_votes` DISABLE KEYS */;
/*!40000 ALTER TABLE `qc_votes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question_comments`
--

DROP TABLE IF EXISTS `question_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question_comments` (
  `id` char(36) NOT NULL,
  `question_comment_id` char(36) NOT NULL DEFAULT '0',
  `user_id` char(36) NOT NULL,
  `question_id` char(36) NOT NULL,
  `description` text,
  `created` datetime DEFAULT NULL,
  `vote_ups` int(10) unsigned DEFAULT '0',
  `vote_downs` int(10) unsigned DEFAULT '0',
  `accepted_answer` tinyint(1) DEFAULT '0',
  `is_comment` tinyint(4) NOT NULL DEFAULT '0',
  `published` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `question_comments_FKIndex1` (`question_id`),
  KEY `question_comments_FKIndex2` (`user_id`),
  KEY `question_comments_FKIndex3` (`question_comment_id`),
  KEY `is_comment` (`is_comment`),
  CONSTRAINT `question_comments_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `question_comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `question_comments_ibfk_4` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `question_comments_ibfk_5` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question_comments`
--

LOCK TABLES `question_comments` WRITE;
/*!40000 ALTER TABLE `question_comments` DISABLE KEYS */;
INSERT INTO `question_comments` VALUES ('0511168e-76d6-11e2-8eec-17ba60b0528a','31456e92-76d3-11e2-8eec-17ba60b0528a','fa5e9b92-76d2-11e2-8eec-17ba60b0528a','511c7945-c9ec-4baf-a175-b398ae34c9d9','This is a sample comment to a previous answer. When I talk to people about it, everyone thinks moonshot thinking isn’t for them. We relegate the big thinking to someone else or some other organization instead, playing a weird kind of “not it” game. The small companies and startups think.','2013-02-14 09:16:26',0,0,0,1,1),('31456e92-76d3-11e2-8eec-17ba60b0528a','0','fa5e9b92-76d2-11e2-8eec-17ba60b0528a','511c7945-c9ec-4baf-a175-b398ae34c9d9','<p>CodeMirror is maintained by volunteers. They don\'t owe you anything, so be polite. Reports with an indignant or belligerent tone tend to be moved to the bottom of the pile.\r\n</p>\r\n<p>\r\nInclude information about the browser in which the problem occurred. Even if you tested several browsers, and the problem occurred in all of them, mention this fact in the bug report. Also include browser version numbers and the operating system that you\'re on.\r\n</p>\r\n<p>\r\nMention which release of CodeMirror you\'re using. Preferably, try also with the current development snapshot, to ensure the problem has not already been fixed.\r\n</p>\r\n<p>\r\nMention very precisely what went wrong. \"X is broken\" is not a good bug report. What did you expect to happen? What happened instead? Describe the exact steps a maintainer has to take to make the problem occur. We can not fix something that we can not observe.\r\n</p>\r\n<p>\r\nIf the problem can not be reproduced in any of the demos included in the CodeMirror distribution, please provide an HTML document that demonstrates the problem. The best way to do this is to go to jsbin.com, enter it there, press save, and include the resulting link in your bug report.\r\n</p>','2013-02-14 01:22:19',0,0,0,0,1),('4f66d720-777e-11e2-8eec-17ba60b0528a','0','fa5e9b92-76d2-11e2-8eec-17ba60b0528a','511c7945-c9ec-4baf-a175-b398ae34c9d9','<p>CodeMirror is maintained by volunteers. They don\'t owe you anything, so be polite. Reports with an indignant or belligerent tone tend to be moved to the bottom of the pile.\r\n</p>\r\n<p>\r\nInclude information about the browser in which the problem occurred. Even if you tested several browsers, and the problem occurred in all of them, mention this fact in the bug report. Also include browser version numbers and the operating system that you\'re on.\r\n</p>\r\n<p>\r\nMention which release of CodeMirror you\'re using. Preferably, try also with the current development snapshot, to ensure the problem has not already been fixed.\r\n</p>\r\n<p>\r\nMention very precisely what went wrong. \"X is broken\" is not a good bug report. What did you expect to happen? What happened instead? Describe the exact steps a maintainer has to take to make the problem occur. We can not fix something that we can not observe.\r\n</p>\r\n<p>\r\nIf the problem can not be reproduced in any of the demos included in the CodeMirror distribution, please provide an HTML document that demonstrates the problem. The best way to do this is to go to jsbin.com, enter it there, press save, and include the resulting link in your bug report.\r\n</p>','2013-02-14 01:22:19',0,0,0,0,1),('4fd814a4-7773-11e2-8eec-17ba60b0528a','0','cdf2310c-7611-11e2-8eec-17ba60b0528a','511c7945-c9ec-4baf-a175-b398ae34c9d9','This is a test comment, directly attached to the question.\n\nI hope  Mention very precisely what went wrong. \"X is broken\" is not a good bug report. What did you expect to happen? What happened instead? Describe the exact steps a maintainer has to take to make the problem occur. We can not fix something that we can not observe.','2013-02-14 05:18:22',0,0,0,1,1),('511e59af-5c10-4c36-923d-499dae34c9d9','0','cdf2310c-7611-11e2-8eec-17ba60b0528a','511c7945-c9ec-4baf-a175-b398ae34c9d9','This is an answer. Wouldn\'t this bind the event before the appLaunchers are created, and thus not have them working? Because they are dynamically added to the DOM when a button is pressed. Wouldn\'t this bind the event before the appLaunchers are created, and thus not have them working? Because they are dynamically added to the DOM when a button is pressed. This is an answer. Wouldn\'t this bind the event before the appLaunchers are created, and thus not have them working? Because they are dynamically added to the DOM when a button is pressed. Wouldn\'t this bind the event before the appLaunchers are created, and thus not have them working? Because they are dynamically added to the DOM when a button is pressed. This is an answer. Wouldn\'t this bind the event before the appLaunchers are created, and thus not have them working? Because they are dynamically added to the DOM when a button is pressed. Wouldn\'t this bind the event before the appLaunchers are created, and thus not have them working? Because they are dynamically added to the DOM when a button is pressed.','2013-02-15 16:52:15',0,0,0,0,1),('511e64cd-fb24-4715-97eb-44c4ae34c9d9','0','cdf2310c-7611-11e2-8eec-17ba60b0528a','511c7945-c9ec-4baf-a175-b398ae34c9d9','This is an answer. Wouldn\'t this bind the event before the appLaunchers are created, and thus not have them working? Because they are dynamically added to the DOM when a button is pressed. Wouldn\'t this bind the event before the appLaunchers are created, and thus not have them working? Because they are dynamically added to the DOM when a button is pressed. This is an answer. Wouldn\'t this bind the event before the appLaunchers are created, and thus not have them working? Because they are dynamically added to the DOM when a button is pressed. Wouldn\'t this bind the event before the appLaunchers are created, and thus not have them working? Because they are dynamically added to the DOM when a button is pressed. This is an answer. Wouldn\'t this bind the event before the appLaunchers are created, and thus not have them working? Because they are dynamically added to the DOM when a button is pressed. Wouldn\'t this bind the event before the appLaunchers are created, and thus not have them working? Because they are dynamically added to the DOM when a button is pressed.','2013-02-15 17:39:41',0,0,0,0,1),('511e7333-3158-4cfb-ae9e-45cbae34c9d9','0','cdf2310c-7611-11e2-8eec-17ba60b0528a','511c7945-c9ec-4baf-a175-b398ae34c9d9','THis is my comment!','2013-02-15 18:41:07',0,0,0,1,1),('511e73c9-397c-4b84-9e12-4f09ae34c9d9','511e59af-5c10-4c36-923d-499dae34c9d9','cdf2310c-7611-11e2-8eec-17ba60b0528a','511c7945-c9ec-4baf-a175-b398ae34c9d9','This is a comment to an answer','2013-02-15 18:43:37',0,0,0,1,1),('511e7434-3440-48c4-8f30-4c8bae34c9d9','511e59af-5c10-4c36-923d-499dae34c9d9','cdf2310c-7611-11e2-8eec-17ba60b0528a','511c7945-c9ec-4baf-a175-b398ae34c9d9','This is another comment sha','2013-02-15 18:45:24',0,0,0,1,1),('511e74c7-db18-42c3-8cd6-44d8ae34c9d9','511e59af-5c10-4c36-923d-499dae34c9d9','cdf2310c-7611-11e2-8eec-17ba60b0528a','511c7945-c9ec-4baf-a175-b398ae34c9d9','Testing hash check','2013-02-15 18:47:51',0,0,0,1,1),('511e7612-8f6c-4324-b36f-4dd2ae34c9d9','0','cdf2310c-7611-11e2-8eec-17ba60b0528a','511c7945-c9ec-4baf-a175-b398ae34c9d9','This is an answer to the problem posted above','2013-02-15 18:53:22',0,0,0,0,1),('5c5a1140-7774-11e2-8eec-17ba60b0528a','0','cdf2310c-7611-11e2-8eec-17ba60b0528a','511c7945-c9ec-4baf-a175-b398ae34c9d9','This is a another test comment, directly attached to the question.\n\n','2013-02-14 05:18:22',0,0,0,1,1),('8ac9eece-7774-11e2-8eec-17ba60b0528a','31456e92-76d3-11e2-8eec-17ba60b0528a','cdf2310c-7611-11e2-8eec-17ba60b0528a','511c7945-c9ec-4baf-a175-b398ae34c9d9','This is a another sample comment to a previous answer','2013-02-14 15:16:26',0,0,0,1,1);
/*!40000 ALTER TABLE `question_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` char(36) NOT NULL,
  `user_id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(200) NOT NULL,
  `description` text,
  `flag` smallint(5) unsigned DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `questions_FKIndex1` (`user_id`),
  KEY `created` (`created`),
  KEY `flag` (`flag`),
  KEY `deleted` (`deleted`),
  KEY `slug` (`slug`),
  CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES ('511c792d-8b10-471c-ac3a-af3aae34c9d9','cdf2310c-7611-11e2-8eec-17ba60b0528a','Problem in AJAX Dropdown-checkbox','problem-in-ajax-dropdown-checkbox','I have dropdown down boxes with checkboxes; I\'m using jguery to display Dropdown with checkboxes; I\'m populating Select Locality with Select City dropdown. Now, when I select a city from dropdown It should display its locality in dropdown with checkboxes but showing localities in dropdown only. I have dropdown down boxes with checkboxes; I\'m using jguery to display Dropdown with checkboxes; I\'m populating Select Locality with Select City dropdown. Now, when I select a city from dropdown It should display its locality in dropdown with checkboxes but showing localities in dropdown only. ',0,'2013-02-14 17:50:44','0000-00-00 00:00:00',0,1,1),('511c7945-c9ec-4baf-a175-b398ae34c9d9','cdf2310c-7611-11e2-8eec-17ba60b0528a','Problem in AJAX Dropdown-checkbox','problem-in-ajax-dropdown-checkbox-1','I have dropdown down boxes with checkboxes; I\'m using jguery to display Dropdown with checkboxes; I\'m populating Select Locality with Select City dropdown. Now, when I select a city from dropdown It should display its locality in dropdown with checkboxes but showing localities in dropdown only. I have dropdown down boxes with checkboxes; I\'m using jguery to display Dropdown with checkboxes; I\'m populating Select Locality with Select City dropdown. Now, when I select a city from dropdown It should display its locality in dropdown with checkboxes but showing localities in dropdown only. ',0,'2013-01-21 13:20:43','0000-00-00 00:00:00',0,1,1),('511ea5ed-d838-460f-9317-47f1ae34c9d9','cdf2310c-7611-11e2-8eec-17ba60b0528a','Displaying images in web page from database (PHP)','displaying-images-in-web-page-from-database-php','I need some urgent help with displaying images in a web page from a database. I\'ve created the table picture in phpmydamin and it has these columns: id_picture( wich is the primary key), name, description and the pic_url ( wich contains the url path of the image for example: images/pic_1.jpeg). For now I just want to display the image, but instead it displays the url path as a text that is located in the pic_url column. This is the code I\'m using: I need some urgent help with displaying images in a web page from a database. I\'ve created the table picture in phpmydamin and it has these columns: id_picture( wich is the primary key), name, description and the pic_url ( wich contains the url path of the image for example: images/pic_1.jpeg). For now I just want to display the image, but instead it displays the url path as a text that is located in the pic_url column. This is the code I\'m using:',0,'2013-02-15 22:17:33','2013-02-15 22:17:33',0,1,1),('511eaa80-4224-4fe4-a762-011cae34c9d9','cdf2310c-7611-11e2-8eec-17ba60b0528a','Compiling PHP Applications','compiling-php-applications','How do I compile a PHP application? Test Question. How do I compile a PHP application? Test Question',0,'2013-02-15 22:37:04','2013-02-15 22:37:04',0,1,1);
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions_tags`
--

DROP TABLE IF EXISTS `questions_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` char(36) NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `questions_tags_FKIndex1` (`question_id`),
  KEY `questions_tags_FKIndex2` (`tag_id`),
  CONSTRAINT `questions_tags_ibfk_3` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `questions_tags_ibfk_4` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `questions_tags_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `questions_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions_tags`
--

LOCK TABLES `questions_tags` WRITE;
/*!40000 ALTER TABLE `questions_tags` DISABLE KEYS */;
INSERT INTO `questions_tags` VALUES (1,'511c792d-8b10-471c-ac3a-af3aae34c9d9',1,'2013-02-14 06:42:05'),(2,'511c792d-8b10-471c-ac3a-af3aae34c9d9',2,'2013-02-14 06:42:05'),(3,'511c792d-8b10-471c-ac3a-af3aae34c9d9',3,'2013-02-14 06:42:05'),(4,'511c792d-8b10-471c-ac3a-af3aae34c9d9',4,'2013-02-14 06:42:05'),(5,'511c7945-c9ec-4baf-a175-b398ae34c9d9',1,'2013-02-14 06:42:29'),(6,'511c7945-c9ec-4baf-a175-b398ae34c9d9',2,'2013-02-14 06:42:29'),(7,'511c7945-c9ec-4baf-a175-b398ae34c9d9',3,'2013-02-14 06:42:29'),(8,'511c7945-c9ec-4baf-a175-b398ae34c9d9',4,'2013-02-14 06:42:29'),(10,'511ea5ed-d838-460f-9317-47f1ae34c9d9',6,'2013-02-15 22:17:33'),(11,'511ea5ed-d838-460f-9317-47f1ae34c9d9',7,'2013-02-15 22:17:33'),(12,'511ea5ed-d838-460f-9317-47f1ae34c9d9',8,'2013-02-15 22:17:33'),(13,'511eaa80-4224-4fe4-a762-011cae34c9d9',6,'2013-02-15 22:37:04');
/*!40000 ALTER TABLE `questions_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'ajax','',1),(2,'jquery','',1),(3,'multiselect','',1),(4,'javascript','',1),(5,'phpmysqlimages','',1),(6,'php','',1),(7,'mysql','',1),(8,'images','',1);
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `hash_change_password` varchar(255) NOT NULL DEFAULT '',
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `link` varchar(200) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `image` text NOT NULL,
  `token` text NOT NULL,
  `location` varchar(200) NOT NULL,
  `provider` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('1b5b7568-7917-11e2-8eec-17ba60b0528a','deji','','addonis88@yahoo.com','','admin','2013-02-16 19:17:42','2013-02-16 19:17:42','','','','','','','','',''),('1b5b854e-7917-11e2-8eec-17ba60b0528a','mohammed ajala','','hotoracle2@gmail.com','mohammed ajala','','2013-02-16 21:44:20','2013-02-16 21:44:20','','mohammed','ajala','https://plus.google.com/114801751578195482688','male','https://lh3.googleusercontent.com/-i2DDjiUsQjU/AAAAAAAAAAI/AAAAAAAAAK4/tX0gPSVYy5M/photo.jpg','','','Google'),('cdf2310c-7611-11e2-8eec-17ba60b0528a','Femi Taiwo','','dftaiwo@gmail.com','Femi Taiwo','','2013-02-17 07:52:24','2013-02-17 07:52:24','','Femi','Taiwo','http://www.facebook.com/femi.taiwo','male','https://graph.facebook.com/516829919/picture?type=square','','','Facebook'),('fa5e9b92-76d2-11e2-8eec-17ba60b0528a','Mohammed Kabir Ajala','','hotoracle@yahoo.com','Mohammed Kabir Ajala','','2013-02-16 21:50:25','2013-02-16 21:50:25','','Mohammed Kabir','Ajala','http://www.facebook.com/hotoracle','male','https://graph.facebook.com/748474656/picture?type=square','','','Facebook');
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

-- Dump completed on 2013-02-17 16:45:50
