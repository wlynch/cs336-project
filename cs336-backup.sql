-- MySQL dump 10.13  Distrib 5.1.42, for pc-linux-gnu (i686)
--
-- Host: 127.0.0.1    Database: cs336
-- ------------------------------------------------------
-- Server version	5.1.42

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
-- Table structure for table `activity`
--

DROP TABLE IF EXISTS `activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity` (
  `aname` char(30) NOT NULL,
  `aid` int(11) NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity`
--

LOCK TABLES `activity` WRITE;
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;
INSERT INTO `activity` VALUES ('reading',1),('video gaming',2),('watching tv',3),('programming',4),('cooking',5),('photography',6),('meditating',7),('sports',8),('movies',9),('cleaning',10),('shopping',11),('eating',12),('travelling',13),('tea',14),('dancing',15),('blogging',16),('teaching',17),('trolling others',18),('languages',19),('culture',20),('garage sales',21),('junk collections',22),('winning',23),('making friends',24),('sleeping',25),('theater',26);
/*!40000 ALTER TABLE `activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `album`
--

DROP TABLE IF EXISTS `album`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `album` (
  `albumid` char(30) NOT NULL,
  `aname` char(30) NOT NULL,
  `year` int(11) DEFAULT NULL,
  PRIMARY KEY (`albumid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `album`
--

LOCK TABLES `album` WRITE;
/*!40000 ALTER TABLE `album` DISABLE KEYS */;
INSERT INTO `album` VALUES ('1','Absolution',2004),('2','Ocean Eyes',2010),('3','The Colour and the Shape',1997),('4','Enema of the State',1999),('5','Scary Monsters and Nice Sprite',2010);
/*!40000 ALTER TABLE `album` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `artist`
--

DROP TABLE IF EXISTS `artist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `artist` (
  `aid` int(11) NOT NULL,
  `name` char(30) NOT NULL,
  `purl` text,
  `bio` text,
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artist`
--

LOCK TABLES `artist` WRITE;
/*!40000 ALTER TABLE `artist` DISABLE KEYS */;
INSERT INTO `artist` VALUES (1,'Muse','http://t2.gstatic.com/images?q=tbn:ANd9GcTpF4r74iu63ibCGH2kg5-yJYmG8iyvKpZAFtFg3qW1SBsr6DV-qw','Biography Teignmouth, England, United Kingdom (1994 â€“ present). Muse are an alternative rock band from Teignmouth, England, United Kingdom. The band consists of Matthew Bellamy on lead vocals, piano, keyboard and guitar, Chris Wolstenholme on backing vocals and bass guitar, and Dominic Howard on drums and percussion. They have been friends since their formation in early 1994 and changed band names a number of times (such as Gothic Plague, Fixed Penalty, and Rocket Baby Dolls) before adopting the name Muse. Since the release of their fourth album, Morgan Nicholls has also appeared with the band at live performances to provide keyboards, samples/synth, and backing vocals. Their sound is a blend of alternative rock, classical music, electronica, metal, spanish guitars, and progressive rock. Usually they use the bass line as the driving force, often with the guitar providing only an extra layer to the song rather than carrying the melody, the bass has distortion and other effects applied to it to achieve a greater weight, allowing the guitar to digress from the main tune and play higher notes. Another peculiarity is MuseÂ´s piano style in many of their songs; their music has been inspired by the works of Romantic pianist-composers such as Rachmaninoff, Tchaikovsky and Liszt, and has thus resulted in a fusion of Romantic style with modern rock. The band is known for their energetic live performances and front man Matthew Bellamyâ€™s eccentric and avid interests in global conspiracy, extraterrestrial life, theology and the apocalypse (as much as in Space and theoretical physics). Their lyrical themes involve madcap conspiracy theory, revolutionary rabble-rousing, weird stuff about aliens (or Zetas, if you please), religions and other such classic Muse concerns.'),(2,'Owl City','http://t3.gstatic.com/images?q=tbn:ANd9GcRDaPaFuwQZRL3R6g6B8qyWhBixjuQY2GWrLvbmHU3kH63FTleW','Owl City is an American electropop musical project by Adam Young. Young started out making music in 2007 in his basement in his hometown of Owatonna, Minnesota, United States, later developing a following through his MySpace profile before being signed to Universal Republic. Young has released four albums under the Owl City moniker: â€œMaybe Iâ€™m Dreamingâ€ (2008), â€œOcean Eyesâ€ (2009), â€œAll Things Bright and Beautifulâ€ (2011) and â€œThe Midsummer Stationâ€ (2012). Youngâ€™s 2009 single â€œFirefliesâ€ reached #1 in the United States, United Kingdom, Ireland, Australia and The Netherlands. His second major hit, 2012â€™s â€œGood Timeâ€ featuring Carly Rae Jepsen reached #13 in the US and #1 in New Zealand'),(3,'Foo Fighters','http://t1.gstatic.com/images?q=tbn:ANd9GcS77OS7Vhaf5w8QIbtu-SRLB-FDa_fI9CVcPPgn9gaO0pCEeYFS','Foo Fighters are an American rock band formed by singer/guitarist/drummer Dave Grohl in 1995 in Seattle, USA. Grohl formed the group as a one-man project after the dissolution of his previous band Nirvana in 1994. Prior to the release of Foo Fighters in 1995, Grohl drafted Nate Mendel (bass), William Goldsmith (drums) (both of Sunny Day Real Estate and The Fire Theft), and Pat Smear (guitar) (of The Germs) to complete the group. Goldsmith left during the recording of the groupâ€™s second album The Colour and the Shape (1997), soon followed by Smear. They were replaced by Taylor Hawkins and Franz Stahl, respectively, although Stahl left prior to the recording of the groupâ€™s third album, There Is Nothing Left to Lose (1999). Chris Shiflett joined as the bandâ€™s second guitarist after the completion of There Is Nothing Left to Lose. The band released its fourth album One by One in 2002. The group followed that release with the two-disc In Your Honor (2005), which was split between acoustic songs and harder-rocking material. Foo Fighters released its sixth album Echoes, Silence, Patience & Grace in 2007. Over the course of the bandâ€™s career, three of its albums have won Grammy Awards for Best Rock Album, and all six have been nominated for Grammys. The bandâ€™s seventh album Wasting Light was released in 2011 and peaked at #1 in several countries.'),(4,'blink-182','http://t1.gstatic.com/images?q=tbn:ANd9GcTqZHoiUnbQ9yg_366V0qhJKAR7IlGv42H5veQ6AE4yKlbdCDmCcQ','Blink-182 is a pop punk band from San Diego, California formed in 1992 by Tom DeLonge, Mark Hoppus, and Scott Raynor. In 1998, Raynor was replaced by Travis Barker, and in early 2005 DeLonge left the group, initiating an indefinite hiatus. DeLonge went on to form Angels & Airwaves, while Hoppus and Barker formed +44. On February 8, 2009, blink-182 announced that they had reunited.'),(5,'Skrillex','http://t1.gstatic.com/images?q=tbn:ANd9GcSRwujtIDT6bcwdjKjIatq_OPXNsT8VKS7qwqcCxKO6AsoF-LEr','Skrillex is the pseudonym used by Los Angeles, California, USA musician Sonny Moore to differentiate his electronic solo work from his work with From First To Last and his other solo projects.As Skrillex, Moore is an electronic DJ and producer boasting a musical style that incorporates electro house, fidget house, and dubstep. Moore began producing and performing under the alias Skrillex at clubs in the Los Angeles area in 2008. Throughout 2010, Skrillex became a bigger and bigger part of Mooreâ€™s life. On June 7, 2010 he released his debut EP as Skrillex, My Name Is Skrillex, as a free download. Soon after, he was signed to mau5trap and began a nationwide tour with deadmau5. On October 22, 2010 he released his second EP, Scary Monsters and Nice Sprites, as a co-release through mau5trap and Big Beat. On June 2, 2011, Moore announced the release of a â€œScary Monsters and Nice Spritesâ€ remix EP titled More Monsters And Sprites, which was released on June 7, 2011 on Beatport and June 21, 2011 on iTunes. It contained 3 new tracks, as well as 4 remixes of â€œScary Monsters and Nice Spritesâ€. Skrillex announced his label OWSLA on August 17, 2011. On December 23, 2011, Moore released the Bangarang EP. The EP features Ellie Goulding on the track â€œSummitâ€, as well as collaborations with Wolfgang Gartner, Kill the Noise, The Doors and 12th Planet'),(6,'Streetlight Manifesto','http://t1.gstatic.com/images?q=tbn:ANd9GcShoNqhh1ZPMoqgzMA1Xd9TEI0g_1hxY8v7pAvYIwROt5mOujjlqA','Streetlight Manifesto is a third wave ska punk band from East Brunswick, New Jersey, under the creative leadership of singer/guitarist Tomas Kalnoky. Since forming in 2002, the band has released four full-length albums.');
/*!40000 ALTER TABLE `artist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attended`
--

DROP TABLE IF EXISTS `attended`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attended` (
  `uid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `degree` char(40) NOT NULL,
  PRIMARY KEY (`uid`,`sid`,`degree`),
  KEY `sid` (`sid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attended`
--

LOCK TABLES `attended` WRITE;
/*!40000 ALTER TABLE `attended` DISABLE KEYS */;
INSERT INTO `attended` VALUES (0,1,'2010-09-10','2014-05-01','Computer Science'),(1,1,'2010-09-10','2014-05-01','Computer Science'),(2,1,'2010-09-10','2014-05-01','Computer Science'),(3,2,'2010-09-15','2014-05-15','Public Policy'),(4,1,'2010-09-01','2014-05-01','Economics'),(5,7,'2005-09-15','2008-05-15','Applied mathematics'),(5,8,'2010-09-10','2011-05-01','Mathematics'),(6,3,'2010-09-01','2014-05-01','Civil Engineering'),(7,1,'2011-09-01','2015-05-01','Biology'),(8,2,'2010-09-15','2014-05-15','Religion'),(9,1,'2010-09-01','2014-05-01','Political Science'),(10,2,'2010-09-15','2014-05-15','Public Policy'),(11,2,'2010-09-15','2014-05-15','Anthropology'),(12,5,'1996-09-01','2000-05-01','Chinese'),(12,6,'2000-09-01','2002-05-01','Music'),(13,4,'2004-08-15','2008-05-15','Physical Education'),(14,9,'1729-09-15','1733-05-15','Oriental Art and Painting'),(14,9,'1729-09-15','1733-05-15','Asian Womens and Gender Studies');
/*!40000 ALTER TABLE `attended` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company` (
  `cid` int(11) NOT NULL,
  `employer_name` char(30) NOT NULL,
  `address` char(255) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES (1,'Rutgers LCSR','Piscataway, NJ, USA'),(2,'Rutgers NBCS','New Brunswick, NJ, USA'),(3,'Princeton University','Princeton, NJ, USA'),(4,'Ocean Mutterflies Music','Singapore, Singapore'),(5,'Warner Music Taiwan','Taipei, Taiwan'),(6,'Aisin Gioro Family Company','Beijing, China'),(7,'Jamaican National Olympic Team','Kingston, Jamaica'),(9,'Yakuza Crime Syndicate','Tokyo, Japan'),(10,'Shen Family Incorporated','Anaheim, CA, USA'),(11,'Frank Pallone','New Brunswick, NJ, USA'),(12,'UFO Record','Hong Kong, China'),(13,'Buddhist Society of Hong Kong','Hong Kong, China'),(14,'Kathka Event Planning','Topeka, KS, USA'),(15,'HZGG Tumblr Inc, Ltd.','Bridgewater, NJ, USA'),(8,'iPartment Residential Assoc','Shanghai, China');
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employment`
--

DROP TABLE IF EXISTS `employment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employment` (
  `job_title` char(25) DEFAULT NULL,
  `salary` int(11) DEFAULT NULL,
  `uid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  PRIMARY KEY (`uid`,`cid`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employment`
--

LOCK TABLES `employment` WRITE;
/*!40000 ALTER TABLE `employment` DISABLE KEYS */;
INSERT INTO `employment` VALUES ('System Administrator',13,1,1,'2011-09-01',NULL),('Lab Consultant',9,2,2,'2012-01-25',NULL),('Chairwoman of Reunions',25,3,14,'2010-09-15',NULL),('Caption Lady',13,3,15,'2011-12-24',NULL),('Benevolent Dictator',33,3,8,'2012-06-01',NULL),('Mad Scientist',2,4,10,'1992-10-23',NULL),('Assistant Professor',70,5,3,'2011-09-15',NULL),('Singer-Songwriter',44,8,12,'2004-01-01','2011-01-01'),('Buddhist Monk',0,8,13,'2010-01-02',NULL),('Campaign Secretary',18,9,11,'2012-01-01','2012-11-06'),('Bubble Tea Delivery Boy',100,10,9,'2008-01-01',NULL),('Writing Tutor',10,11,3,'2010-09-15','2012-05-15'),('Singer-Songwriter',80,12,4,'2003-01-01','2011-06-01'),('Singer-Songwriter',90,12,5,'2011-06-02',NULL),('Sprinter',50,13,7,'2004-09-01',NULL),('Palace Painter',30,14,6,'1735-01-01','1749-08-20');
/*!40000 ALTER TABLE `employment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `friend`
--

DROP TABLE IF EXISTS `friend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `friend` (
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  PRIMARY KEY (`user1`,`user2`),
  KEY `user2` (`user2`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friend`
--

LOCK TABLES `friend` WRITE;
/*!40000 ALTER TABLE `friend` DISABLE KEYS */;
/*!40000 ALTER TABLE `friend` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `in_relationship_with`
--

DROP TABLE IF EXISTS `in_relationship_with`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `in_relationship_with` (
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  `status` char(20) DEFAULT NULL,
  PRIMARY KEY (`user1`,`user2`),
  KEY `user2` (`user2`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `in_relationship_with`
--

LOCK TABLES `in_relationship_with` WRITE;
/*!40000 ALTER TABLE `in_relationship_with` DISABLE KEYS */;
/*!40000 ALTER TABLE `in_relationship_with` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `interested_in`
--

DROP TABLE IF EXISTS `interested_in`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interested_in` (
  `actid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`uid`,`actid`),
  KEY `actid` (`actid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interested_in`
--

LOCK TABLES `interested_in` WRITE;
/*!40000 ALTER TABLE `interested_in` DISABLE KEYS */;
INSERT INTO `interested_in` VALUES (2,0),(4,0),(2,1),(4,1),(8,1),(18,1),(19,1),(5,2),(6,2),(12,2),(14,2),(19,2),(5,3),(6,3),(13,3),(14,3),(16,3),(25,3),(3,4),(9,4),(10,4),(1,5),(17,5),(7,8),(11,8),(20,8),(6,9),(14,9),(15,9),(13,10),(19,10),(20,10),(21,10),(22,10),(1,11),(6,11),(16,11),(25,11),(6,12),(13,12),(23,13),(13,14),(19,14),(24,14),(25,14),(26,14);
/*!40000 ALTER TABLE `interested_in` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `library`
--

DROP TABLE IF EXISTS `library`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `library` (
  `sid` int(11) NOT NULL,
  `albumid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  KEY `sid` (`sid`),
  KEY `albumid` (`albumid`),
  KEY `FK_library` (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `library`
--

LOCK TABLES `library` WRITE;
/*!40000 ALTER TABLE `library` DISABLE KEYS */;
INSERT INTO `library` VALUES (1,1,1),(2,1,1),(3,1,1),(4,1,1),(5,1,1),(6,2,2),(7,2,2),(8,2,2),(9,2,2),(10,2,2),(11,3,3),(12,3,3),(13,3,3),(14,3,3),(15,3,3),(16,4,4),(17,4,4),(18,4,4),(19,4,4),(20,4,4),(21,5,5),(22,5,5),(23,5,5),(24,5,5),(25,5,5);
/*!40000 ALTER TABLE `library` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likesAlbum`
--

DROP TABLE IF EXISTS `likesAlbum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `likesAlbum` (
  `uid` int(11) NOT NULL,
  `albumid` int(11) NOT NULL,
  PRIMARY KEY (`uid`,`albumid`),
  KEY `albumid` (`albumid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likesAlbum`
--

LOCK TABLES `likesAlbum` WRITE;
/*!40000 ALTER TABLE `likesAlbum` DISABLE KEYS */;
/*!40000 ALTER TABLE `likesAlbum` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likesArtist`
--

DROP TABLE IF EXISTS `likesArtist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `likesArtist` (
  `uid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  PRIMARY KEY (`uid`,`aid`),
  KEY `aid` (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likesArtist`
--

LOCK TABLES `likesArtist` WRITE;
/*!40000 ALTER TABLE `likesArtist` DISABLE KEYS */;
/*!40000 ALTER TABLE `likesArtist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likesSong`
--

DROP TABLE IF EXISTS `likesSong`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `likesSong` (
  `uid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  PRIMARY KEY (`uid`,`sid`),
  KEY `sid` (`sid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likesSong`
--

LOCK TABLES `likesSong` WRITE;
/*!40000 ALTER TABLE `likesSong` DISABLE KEYS */;
/*!40000 ALTER TABLE `likesSong` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `mid` int(11) NOT NULL,
  `ownerid` int(11) NOT NULL,
  `senderid` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `content` char(255) DEFAULT NULL,
  `subject` char(100) NOT NULL,
  PRIMARY KEY (`mid`),
  KEY `ownerid` (`ownerid`),
  KEY `senderid` (`senderid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pending_friend`
--

DROP TABLE IF EXISTS `pending_friend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pending_friend` (
  `requesting` int(11) NOT NULL,
  `requested` int(11) NOT NULL,
  PRIMARY KEY (`requesting`,`requested`),
  KEY `requested` (`requested`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pending_friend`
--

LOCK TABLES `pending_friend` WRITE;
/*!40000 ALTER TABLE `pending_friend` DISABLE KEYS */;
/*!40000 ALTER TABLE `pending_friend` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `school`
--

DROP TABLE IF EXISTS `school`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `school` (
  `sid` int(11) NOT NULL,
  `sname` char(40) NOT NULL,
  `address` char(80) DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `school`
--

LOCK TABLES `school` WRITE;
/*!40000 ALTER TABLE `school` DISABLE KEYS */;
INSERT INTO `school` VALUES (1,'Rutgers University','Piscataway, NJ, USA'),(2,'Princeton University','Princeton, NJ, USA'),(3,'Lehigh University','Bethlehem, PA, USA'),(4,'Kingston University of Technology','Kingston, Jamaica'),(5,'Anglo-Chinese School','Singapore, Singapore'),(6,'Saint Andrews Junior College','Singapore, Singapore'),(7,'Ecole Normale Superieure de Cachan','Cachan, France'),(8,'Centre de Recerca Matematica','Barcelona, Spain'),(9,'Peking University','Beijing, China');
/*!40000 ALTER TABLE `school` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `song`
--

DROP TABLE IF EXISTS `song`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `song` (
  `sid` int(11) NOT NULL,
  `sname` char(30) NOT NULL,
  `genre` char(20) DEFAULT NULL,
  `length` int(11) DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `song`
--

LOCK TABLES `song` WRITE;
/*!40000 ALTER TABLE `song` DISABLE KEYS */;
INSERT INTO `song` VALUES (1,'Madness','Progressive Rock',320),(2,'Panic Station','Progressive Rock',187),(3,'Supremacy','Progressive Rock',300),(4,'Survival','Progressive Rock',321),(5,'Follow Me','Progressive Rock',230),(6,'Cave In','Electronic',202),(7,'The Bird and The Worm','Electronic',208),(8,'Hello Seattle','Electronic',177),(9,'Umbrella Beach','Electronic',231),(10,'The Saltwater Room','Electronic',243),(11,'Doll','Rock',84),(12,'Monkey Wrench','Rock',231),(13,'Hey, Johnny Park!','Rock',248),(14,'My Poor Brain','Rock',213),(15,'Wind Up','Rock',210),(16,'Dumpweed','Punk',144),(17,'Dont Leave Me','Punk',143),(18,'Aliens Exist','Punk',193),(19,'Going Away to College','Punk',179),(20,'Whats My Age Again?','Punk',148),(21,'Scary Monsters and Nice Sprite','Dubstep',191),(22,'Rock N Roll','Dubstep',286),(23,'Kill Everybody','Dubstep',299),(24,'All I Ask of You','Dubstep',342),(25,'Scatta','Dubstep',236);
/*!40000 ALTER TABLE `song` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `photoid` char(40) DEFAULT NULL,
  `gender` char(8) NOT NULL,
  `address` char(80) DEFAULT NULL,
  `username` char(32) NOT NULL,
  `firstname` char(32) DEFAULT NULL,
  `lastname` char(32) DEFAULT NULL,
  `email` char(32) DEFAULT NULL,
  `birth` date NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (0,'0','Male','148 Spruce Dr, Shrewsbury, NJ, USA','ekamp','Erik','Kamp','ekamp@eden.rutgers.edu','1991-05-22'),(1,'1','Male','123 Billay Ln, Beaverton, OR, USA','wlynch92','Billy','Lynch','wlynch92@eden.rutgers.edu','1992-11-18'),(2,'2','Female','560 Windstone Trail, Alpharetta, GA, USA','jennpeare','Jenny','Shi','jenny.shi@rutgers.edu','1992-06-07'),(3,'3','Female','25 Sunflower Rd, Lawrence, KS, USA','ksun92','Kathy','Sun','kathy@rulingtheworld.com','1992-06-13'),(4,'4','Female','34 Tuscan Dr, Anaheim, CA, USA','vickishen23','Vicki','Shen','ickivicki@gmail.com','1992-10-23'),(5,'5','Male','65 Rue Jacques Ln, Toulouse, France','sbubeck','Sebastien','Bubeck','lovemyaccent@princeton.edu','1985-04-16'),(6,'6','Male','12 Leonardo Ct, Middletown, NJ, USA','dchad','Dan','Chadwick','cthudawn@gmail.com','1991-09-15'),(7,'7','Female','15 New Rd, South Brunswick, NJ, USA','guardGirl11','Sarah','Feldman','srf73@rutgers.edu','1993-05-20'),(8,'8','Male','888 Fafafa Ave, Hongkong, China','premedstudent','Ho Wa','Cheng','luckyme@sina.com.cn','1988-08-08'),(9,'9','Female','14 Eva Ave, Estelline, SD, USA','lynn','Janice','Tsai','pastmecomeback@gmail.com','1992-03-28'),(10,'10','Male','123 Kawaiiness Blvd, Shibuya, Japan','thebesthostever','Shiro','Kuriwaki','cheapairmattress@princeton.edu','1991-06-10'),(11,'11','Female','E Nakhalpara Rd, Dhaka, Bangladesh','thetorturedone','Alaka','Halder','forevermia@facebook.com','1990-01-01'),(12,'12','Male','54 Orchard Blvd, Singapore, Singapore','jjlin','Junjie','Lin','jjlin@oceanbutterflies.org','1981-03-27'),(13,'13','Male','77 Fast Ln, Trelawny, Jamaica','lightningbolt','Usain','Bolt','irunfast@olympics.org','1986-08-21'),(14,'14','Male','39 Fairfax Ave, Oxford, England, United Kingdom','iheartchina','Cody','Abbey','benjithepainter@hzgg.edu','1711-10-22');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-11-28 17:23:35
