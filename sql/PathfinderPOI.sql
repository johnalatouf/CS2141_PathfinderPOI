-- MySQL dump 10.13  Distrib 5.6.24, for osx10.8 (x86_64)
--
-- Host: 127.0.0.1    Database: PathfinderPOI
-- ------------------------------------------------------
-- Server version	5.5.34

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
-- Table structure for table `attractions`
--

DROP TABLE IF EXISTS `attractions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attractions` (
  `attractionID` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(50) DEFAULT NULL,
  `category` char(30) DEFAULT NULL,
  `address` char(50) DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `state` char(30) DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `price` decimal(5,2) DEFAULT NULL,
  `avgRating` float DEFAULT NULL,
  `popularity` int(11) DEFAULT NULL,
  `geolatitude` decimal(10,7) DEFAULT NULL,
  `geoLongitude` decimal(10,7) DEFAULT NULL,
  PRIMARY KEY (`attractionID`),
  KEY `country` (`country`),
  KEY `attractions_ibfk_3_idx` (`category`),
  KEY `attractions_ibfk_1` (`city`),
  CONSTRAINT `attractions_ibfk_1` FOREIGN KEY (`city`) REFERENCES `cities` (`cityID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `attractions_ibfk_2` FOREIGN KEY (`country`) REFERENCES `countries` (`countryID`),
  CONSTRAINT `attractions_ibfk_3` FOREIGN KEY (`category`) REFERENCES `categories` (`category`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attractions`
--

LOCK TABLES `attractions` WRITE;
/*!40000 ALTER TABLE `attractions` DISABLE KEYS */;
INSERT INTO `attractions` VALUES (89,'Halifax Citadel','Historical','5425 Sackville St',10,'NS',6,11.70,4.33333,3,44.6463068,-63.5814455),(90,'Lake Louise','Nature','111 Lake Louise Dr',11,'AB',6,0.00,5,1,51.4190982,-116.2147009),(91,'Cedar Point','Amusement Park','1 Cedar Point Dr',12,'OH',7,54.00,4.5,2,41.4822070,-82.6835206),(92,'Grand Bahia Principe','Resort','Grand Bahia Principe Ambar',13,'',8,166.00,5,2,18.7272670,-68.5326696),(93,'White Point Beach Resort','Resort','75 White Point Beach Resort Rd,',14,'NS',6,120.00,4,1,43.9659733,-64.7374703),(94,'Kejimkujik National Park','Nature','3005 Main Pky',15,'NS',6,10.00,3,1,44.3833333,-65.3333333),(96,'Canadas Wonderland','Amusement Park','9580 Jane St',16,'ON',6,45.00,3,1,43.8430176,-79.5394625),(97,'Fisheries Museum of the Atlantic','Business','68 Bluenose Dr',17,'NS',6,10.00,2,1,44.3760613,-64.3122147);
/*!40000 ALTER TABLE `attractions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `category` char(30) NOT NULL DEFAULT '',
  `avgRating` float DEFAULT NULL,
  `popularity` int(11) DEFAULT NULL,
  PRIMARY KEY (`category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES ('Amusement Park',4,3),('Business',2,1),('Event',0,0),('Historical',4.33333,3),('Nature',4,2),('Resort',4.66667,3);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cities` (
  `cityID` int(11) NOT NULL AUTO_INCREMENT,
  `cityName` char(30) DEFAULT NULL,
  `state` char(30) DEFAULT NULL,
  `countryID` int(11) DEFAULT NULL,
  `avgRating` float DEFAULT NULL,
  `popularity` int(11) DEFAULT NULL,
  PRIMARY KEY (`cityID`),
  KEY `cities_ibfk_1` (`countryID`),
  CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`countryID`) REFERENCES `countries` (`countryID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (10,'Halifax','NS',6,4.33333,3),(11,'Lake Louise','AB',6,5,1),(12,'Sandusky','OH',7,4.5,2),(13,'Punta Cana','',8,5,2),(14,'White Point','NS',6,4,1),(15,'Maitland Bridge','NS',6,3,1),(16,'Vaughan','ON',6,3,1),(17,'Lunenburg','NS',6,2,1);
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `countryID` int(11) NOT NULL AUTO_INCREMENT,
  `countryName` char(30) DEFAULT NULL,
  `continent` char(20) DEFAULT NULL,
  `avgRating` float DEFAULT NULL,
  `popularity` int(11) DEFAULT NULL,
  PRIMARY KEY (`countryID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (6,'Canada','North America',3.75,8),(7,'United States','North America',4.5,2),(8,'Dominican Republic','North America',5,2);
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ratings` (
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `attraction` int(11) NOT NULL DEFAULT '0',
  `user` char(30) NOT NULL DEFAULT '',
  `rating` int(11) DEFAULT NULL,
  `date_visited` datetime DEFAULT NULL,
  PRIMARY KEY (`user`,`attraction`),
  KEY `ratings_ibfk_1` (`attraction`),
  CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`attraction`) REFERENCES `attractions` (`attractionID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ratings`
--

LOCK TABLES `ratings` WRITE;
/*!40000 ALTER TABLE `ratings` DISABLE KEYS */;
INSERT INTO `ratings` VALUES ('2015-12-06 00:53:13',89,'admin',5,'2015-09-25 00:00:00'),('2015-12-06 00:59:01',90,'admin',5,'2015-08-05 00:00:00'),('2015-12-06 01:06:16',91,'admin',4,'2013-07-24 00:00:00'),('2015-12-08 23:44:26',96,'admin',3,'2010-04-23 00:00:00'),('2015-12-06 01:31:44',89,'johna',4,'2010-02-25 00:00:00'),('2015-12-06 01:54:19',92,'johna',5,'2012-03-20 00:00:00'),('2015-12-06 01:53:20',94,'johna',3,'2014-08-14 00:00:00'),('2015-12-09 15:27:02',97,'kirby',2,'2012-09-24 00:00:00'),('2015-12-06 01:16:38',89,'test',4,'2010-10-10 00:00:00'),('2015-12-06 01:23:55',91,'test',5,'2014-09-01 00:00:00'),('2015-12-06 01:15:49',92,'test',5,'2013-03-25 00:00:00'),('2015-12-06 01:28:51',93,'test',4,'2015-07-25 00:00:00');
/*!40000 ALTER TABLE `ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews` (
  `reviewID` int(11) NOT NULL AUTO_INCREMENT,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `attraction` int(11) DEFAULT NULL,
  `user` char(30) DEFAULT NULL,
  `content` varchar(500) DEFAULT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`reviewID`),
  KEY `user` (`user`),
  KEY `reviews_ibfk_1` (`attraction`),
  CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`attraction`) REFERENCES `attractions` (`attractionID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (20,'2015-12-06 00:53:13',89,'admin','\"It’s obvious why this strategic hilltop location with a commanding view of the Halifax harbour was chosen in 1749 for the fort destined to protect the city. The Halifax Citadel’s star-shaped architecture is equally as impressive from the inside and out. \\r\\nStep back in time with the 78th Highlanders and the 3rd Brigade Royal Artillery to learn what it was like for the soldiers and their families to live and work in this historic fort.\\\" (Halifax National Historical Site of Canada)','img/hc.jpg'),(21,'2015-12-06 00:59:01',90,'admin','A beautiful glacial lake in Banff National Park.','img/ll.jpg'),(22,'2015-12-06 01:06:16',91,'admin','Cedar Point is an amusement park in Ohio that features several roller coasters.','img/cedar.jpg'),(23,'2015-12-06 01:15:49',92,'test','This resort is located in Punta Cana, right next to the ocean.','img/bahia.jpg'),(26,'2015-12-06 01:28:51',93,'test','White Point is a great, affordable beach resort in Nova Scotia. It includes swimming, surfing, kayaking, a restaurant, parties and events, etc.','img/wp.jpg'),(27,'2015-12-06 01:31:44',89,'johna','This is a very nice place.',''),(28,'2015-12-06 01:53:20',94,'johna','Keji is an excellent place to hike.','img/keji.jpg'),(29,'2015-12-06 01:54:19',92,'johna','Absolutely beautiful.','img/bahia2.jpg'),(30,'2015-12-08 23:44:26',96,'admin','Canada\\\'s Wonderland is an amusement park located outside of Toronto, Ontario. ','img/cedar.jpg'),(31,'2015-12-09 15:27:02',97,'kirby','This is a museum in Lunenburg, NS.','img/hc.jpg');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_history`
--

DROP TABLE IF EXISTS `user_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_history` (
  `userID` char(30) NOT NULL DEFAULT '',
  `date_entered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `attraction_visited` int(11) DEFAULT NULL,
  `date_visited` char(20) DEFAULT NULL,
  `reviews` int(11) DEFAULT NULL,
  `rating` float DEFAULT NULL,
  PRIMARY KEY (`userID`,`date_entered`),
  KEY `user_history_ibfk_3_idx` (`reviews`),
  KEY `user_history_ibfk_2_idx` (`attraction_visited`),
  CONSTRAINT `user_history_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_history_ibfk_2` FOREIGN KEY (`attraction_visited`) REFERENCES `attractions` (`attractionID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_history_ibfk_3` FOREIGN KEY (`reviews`) REFERENCES `reviews` (`reviewID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_history`
--

LOCK TABLES `user_history` WRITE;
/*!40000 ALTER TABLE `user_history` DISABLE KEYS */;
INSERT INTO `user_history` VALUES ('admin','2015-12-06 00:53:13',89,'2015-09-25 00:00:00',20,5),('admin','2015-12-06 00:59:01',90,'2015-08-05 00:00:00',21,5),('admin','2015-12-06 01:06:16',91,'2013-07-24 00:00:00',22,4),('admin','2015-12-08 23:44:26',96,'2010-04-23 00:00:00',30,3),('johna','2015-12-06 01:31:44',89,'2010-02-25 00:00:00',27,4),('johna','2015-12-06 01:53:20',94,'2014-08-14 00:00:00',28,3),('johna','2015-12-06 01:54:19',92,'2012-03-20 00:00:00',29,5),('kirby','2015-12-09 15:27:02',97,'2012-09-24 00:00:00',31,2),('test','2015-12-06 01:15:49',92,'2013-03-25 00:00:00',23,5),('test','2015-12-06 01:28:51',93,'2015-07-25 00:00:00',26,4);
/*!40000 ALTER TABLE `user_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_wishlist`
--

DROP TABLE IF EXISTS `user_wishlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_wishlist` (
  `userID` char(30) NOT NULL DEFAULT '',
  `attraction` int(11) NOT NULL DEFAULT '0',
  `date_entered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`userID`,`attraction`),
  KEY `user_wishlist_ibfk_2` (`attraction`),
  CONSTRAINT `user_wishlist_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_wishlist_ibfk_2` FOREIGN KEY (`attraction`) REFERENCES `attractions` (`attractionID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_wishlist`
--

LOCK TABLES `user_wishlist` WRITE;
/*!40000 ALTER TABLE `user_wishlist` DISABLE KEYS */;
INSERT INTO `user_wishlist` VALUES ('admin',94,'2015-12-08 23:45:39'),('johna',90,'2015-12-06 01:32:20'),('johna',91,'2015-12-06 01:32:00'),('kirby',92,'2015-12-09 15:27:22'),('test',90,'2015-12-06 01:24:21');
/*!40000 ALTER TABLE `user_wishlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `userID` char(30) NOT NULL DEFAULT '',
  `email` char(30) DEFAULT NULL,
  `name` char(40) DEFAULT NULL,
  `address` char(50) DEFAULT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `pword` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('admin','Johna.Latouf@dal.ca','admin','Halifax, NS, Canada',1,'$2y$10$gP.vCe0wUYeDb0QTWoYKe.C4pm9OP8dVYNbhSf7FD2H6ylWPXiK7i'),('bob','bob@','Bob','Ontario',0,'$2y$10$c3Sy6wSrg.jn5KENjhZwNOw/t3bOp7OfhAfiT9s1jCrd0hS9gRNPW'),('johna','Johna.Latouf@dal.ca','Johna Latouf','Lower Sackville',0,'$2y$10$TdtDA50EYSt5TJQoc7iOzOpEFBosEFDizTXjM9QpSHyvxb0IBAZzy'),('kirby','kirby@fake','Kirby the Pug','Halifax',0,'$2y$10$XS1V1EZzjxhPo.BwfY0dle1aZrgH1A4SkWNdgtGXui9d1C.yS.xXS'),('new','new','new','new',0,'$2y$10$o7HtwUZ9sttxv76MAk1kKeA0vMtbXg1VjP2sBIrQEsocNHAcWWE.u'),('test','test@test.fake','test','test',0,'$2y$10$.TpB7Gdrz7EAZav0RoLzP.MNsWS1kRD1pP0bQBeyYrJM3vBLS6G82'),('test_user','testuser@testuser','Test User','Fake St.',0,'$2y$10$UH.OZdUpm7rOmZJ/7Iet8O5RT2Rz7HkJdody4QXdBGwD1Kx2lO996');
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

-- Dump completed on 2016-01-05  8:58:35
