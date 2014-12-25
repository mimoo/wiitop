-- MySQL dump 10.13  Distrib 5.1.73, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: wiitop
-- ------------------------------------------------------
-- Server version 5.1.73-1

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
-- Current Database: `wiitop`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `wiitop` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `wiitop`;

--
-- Table structure for table `wiitop_games`
--

DROP TABLE IF EXISTS `wiitop_games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wiitop_games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `official` tinyint(1) NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  `id_tn` int(11) NOT NULL,
  `players` tinyint(4) NOT NULL,
  `servers` tinyint(4) NOT NULL,
  `maps` tinyint(4) NOT NULL,
  `scores` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wiitop_games`
--

LOCK TABLES `wiitop_games` WRITE;
/*!40000 ALTER TABLE `wiitop_games` DISABLE KEYS */;
INSERT INTO `wiitop_games` VALUES (1,'cs:go',1,'[{\"name\":\"de_dust2\",\"url\":\"http:\\/\\/i.imgur.com\\/kcVxOav.jpg\"},{\"name\":\"de_nuke\",\"url\":\"http:\\/\\/i.imgur.com\\/RkK8n2k.jpg\"},{\"name\":\"de_inferno\",\"url\":\"http:\\/\\/i.imgur.com\\/ZL2uO1y.jpg\"},{\"name\":\"de_train\",\"url\":\"http:\\/\\/i.imgur.com\\/4QHobcf.jpg\"},{\"name\":\"de_vertigo\",\"url\":\"http:\\/\\/i.imgur.com\\/nHBwcZz.jpg\"}]',1,5,1,1,1),(2,'LoL',1,'',1,5,0,0,0),(3,'Dota2',1,'',1,5,0,0,0),(4,'Starcraft2 1on1',0,'[{\"name\":\"Lost Temple\",\"url\":\"http:\\/\\/i.imgur.com\\/4g0w9oV.jpg\"}]',1,1,0,1,0),(5,'cs:golol',0,'[{\"name\":\"de_dust2\",\"url\":\"http:\\/\\/i.imgur.com\\/kcVxOav.jpg\"},{\"name\":\"de_nuke\",\"url\":\"http:\\/\\/i.imgur.com\\/RkK8n2k.jpg\"},{\"name\":\"de_inferno\",\"url\":\"http:\\/\\/i.imgur.com\\/ZL2uO1y.jpg\"},{\"name\":\"de_train\",\"url\":\"http:\\/\\/i.imgur.com\\/4QHobcf.jpg\"},{\"name\":\"de_vertigo\",\"url\":\"http:\\/\\/i.imgur.com\\/nHBwcZz.jpg\"}]',4,5,1,1,1),(6,'LoLol',0,'',4,5,0,0,0),(7,'cs:golol',0,'[{\"name\":\"de_dust2\",\"url\":\"http:\\/\\/i.imgur.com\\/kcVxOav.jpg\"},{\"name\":\"de_nuke\",\"url\":\"http:\\/\\/i.imgur.com\\/RkK8n2k.jpg\"},{\"name\":\"de_inferno\",\"url\":\"http:\\/\\/i.imgur.com\\/ZL2uO1y.jpg\"},{\"name\":\"de_train\",\"url\":\"http:\\/\\/i.imgur.com\\/4QHobcf.jpg\"},{\"name\":\"de_vertigo\",\"url\":\"http:\\/\\/i.imgur.com\\/nHBwcZz.jpg\"}]',4,5,1,1,1),(8,'Counter Strike ',0,'',6,5,1,0,1),(9,'LoL',0,'[]',7,1,0,1,1),(10,'Counter Strike 1.6',0,'',13,5,1,0,1),(11,'LoL',0,'[{\"name\":\"Sihirdar Vadisi\",\"url\":\"https:\\/\\/encrypted-tbn0.gstatic.com\\/images?q=tbn:ANd9GcQQEwGU4UA9j1jpBXZYJACN9DhWIDMdh1OU_wHTtCZXpDycZg7YAA\"}]',15,7,1,1,1),(12,'Counter-Strike 1.6',0,'',16,5,1,1,1),(13,'Counter Strike 1.6',0,'',18,5,1,1,1),(14,'Condition-Zero',0,'',20,5,0,1,0),(15,'Dota2',0,'',23,1,1,1,1),(16,'CS 1.6',0,'[{\"name\":\"de_dust2\",\"url\":\"http:\\/\\/s8.postimg.org\\/djslvmrjp\\/dedust2.jpg\"},{\"name\":\"de_nuke\",\"url\":\"http:\\/\\/postimg.org\\/image\\/46p67scu3\\/\"},{\"name\":\"de_inferno\",\"url\":\"http:\\/\\/s23.postimg.org\\/n4h1zufm3\\/inferno.jpg\"},{\"name\":\"de_mirage\",\"url\":\"http:\\/\\/s11.postimg.org\\/5bgspv8ab\\/demirage.jpg\"},{\"name\":\"de_train\",\"url\":\"http:\\/\\/postimg.org\\/image\\/ykw764p35\\/\"},{\"name\":\"de_tuscan\",\"url\":\"http:\\/\\/postimg.org\\/image\\/ypx90zm2v\\/\"}]',24,5,1,1,1),(17,'css',0,'[]',28,5,1,1,1),(18,'LoL',0,'',32,5,0,0,0),(19,'Counter Strike 1.6',0,'',35,5,1,1,1),(20,'Condition Zero',0,'[{\"name\":\"de_dust2\",\"url\":\"http:\\/\\/i.imgur.com\\/kcVxOav.jpg\"},{\"name\":\"de_nuke\",\"url\":\"http:\\/\\/i.imgur.com\\/RkK8n2k.jpg\"},{\"name\":\"de_inferno\",\"url\":\"http:\\/\\/i.imgur.com\\/ZL2uO1y.jpg\"},{\"name\":\"de_train\",\"url\":\"http:\\/\\/i.imgur.com\\/4QHobcf.jpg\"},{\"name\":\"de_vertigo\",\"url\":\"http:\\/\\/i.imgur.com\\/nHBwcZz.jpg\"}]',36,5,1,1,1),(21,'Shootmania',0,'',39,3,1,1,1),(22,'css',0,'[{\"name\":\"de_inferno\",\"url\":\"http:\\/\\/i.imgur.com\\/fO9vw7f.jpg\"},{\"name\":\"de_dust2\",\"url\":\"http:\\/\\/i.imgur.com\\/aAoCGFY.jpg\"},{\"name\":\"de_nuke\",\"url\":\"http:\\/\\/i.imgur.com\\/1qLvt73.jpg\"},{\"name\":\"de_cbble\",\"url\":\"http:\\/\\/i.imgur.com\\/CsUx4U1.jpg\"},{\"name\":\"de_dust\",\"url\":\"http:\\/\\/i.imgur.com\\/4x5bGN0.jpg\"},{\"name\":\"de_prodigy\",\"url\":\"http:\\/\\/i.imgur.com\\/1YZG3Gg.jpg\"},{\"name\":\"de_port\",\"url\":\"http:\\/\\/i.imgur.com\\/KKY6rmH.jpg\"},{\"name\":\"de_aztec\",\"url\":\"http:\\/\\/i.imgur.com\\/jIW98VY.jpg\"},{\"name\":\"de_tides\",\"url\":\"http:\\/\\/i.imgur.com\\/y7aujB3.jpg\"},{\"name\":\"de_tuscan\",\"url\":\"http:\\/\\/i.imgur.com\\/ruRHwDv.jpg\"},{\"name\":\"de_train\",\"url\":\"http:\\/\\/i.imgur.com\\/Q8mWpwN.jpg\"}]',40,6,1,1,1),(23,'Counter Strike',0,'[{\"name\":\"de_dust2\",\"url\":\"http:\\/\\/i.imgur.com\\/kcVxOav.jpg\"},{\"name\":\"de_nuke\",\"url\":\"http:\\/\\/i.imgur.com\\/RkK8n2k.jpg\"},{\"name\":\"de_inferno\",\"url\":\"http:\\/\\/i.imgur.com\\/ZL2uO1y.jpg\"}]',41,5,1,1,1),(24,'cs:go',0,'[{\"name\":\"de_dust2\",\"url\":\"http:\\/\\/i.imgur.com\\/kcVxOav.jpg\"},{\"name\":\"de_nuke\",\"url\":\"http:\\/\\/i.imgur.com\\/RkK8n2k.jpg\"},{\"name\":\"de_inferno\",\"url\":\"http:\\/\\/i.imgur.com\\/ZL2uO1y.jpg\"},{\"name\":\"de_train\",\"url\":\"http:\\/\\/i.imgur.com\\/4QHobcf.jpg\"},{\"name\":\"de_vertigo\",\"url\":\"http:\\/\\/i.imgur.com\\/nHBwcZz.jpg\"}]',45,5,1,1,1),(25,'Gamestation',0,'',45,5,0,1,1),(26,'FIFA 14',0,'',47,1,0,0,0);
/*!40000 ALTER TABLE `wiitop_games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wiitop_groups`
--

DROP TABLE IF EXISTS `wiitop_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wiitop_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wiitop_groups`
--

LOCK TABLES `wiitop_groups` WRITE;
/*!40000 ALTER TABLE `wiitop_groups` DISABLE KEYS */;
INSERT INTO `wiitop_groups` VALUES (1,'admin','Administrator'),(2,'members','General User');
/*!40000 ALTER TABLE `wiitop_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wiitop_ips`
--

DROP TABLE IF EXISTS `wiitop_ips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wiitop_ips` (
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `action` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `times` tinyint(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wiitop_ips`
--

LOCK TABLES `wiitop_ips` WRITE;
/*!40000 ALTER TABLE `wiitop_ips` DISABLE KEYS */;
/*!40000 ALTER TABLE `wiitop_ips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wiitop_login_attempts`
--

DROP TABLE IF EXISTS `wiitop_login_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wiitop_login_attempts` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `login` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wiitop_login_attempts`
--

LOCK TABLES `wiitop_login_attempts` WRITE;
/*!40000 ALTER TABLE `wiitop_login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `wiitop_login_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wiitop_news`
--

DROP TABLE IF EXISTS `wiitop_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wiitop_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_page` int(11) NOT NULL,
  `id_login` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wiitop_news`
--

LOCK TABLES `wiitop_news` WRITE;
/*!40000 ALTER TABLE `wiitop_news` DISABLE KEYS */;
/*!40000 ALTER TABLE `wiitop_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wiitop_pages`
--

DROP TABLE IF EXISTS `wiitop_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wiitop_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `namespace` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `rules` text COLLATE utf8_unicode_ci NOT NULL,
  `faq` text COLLATE utf8_unicode_ci NOT NULL,
  `contact` text COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `theme` int(11) NOT NULL,
  `live` tinyint(4) NOT NULL,
  `games` text COLLATE utf8_unicode_ci NOT NULL,
  `update_onchange` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `wiitop_themes`
--

DROP TABLE IF EXISTS `wiitop_themes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wiitop_themes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `official` tinyint(4) NOT NULL,
  `id_page` int(11) NOT NULL,
  `css` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wiitop_themes`
--

LOCK TABLES `wiitop_themes` WRITE;
/*!40000 ALTER TABLE `wiitop_themes` DISABLE KEYS */;
INSERT INTO `wiitop_themes` VALUES (1,'default',1,0,'body{background:url(/images/default_background.png)}::-moz-selection{background:#f15a23;color:#fff;text-shadow:none}::selection{background:#f15a23;color:#fff;text-shadow:none}#wrapper{box-shadow:0 0 15px rgba(0,0,0,0.4);width:1000px}header{background-color:#F60;padding:hey20px}header h1{margin:0;color:#FFFFFF;padding:20px;font-size:32px;font-weight:700;cursor:default}nav{background-color:#333}nav ul{font-size:0;line-height:0;margin:0}nav ul li{display:inline-block;margin-left:0}nav ul li a{float:left;padding:10px;display:block;color:#FFF;font-weight:bold;font-size:11px;-webkit-transition:background-color 0.25s ease-out;-moz-transition:background-color 0.25s ease-out;-ms-transition:background-color 0.25s ease-out;-o-transition:background-color 0.25s ease-out;transition:background-color 0.25s ease-out}nav ul li a:hover{background-color:#F60;color:#FFF;text-decoration:none}#content{background-color:#FFFFFF;padding:40px}footer{padding:40px;text-align:center;font-size:11px;background-color:#FFF}#teams .team_player{color:#333333}#teams .team_server .server_on{color:#669966}#teams .team_server .server_off{color:#FF33CC}#teams tr{-webkit-transition:background-color 0.25s ease-out;-moz-transition:background-color 0.25s ease-out;-ms-transition:background-color 0.25s ease-out;-o-transition:background-color 0.25s ease-out;transition:background-color 0.25s ease-out}#teams tr td{padding:5px}#teams tr:nth-child(even){background-color:#e3e3e3}#teams tr:nth-child(odd){background-color:#FFF}#teams tr:hover{background-color:#CCC}#maps .map{border:1px #000 solid}#maps .winner{background-image:url(http://i.imgur.com/peAErWM.jpg)}#bracket{margin-bottom:40px}#bracket .team{padding:5px;cursor:default;-moz-user-select:none;-webkit-user-select:none}#bracket .span2{text-align:right}#bracket .winner .span2{color:#669966}#bracket .loser .span2{color:#FF33CC}#oldtn{margin-right:240px}#oldtn article{-webkit-box-shadow:0 0 5px rgba(0,0,0,0.2);box-shadow:0 0 5px rgba(0,0,0,0.2);padding:10px;overflow:auto;margin-bottom:20px}#oldtn article h1{margin:0 65px;font-size:3em;font-weight:300}#oldtn article section{float:left;text-align:center}#oldtn article section span{display:block}#oldtn article section .day{background:#f2f2f2;font-size:16px;font-weight:500;color:#999;border-radius:2px 2px 0 0;padding:10px}#oldtn article section .month{background:#ccc;color:#fff;border-radius:0 0 2px 2px;box-shadow:inset 0 -1px 0 0 rgba(0,0,0,0.07);padding:0 10px 2px}#oldtnright{float:right;width:200px}#oldtnright h1{background:#ccc;color:#fff;border-radius:0 0 2px 2px;box-shadow:inset 0 -1px 0 0 rgba(0,0,0,0.07);padding:0 10px 2px}.oldtn p{margin-top:5px;color:#333333;font-size:11px;text-align:center}.oldtn a{color:#666666;text-decoration:none}.oldtn th{color:#000000;padding-bottom:5px;border-bottom:1px #666 solid}.oldtn img{border:0}\r\n');
/*!40000 ALTER TABLE `wiitop_themes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wiitop_tournaments`
--

DROP TABLE IF EXISTS `wiitop_tournaments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wiitop_tournaments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_page` int(11) NOT NULL,
  `id_game` tinyint(2) NOT NULL,
  `date` datetime NOT NULL,
  `slots` tinyint(2) NOT NULL,
  `data_teams` text COLLATE utf8_unicode_ci NOT NULL,
  `data_maps` text COLLATE utf8_unicode_ci NOT NULL,
  `data_tree` text COLLATE utf8_unicode_ci NOT NULL,
  `live` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wiitop_updates`
--

DROP TABLE IF EXISTS `wiitop_updates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wiitop_updates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `version` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `changelog` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wiitop_updates`
--

LOCK TABLES `wiitop_updates` WRITE;
/*!40000 ALTER TABLE `wiitop_updates` DISABLE KEYS */;
INSERT INTO `wiitop_updates` VALUES (1,'2013-03-03 19:03:13','1.0','<ul>\r\n<li>New version of the script is out!</li>\r\n</ul>');
/*!40000 ALTER TABLE `wiitop_updates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wiitop_users`
--

DROP TABLE IF EXISTS `wiitop_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wiitop_users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `id_tn` int(11) NOT NULL,
  `ip_address` varbinary(16) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `activation_code` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `forgotten_password_code` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wiitop_users_groups`
--

DROP TABLE IF EXISTS `wiitop_users_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wiitop_users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wiitop_users_groups`
--

LOCK TABLES `wiitop_users_groups` WRITE;
/*!40000 ALTER TABLE `wiitop_users_groups` DISABLE KEYS */;
INSERT INTO `wiitop_users_groups` VALUES (1,1,1),(2,1,2),(3,2,2),(4,3,2),(5,4,2),(6,5,2),(7,6,2),(8,7,2),(9,8,2),(10,9,2),(11,10,2),(12,11,2),(13,12,2),(14,13,2),(15,14,2),(16,15,2),(17,16,2),(18,17,2),(19,18,2),(20,19,2),(21,20,2),(22,21,2),(23,22,2),(24,23,2),(25,24,2),(26,25,2),(27,26,2),(28,27,2),(29,28,2),(30,29,2),(31,30,2),(32,31,2),(33,32,2),(34,33,2),(35,34,2),(36,35,2),(37,36,2),(38,37,2),(39,38,2),(40,39,2),(41,40,2),(42,41,2),(43,42,2),(44,43,2),(45,44,2),(46,45,2),(47,46,2),(48,47,2),(49,48,2),(50,49,2);
/*!40000 ALTER TABLE `wiitop_users_groups` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-10-01  6:26:41
