-- MySQL dump 10.13  Distrib 5.5.23, for Linux (x86_64)
--
-- Host: localhost    Database: campaign
-- ------------------------------------------------------
-- Server version	5.5.23

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
-- Table structure for table `access_detail`
--

DROP TABLE IF EXISTS `access_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `access_detail` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date_created` datetime DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `login_type` int(11) DEFAULT NULL,
  `access_service` varchar(100) DEFAULT NULL,
  `active_status` int(11) DEFAULT NULL,
  `circle_id` int(4) DEFAULT NULL,
  `cp_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_login` (`login`(20))
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `access_detail`
--

LOCK TABLES `access_detail` WRITE;
/*!40000 ALTER TABLE `access_detail` DISABLE KEYS */;
INSERT INTO `access_detail` VALUES (1,'2010-09-21 02:50:15','admin','tot_admin',1,'1,2,3,4,5,6,7',1,NULL,NULL),(27,'2016-09-22 14:14:01','MSL','msl_321',1,'1,2,3,4,5,6,7',1,NULL,''),(29,'2016-09-28 16:51:17','hi','123456',1,'1,2,3,4,5,6,7',1,NULL,'');
/*!40000 ALTER TABLE `access_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `billing_response`
--

DROP TABLE IF EXISTS `billing_response`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `billing_response` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `trans_date` datetime DEFAULT NULL,
  `msisdn` varchar(20) DEFAULT NULL,
  `billing_req` varchar(200) DEFAULT NULL,
  `billing_resp` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `billing_response`
--

LOCK TABLES `billing_response` WRITE;
/*!40000 ALTER TABLE `billing_response` DISABLE KEYS */;
/*!40000 ALTER TABLE `billing_response` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contest_banner`
--

DROP TABLE IF EXISTS `contest_banner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contest_banner` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `contest_id` bigint(11) NOT NULL,
  `label` varchar(50) NOT NULL,
  `format` varchar(10) NOT NULL,
  `width` bigint(5) NOT NULL,
  `height` bigint(5) NOT NULL,
  `path` varchar(200) NOT NULL,
  `type` varchar(10) NOT NULL,
  `login` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contest_banner`
--

LOCK TABLES `contest_banner` WRITE;
/*!40000 ALTER TABLE `contest_banner` DISABLE KEYS */;
INSERT INTO `contest_banner` VALUES (1,1,'515x52.jpg','jpg',515,52,'C:wampwwwcampaign/uploads/admin/ContestOne/header/515x52.jpg','header','admin'),(2,1,'515x52.jpg','jpg',515,52,'C:wampwwwcampaign/uploads/admin/ContestOne/footer/515x52.jpg','footer','admin');
/*!40000 ALTER TABLE `contest_banner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contest_detail`
--

DROP TABLE IF EXISTS `contest_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contest_detail` (
  `contest_id` bigint(11) NOT NULL AUTO_INCREMENT,
  `contest_name` varchar(50) NOT NULL,
  `welcome_message` varchar(160) NOT NULL,
  `contest_type` int(2) NOT NULL DEFAULT '0',
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `score` int(2) NOT NULL DEFAULT '0',
  `score_neg_status` int(1) DEFAULT '0',
  `negative_marking` int(2) DEFAULT NULL,
  `cummulative_score` int(1) DEFAULT '0',
  `today_score` int(1) DEFAULT '0',
  `weekly_score` int(1) DEFAULT '0',
  `bill_status` int(1) DEFAULT '0',
  `application_id` varchar(20) DEFAULT NULL,
  `price_status` int(1) DEFAULT '0',
  `price_pt` int(3) DEFAULT '0',
  `smskey_status` int(1) DEFAULT '0',
  `key_alias_status` int(1) DEFAULT '0',
  `question_status` int(1) DEFAULT '0',
  `question_size` bigint(4) DEFAULT '0',
  `score_type` int(1) DEFAULT '0',
  `max_options` int(1) NOT NULL DEFAULT '2',
  `off_message` varchar(160) NOT NULL,
  `contest_over_message` varchar(160) NOT NULL,
  `contest_footer_message` varchar(160) NOT NULL,
  `active_status` int(1) NOT NULL DEFAULT '0',
  `archive` int(1) DEFAULT '0',
  `footer_status` int(1) DEFAULT '0',
  `footer_sept` int(1) DEFAULT '0',
  `diplay_add` int(1) DEFAULT '0',
  `footer_link` int(1) DEFAULT '0',
  `header_upload` varchar(50) NOT NULL,
  `footer_upload` varchar(50) NOT NULL,
  `login` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`contest_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contest_detail`
--

LOCK TABLES `contest_detail` WRITE;
/*!40000 ALTER TABLE `contest_detail` DISABLE KEYS */;
INSERT INTO `contest_detail` VALUES (1,'ContestOne','Welcome to contest one',1,'2012-06-26 10:10:00','2012-07-03 09:40:00',1,0,0,1,0,0,0,'',0,0,0,0,2,0,1,4,'Contest expires','Thank you','footer',0,0,0,1,0,0,'515x52.zip','515x52.zip','admin');
/*!40000 ALTER TABLE `contest_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contest_flink`
--

DROP TABLE IF EXISTS `contest_flink`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contest_flink` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `contest_id` bigint(11) NOT NULL,
  `footer_text` varchar(50) DEFAULT NULL,
  `footer_link` varchar(150) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contest_flink`
--

LOCK TABLES `contest_flink` WRITE;
/*!40000 ALTER TABLE `contest_flink` DISABLE KEYS */;
/*!40000 ALTER TABLE `contest_flink` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contest_questions`
--

DROP TABLE IF EXISTS `contest_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contest_questions` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `contest_id` bigint(11) NOT NULL,
  `ques_no` bigint(11) NOT NULL,
  `question` varchar(100) NOT NULL,
  `a` varchar(100) NOT NULL,
  `b` varchar(100) NOT NULL,
  `c` varchar(100) NOT NULL,
  `d` varchar(100) NOT NULL,
  `ans` char(1) NOT NULL,
  `max_options` int(1) DEFAULT '2',
  `active_status` int(1) NOT NULL DEFAULT '1',
  `question_type` int(1) DEFAULT NULL,
  `contest_seq` varchar(20) DEFAULT NULL,
  `header` varchar(20) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contest_questions`
--

LOCK TABLES `contest_questions` WRITE;
/*!40000 ALTER TABLE `contest_questions` DISABLE KEYS */;
INSERT INTO `contest_questions` VALUES (1,1,1,'What should be 1+2','1','2','3','4','c',4,1,NULL,'',NULL,'admin'),(2,1,2,'After Sunday it is','Monday','Tuesday','Wednesday','None','a',4,1,NULL,'',NULL,'admin'),(9,1,3,'Who plays the negative role in Om Shanti Om?','Milind Soman','Salman Khan','Arjun Rampal','','c',3,1,NULL,NULL,NULL,'admin'),(10,1,4,'How are you?','Good','Fine','Bad','','a',3,1,NULL,NULL,NULL,'admin');
/*!40000 ALTER TABLE `contest_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contest_session`
--

DROP TABLE IF EXISTS `contest_session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contest_session` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `entry_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `msisdn` varchar(15) NOT NULL DEFAULT '',
  `contest_id` bigint(11) NOT NULL DEFAULT '0',
  `score` int(4) NOT NULL DEFAULT '0',
  `question_counter` bigint(11) NOT NULL DEFAULT '0',
  `question_correctly_answered` int(4) NOT NULL DEFAULT '0',
  `question_no_asked` int(4) NOT NULL DEFAULT '0',
  `answer` char(10) DEFAULT NULL,
  `active_status` int(4) DEFAULT '1',
  `sms_type` int(4) DEFAULT NULL,
  `keyword` varchar(20) DEFAULT NULL,
  `shortcode` int(4) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contest_session`
--

LOCK TABLES `contest_session` WRITE;
/*!40000 ALTER TABLE `contest_session` DISABLE KEYS */;
/*!40000 ALTER TABLE `contest_session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contest_transaction_log`
--

DROP TABLE IF EXISTS `contest_transaction_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contest_transaction_log` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `request_datetime` datetime NOT NULL,
  `msisdn` varchar(20) DEFAULT NULL,
  `user_request` varchar(100) DEFAULT NULL,
  `server_response` varchar(500) DEFAULT NULL,
  `billing_url` varchar(1000) DEFAULT NULL,
  `billing_response` varchar(1000) DEFAULT NULL,
  `contest_id` bigint(11) DEFAULT '0',
  `sms_type` int(4) DEFAULT NULL,
  `keyword` varchar(20) DEFAULT NULL,
  `shortcode` int(4) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`,`request_datetime`),
  KEY `ind_request_datetime` (`request_datetime`),
  KEY `ind_msisdn` (`msisdn`),
  KEY `ind_user_request` (`user_request`),
  KEY `ind_billing_response` (`billing_response`),
  KEY `ind_contest_id` (`contest_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contest_transaction_log`
--

LOCK TABLES `contest_transaction_log` WRITE;
/*!40000 ALTER TABLE `contest_transaction_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `contest_transaction_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dnd_detail`
--

DROP TABLE IF EXISTS `dnd_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dnd_detail` (
  `dnd_id` bigint(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(4) NOT NULL,
  `subgroup_id` int(4) DEFAULT NULL,
  `file_path` varchar(150) DEFAULT NULL,
  `active_status` int(1) DEFAULT '1',
  `login` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`dnd_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dnd_detail`
--

LOCK TABLES `dnd_detail` WRITE;
/*!40000 ALTER TABLE `dnd_detail` DISABLE KEYS */;
INSERT INTO `dnd_detail` VALUES (1,1,1,'C:wampwwwcampaign/uploads/admin/pramod/kumar/dnd/test-msisdn.csv',1,'admin');
/*!40000 ALTER TABLE `dnd_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file_detail`
--

DROP TABLE IF EXISTS `file_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file_detail` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `filename` varchar(100) DEFAULT NULL,
  `cdrdate` datetime DEFAULT '0000-00-00 00:00:00',
  `foldername` varchar(50) DEFAULT NULL,
  `keyword` varchar(20) DEFAULT NULL,
  `shortcode` int(4) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file_detail`
--

LOCK TABLES `file_detail` WRITE;
/*!40000 ALTER TABLE `file_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `file_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_detail`
--

DROP TABLE IF EXISTS `group_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_detail` (
  `group_id` bigint(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `login` varchar(50) NOT NULL,
  `active_status` int(1) DEFAULT '1',
  `archive` int(1) DEFAULT '0',
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_detail`
--

LOCK TABLES `group_detail` WRITE;
/*!40000 ALTER TABLE `group_detail` DISABLE KEYS */;
INSERT INTO `group_detail` VALUES (1,'pramod','Group One','admin',1,0),(2,'idt','Integrated Digital Test Group','admin',1,0),(3,'gaurav','Gaurav Bhandari','admin',1,0),(4,'abc','Promo','admin',1,0);
/*!40000 ALTER TABLE `group_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `handset_detail`
--

DROP TABLE IF EXISTS `handset_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `handset_detail` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `make` varchar(100) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `xhtml_support` varchar(10) DEFAULT '0',
  `wml_support` varchar(10) DEFAULT '1',
  `screen_size` varchar(10) DEFAULT 'n/a',
  `background_support` varchar(10) DEFAULT 'n/a',
  `bgcolor_support` varchar(10) DEFAULT 'n/a',
  `italic_support` varchar(10) DEFAULT 'n/a',
  `small_support` varchar(10) DEFAULT 'n/a',
  `font_support` varchar(10) DEFAULT 'n/a',
  `span_support` varchar(10) DEFAULT '1',
  `already_bold` varchar(10) DEFAULT 'n/a',
  `wallpaper_support` varchar(10) DEFAULT '1',
  `polytone_support` varchar(10) DEFAULT '1',
  `truetone_support` varchar(10) DEFAULT 'n/a',
  `mp3_support` varchar(10) DEFAULT 'n/a',
  `game_support` varchar(10) DEFAULT 'n/a',
  `theme_support` varchar(10) DEFAULT 'n/a',
  `video_support` varchar(10) DEFAULT 'n/a',
  `videotone_support` varchar(10) DEFAULT 'n/a',
  `text_font_size` varchar(10) DEFAULT '6',
  `result_font_size` varchar(10) DEFAULT '6',
  `tone_trailing_chars` int(5) DEFAULT '15',
  `text_trailing_chars` int(5) DEFAULT '20',
  `bookmark_support` varchar(10) DEFAULT 'n/a',
  `heading_font_size` varchar(10) DEFAULT '6',
  `clogo_support` varchar(10) DEFAULT 'n/a',
  `morelink_font_size` varchar(10) DEFAULT '6',
  `morelink_font_name` varchar(100) DEFAULT 'arbeka',
  `text_font_name` varchar(100) DEFAULT 'verdana',
  `result_font_name` varchar(100) DEFAULT 'bitstream vera sans',
  `is_small` varchar(10) DEFAULT '0',
  `input_box_size` varchar(10) DEFAULT '12',
  `remarks` text,
  `anchor_support` varchar(10) DEFAULT '1',
  `line_height` varchar(10) DEFAULT '4',
  PRIMARY KEY (`id`),
  KEY `ind_make` (`make`),
  KEY `ind_model` (`model`),
  KEY `ind_xhtml` (`xhtml_support`),
  KEY `ind_wml` (`wml_support`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `handset_detail`
--

LOCK TABLES `handset_detail` WRITE;
/*!40000 ALTER TABLE `handset_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `handset_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keyword`
--

DROP TABLE IF EXISTS `keyword`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `keyword` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(20) NOT NULL,
  `type` int(1) NOT NULL DEFAULT '0',
  `shortcode` int(5) NOT NULL,
  `type_id` bigint(11) NOT NULL,
  `login` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unqind_key_sort` (`keyword`,`shortcode`),
  KEY `ind_keyword` (`keyword`),
  KEY `ind_shortcode` (`shortcode`),
  KEY `ind_type_id` (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keyword`
--

LOCK TABLES `keyword` WRITE;
/*!40000 ALTER TABLE `keyword` DISABLE KEYS */;
/*!40000 ALTER TABLE `keyword` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keyword_detail`
--

DROP TABLE IF EXISTS `keyword_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `keyword_detail` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `type_id` bigint(11) DEFAULT NULL,
  `keyword_id` bigint(11) NOT NULL,
  `keyword_alias` varchar(15) NOT NULL,
  `shortcode` int(5) NOT NULL,
  `login` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mul_shortkey_alias` (`shortcode`,`keyword_alias`),
  KEY `ind_shortcode` (`shortcode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keyword_detail`
--

LOCK TABLES `keyword_detail` WRITE;
/*!40000 ALTER TABLE `keyword_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `keyword_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `list_detail`
--

DROP TABLE IF EXISTS `list_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `list_detail` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `date_created` datetime DEFAULT NULL,
  `login_created` varchar(50) DEFAULT NULL,
  `scheduler_name` varchar(50) DEFAULT NULL,
  `target_id` bigint(11) NOT NULL,
  `target_path` varchar(200) NOT NULL,
  `dnd_id` bigint(11) DEFAULT NULL,
  `dnd_path` varchar(200) DEFAULT NULL,
  `sms_id` bigint(11) NOT NULL,
  `message` varchar(850) DEFAULT NULL,
  `footer_url` varchar(600) DEFAULT NULL,
  `sms_mode` int(1) NOT NULL DEFAULT '1',
  `no_of_sms` bigint(20) NOT NULL DEFAULT '1',
  `start_date` datetime NOT NULL,
  `start_time` time NOT NULL,
  `end_date` datetime NOT NULL,
  `end_time` time NOT NULL,
  `active_status` int(1) NOT NULL DEFAULT '0',
  `archive` int(1) NOT NULL DEFAULT '0',
  `send_status` int(1) NOT NULL DEFAULT '0',
  `push_interrupt` varchar(50) DEFAULT '0',
  `actualbase_path` varchar(200) DEFAULT NULL,
  `no_of_called_sms` bigint(11) DEFAULT '0',
  `total_downloads` varchar(20) DEFAULT NULL,
  `rule_id` bigint(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `sms_type` int(1) DEFAULT NULL,
  `daily_new_target` int(1) DEFAULT '0',
  `last_call_date` datetime DEFAULT NULL,
  `sender_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `list_detail`
--

LOCK TABLES `list_detail` WRITE;
/*!40000 ALTER TABLE `list_detail` DISABLE KEYS */;
INSERT INTO `list_detail` VALUES (30,'2013-12-21 13:35:35','admin','eastzoneshayari',24,'/opt/www/htdocs/campaign/uploads/admin/bsnleastzoneshayari/bsnl/BSNLEastShayariDec2013/EastBSNL.csv',0,'',25,'Bhaut khoobsurat hai aaknhen teri,raat ko jaagna chhod de,ab paaye sharyi apne phone per sirf Rs15/30 dino ke liye subscribe. SMS SUB SHAY  to 59000.','',1,829233,'2014-01-07 07:30:00','07:30:00','2014-01-07 20:00:00','20:00:00',1,0,3,'','/opt/www/htdocs/campaign/campaignjava/logs/07_01_2014_30/ActualBase.csv',555500,NULL,25,1,1,2,'2014-01-07 19:02:03','BV659000'),(18,'2013-11-05 16:28:25','admin','kerlasouth',17,'/opt/www/htdocs/campaign/uploads/admin/new_south/southpromotion/Novsouthnew/testmsisdn.csv',0,'',18,'Now look beautiful with effective beauty tips just at Rs3/3Days to subscribed. SMS SUB BT3 to 59000','',1,200000,'2013-11-06 09:10:00','09:10:00','2013-11-06 13:30:00','13:30:00',1,0,2,'','/opt/www/htdocs/campaign/campaignjava/logs/16_12_2013_256/ActualBase.csv',132068,NULL,18,1,1,2,'2013-11-06 20:20:00','BT659000'),(28,'2013-11-15 10:13:17','admin','north',22,'/opt/www/htdocs/campaign/uploads/admin/newnorthzone/allnorthcircle/northpromzone/northpromo.csv',0,'',45,'Paayen 500 Rupaye ka recharge. SMS karen BID <Space> <aapka unique amount> 59000 par. T&C Apply\r\n','',1,550000,'2014-02-11 07:30:00','07:30:00','2014-02-11 20:00:00','20:00:00',1,0,1,'','/opt/www/htdocs/campaign/campaignjava/logs/11_02_2014_28/ActualBase.csv',549998,NULL,45,1,1,1,'2014-02-11 18:20:54','BT'),(25,'2014-03-30 15:16:41','admin','bsnlwest',20,'/opt/www/htdocs/campaign/uploads/admin/westzone/westbsnlzone/westallzone/westzonepromo.csv',0,'',29,'Get NAUGHTY and SPICY sms, Send SUB JOKES to 59000. TNC for above 18 years Rs.15/30 days.','',1,560000,'2014-02-11 07:30:00','07:30:00','2014-03-30 20:00:00','20:00:00',1,0,4,'','/opt/www/campaign/campaignjava/logs/16_12_2013_25/ActualBase.csv',198565,NULL,29,1,1,2,'2014-02-11 12:57:54','BT'),(26,'2013-11-12 15:17:54','admin','karnatakabsnl',18,'/opt/www/htdocs/campaign/uploads/admin/south_zone/south/karnataka/Karnataka.csv',0,'',34,'Now get daily Horoscope on your mobile just at Rs. 3/3Days to subscribe send first 3 character of your sun sign example for Aries; SUB ARI3 to 59000','',1,550000,'2014-02-07 07:30:00','07:30:00','2014-02-07 20:00:00','20:00:00',1,0,4,'','/opt/www/htdocs/campaign/campaignjava/logs/07_02_2014_26/ActualBase.csv',448237,NULL,34,1,1,2,'2014-02-07 16:42:11','BT'),(31,'2013-12-26 11:56:26','admin','abc',25,'/opt/www/htdocs/campaign/uploads/admin/akshesh/varchas/Promo/TestBase123.csv',0,'',4,'testing the camp','footer',1,125,'2013-12-26 07:00:00','07:00:00','2014-01-02 20:00:00','20:00:00',1,0,0,'','null',0,NULL,4,1,1,0,NULL,'BV659000'),(32,'2014-01-18 15:49:41','admin','northwappush',26,'/opt/www/htdocs/campaign/uploads/admin/north_wap_push/wappush/wappush/wapmsisdnnorth.csv',0,'',38,'Ab kare download bhagwan Ganesh ji ki picture apne mobile per sirf ek click per @2 Rs','http://wap.59000.in/cmswap/wap?poid=247&prid=218',2,550000,'2014-01-31 07:30:00','07:30:00','2014-01-31 20:00:00','20:00:00',1,0,3,'','/opt/www/htdocs/campaign/campaignjava/logs/31_01_2014_32/ActualBase.csv',549500,NULL,38,1,2,2,'2014-01-31 19:06:19','BP'),(33,'2014-01-22 13:58:14','admin','eastwappromo',27,'/opt/www/htdocs/campaign/uploads/admin/eastwappromo/eastwap/EastWapPromotion/EastWap.csv',0,'',39,'Old is gold for More video subscribe @ Rs 2 for 3 days Click now','http://wap.59000.in/cmswap/wap?poid=247&prid=255',2,550000,'2014-01-31 07:30:00','07:30:00','2014-01-31 20:00:00','20:00:00',1,0,1,'','/opt/www/htdocs/campaign/campaignjava/logs/31_01_2014_33/ActualBase.csv',549998,NULL,39,1,2,1,'2014-01-31 19:06:41','BV659000'),(34,'2014-01-23 10:47:47','admin','westwappromotion',28,'/opt/www/htdocs/campaign/uploads/admin/westwap/westwapsub/WestPromoJan/WestwapPromo.csv',0,'',39,'Old is gold for More video subscribe @ Rs 2 for 3 days Click now','http://wap.59000.in/cmswap/wap?poid=247&prid=255',2,550000,'2014-01-31 07:30:00','07:30:00','2014-01-31 20:00:00','20:00:00',1,0,1,'','D:\\myfile\\Campaign_Reporting\\csv\\16_12_2013_25/ActualBase.csv',549998,NULL,39,1,2,1,'2014-01-31 19:06:37','BZ659000'),(29,'2013-11-18 12:45:10','admin','eastzonepromo',23,'/opt/www/htdocs/campaign/uploads/admin/eastzone/eastzoneallcircle/EastZoneBSNL/Eastpromo.csv',0,'',41,'Earn 8000 to 20000 per month from part time jobs to know sms JOB to 59000.','',1,550000,'2014-02-12 09:00:00','09:00:00','2014-02-12 20:00:00','20:00:00',1,0,2,'','/opt/www/htdocs/campaign/campaignjava/logs/12_02_2014_29/ActualBase.csv',442041,NULL,41,1,1,2,'2014-02-12 20:00:01','BV659000'),(36,'2014-02-10 16:55:11','admin','northzonecontestpromo',30,'/opt/www/htdocs/campaign/uploads/admin/northzonecontest/contest/ContestNorthZonePromo/NorthContest.csv',0,'',45,'Paayen 500 Rupaye ka recharge. SMS karen BID <Space> <aapka unique amount> 59000 par. T&C Apply\r\n','',1,544000,'2014-02-12 09:00:00','09:00:00','2014-02-12 20:00:00','20:00:00',1,0,2,'','/opt/www/htdocs/campaign/campaignjava/logs/12_02_2014_36/ActualBase.csv',442078,NULL,45,1,1,2,'2014-02-12 20:00:01','659000'),(35,'2014-02-07 13:51:19','admin','southzonejobalerts',29,'/opt/www/htdocs/campaign/uploads/admin/jobs/jobssouthzone/SouthzoneJobAlert/southjob.csv',0,'',41,'Earn 8000 to 20000 per month from part time jobs to know sms JOB to 59000.','',1,550000,'2014-02-12 09:00:00','09:00:00','2014-02-12 20:00:00','20:00:00',1,0,2,'','/opt/www/htdocs/campaign/campaignjava/logs/12_02_2014_35/ActualBase.csv',442171,NULL,41,1,1,2,'2014-02-12 20:00:01','BT659000'),(38,'2014-02-13 08:43:13','admin','northcontest',32,'/opt/www/htdocs/campaign/uploads/admin/northzonec/northzonesub/NorthZoneContestPromo/NorthC.csv',0,'',45,'Paayen 500 Rupaye ka recharge. SMS karen BID <Space> <aapka unique amount> 59000 par. T&C Apply\r\n','',1,313000,'2014-02-13 10:00:00','10:00:00','2014-02-18 20:00:00','20:00:00',1,0,4,'yes','/opt/www/htdocs/campaign/campaignjava/logs/13_02_2014_38/ActualBase.csv',222000,NULL,45,1,1,2,'2014-02-13 17:57:44','BP659000'),(37,'2014-02-11 12:32:02','admin','naughtyjokeswest',31,'/opt/www/htdocs/campaign/uploads/admin/westnaughtyjokes/naughty/NaughtyJokesWest/WestNaughty.csv',0,'',46,'Do u know where little boy n girl go when they do bad things Johnnie Sure back of the church.For More adult Jokes Send sub jokes3 to 59000 chrgs Rs3/3days.','',1,540000,'2014-02-12 09:00:00','09:00:00','2014-02-12 20:00:00','20:00:00',1,0,2,'','/opt/www/htdocs/campaign/campaignjava/logs/12_02_2014_37/ActualBase.csv',442136,NULL,46,1,1,2,'2014-02-12 20:00:01','BZ659000'),(39,'2014-02-13 08:46:05','admin','southjobsalertpromo',33,'/opt/www/htdocs/campaign/uploads/admin/southjobs/southsub/SouthJobsalerts/SouthJ.csv',0,'',41,'Earn 8000 to 20000 per month from part time jobs to know sms JOB to 59000.','',1,350000,'2014-02-13 10:00:00','10:00:00','2014-02-18 20:00:00','20:00:00',1,0,1,'','/opt/www/htdocs/campaign/campaignjava/logs/13_02_2014_39/ActualBase.csv',222000,NULL,41,1,1,2,'2014-02-13 17:57:41','BT659000'),(40,'2014-02-13 08:48:29','admin','eastjobspromo',34,'/opt/www/htdocs/campaign/uploads/admin/eastjobs/eastjobsub/EastJobsPromo/EastJ.csv',0,'',41,'Earn 8000 to 20000 per month from part time jobs to know sms JOB to 59000.','',1,350000,'2014-02-13 10:00:00','10:00:00','2014-02-19 20:00:00','20:00:00',1,0,1,'','/opt/www/htdocs/campaign/campaignjava/logs/13_02_2014_40/ActualBase.csv',222000,NULL,41,1,1,2,'2014-02-13 17:57:40','BV659000'),(41,'2014-02-13 08:51:14','admin','westnaughtypromo',35,'/opt/www/htdocs/campaign/uploads/admin/westnaughtyj/westnaughtysub/WestNaughtyPromo/WestN.csv',0,'',46,'Do u know where little boy n girl go when they do bad things Johnnie Sure back of the church.For More adult Jokes Send sub jokes3 to 59000 chrgs Rs3/3days.','',1,490684,'2014-02-13 07:30:00','07:30:00','2014-02-13 20:00:00','20:00:00',1,0,4,'yes','/opt/www/htdocs/campaign/campaignjava/logs/13_02_2014_41/ActualBase.csv',181679,NULL,46,1,1,2,'2014-02-13 12:27:17','BZ659000'),(42,'2014-02-13 12:15:49','admin','southjobsalerts13',36,'/opt/www/htdocs/campaign/uploads/admin/southjobs2/subsouth2/SouthZoneJobalert13/SouthJ2.csv',0,'',47,'Now get Job alerts on your mobile by just sending JOB to 59000 charges RS 3/3Days TNC Apply.','',1,150000,'2014-02-13 07:30:00','07:30:00','2014-02-13 20:00:00','20:00:00',1,0,3,'','/opt/www/htdocs/campaign/campaignjava/logs/13_02_2014_42/ActualBase.csv',46500,NULL,47,1,1,2,'2014-02-13 13:07:07','BT659000'),(43,'2014-02-13 12:17:51','admin','westjobsalerts',37,'/opt/www/htdocs/campaign/uploads/admin/westjobsalerts/westsubjobsalert/WestJobsalerts/WestJ.csv',0,'',41,'Earn 8000 to 20000 per month from part time jobs to know sms JOB to 59000.','',1,320000,'2014-02-13 10:00:00','10:00:00','2014-02-13 20:00:00','20:00:00',1,0,3,'','/opt/www/htdocs/campaign/campaignjava/logs/13_02_2014_43/ActualBase.csv',222000,NULL,41,1,1,2,'2014-02-13 17:57:42','BP659000');
/*!40000 ALTER TABLE `list_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mmc_session`
--

DROP TABLE IF EXISTS `mmc_session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mmc_session` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `login_created` varchar(50) DEFAULT NULL,
  `login_history` varchar(50) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  `sess_id` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1039 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mmc_session`
--

LOCK TABLES `mmc_session` WRITE;
/*!40000 ALTER TABLE `mmc_session` DISABLE KEYS */;
INSERT INTO `mmc_session` VALUES (1,'admin','Login Success!!!','2012-06-22 19:09:48','2c747dd1bf2f6e4e6085583353a8dd63'),(2,'admin','Login Field Choose','2012-06-22 19:09:50','2c747dd1bf2f6e4e6085583353a8dd63'),(3,'admin','Group Management Choose','2012-06-22 19:09:58','2c747dd1bf2f6e4e6085583353a8dd63'),(4,'admin','Target Buildup Choose','2012-06-22 19:10:09','2c747dd1bf2f6e4e6085583353a8dd63'),(5,'admin','Bulk SMS Broadcast Choose','2012-06-22 19:10:13','2c747dd1bf2f6e4e6085583353a8dd63'),(6,'admin','Scheduler Choose','2012-06-22 19:10:17','2c747dd1bf2f6e4e6085583353a8dd63'),(7,'admin','Group Management Choose','2012-06-22 19:10:19','2c747dd1bf2f6e4e6085583353a8dd63'),(8,'admin','Login Field Choose','2012-06-22 19:10:21','2c747dd1bf2f6e4e6085583353a8dd63'),(9,'admin','Map Field Choose','2012-06-22 19:10:22','2c747dd1bf2f6e4e6085583353a8dd63'),(10,'admin','','2012-06-22 19:10:27','2c747dd1bf2f6e4e6085583353a8dd63'),(11,'admin','','2012-06-22 19:10:29','2c747dd1bf2f6e4e6085583353a8dd63'),(12,'admin','','2012-06-22 19:10:31','2c747dd1bf2f6e4e6085583353a8dd63'),(13,'admin','','2012-06-22 19:10:34','2c747dd1bf2f6e4e6085583353a8dd63'),(14,'admin','Map UnArchive Choosess','2012-06-22 19:10:35','2c747dd1bf2f6e4e6085583353a8dd63'),(15,'admin','Login Success!!!','2012-06-25 15:35:57','c08b61e87a2062d8de9c4b18e8b2c08d'),(16,'admin','Login Field Choose','2012-06-25 15:36:07','c08b61e87a2062d8de9c4b18e8b2c08d'),(17,'admin','Group Management Choose','2012-06-25 15:36:08','c08b61e87a2062d8de9c4b18e8b2c08d'),(18,'admin','Bulk SMS Broadcast Choose','2012-06-25 15:36:10','c08b61e87a2062d8de9c4b18e8b2c08d'),(19,'admin','Scheduler Choose','2012-06-25 15:36:11','c08b61e87a2062d8de9c4b18e8b2c08d'),(20,'admin','Scheduler UnArchive Choosess','2012-06-25 15:36:23','c08b61e87a2062d8de9c4b18e8b2c08d'),(21,'admin','Scheduler Create Choose','2012-06-25 15:36:25','c08b61e87a2062d8de9c4b18e8b2c08d'),(22,'admin','Target Buildup Choose','2012-06-25 15:36:35','c08b61e87a2062d8de9c4b18e8b2c08d'),(23,'admin','Group Creation Choose','2012-06-25 15:36:42','c08b61e87a2062d8de9c4b18e8b2c08d'),(24,'admin','','2012-06-25 15:36:47','c08b61e87a2062d8de9c4b18e8b2c08d'),(25,'admin','Group Creation Choose','2012-06-25 15:36:49','c08b61e87a2062d8de9c4b18e8b2c08d'),(26,'admin','Target UnArchive Choosess','2012-06-25 15:36:50','c08b61e87a2062d8de9c4b18e8b2c08d'),(27,'admin','Group Management Choose','2012-06-25 15:36:54','c08b61e87a2062d8de9c4b18e8b2c08d'),(28,'admin','Target Buildup Choose','2012-06-25 15:36:56','c08b61e87a2062d8de9c4b18e8b2c08d'),(29,'admin','Group Creation Choose','2012-06-25 15:37:17','c08b61e87a2062d8de9c4b18e8b2c08d'),(30,'admin','Group Management Choose','2012-06-25 15:37:27','c08b61e87a2062d8de9c4b18e8b2c08d'),(31,'admin','Group Management Choose','2012-06-25 15:37:28','c08b61e87a2062d8de9c4b18e8b2c08d'),(32,'admin','Group Creation Choose','2012-06-25 15:37:34','c08b61e87a2062d8de9c4b18e8b2c08d'),(33,'admin','pramod Group Successfully Created!','2012-06-25 15:38:43','c08b61e87a2062d8de9c4b18e8b2c08d'),(34,'admin','Target Buildup Choose','2012-06-25 15:38:47','c08b61e87a2062d8de9c4b18e8b2c08d'),(35,'admin','Group Creation Choose','2012-06-25 15:38:50','c08b61e87a2062d8de9c4b18e8b2c08d'),(36,'admin','Group Management Choose','2012-06-25 15:38:53','c08b61e87a2062d8de9c4b18e8b2c08d'),(37,'admin','Sub Group Creation Choose','2012-06-25 15:38:55','c08b61e87a2062d8de9c4b18e8b2c08d'),(38,'admin','kumar Sub Group Successfully Created!','2012-06-25 15:39:08','c08b61e87a2062d8de9c4b18e8b2c08d'),(39,'admin','Target Buildup Choose','2012-06-25 15:39:11','c08b61e87a2062d8de9c4b18e8b2c08d'),(40,'admin','Group Creation Choose','2012-06-25 15:39:13','c08b61e87a2062d8de9c4b18e8b2c08d'),(41,'admin','Target Successfully Created','2012-06-25 15:42:44','c08b61e87a2062d8de9c4b18e8b2c08d'),(42,'admin','Scheduler Create Choose','2012-06-25 15:42:45','c08b61e87a2062d8de9c4b18e8b2c08d'),(43,'admin','Bulk SMS Broadcast Choose','2012-06-25 15:43:00','c08b61e87a2062d8de9c4b18e8b2c08d'),(44,'admin','Bulk SMS Creation Choose','2012-06-25 15:43:03','c08b61e87a2062d8de9c4b18e8b2c08d'),(45,'admin','Login Field Choose','2012-06-25 15:43:08','c08b61e87a2062d8de9c4b18e8b2c08d'),(46,'admin','Group Management Choose','2012-06-25 15:43:09','c08b61e87a2062d8de9c4b18e8b2c08d'),(47,'admin','Map Field Choose','2012-06-25 15:43:15','c08b61e87a2062d8de9c4b18e8b2c08d'),(48,'admin','Target Buildup Choose','2012-06-25 15:43:18','c08b61e87a2062d8de9c4b18e8b2c08d'),(49,'admin','Bulk SMS Broadcast Choose','2012-06-25 15:43:23','c08b61e87a2062d8de9c4b18e8b2c08d'),(50,'admin','Bulk SMS Creation Choose','2012-06-25 15:43:25','c08b61e87a2062d8de9c4b18e8b2c08d'),(51,'admin','Message Successfully Created','2012-06-25 15:43:42','c08b61e87a2062d8de9c4b18e8b2c08d'),(52,'admin','Target Buildup Choose','2012-06-25 15:43:45','c08b61e87a2062d8de9c4b18e8b2c08d'),(53,'admin','Scheduler Choose','2012-06-25 15:43:48','c08b61e87a2062d8de9c4b18e8b2c08d'),(54,'admin','Scheduler Create Choose','2012-06-25 15:43:49','c08b61e87a2062d8de9c4b18e8b2c08d'),(55,'admin','','2012-06-25 15:44:40','c08b61e87a2062d8de9c4b18e8b2c08d'),(56,'admin','','2012-06-25 15:44:44','c08b61e87a2062d8de9c4b18e8b2c08d'),(57,'admin','','2012-06-25 15:44:45','c08b61e87a2062d8de9c4b18e8b2c08d'),(58,'admin','Group Management Choose','2012-06-25 15:45:44','c08b61e87a2062d8de9c4b18e8b2c08d'),(59,'admin','Map Field Choose','2012-06-25 15:45:46','c08b61e87a2062d8de9c4b18e8b2c08d'),(60,'admin','','2012-06-25 15:45:48','c08b61e87a2062d8de9c4b18e8b2c08d'),(61,'admin','','2012-06-25 15:47:58','c08b61e87a2062d8de9c4b18e8b2c08d'),(62,'admin','','2012-06-25 15:48:00','c08b61e87a2062d8de9c4b18e8b2c08d'),(63,'admin','','2012-06-25 15:48:03','c08b61e87a2062d8de9c4b18e8b2c08d'),(64,'admin','','2012-06-25 15:48:25','c08b61e87a2062d8de9c4b18e8b2c08d'),(65,'admin','','2012-06-25 15:48:31','c08b61e87a2062d8de9c4b18e8b2c08d'),(66,'admin','','2012-06-25 15:48:32','c08b61e87a2062d8de9c4b18e8b2c08d'),(67,'admin','','2012-06-25 15:48:33','c08b61e87a2062d8de9c4b18e8b2c08d'),(68,'admin','','2012-06-25 15:48:34','c08b61e87a2062d8de9c4b18e8b2c08d'),(69,'admin','','2012-06-25 15:48:41','c08b61e87a2062d8de9c4b18e8b2c08d'),(70,'admin','','2012-06-25 15:48:42','c08b61e87a2062d8de9c4b18e8b2c08d'),(71,'admin','','2012-06-25 15:48:44','c08b61e87a2062d8de9c4b18e8b2c08d'),(72,'admin','','2012-06-25 15:52:25','c08b61e87a2062d8de9c4b18e8b2c08d'),(73,'admin','','2012-06-25 15:52:26','c08b61e87a2062d8de9c4b18e8b2c08d'),(74,'admin','','2012-06-25 16:10:19','c08b61e87a2062d8de9c4b18e8b2c08d'),(75,'admin','','2012-06-25 16:10:21','c08b61e87a2062d8de9c4b18e8b2c08d'),(76,'admin','','2012-06-25 16:10:23','c08b61e87a2062d8de9c4b18e8b2c08d'),(77,'admin','','2012-06-25 16:10:23','c08b61e87a2062d8de9c4b18e8b2c08d'),(78,'admin','','2012-06-25 16:10:24','c08b61e87a2062d8de9c4b18e8b2c08d'),(79,'admin','','2012-06-25 16:10:25','c08b61e87a2062d8de9c4b18e8b2c08d'),(80,'admin','','2012-06-25 16:10:25','c08b61e87a2062d8de9c4b18e8b2c08d'),(81,'admin','','2012-06-25 16:10:26','c08b61e87a2062d8de9c4b18e8b2c08d'),(82,'admin','','2012-06-25 16:10:48','c08b61e87a2062d8de9c4b18e8b2c08d'),(83,'admin','','2012-06-25 16:10:51','c08b61e87a2062d8de9c4b18e8b2c08d'),(84,'admin','','2012-06-25 16:11:38','c08b61e87a2062d8de9c4b18e8b2c08d'),(85,'admin','','2012-06-25 16:11:39','c08b61e87a2062d8de9c4b18e8b2c08d'),(86,'admin','Target Buildup Choose','2012-06-25 16:13:51','c08b61e87a2062d8de9c4b18e8b2c08d'),(87,'admin','','2012-06-25 16:13:55','c08b61e87a2062d8de9c4b18e8b2c08d'),(88,'admin','Target Buildup Choose','2012-06-25 16:14:05','c08b61e87a2062d8de9c4b18e8b2c08d'),(89,'admin','Map Field Choose','2012-06-25 16:14:06','c08b61e87a2062d8de9c4b18e8b2c08d'),(90,'admin','Bulk SMS Broadcast Choose','2012-06-25 16:14:07','c08b61e87a2062d8de9c4b18e8b2c08d'),(91,'admin','Target Buildup Choose','2012-06-25 16:14:09','c08b61e87a2062d8de9c4b18e8b2c08d'),(92,'admin','Map Field Choose','2012-06-25 16:14:10','c08b61e87a2062d8de9c4b18e8b2c08d'),(93,'admin','','2012-06-25 16:14:12','c08b61e87a2062d8de9c4b18e8b2c08d'),(94,'admin','','2012-06-25 16:14:33','c08b61e87a2062d8de9c4b18e8b2c08d'),(95,'admin','','2012-06-25 16:14:34','c08b61e87a2062d8de9c4b18e8b2c08d'),(96,'admin','','2012-06-25 16:15:18','c08b61e87a2062d8de9c4b18e8b2c08d'),(97,'admin','','2012-06-25 16:16:07','c08b61e87a2062d8de9c4b18e8b2c08d'),(98,'admin','','2012-06-25 16:16:08','c08b61e87a2062d8de9c4b18e8b2c08d'),(99,'admin','','2012-06-25 16:17:39','c08b61e87a2062d8de9c4b18e8b2c08d'),(100,'admin','','2012-06-25 16:17:44','c08b61e87a2062d8de9c4b18e8b2c08d'),(101,'admin','','2012-06-25 16:17:45','c08b61e87a2062d8de9c4b18e8b2c08d'),(102,'admin','','2012-06-25 16:17:46','c08b61e87a2062d8de9c4b18e8b2c08d'),(103,'admin','','2012-06-25 16:17:47','c08b61e87a2062d8de9c4b18e8b2c08d'),(104,'admin','','2012-06-25 16:17:47','c08b61e87a2062d8de9c4b18e8b2c08d'),(105,'admin','','2012-06-25 16:17:48','c08b61e87a2062d8de9c4b18e8b2c08d'),(106,'admin','','2012-06-25 16:20:20','c08b61e87a2062d8de9c4b18e8b2c08d'),(107,'admin','','2012-06-25 16:20:22','c08b61e87a2062d8de9c4b18e8b2c08d'),(108,'admin','','2012-06-25 16:20:33','c08b61e87a2062d8de9c4b18e8b2c08d'),(109,'admin','','2012-06-25 16:21:03','c08b61e87a2062d8de9c4b18e8b2c08d'),(110,'admin','','2012-06-25 16:21:17','c08b61e87a2062d8de9c4b18e8b2c08d'),(111,'admin','','2012-06-25 16:21:23','c08b61e87a2062d8de9c4b18e8b2c08d'),(112,'admin','','2012-06-25 16:21:24','c08b61e87a2062d8de9c4b18e8b2c08d'),(113,'admin','','2012-06-25 16:21:25','c08b61e87a2062d8de9c4b18e8b2c08d'),(114,'admin','','2012-06-25 16:22:00','c08b61e87a2062d8de9c4b18e8b2c08d'),(115,'admin','','2012-06-25 16:22:07','c08b61e87a2062d8de9c4b18e8b2c08d'),(116,'admin','','2012-06-25 16:22:47','c08b61e87a2062d8de9c4b18e8b2c08d'),(117,'admin','','2012-06-25 16:22:49','c08b61e87a2062d8de9c4b18e8b2c08d'),(118,'admin','','2012-06-25 16:22:50','c08b61e87a2062d8de9c4b18e8b2c08d'),(119,'admin','Map UnArchive Choosess','2012-06-25 16:22:51','c08b61e87a2062d8de9c4b18e8b2c08d'),(120,'admin','','2012-06-25 16:22:55','c08b61e87a2062d8de9c4b18e8b2c08d'),(121,'admin','','2012-06-25 16:22:56','c08b61e87a2062d8de9c4b18e8b2c08d'),(122,'admin','','2012-06-25 16:23:36','c08b61e87a2062d8de9c4b18e8b2c08d'),(123,'admin','','2012-06-25 16:25:50','c08b61e87a2062d8de9c4b18e8b2c08d'),(124,'admin','','2012-06-25 16:26:07','c08b61e87a2062d8de9c4b18e8b2c08d'),(125,'admin','','2012-06-25 16:27:39','c08b61e87a2062d8de9c4b18e8b2c08d'),(126,'admin','','2012-06-25 16:27:52','c08b61e87a2062d8de9c4b18e8b2c08d'),(127,'admin','','2012-06-25 16:30:48','c08b61e87a2062d8de9c4b18e8b2c08d'),(128,'admin','','2012-06-25 16:31:05','c08b61e87a2062d8de9c4b18e8b2c08d'),(129,'admin','','2012-06-25 16:31:09','c08b61e87a2062d8de9c4b18e8b2c08d'),(130,'admin','','2012-06-25 16:33:00','c08b61e87a2062d8de9c4b18e8b2c08d'),(131,'admin','','2012-06-25 16:33:20','c08b61e87a2062d8de9c4b18e8b2c08d'),(132,'admin','','2012-06-25 16:33:25','c08b61e87a2062d8de9c4b18e8b2c08d'),(133,'admin','','2012-06-25 16:33:44','c08b61e87a2062d8de9c4b18e8b2c08d'),(134,'admin','','2012-06-25 16:34:30','c08b61e87a2062d8de9c4b18e8b2c08d'),(135,'admin','','2012-06-25 17:03:38','c08b61e87a2062d8de9c4b18e8b2c08d'),(136,'admin','','2012-06-25 17:04:15','c08b61e87a2062d8de9c4b18e8b2c08d'),(137,'admin','','2012-06-25 17:04:31','c08b61e87a2062d8de9c4b18e8b2c08d'),(138,'admin','','2012-06-25 17:04:35','c08b61e87a2062d8de9c4b18e8b2c08d'),(139,'admin','','2012-06-25 17:05:29','c08b61e87a2062d8de9c4b18e8b2c08d'),(140,'admin','','2012-06-25 17:05:35','c08b61e87a2062d8de9c4b18e8b2c08d'),(141,'admin','','2012-06-25 17:05:38','c08b61e87a2062d8de9c4b18e8b2c08d'),(142,'admin','','2012-06-25 17:05:54','c08b61e87a2062d8de9c4b18e8b2c08d'),(143,'admin','','2012-06-25 17:05:56','c08b61e87a2062d8de9c4b18e8b2c08d'),(144,'admin','Group Management Choose','2012-06-25 17:05:57','c08b61e87a2062d8de9c4b18e8b2c08d'),(145,'admin','Map Field Choose','2012-06-25 17:05:58','c08b61e87a2062d8de9c4b18e8b2c08d'),(146,'admin','Target Buildup Choose','2012-06-25 17:05:59','c08b61e87a2062d8de9c4b18e8b2c08d'),(147,'admin','','2012-06-25 17:06:02','c08b61e87a2062d8de9c4b18e8b2c08d'),(148,'admin','Group Creation Choose','2012-06-25 17:06:09','c08b61e87a2062d8de9c4b18e8b2c08d'),(149,'admin','DND Successfully Created','2012-06-25 17:06:31','c08b61e87a2062d8de9c4b18e8b2c08d'),(150,'admin','','2012-06-25 17:06:43','c08b61e87a2062d8de9c4b18e8b2c08d'),(151,'admin','Target UnArchive Choosess','2012-06-25 17:07:46','c08b61e87a2062d8de9c4b18e8b2c08d'),(152,'admin','Map Field Choose','2012-06-25 17:07:59','c08b61e87a2062d8de9c4b18e8b2c08d'),(153,'admin','Target Buildup Choose','2012-06-25 17:08:00','c08b61e87a2062d8de9c4b18e8b2c08d'),(154,'admin','Bulk SMS Broadcast Choose','2012-06-25 17:08:01','c08b61e87a2062d8de9c4b18e8b2c08d'),(155,'admin','Scheduler Choose','2012-06-25 17:08:02','c08b61e87a2062d8de9c4b18e8b2c08d'),(156,'admin','Target Buildup Choose','2012-06-25 17:12:23','c08b61e87a2062d8de9c4b18e8b2c08d'),(157,'admin','Group Creation Choose','2012-06-25 17:12:27','c08b61e87a2062d8de9c4b18e8b2c08d'),(158,'admin','','2012-06-25 17:12:28','c08b61e87a2062d8de9c4b18e8b2c08d'),(159,'admin','Group Management Choose','2012-06-25 17:13:05','c08b61e87a2062d8de9c4b18e8b2c08d'),(160,'admin','Scheduler Choose','2012-06-25 17:39:48','c08b61e87a2062d8de9c4b18e8b2c08d'),(161,'admin','','2012-06-25 17:39:50','c08b61e87a2062d8de9c4b18e8b2c08d'),(162,'admin','','2012-06-25 17:39:53','c08b61e87a2062d8de9c4b18e8b2c08d'),(163,'admin','','2012-06-25 18:38:10','c08b61e87a2062d8de9c4b18e8b2c08d'),(164,'admin','','2012-06-25 18:38:12','c08b61e87a2062d8de9c4b18e8b2c08d'),(165,'admin','Scheduler Create Choose','2012-06-25 18:39:00','c08b61e87a2062d8de9c4b18e8b2c08d'),(166,'admin','','2012-06-25 18:39:03','c08b61e87a2062d8de9c4b18e8b2c08d'),(167,'admin','Scheduler Create Choose','2012-06-25 18:39:06','c08b61e87a2062d8de9c4b18e8b2c08d'),(168,'admin','','2012-06-25 18:48:16','c08b61e87a2062d8de9c4b18e8b2c08d'),(169,'admin','Login Success!!!','2012-06-26 11:26:12','0e9b96baafec22be1f9aaf93d0248a9b'),(170,'admin','Group Management Choose','2012-06-26 11:26:13','0e9b96baafec22be1f9aaf93d0248a9b'),(171,'admin','Login Field Choose','2012-06-26 11:26:14','0e9b96baafec22be1f9aaf93d0248a9b'),(172,'admin','Group Management Choose','2012-06-26 11:26:15','0e9b96baafec22be1f9aaf93d0248a9b'),(173,'admin','Map Field Choose','2012-06-26 11:26:16','0e9b96baafec22be1f9aaf93d0248a9b'),(174,'admin','','2012-06-26 11:26:20','0e9b96baafec22be1f9aaf93d0248a9b'),(175,'admin','','2012-06-26 11:26:26','0e9b96baafec22be1f9aaf93d0248a9b'),(176,'admin','','2012-06-26 11:26:29','0e9b96baafec22be1f9aaf93d0248a9b'),(177,'admin','','2012-06-26 11:26:31','0e9b96baafec22be1f9aaf93d0248a9b'),(178,'admin','','2012-06-26 11:26:35','0e9b96baafec22be1f9aaf93d0248a9b'),(179,'admin','','2012-06-26 11:26:52','0e9b96baafec22be1f9aaf93d0248a9b'),(180,'admin','','2012-06-26 11:27:03','0e9b96baafec22be1f9aaf93d0248a9b'),(181,'admin','Target Buildup Choose','2012-06-26 11:27:42','0e9b96baafec22be1f9aaf93d0248a9b'),(182,'admin','Bulk SMS Broadcast Choose','2012-06-26 11:27:44','0e9b96baafec22be1f9aaf93d0248a9b'),(183,'admin','Scheduler Choose','2012-06-26 11:27:46','0e9b96baafec22be1f9aaf93d0248a9b'),(184,'admin','','2012-06-26 11:27:49','0e9b96baafec22be1f9aaf93d0248a9b'),(185,'admin','Scheduler Choose','2012-06-26 11:28:34','0e9b96baafec22be1f9aaf93d0248a9b'),(186,'admin','','2012-06-26 11:28:37','0e9b96baafec22be1f9aaf93d0248a9b'),(187,'admin','Bulk SMS Broadcast Choose','2012-06-26 11:28:51','0e9b96baafec22be1f9aaf93d0248a9b'),(188,'admin','Bulk SMS View Choose','2012-06-26 11:28:53','0e9b96baafec22be1f9aaf93d0248a9b'),(189,'admin','Login Success!!!','2012-06-26 12:46:24','0ef2adc7d3bf39b51300a1368b43a6e6'),(190,'admin','Login Field Choose','2012-06-26 12:46:29','0ef2adc7d3bf39b51300a1368b43a6e6'),(191,'admin','Group Management Choose','2012-06-26 12:46:31','0ef2adc7d3bf39b51300a1368b43a6e6'),(192,'admin','Map Field Choose','2012-06-26 12:46:33','0ef2adc7d3bf39b51300a1368b43a6e6'),(193,'admin','Target Buildup Choose','2012-06-26 12:46:34','0ef2adc7d3bf39b51300a1368b43a6e6'),(194,'admin','Bulk SMS Broadcast Choose','2012-06-26 12:46:34','0ef2adc7d3bf39b51300a1368b43a6e6'),(195,'admin','Scheduler Choose','2012-06-26 12:46:35','0ef2adc7d3bf39b51300a1368b43a6e6'),(196,'admin','','2012-06-26 13:00:20','0ef2adc7d3bf39b51300a1368b43a6e6'),(197,'admin','Target Buildup Choose','2012-06-26 13:00:27','0ef2adc7d3bf39b51300a1368b43a6e6'),(198,'admin','Bulk SMS Broadcast Choose','2012-06-26 13:00:28','0ef2adc7d3bf39b51300a1368b43a6e6'),(199,'admin','Scheduler Choose','2012-06-26 13:00:31','0ef2adc7d3bf39b51300a1368b43a6e6'),(200,'admin','Group Management Choose','2012-06-26 13:00:33','0ef2adc7d3bf39b51300a1368b43a6e6'),(201,'admin','kumar Sub Group View Choose','2012-06-26 13:00:34','0ef2adc7d3bf39b51300a1368b43a6e6'),(202,'admin','pramod Group View Choosess','2012-06-26 13:00:36','0ef2adc7d3bf39b51300a1368b43a6e6'),(203,'admin','pramod Group View Choosess','2012-06-26 13:00:42','0ef2adc7d3bf39b51300a1368b43a6e6'),(204,'admin','Login Success!!!','2012-06-26 13:00:55','7b3f641415a17e0fe6262ec566c43cab'),(205,'admin','Group Management Choose','2012-06-26 13:00:59','7b3f641415a17e0fe6262ec566c43cab'),(206,'admin','Group Creation Choose','2012-06-26 13:01:09','7b3f641415a17e0fe6262ec566c43cab'),(207,'admin','pramod Group View Choosess','2012-06-26 13:01:13','7b3f641415a17e0fe6262ec566c43cab'),(208,'admin','Bulk SMS Broadcast Choose','2012-06-26 13:01:20','7b3f641415a17e0fe6262ec566c43cab'),(209,'admin','Target Buildup Choose','2012-06-26 13:02:58','7b3f641415a17e0fe6262ec566c43cab'),(210,'admin','','2012-06-26 13:03:01','7b3f641415a17e0fe6262ec566c43cab'),(211,'admin','Bulk SMS Broadcast Choose','2012-06-26 14:15:57','7b3f641415a17e0fe6262ec566c43cab'),(212,'admin','Bulk SMS View Choose','2012-06-26 14:15:59','7b3f641415a17e0fe6262ec566c43cab'),(213,'admin','Login Success!!!','2012-06-26 14:32:05','58345b42837d4563a437a1d1cec70339'),(214,'admin','Login Success!!!','2012-06-26 14:32:25','09aa559a5fd2e1011eeb6f6fc8608486'),(215,'admin','Login Field Choose','2012-06-26 14:32:27','09aa559a5fd2e1011eeb6f6fc8608486'),(216,'admin','Contest Question Implode Choosess','2012-06-26 14:32:50','09aa559a5fd2e1011eeb6f6fc8608486'),(217,'admin','Contest Question Implode Choosess','2012-06-26 14:33:03','09aa559a5fd2e1011eeb6f6fc8608486'),(218,'admin','Contest Question Implode Choosess','2012-06-26 14:33:08','09aa559a5fd2e1011eeb6f6fc8608486'),(219,'admin','Contest Question Implode Choosess','2012-06-26 14:33:13','09aa559a5fd2e1011eeb6f6fc8608486'),(220,'admin','Contest UnArchive Choosess','2012-06-26 14:34:52','09aa559a5fd2e1011eeb6f6fc8608486'),(221,'admin','Contest Creation Choosess','2012-06-26 14:34:58','09aa559a5fd2e1011eeb6f6fc8608486'),(222,'admin','Contest Creation Choosess','2012-06-26 14:36:05','09aa559a5fd2e1011eeb6f6fc8608486'),(223,'admin','Contest Creation Choosess','2012-06-26 14:36:07','09aa559a5fd2e1011eeb6f6fc8608486'),(224,'admin','Nazara Quiz Header Banner size doesn?t matches wit','2012-06-26 14:45:25','09aa559a5fd2e1011eeb6f6fc8608486'),(225,'admin','Nazara Quiz Header Banner size doesn?t matches wit','2012-06-26 14:49:55','09aa559a5fd2e1011eeb6f6fc8608486'),(226,'admin','Please Change Start Datetime Greater Than Current ','2012-06-26 15:14:50','09aa559a5fd2e1011eeb6f6fc8608486'),(227,'admin','ContestOne Contest successfully Created!','2012-06-26 15:26:03','09aa559a5fd2e1011eeb6f6fc8608486'),(228,'admin','View The Contest ContestOne','2012-06-26 15:26:03','09aa559a5fd2e1011eeb6f6fc8608486'),(229,'admin','Contest Question Add Choosess','2012-06-26 15:26:46','09aa559a5fd2e1011eeb6f6fc8608486'),(230,'admin','Contest Question Successfully Added!','2012-06-26 15:28:13','09aa559a5fd2e1011eeb6f6fc8608486'),(231,'admin','Contest Question Successfully Inserted!','2012-06-26 15:28:13','09aa559a5fd2e1011eeb6f6fc8608486'),(232,'admin','Contest Question View Choosess','2012-06-26 15:28:18','09aa559a5fd2e1011eeb6f6fc8608486'),(233,'admin','Contest Question Modification Choosess','2012-06-26 15:28:31','09aa559a5fd2e1011eeb6f6fc8608486'),(234,'admin','View The Contest ContestOne','2012-06-26 15:28:42','09aa559a5fd2e1011eeb6f6fc8608486'),(235,'admin','Contest Question Add Choosess','2012-06-26 15:28:46','09aa559a5fd2e1011eeb6f6fc8608486'),(236,'admin','Contest Question Successfully Added!','2012-06-26 15:29:37','09aa559a5fd2e1011eeb6f6fc8608486'),(237,'admin','Contest Question Successfully Inserted!','2012-06-26 15:29:37','09aa559a5fd2e1011eeb6f6fc8608486'),(238,'admin','Contest Question View Choosess','2012-06-26 15:29:46','09aa559a5fd2e1011eeb6f6fc8608486'),(239,'admin','Contest Question View Choosess','2012-06-26 15:29:48','09aa559a5fd2e1011eeb6f6fc8608486'),(240,'admin','Contest Question View Choosess','2012-06-26 15:30:00','09aa559a5fd2e1011eeb6f6fc8608486'),(241,'admin','View The Contest ContestOne','2012-06-26 15:30:05','09aa559a5fd2e1011eeb6f6fc8608486'),(242,'admin','Contest Question Implode Choosess','2012-06-26 15:30:13','09aa559a5fd2e1011eeb6f6fc8608486'),(243,'admin','Either file is empity or mandatory field is not fo','2012-06-26 15:33:02','09aa559a5fd2e1011eeb6f6fc8608486'),(244,'admin','Uploading file already exist.','2012-06-26 15:33:29','09aa559a5fd2e1011eeb6f6fc8608486'),(245,'admin','Either file is empity or mandatory field is not fo','2012-06-26 15:34:03','09aa559a5fd2e1011eeb6f6fc8608486'),(246,'admin','Either file is empity or mandatory field is not fo','2012-06-26 15:36:37','09aa559a5fd2e1011eeb6f6fc8608486'),(247,'admin','Either file is empity or mandatory field is not fo','2012-06-26 15:38:50','09aa559a5fd2e1011eeb6f6fc8608486'),(248,'admin','Either file is empity or mandatory field is not fo','2012-06-26 15:39:26','09aa559a5fd2e1011eeb6f6fc8608486'),(249,'admin','Uploading file already exist.','2012-06-26 15:49:09','09aa559a5fd2e1011eeb6f6fc8608486'),(250,'admin','Either file is empity or mandatory field is not fo','2012-06-26 15:49:36','09aa559a5fd2e1011eeb6f6fc8608486'),(251,'admin','Uploading file already exist.','2012-06-26 15:52:18','09aa559a5fd2e1011eeb6f6fc8608486'),(252,'admin','Uploading file already exist.','2012-06-26 17:07:05','09aa559a5fd2e1011eeb6f6fc8608486'),(253,'admin','Uploading file already exist.','2012-06-26 17:21:10','09aa559a5fd2e1011eeb6f6fc8608486'),(254,'admin','Contest Question Implode Choosess','2012-06-26 17:53:55','09aa559a5fd2e1011eeb6f6fc8608486'),(255,'admin','Contest Creation Choosess','2012-06-26 17:55:34','09aa559a5fd2e1011eeb6f6fc8608486'),(256,'admin','View The Contest ContestOne','2012-06-26 17:55:36','09aa559a5fd2e1011eeb6f6fc8608486'),(257,'admin','View The Contest ContestOne','2012-06-26 17:55:54','09aa559a5fd2e1011eeb6f6fc8608486'),(258,'admin','Contest Question View Choosess','2012-06-26 17:55:56','09aa559a5fd2e1011eeb6f6fc8608486'),(259,'admin','View The Contest ContestOne','2012-06-26 17:56:24','09aa559a5fd2e1011eeb6f6fc8608486'),(260,'admin','Contest Question View Choosess','2012-06-26 17:56:25','09aa559a5fd2e1011eeb6f6fc8608486'),(261,'admin','View The Contest ContestOne','2012-06-26 17:59:07','09aa559a5fd2e1011eeb6f6fc8608486'),(262,'admin','Contest Question Implode Choosess','2012-06-26 17:59:11','09aa559a5fd2e1011eeb6f6fc8608486'),(263,'admin','Uploading file already exist.','2012-06-26 18:24:10','09aa559a5fd2e1011eeb6f6fc8608486'),(264,'admin','Contest Question Implode Choosess','2012-06-26 18:43:39','09aa559a5fd2e1011eeb6f6fc8608486'),(265,'admin','Contest Question View Choosess','2012-06-26 18:43:45','09aa559a5fd2e1011eeb6f6fc8608486'),(266,'admin','Contest id 1 Question id 3 successfully Deleted!','2012-06-26 18:43:49','09aa559a5fd2e1011eeb6f6fc8608486'),(267,'admin','Contest Question Successfully Deleted!','2012-06-26 18:43:49','09aa559a5fd2e1011eeb6f6fc8608486'),(268,'admin','View The Contest ContestOne','2012-06-26 18:43:51','09aa559a5fd2e1011eeb6f6fc8608486'),(269,'admin','Contest Question Implode Choosess','2012-06-26 18:43:54','09aa559a5fd2e1011eeb6f6fc8608486'),(270,'admin','Uploading file already exist.','2012-06-26 18:44:03','09aa559a5fd2e1011eeb6f6fc8608486'),(271,'admin','Contest Question Implode Choosess','2012-06-26 18:44:15','09aa559a5fd2e1011eeb6f6fc8608486'),(272,'admin','View The Contest ContestOne','2012-06-26 18:44:47','09aa559a5fd2e1011eeb6f6fc8608486'),(273,'admin','Contest Question View Choosess','2012-06-26 18:44:49','09aa559a5fd2e1011eeb6f6fc8608486'),(274,'admin','Contest Question View Choosess','2012-06-26 18:47:15','09aa559a5fd2e1011eeb6f6fc8608486'),(275,'admin','Contest id 1 Question id 4 successfully Deleted!','2012-06-26 18:47:17','09aa559a5fd2e1011eeb6f6fc8608486'),(276,'admin','Contest Question Successfully Deleted!','2012-06-26 18:47:17','09aa559a5fd2e1011eeb6f6fc8608486'),(277,'admin','View The Contest ContestOne','2012-06-26 18:47:19','09aa559a5fd2e1011eeb6f6fc8608486'),(278,'admin','Contest Question Implode Choosess','2012-06-26 18:47:20','09aa559a5fd2e1011eeb6f6fc8608486'),(279,'admin','Contest Question Implode Choosess','2012-06-26 18:51:56','09aa559a5fd2e1011eeb6f6fc8608486'),(280,'admin','Contest Question Implode Choosess','2012-06-26 19:21:17','09aa559a5fd2e1011eeb6f6fc8608486'),(281,'admin','Uploading file already exist.','2012-06-26 19:21:28','09aa559a5fd2e1011eeb6f6fc8608486'),(282,'admin','Contest Question Implode Choosess','2012-06-26 19:21:43','09aa559a5fd2e1011eeb6f6fc8608486'),(283,'admin','Contest Question View Choosess','2012-06-26 19:21:49','09aa559a5fd2e1011eeb6f6fc8608486'),(284,'admin','Contest id 1 Question id 8 successfully Deleted!','2012-06-26 19:21:55','09aa559a5fd2e1011eeb6f6fc8608486'),(285,'admin','Contest Question Successfully Deleted!','2012-06-26 19:21:55','09aa559a5fd2e1011eeb6f6fc8608486'),(286,'admin','Contest Question View Choosess','2012-06-26 19:21:56','09aa559a5fd2e1011eeb6f6fc8608486'),(287,'admin','Contest id 1 Question id 7 successfully Deleted!','2012-06-26 19:21:59','09aa559a5fd2e1011eeb6f6fc8608486'),(288,'admin','Contest Question Successfully Deleted!','2012-06-26 19:21:59','09aa559a5fd2e1011eeb6f6fc8608486'),(289,'admin','View The Contest ContestOne','2012-06-26 19:23:31','09aa559a5fd2e1011eeb6f6fc8608486'),(290,'admin','Contest Question Implode Choosess','2012-06-26 19:23:32','09aa559a5fd2e1011eeb6f6fc8608486'),(291,'admin','Contest Question Implode Choosess','2012-06-26 19:23:38','09aa559a5fd2e1011eeb6f6fc8608486'),(292,'admin','Contest Question View Choosess','2012-06-26 19:23:43','09aa559a5fd2e1011eeb6f6fc8608486'),(293,'admin','Contest Question View Choosess','2012-06-26 19:23:46','09aa559a5fd2e1011eeb6f6fc8608486'),(294,'admin','Login Success!!!','2012-06-27 10:38:33','76e5ec6542f6edb1184fb1edd1070560'),(295,'admin','Login Field Choose','2012-06-27 10:38:35','76e5ec6542f6edb1184fb1edd1070560'),(296,'admin','Group Management Choose','2012-06-27 10:38:39','76e5ec6542f6edb1184fb1edd1070560'),(297,'admin','Map Field Choose','2012-06-27 10:38:44','76e5ec6542f6edb1184fb1edd1070560'),(298,'admin','','2012-06-27 10:38:45','76e5ec6542f6edb1184fb1edd1070560'),(299,'admin','Target Buildup Choose','2012-06-27 10:38:50','76e5ec6542f6edb1184fb1edd1070560'),(300,'admin','','2012-06-27 10:38:54','76e5ec6542f6edb1184fb1edd1070560'),(301,'admin','Login Success!!!','2012-06-27 14:15:19','fb864c77fe81aa0af9ab1bd455a23b22'),(302,'admin','Login Field Choose','2012-06-27 14:15:31','fb864c77fe81aa0af9ab1bd455a23b22'),(303,'admin','Group Management Choose','2012-06-27 14:15:41','fb864c77fe81aa0af9ab1bd455a23b22'),(304,'admin','Map Field Choose','2012-06-27 14:15:46','fb864c77fe81aa0af9ab1bd455a23b22'),(305,'admin','Target Buildup Choose','2012-06-27 14:15:49','fb864c77fe81aa0af9ab1bd455a23b22'),(306,'admin','Bulk SMS Broadcast Choose','2012-06-27 14:15:52','fb864c77fe81aa0af9ab1bd455a23b22'),(307,'admin','Bulk SMS Broadcast Choose','2012-06-27 14:15:55','fb864c77fe81aa0af9ab1bd455a23b22'),(308,'admin','Scheduler Choose','2012-06-27 14:24:22','fb864c77fe81aa0af9ab1bd455a23b22'),(309,'admin','Bulk SMS Broadcast Choose','2012-06-27 14:24:23','fb864c77fe81aa0af9ab1bd455a23b22'),(310,'admin','Target Buildup Choose','2012-06-27 14:24:24','fb864c77fe81aa0af9ab1bd455a23b22'),(311,'admin','Map Field Choose','2012-06-27 14:24:25','fb864c77fe81aa0af9ab1bd455a23b22'),(312,'admin','Login Field Choose','2012-06-27 14:24:27','fb864c77fe81aa0af9ab1bd455a23b22'),(313,'admin','Login Success!!!','2012-06-27 14:24:46','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(314,'admin','Login Field Choose','2012-06-27 14:24:49','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(315,'admin','Group Management Choose','2012-06-27 14:24:56','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(316,'admin','Target Buildup Choose','2012-06-27 14:25:05','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(317,'admin','Contest Management Choose','2012-06-27 14:25:10','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(318,'admin','Contest Creation Choosess','2012-06-27 14:25:15','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(319,'admin','View The Contest ContestOne','2012-06-27 14:25:18','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(320,'admin','Login Field Choose','2012-06-27 14:44:46','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(321,'admin','Contest Management Choose','2012-06-27 14:44:52','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(322,'admin','Contest Management Choose','2012-06-27 14:45:01','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(323,'admin','Contest Creation Choosess','2012-06-27 14:45:06','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(324,'admin','Contest Creation Choosess','2012-06-27 14:48:28','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(325,'admin','Contest Creation Choosess','2012-06-27 14:48:38','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(326,'admin','Contest Creation Choosess','2012-06-27 14:48:43','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(327,'admin','Voting Creation Choosess','2012-06-27 14:48:50','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(328,'admin','Login Field Choose','2012-06-27 14:49:21','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(329,'admin','Contest Management Choose','2012-06-27 14:49:24','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(330,'admin','','2012-06-27 14:49:25','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(331,'admin','Voting Creation Choosess','2012-06-27 14:49:27','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(332,'admin','Voting Creation Choosess','2012-06-27 14:52:50','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(333,'admin','Login Field Choose','2012-06-27 14:53:40','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(334,'admin','','2012-06-27 14:53:43','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(335,'admin','Map Field Choose','2012-06-27 14:54:07','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(336,'admin','Login Field Choose','2012-06-27 14:54:17','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(337,'admin','','2012-06-27 14:54:23','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(338,'admin','','2012-06-27 14:54:28','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(339,'admin','Login Field Choose','2012-06-27 14:54:30','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(340,'admin','','2012-06-27 14:54:32','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(341,'admin','','2012-06-27 14:54:33','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(342,'admin','','2012-06-27 14:54:36','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(343,'admin','','2012-06-27 14:54:39','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(344,'admin','','2012-06-27 14:54:41','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(345,'admin','Contest Question View Choosess','2012-06-27 14:54:43','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(346,'admin','Contest Question View Choosess','2012-06-27 14:54:46','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(347,'admin','Contest Question View Choosess','2012-06-27 14:54:48','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(348,'admin','Contest Question View Choosess','2012-06-27 14:54:50','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(349,'admin','Contest Question View Choosess','2012-06-27 14:54:55','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(350,'admin','Contest Question View Choosess','2012-06-27 14:54:59','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(351,'admin','Contest Question View Choosess','2012-06-27 14:55:00','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(352,'admin','Contest Question View Choosess','2012-06-27 14:55:04','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(353,'admin','Map Field Choose','2012-06-27 14:55:35','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(354,'admin','Group Management Choose','2012-06-27 14:55:36','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(355,'admin','Login Field Choose','2012-06-27 14:55:37','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(356,'admin','Target Buildup Choose','2012-06-27 14:55:38','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(357,'admin','Bulk SMS Broadcast Choose','2012-06-27 14:55:38','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(358,'admin','Scheduler Choose','2012-06-27 14:55:39','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(359,'admin','Contest Management Choose','2012-06-27 14:55:39','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(360,'admin','','2012-06-27 14:55:40','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(361,'admin','','2012-06-27 14:55:41','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(362,'admin','','2012-06-27 14:55:46','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(363,'admin','Contest Question View Choosess','2012-06-27 14:56:05','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(364,'admin','Contest Question View Choosess','2012-06-27 16:19:25','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(365,'admin','Contest Question View Choosess','2012-06-27 16:19:26','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(366,'admin','Contest Question View Choosess','2012-06-27 16:19:28','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(367,'admin','Contest Question View Choosess','2012-06-27 16:19:29','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(368,'admin','','2012-06-27 16:19:58','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(369,'admin','Contest Question View Choosess','2012-06-27 16:19:59','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(370,'admin','Contest Question View Choosess','2012-06-27 16:20:01','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(371,'admin','Contest Question View Choosess','2012-06-27 16:20:03','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(372,'admin','Contest Question View Choosess','2012-06-27 16:20:04','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(373,'admin','Contest Question View Choosess','2012-06-27 16:20:05','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(374,'admin','Contest Question View Choosess','2012-06-27 16:20:06','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(375,'admin','Contest Question View Choosess','2012-06-27 16:20:06','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(376,'admin','','2012-06-27 16:20:08','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(377,'admin','Contest Question View Choosess','2012-06-27 16:20:09','d4a8db6e7dce01d7e4bb7f72a5c8d28b'),(378,'admin','Login Success!!!','2012-06-27 17:45:43','277b56221c3f27d9ca482d0c475584d3'),(379,'admin','Login Field Choose','2012-06-27 17:45:45','277b56221c3f27d9ca482d0c475584d3'),(380,'admin','Group Management Choose','2012-06-27 17:45:47','277b56221c3f27d9ca482d0c475584d3'),(381,'admin','Map Field Choose','2012-06-27 17:45:48','277b56221c3f27d9ca482d0c475584d3'),(382,'admin','Target Buildup Choose','2012-06-27 17:45:48','277b56221c3f27d9ca482d0c475584d3'),(383,'admin','Scheduler Choose','2012-06-27 17:45:50','277b56221c3f27d9ca482d0c475584d3'),(384,'admin','Bulk SMS Broadcast Choose','2012-06-27 17:45:51','277b56221c3f27d9ca482d0c475584d3'),(385,'admin','Login Field Choose','2012-06-27 17:52:09','277b56221c3f27d9ca482d0c475584d3'),(386,'admin','Login Success!!!','2012-06-27 17:52:20','39c848faf5c246e0ddb43b6604e0f23e'),(387,'admin','Login Field Choose','2012-06-27 17:53:54','39c848faf5c246e0ddb43b6604e0f23e'),(388,'admin','Group Management Choose','2012-06-27 17:53:59','39c848faf5c246e0ddb43b6604e0f23e'),(389,'admin','Scheduler Choose','2012-06-27 17:54:00','39c848faf5c246e0ddb43b6604e0f23e'),(390,'admin','Contest Management Choose','2012-06-27 17:54:00','39c848faf5c246e0ddb43b6604e0f23e'),(391,'admin','View The Contest ContestOne','2012-06-27 17:54:05','39c848faf5c246e0ddb43b6604e0f23e'),(392,'admin','Contest Question Implode Choosess','2012-06-27 17:54:18','39c848faf5c246e0ddb43b6604e0f23e'),(393,'admin','View The Contest ContestOne','2012-06-27 17:56:14','39c848faf5c246e0ddb43b6604e0f23e'),(394,'admin','Contest Question Implode Choosess','2012-06-27 17:56:17','39c848faf5c246e0ddb43b6604e0f23e'),(395,'admin','Login Field Choose','2012-06-27 18:15:33','39c848faf5c246e0ddb43b6604e0f23e'),(396,'admin','','2012-06-27 18:15:36','39c848faf5c246e0ddb43b6604e0f23e'),(397,'admin','Contest Management Choose','2012-06-27 18:15:37','39c848faf5c246e0ddb43b6604e0f23e'),(398,'admin','View The Contest ContestOne','2012-06-27 18:15:41','39c848faf5c246e0ddb43b6604e0f23e'),(399,'admin','Contest Question Implode Choosess','2012-06-27 18:15:42','39c848faf5c246e0ddb43b6604e0f23e'),(400,'admin','View The Contest ContestOne','2012-06-27 18:17:05','39c848faf5c246e0ddb43b6604e0f23e'),(401,'admin','Contest Question Implode Choosess','2012-06-27 18:17:07','39c848faf5c246e0ddb43b6604e0f23e'),(402,'admin','Contest Question Implode Choosess','2012-06-27 18:31:39','39c848faf5c246e0ddb43b6604e0f23e'),(403,'admin','Login Success!!!','2012-06-28 11:41:12','695a5dd3d0b2a6bd23e4c96f9a75890f'),(404,'admin','Contest Management Choose','2012-06-28 11:41:15','695a5dd3d0b2a6bd23e4c96f9a75890f'),(405,'admin','View The Contest ContestOne','2012-06-28 11:41:18','695a5dd3d0b2a6bd23e4c96f9a75890f'),(406,'admin','Contest Question Implode Choosess','2012-06-28 11:41:20','695a5dd3d0b2a6bd23e4c96f9a75890f'),(407,'admin','Login Success!!!','2012-06-28 13:48:51','86aaf63a4d2ac15435c7e261971d020f'),(408,'admin','Contest Management Choose','2012-06-28 13:48:54','86aaf63a4d2ac15435c7e261971d020f'),(409,'admin','Login Success!!!','2012-06-28 15:28:59','7a7c4e6b3e3ff56eb9a6f0ed814cd696'),(410,'admin','Contest Management Choose','2012-06-28 15:29:01','7a7c4e6b3e3ff56eb9a6f0ed814cd696'),(411,'admin','Contest Creation Choosess','2012-06-28 15:29:02','7a7c4e6b3e3ff56eb9a6f0ed814cd696'),(412,'admin','View The Contest ContestOne','2012-06-28 15:29:03','7a7c4e6b3e3ff56eb9a6f0ed814cd696'),(413,'admin','Contest Question Implode Choosess','2012-06-28 15:29:05','7a7c4e6b3e3ff56eb9a6f0ed814cd696'),(414,'admin','Login Success!!!','2012-07-13 16:19:33','59dcd359ee0ae6caed39df97b3016c08'),(415,'admin','Target Buildup Choose','2012-07-13 16:19:38','59dcd359ee0ae6caed39df97b3016c08'),(416,'admin','Group Creation Choose','2012-07-13 16:19:41','59dcd359ee0ae6caed39df97b3016c08'),(417,'admin','Scheduler Choose','2012-07-13 16:19:47','59dcd359ee0ae6caed39df97b3016c08'),(418,'admin','Contest Management Choose','2012-07-13 16:19:48','59dcd359ee0ae6caed39df97b3016c08'),(419,'admin','Target Buildup Choose','2012-07-13 16:20:11','59dcd359ee0ae6caed39df97b3016c08'),(420,'admin','Group Creation Choose','2012-07-13 16:20:13','59dcd359ee0ae6caed39df97b3016c08'),(421,'admin','Target Successfully Created','2012-07-13 16:20:34','59dcd359ee0ae6caed39df97b3016c08'),(422,'admin','Target Name Already Exist, Choose Another Name','2012-07-13 16:21:00','59dcd359ee0ae6caed39df97b3016c08'),(423,'admin','Target Successfully Created','2012-07-13 16:21:17','59dcd359ee0ae6caed39df97b3016c08'),(424,'admin','Scheduler Create Choose','2012-07-13 16:22:28','59dcd359ee0ae6caed39df97b3016c08'),(425,'admin','Map Field Choose','2012-07-13 16:23:54','59dcd359ee0ae6caed39df97b3016c08'),(426,'admin','Target Buildup Choose','2012-07-13 16:23:56','59dcd359ee0ae6caed39df97b3016c08'),(427,'admin','Bulk SMS Broadcast Choose','2012-07-13 16:23:57','59dcd359ee0ae6caed39df97b3016c08'),(428,'admin','Login Success!!!','2012-07-16 12:16:39','49ddff5d3b78946947afa0db28992c43'),(429,'admin','','2012-07-16 12:16:42','49ddff5d3b78946947afa0db28992c43'),(430,'admin','Contest Management Choose','2012-07-16 12:16:44','49ddff5d3b78946947afa0db28992c43'),(431,'admin','Scheduler Choose','2012-07-16 12:16:45','49ddff5d3b78946947afa0db28992c43'),(432,'admin','Bulk SMS Broadcast Choose','2012-07-16 12:16:45','49ddff5d3b78946947afa0db28992c43'),(433,'admin','Target Buildup Choose','2012-07-16 12:16:46','49ddff5d3b78946947afa0db28992c43'),(434,'admin','Map Field Choose','2012-07-16 12:16:48','49ddff5d3b78946947afa0db28992c43'),(435,'admin','Login Field Choose','2012-07-16 13:23:31','49ddff5d3b78946947afa0db28992c43'),(436,'admin','Login Field Choose','2012-07-16 13:23:50','49ddff5d3b78946947afa0db28992c43'),(437,'admin','Group Management Choose','2012-07-16 13:23:51','49ddff5d3b78946947afa0db28992c43'),(438,'admin','Map Field Choose','2012-07-16 13:23:52','49ddff5d3b78946947afa0db28992c43'),(439,'admin','Target Buildup Choose','2012-07-16 13:23:53','49ddff5d3b78946947afa0db28992c43'),(440,'admin','Bulk SMS Broadcast Choose','2012-07-16 13:23:54','49ddff5d3b78946947afa0db28992c43'),(441,'admin','Scheduler Choose','2012-07-16 13:23:55','49ddff5d3b78946947afa0db28992c43'),(442,'admin','Contest Management Choose','2012-07-16 13:23:56','49ddff5d3b78946947afa0db28992c43'),(443,'admin','','2012-07-16 13:23:56','49ddff5d3b78946947afa0db28992c43'),(444,'admin','','2012-07-16 13:23:58','49ddff5d3b78946947afa0db28992c43'),(445,'admin','Login Success!!!','2013-04-16 11:44:10','489e75c1abbc8fb5052bdd1ad19a1269'),(446,'admin','Login Field Choose','2013-04-16 11:44:11','489e75c1abbc8fb5052bdd1ad19a1269'),(447,'admin','Group Management Choose','2013-04-16 11:44:13','489e75c1abbc8fb5052bdd1ad19a1269'),(448,'admin','Map Field Choose','2013-04-16 11:44:14','489e75c1abbc8fb5052bdd1ad19a1269'),(449,'admin','Bulk SMS Broadcast Choose','2013-04-16 11:44:17','489e75c1abbc8fb5052bdd1ad19a1269'),(450,'admin','Scheduler Choose','2013-04-16 11:44:18','489e75c1abbc8fb5052bdd1ad19a1269'),(451,'admin','Scheduler Create Choose','2013-04-16 11:44:22','489e75c1abbc8fb5052bdd1ad19a1269'),(452,'admin','Contest Management Choose','2013-04-16 11:44:27','489e75c1abbc8fb5052bdd1ad19a1269'),(453,'admin','View The Contest ContestOne','2013-04-16 11:44:32','489e75c1abbc8fb5052bdd1ad19a1269'),(454,'admin','','2013-04-16 11:44:39','489e75c1abbc8fb5052bdd1ad19a1269'),(455,'admin','Voting Creation Choosess','2013-04-16 11:44:42','489e75c1abbc8fb5052bdd1ad19a1269'),(456,'admin','','2013-04-16 11:44:51','489e75c1abbc8fb5052bdd1ad19a1269'),(457,'admin','','2013-04-16 11:44:53','489e75c1abbc8fb5052bdd1ad19a1269'),(458,'admin','','2013-04-16 11:44:55','489e75c1abbc8fb5052bdd1ad19a1269'),(459,'admin','Scheduler Choose','2013-04-16 11:44:58','489e75c1abbc8fb5052bdd1ad19a1269'),(460,'admin','','2013-04-16 11:45:00','489e75c1abbc8fb5052bdd1ad19a1269'),(461,'admin','Bulk SMS Broadcast Choose','2013-04-16 11:45:08','489e75c1abbc8fb5052bdd1ad19a1269'),(462,'admin','Bulk SMS Creation Choose','2013-04-16 11:45:11','489e75c1abbc8fb5052bdd1ad19a1269'),(463,'admin','Login Field Choose','2013-04-16 11:45:14','489e75c1abbc8fb5052bdd1ad19a1269'),(464,'admin','Group Management Choose','2013-04-16 11:45:15','489e75c1abbc8fb5052bdd1ad19a1269'),(465,'admin','Group Creation Choose','2013-04-16 11:45:18','489e75c1abbc8fb5052bdd1ad19a1269'),(466,'admin','pramod Group View Choosess','2013-04-16 11:45:23','489e75c1abbc8fb5052bdd1ad19a1269'),(467,'admin','kumar Sub Group View Choose','2013-04-16 11:45:25','489e75c1abbc8fb5052bdd1ad19a1269'),(468,'admin','pramod Group View Choosess','2013-04-16 11:45:28','489e75c1abbc8fb5052bdd1ad19a1269'),(469,'admin','kumar Sub Group View Choose','2013-04-16 11:45:29','489e75c1abbc8fb5052bdd1ad19a1269'),(470,'admin','Target Buildup Choose','2013-04-16 11:45:32','489e75c1abbc8fb5052bdd1ad19a1269'),(471,'admin','','2013-04-16 11:45:34','489e75c1abbc8fb5052bdd1ad19a1269'),(472,'admin','Group Creation Choose','2013-04-16 11:55:49','489e75c1abbc8fb5052bdd1ad19a1269'),(473,'admin','','2013-04-16 11:56:28','489e75c1abbc8fb5052bdd1ad19a1269'),(474,'admin','','2013-04-16 11:56:30','489e75c1abbc8fb5052bdd1ad19a1269'),(475,'admin','','2013-04-16 11:56:32','489e75c1abbc8fb5052bdd1ad19a1269'),(476,'admin','Group Creation Choose','2013-04-16 11:56:35','489e75c1abbc8fb5052bdd1ad19a1269'),(477,'admin','Bulk SMS Broadcast Choose','2013-04-16 11:56:49','489e75c1abbc8fb5052bdd1ad19a1269'),(478,'admin','Bulk SMS View Choose','2013-04-16 11:56:51','489e75c1abbc8fb5052bdd1ad19a1269'),(479,'admin','Bulk SMS Creation Choose','2013-04-16 11:56:54','489e75c1abbc8fb5052bdd1ad19a1269'),(480,'admin','Message Successfully Created','2013-04-16 11:57:38','489e75c1abbc8fb5052bdd1ad19a1269'),(481,'admin','Scheduler Choose','2013-04-16 11:57:48','489e75c1abbc8fb5052bdd1ad19a1269'),(482,'admin','','2013-04-16 11:57:50','489e75c1abbc8fb5052bdd1ad19a1269'),(483,'admin','Scheduler Create Choose','2013-04-16 11:57:52','489e75c1abbc8fb5052bdd1ad19a1269'),(484,'admin','','2013-04-16 11:59:03','489e75c1abbc8fb5052bdd1ad19a1269'),(485,'admin','Contest Management Choose','2013-04-16 11:59:44','489e75c1abbc8fb5052bdd1ad19a1269'),(486,'admin','View The Contest ContestOne','2013-04-16 11:59:46','489e75c1abbc8fb5052bdd1ad19a1269'),(487,'admin','','2013-04-16 11:59:55','489e75c1abbc8fb5052bdd1ad19a1269'),(488,'admin','Voting Creation Choosess','2013-04-16 11:59:57','489e75c1abbc8fb5052bdd1ad19a1269'),(489,'admin','Contest Management Choose','2013-04-16 12:00:04','489e75c1abbc8fb5052bdd1ad19a1269'),(490,'admin','View The Contest ContestOne','2013-04-16 12:00:08','489e75c1abbc8fb5052bdd1ad19a1269'),(491,'admin','','2013-04-16 12:00:16','489e75c1abbc8fb5052bdd1ad19a1269'),(492,'admin','','2013-04-16 12:00:24','489e75c1abbc8fb5052bdd1ad19a1269'),(493,'admin','Contest Question View Choosess','2013-04-16 12:00:25','489e75c1abbc8fb5052bdd1ad19a1269'),(494,'admin','Group Management Choose','2013-04-16 12:00:38','489e75c1abbc8fb5052bdd1ad19a1269'),(495,'admin','Map Field Choose','2013-04-16 12:00:42','489e75c1abbc8fb5052bdd1ad19a1269'),(496,'admin','','2013-04-16 12:00:45','489e75c1abbc8fb5052bdd1ad19a1269'),(497,'admin','','2013-04-16 12:03:52','489e75c1abbc8fb5052bdd1ad19a1269'),(498,'admin','','2013-04-16 12:04:20','489e75c1abbc8fb5052bdd1ad19a1269'),(499,'admin','','2013-04-16 12:04:26','489e75c1abbc8fb5052bdd1ad19a1269'),(500,'admin','Target Buildup Choose','2013-04-16 12:04:32','489e75c1abbc8fb5052bdd1ad19a1269'),(501,'admin','Group Creation Choose','2013-04-16 12:04:34','489e75c1abbc8fb5052bdd1ad19a1269'),(502,'admin','Scheduler Choose','2013-04-16 12:05:22','489e75c1abbc8fb5052bdd1ad19a1269'),(503,'admin','Scheduler Choose','2013-04-16 12:05:46','489e75c1abbc8fb5052bdd1ad19a1269'),(504,'admin','Scheduler Create Choose','2013-04-16 12:05:51','489e75c1abbc8fb5052bdd1ad19a1269'),(505,'admin','Target Buildup Choose','2013-04-16 12:16:44','489e75c1abbc8fb5052bdd1ad19a1269'),(506,'admin','Target Buildup Choose','2013-04-16 12:16:54','489e75c1abbc8fb5052bdd1ad19a1269'),(507,'admin','Contest Management Choose','2013-04-16 12:17:06','489e75c1abbc8fb5052bdd1ad19a1269'),(508,'admin','','2013-04-16 12:17:29','489e75c1abbc8fb5052bdd1ad19a1269'),(509,'admin','','2013-04-16 12:17:32','489e75c1abbc8fb5052bdd1ad19a1269'),(510,'admin','Login Success!!!','2013-04-16 14:32:33','042cfd929b9e0c05b42cc54065b6d3d0'),(511,'admin','Login Success!!!','2013-04-16 14:34:20','6618a86f90a76c3360f6cb91f69bf11b'),(512,'admin','Login Success!!!','2013-04-16 14:57:40','0b5051d1f74e030e74d3e9aa7b2d15a9'),(513,'admin','Target Buildup Choose','2013-04-16 14:58:13','0b5051d1f74e030e74d3e9aa7b2d15a9'),(514,'admin','Group Creation Choose','2013-04-16 14:58:15','0b5051d1f74e030e74d3e9aa7b2d15a9'),(515,'admin','Map Field Choose','2013-04-16 14:59:00','0b5051d1f74e030e74d3e9aa7b2d15a9'),(516,'admin','','2013-04-16 14:59:04','0b5051d1f74e030e74d3e9aa7b2d15a9'),(517,'admin','Bulk SMS Broadcast Choose','2013-04-16 14:59:58','0b5051d1f74e030e74d3e9aa7b2d15a9'),(518,'admin','Bulk SMS View Choose','2013-04-16 15:00:01','0b5051d1f74e030e74d3e9aa7b2d15a9'),(519,'admin','Bulk SMS Creation Choose','2013-04-16 15:00:27','0b5051d1f74e030e74d3e9aa7b2d15a9'),(520,'admin','Message Successfully Created','2013-04-16 15:01:57','0b5051d1f74e030e74d3e9aa7b2d15a9'),(521,'admin','Scheduler Choose','2013-04-16 15:02:09','0b5051d1f74e030e74d3e9aa7b2d15a9'),(522,'admin','Scheduler Create Choose','2013-04-16 15:02:11','0b5051d1f74e030e74d3e9aa7b2d15a9'),(523,'admin','Group Management Choose','2013-04-16 15:12:31','0b5051d1f74e030e74d3e9aa7b2d15a9'),(524,'admin','Map Field Choose','2013-04-16 15:12:33','0b5051d1f74e030e74d3e9aa7b2d15a9'),(525,'admin','Target Buildup Choose','2013-04-16 15:12:34','0b5051d1f74e030e74d3e9aa7b2d15a9'),(526,'admin','','2013-04-16 15:12:39','0b5051d1f74e030e74d3e9aa7b2d15a9'),(527,'admin','Group Creation Choose','2013-04-16 15:13:39','0b5051d1f74e030e74d3e9aa7b2d15a9'),(528,'admin','','2013-04-16 15:13:51','0b5051d1f74e030e74d3e9aa7b2d15a9'),(529,'admin','Group Creation Choose','2013-04-16 15:13:55','0b5051d1f74e030e74d3e9aa7b2d15a9'),(530,'admin','Bulk SMS Broadcast Choose','2013-04-16 15:15:55','0b5051d1f74e030e74d3e9aa7b2d15a9'),(531,'admin','Bulk SMS Creation Choose','2013-04-16 15:16:01','0b5051d1f74e030e74d3e9aa7b2d15a9'),(532,'admin','Contest Management Choose','2013-04-16 15:17:32','0b5051d1f74e030e74d3e9aa7b2d15a9'),(533,'admin','Contest Creation Choosess','2013-04-16 15:17:35','0b5051d1f74e030e74d3e9aa7b2d15a9'),(534,'admin','Contest Question View Choosess','2013-04-16 15:17:53','0b5051d1f74e030e74d3e9aa7b2d15a9'),(535,'admin','Contest Question View Choosess','2013-04-16 15:17:56','0b5051d1f74e030e74d3e9aa7b2d15a9'),(536,'admin','View The Contest ContestOne','2013-04-16 15:18:16','0b5051d1f74e030e74d3e9aa7b2d15a9'),(537,'admin','Contest Creation Choosess','2013-04-16 15:18:18','0b5051d1f74e030e74d3e9aa7b2d15a9'),(538,'admin','','2013-04-16 15:20:57','0b5051d1f74e030e74d3e9aa7b2d15a9'),(539,'admin','Voting Creation Choosess','2013-04-16 15:20:59','0b5051d1f74e030e74d3e9aa7b2d15a9'),(540,'admin','Voting Creation Choosess','2013-04-16 15:23:09','0b5051d1f74e030e74d3e9aa7b2d15a9'),(541,'admin','','2013-04-16 15:24:00','0b5051d1f74e030e74d3e9aa7b2d15a9'),(542,'admin','Contest Question View Choosess','2013-04-16 15:24:03','0b5051d1f74e030e74d3e9aa7b2d15a9'),(543,'admin','Contest Management Choose','2013-04-16 15:25:05','0b5051d1f74e030e74d3e9aa7b2d15a9'),(544,'admin','Contest Question View Choosess','2013-04-16 15:25:10','0b5051d1f74e030e74d3e9aa7b2d15a9'),(545,'admin','View The Contest ContestOne','2013-04-16 15:25:13','0b5051d1f74e030e74d3e9aa7b2d15a9'),(546,'admin','Contest Creation Choosess','2013-04-16 15:25:21','0b5051d1f74e030e74d3e9aa7b2d15a9'),(547,'admin','Map Field Choose','2013-04-16 15:26:17','0b5051d1f74e030e74d3e9aa7b2d15a9'),(548,'admin','','2013-04-16 15:26:18','0b5051d1f74e030e74d3e9aa7b2d15a9'),(549,'admin','Group Management Choose','2013-04-16 15:26:23','0b5051d1f74e030e74d3e9aa7b2d15a9'),(550,'admin','Group Creation Choose','2013-04-16 15:26:25','0b5051d1f74e030e74d3e9aa7b2d15a9'),(551,'admin','pramod Group View Choosess','2013-04-16 15:26:34','0b5051d1f74e030e74d3e9aa7b2d15a9'),(552,'admin','Bulk SMS Broadcast Choose','2013-04-16 15:26:39','0b5051d1f74e030e74d3e9aa7b2d15a9'),(553,'admin','Bulk SMS Creation Choose','2013-04-16 15:26:41','0b5051d1f74e030e74d3e9aa7b2d15a9'),(554,'admin','Scheduler Choose','2013-04-16 15:26:43','0b5051d1f74e030e74d3e9aa7b2d15a9'),(555,'admin','Scheduler Create Choose','2013-04-16 15:26:45','0b5051d1f74e030e74d3e9aa7b2d15a9'),(556,'admin','Map Field Choose','2013-04-16 15:26:54','0b5051d1f74e030e74d3e9aa7b2d15a9'),(557,'admin','','2013-04-16 15:26:56','0b5051d1f74e030e74d3e9aa7b2d15a9'),(558,'admin','Target Buildup Choose','2013-04-16 15:26:59','0b5051d1f74e030e74d3e9aa7b2d15a9'),(559,'admin','Group Creation Choose','2013-04-16 15:27:02','0b5051d1f74e030e74d3e9aa7b2d15a9'),(560,'admin','Bulk SMS Broadcast Choose','2013-04-16 15:27:10','0b5051d1f74e030e74d3e9aa7b2d15a9'),(561,'admin','Bulk SMS Creation Choose','2013-04-16 15:27:14','0b5051d1f74e030e74d3e9aa7b2d15a9'),(562,'admin','Login Success!!!','2013-04-17 13:17:32','11c14681da8cb909f9e6c033302bfd67'),(563,'admin','Target Buildup Choose','2013-04-17 13:17:48','11c14681da8cb909f9e6c033302bfd67'),(564,'admin','Group Creation Choose','2013-04-17 13:17:52','11c14681da8cb909f9e6c033302bfd67'),(565,'admin','Map Field Choose','2013-04-17 13:19:39','11c14681da8cb909f9e6c033302bfd67'),(566,'admin','Target Buildup Choose','2013-04-17 13:19:41','11c14681da8cb909f9e6c033302bfd67'),(567,'admin','Login Field Choose','2013-04-17 13:19:44','11c14681da8cb909f9e6c033302bfd67'),(568,'admin',' Login View Choosess','2013-04-17 13:19:47','11c14681da8cb909f9e6c033302bfd67'),(569,'admin','Login Modify Choose','2013-04-17 13:20:02','11c14681da8cb909f9e6c033302bfd67'),(570,'admin',' Login View Choosess','2013-04-17 13:20:06','11c14681da8cb909f9e6c033302bfd67'),(571,'admin','Login Success!!!','2013-05-03 14:25:41','9daef7dfdb6b3c5518b76c26bb49300b'),(572,'admin','Login Success!!!','2013-05-03 14:25:41','68887ffe0aee52ffdd65211cedf7923d'),(573,'admin','Login Success!!!','2013-05-03 14:26:19','8a447884f4613d67b999b95db9623c8f'),(574,'admin','Scheduler Choose','2013-05-03 14:26:25','8a447884f4613d67b999b95db9623c8f'),(575,'admin','Scheduler Create Choose','2013-05-03 14:26:27','8a447884f4613d67b999b95db9623c8f'),(576,'admin','Group Management Choose','2013-05-03 14:27:35','8a447884f4613d67b999b95db9623c8f'),(577,'admin','Target Buildup Choose','2013-05-03 14:27:38','8a447884f4613d67b999b95db9623c8f'),(578,'admin','Bulk SMS Broadcast Choose','2013-05-03 14:27:39','8a447884f4613d67b999b95db9623c8f'),(579,'admin','Scheduler Choose','2013-05-03 14:27:41','8a447884f4613d67b999b95db9623c8f'),(580,'admin','Login Success!!!','2013-07-11 13:22:03','7fb0b22ac8eead3bf97ca29e009ffdaa'),(581,'admin','Login Field Choose','2013-07-11 13:22:06','7fb0b22ac8eead3bf97ca29e009ffdaa'),(582,'admin','Group Management Choose','2013-07-11 13:22:08','7fb0b22ac8eead3bf97ca29e009ffdaa'),(583,'admin','Login Success!!!','2013-07-25 16:29:11','678ca7ba15207ca9e661f46d9dc67610'),(584,'admin','Contest Management Choose','2013-07-25 16:29:13','678ca7ba15207ca9e661f46d9dc67610'),(585,'admin','','2013-07-25 16:29:15','678ca7ba15207ca9e661f46d9dc67610'),(586,'admin','Login Success!!!','2013-07-29 14:44:00','1538896eacb75c81a275574b6f60e2af'),(587,'admin','Login Success!!!','2014-01-28 14:55:44','ebc5cd82b8dcb8a0f9149518a5767c38'),(588,'admin','Contest Management Choose','2014-01-28 14:55:49','ebc5cd82b8dcb8a0f9149518a5767c38'),(589,'admin','Contest Creation Choosess','2014-01-28 14:55:51','ebc5cd82b8dcb8a0f9149518a5767c38'),(590,'admin','','2014-01-28 14:56:03','ebc5cd82b8dcb8a0f9149518a5767c38'),(591,'admin','Voting Creation Choosess','2014-01-28 14:56:05','ebc5cd82b8dcb8a0f9149518a5767c38'),(592,'admin','Contest Management Choose','2014-01-28 14:56:07','ebc5cd82b8dcb8a0f9149518a5767c38'),(593,'admin','View The Contest ContestOne','2014-01-28 14:56:10','ebc5cd82b8dcb8a0f9149518a5767c38'),(594,'admin','Contest Question View Choosess','2014-01-28 14:56:13','ebc5cd82b8dcb8a0f9149518a5767c38'),(595,'admin','Contest Question View Choosess','2014-01-28 14:56:14','ebc5cd82b8dcb8a0f9149518a5767c38'),(596,'admin','Contest Question View Choosess','2014-01-28 14:56:16','ebc5cd82b8dcb8a0f9149518a5767c38'),(597,'admin','View The Contest ContestOne','2014-01-28 14:56:21','ebc5cd82b8dcb8a0f9149518a5767c38'),(598,'admin','Contest Creation Choosess','2014-01-28 14:56:23','ebc5cd82b8dcb8a0f9149518a5767c38'),(599,'admin','Login Success!!!','2014-01-28 15:01:16','12cf6ca2fdc84269d09e0783af92c2dd'),(600,'admin','Contest Management Choose','2014-01-28 15:01:19','12cf6ca2fdc84269d09e0783af92c2dd'),(601,'admin','Contest Creation Choosess','2014-01-28 15:01:23','12cf6ca2fdc84269d09e0783af92c2dd'),(602,'admin','Contest Question View Choosess','2014-01-28 15:01:38','12cf6ca2fdc84269d09e0783af92c2dd'),(603,'admin','View The Contest ContestOne','2014-01-28 15:01:41','12cf6ca2fdc84269d09e0783af92c2dd'),(604,'admin','Contest Question Add Choosess','2014-01-28 15:01:44','12cf6ca2fdc84269d09e0783af92c2dd'),(605,'admin','View The Contest ContestOne','2014-01-28 15:01:48','12cf6ca2fdc84269d09e0783af92c2dd'),(606,'admin','Contest Modification Choosess','2014-01-28 15:01:49','12cf6ca2fdc84269d09e0783af92c2dd'),(607,'admin','View The Contest ContestOne','2014-01-28 15:01:51','12cf6ca2fdc84269d09e0783af92c2dd'),(608,'admin','Contest Question Implode Choosess','2014-01-28 15:01:55','12cf6ca2fdc84269d09e0783af92c2dd'),(609,'admin','','2014-01-28 15:02:04','12cf6ca2fdc84269d09e0783af92c2dd'),(610,'admin','Voting Creation Choosess','2014-01-28 15:02:06','12cf6ca2fdc84269d09e0783af92c2dd'),(611,'admin','Contest Management Choose','2014-01-28 15:02:10','12cf6ca2fdc84269d09e0783af92c2dd'),(612,'admin','View The Contest ContestOne','2014-01-28 15:02:12','12cf6ca2fdc84269d09e0783af92c2dd'),(613,'admin','View The Contest ContestOne','2014-01-28 15:02:18','12cf6ca2fdc84269d09e0783af92c2dd'),(614,'admin','Contest Question View Choosess','2014-01-28 15:04:45','12cf6ca2fdc84269d09e0783af92c2dd'),(615,'admin','View The Contest ContestOne','2014-01-28 15:04:52','12cf6ca2fdc84269d09e0783af92c2dd'),(616,'admin','Contest Modification Choosess','2014-01-28 15:04:54','12cf6ca2fdc84269d09e0783af92c2dd'),(617,'admin','View The Contest ContestOne','2014-01-28 15:06:24','12cf6ca2fdc84269d09e0783af92c2dd'),(618,'admin','Contest Question Implode Choosess','2014-01-28 15:06:27','12cf6ca2fdc84269d09e0783af92c2dd'),(619,'admin','View The Contest ContestOne','2014-01-28 15:07:07','12cf6ca2fdc84269d09e0783af92c2dd'),(620,'admin','View The Contest ContestOne','2014-01-28 15:07:50','12cf6ca2fdc84269d09e0783af92c2dd'),(621,'admin','Contest Question Add Choosess','2014-01-28 15:08:01','12cf6ca2fdc84269d09e0783af92c2dd'),(622,'admin','View The Contest ContestOne','2014-01-28 15:08:04','12cf6ca2fdc84269d09e0783af92c2dd'),(623,'admin','Contest Question View Choosess','2014-01-28 15:08:06','12cf6ca2fdc84269d09e0783af92c2dd'),(624,'admin','Contest Question Modification Choosess','2014-01-28 15:09:10','12cf6ca2fdc84269d09e0783af92c2dd'),(625,'admin','Contest Question View Choosess','2014-01-28 15:10:10','12cf6ca2fdc84269d09e0783af92c2dd'),(626,'admin','Contest Question View Choosess','2014-01-28 15:10:16','12cf6ca2fdc84269d09e0783af92c2dd'),(627,'admin','View The Contest ContestOne','2014-01-28 15:11:07','12cf6ca2fdc84269d09e0783af92c2dd'),(628,'admin','Contest Question View Choosess','2014-01-28 15:11:14','12cf6ca2fdc84269d09e0783af92c2dd'),(629,'admin','View The Contest ContestOne','2014-01-28 15:11:22','12cf6ca2fdc84269d09e0783af92c2dd'),(630,'admin','Contest Question Add Choosess','2014-01-28 15:11:24','12cf6ca2fdc84269d09e0783af92c2dd'),(631,'admin','','2014-01-28 15:12:16','12cf6ca2fdc84269d09e0783af92c2dd'),(632,'admin','Voting Creation Choosess','2014-01-28 15:12:19','12cf6ca2fdc84269d09e0783af92c2dd'),(633,'admin','Voting Creation Choosess','2014-01-28 15:14:11','12cf6ca2fdc84269d09e0783af92c2dd'),(634,'admin','','2014-01-28 15:14:15','12cf6ca2fdc84269d09e0783af92c2dd'),(635,'admin','Voting Creation Choosess','2014-01-28 15:14:18','12cf6ca2fdc84269d09e0783af92c2dd'),(636,'admin','Login Success!!!','2014-01-28 15:23:27','adadef13d3f3b2adec8f0c47c067fe4f'),(637,'admin','Scheduler Choose','2014-01-28 15:23:42','adadef13d3f3b2adec8f0c47c067fe4f'),(638,'admin','Scheduler Create Choose','2014-01-28 15:23:43','adadef13d3f3b2adec8f0c47c067fe4f'),(639,'admin','','2014-01-28 15:23:52','adadef13d3f3b2adec8f0c47c067fe4f'),(640,'admin','Scheduler Create Choose','2014-01-28 15:23:55','adadef13d3f3b2adec8f0c47c067fe4f'),(641,'admin','Scheduler Choose','2014-01-28 15:23:58','adadef13d3f3b2adec8f0c47c067fe4f'),(642,'admin','Login Success!!!','2016-08-19 13:46:02','da952f8375687dd9ebedf2fe669ce310'),(643,'admin','Login Field Choose','2016-08-19 13:47:06','da952f8375687dd9ebedf2fe669ce310'),(644,'admin','Login Creation Choose','2016-08-19 13:47:12','da952f8375687dd9ebedf2fe669ce310'),(645,'admin','Group Management Choose','2016-08-19 13:47:13','da952f8375687dd9ebedf2fe669ce310'),(646,'admin','Target Buildup Choose','2016-08-19 13:47:17','da952f8375687dd9ebedf2fe669ce310'),(647,'admin','Scheduler Choose','2016-08-19 13:47:18','da952f8375687dd9ebedf2fe669ce310'),(648,'admin','Bulk SMS Broadcast Choose','2016-08-19 13:47:23','da952f8375687dd9ebedf2fe669ce310'),(649,'admin','Contest Management Choose','2016-08-19 13:47:26','da952f8375687dd9ebedf2fe669ce310'),(650,'admin','Bulk SMS Broadcast Choose','2016-08-19 13:47:33','da952f8375687dd9ebedf2fe669ce310'),(651,'admin','Bulk SMS View Choose','2016-08-19 13:47:42','da952f8375687dd9ebedf2fe669ce310'),(652,'admin','','2016-08-19 13:47:57','da952f8375687dd9ebedf2fe669ce310'),(653,'admin','','2016-08-19 13:48:06','da952f8375687dd9ebedf2fe669ce310'),(654,'admin','','2016-08-19 13:48:10','da952f8375687dd9ebedf2fe669ce310'),(655,'admin','','2016-08-19 14:19:31','da952f8375687dd9ebedf2fe669ce310'),(656,'admin','Group Management Choose','2016-08-19 14:19:34','da952f8375687dd9ebedf2fe669ce310'),(657,'admin','Login Success!!!','2016-08-19 14:30:06','123e96bc6d15a28b2dab9c3faa8de5c2'),(658,'admin','Map Field Choose','2016-08-19 14:31:04','123e96bc6d15a28b2dab9c3faa8de5c2'),(659,'admin','Group Management Choose','2016-08-19 14:31:06','123e96bc6d15a28b2dab9c3faa8de5c2'),(660,'admin','Login Success!!!','2016-08-19 14:56:52','be4145da6459ad84eec2d238786f13db'),(661,'admin','Map Field Choose','2016-08-19 14:56:54','be4145da6459ad84eec2d238786f13db'),(662,'admin','Login Success!!!','2016-08-19 14:57:13','f6c9a0a068101f2451583233f3816c7b'),(663,'admin','Login Success!!!','2016-08-19 15:00:03','9891adbb1d05f7e4cfd20be406aa1e1b'),(664,'admin','Login Success!!!','2016-08-19 15:04:33','fa30d49a789dd06eb8feadaf8906106a'),(665,'admin','Login Success!!!','2016-08-22 16:39:57','b2821f257fef313a82b04bc003eca123'),(666,'admin','Login Field Choose','2016-08-22 16:40:18','b2821f257fef313a82b04bc003eca123'),(667,'admin','Login Creation Choose','2016-08-22 16:40:20','b2821f257fef313a82b04bc003eca123'),(668,'admin','Group Management Choose','2016-08-22 16:40:22','b2821f257fef313a82b04bc003eca123'),(669,'admin','Map Field Choose','2016-08-22 16:40:23','b2821f257fef313a82b04bc003eca123'),(670,'admin','Login Creation Choose','2016-08-22 16:40:24','b2821f257fef313a82b04bc003eca123'),(671,'admin','Login Creation Choose','2016-08-22 16:40:24','b2821f257fef313a82b04bc003eca123'),(672,'admin','Target Buildup Choose','2016-08-22 16:40:24','b2821f257fef313a82b04bc003eca123'),(673,'admin','Bulk SMS Broadcast Choose','2016-08-22 16:40:26','b2821f257fef313a82b04bc003eca123'),(674,'admin','Scheduler Choose','2016-08-22 16:40:27','b2821f257fef313a82b04bc003eca123'),(675,'admin','Contest Management Choose','2016-08-22 16:40:28','b2821f257fef313a82b04bc003eca123'),(676,'admin','Target Buildup Choose','2016-08-22 16:40:28','b2821f257fef313a82b04bc003eca123'),(677,'admin','Target Buildup Choose','2016-08-22 16:40:28','b2821f257fef313a82b04bc003eca123'),(678,'admin','','2016-08-22 16:40:31','b2821f257fef313a82b04bc003eca123'),(679,'admin','Contest Management Choose','2016-08-22 16:40:32','b2821f257fef313a82b04bc003eca123'),(680,'admin','Contest Management Choose','2016-08-22 16:40:32','b2821f257fef313a82b04bc003eca123'),(681,'admin','Scheduler Choose','2016-08-22 16:40:35','b2821f257fef313a82b04bc003eca123'),(682,'admin','','2016-08-22 16:40:37','b2821f257fef313a82b04bc003eca123'),(683,'admin','','2016-08-22 16:40:37','b2821f257fef313a82b04bc003eca123'),(684,'admin','Login Field Choose','2016-08-22 16:40:40','b2821f257fef313a82b04bc003eca123'),(685,'admin','Scheduler Choose','2016-08-22 16:40:41','b2821f257fef313a82b04bc003eca123'),(686,'admin','Scheduler Choose','2016-08-22 16:40:41','b2821f257fef313a82b04bc003eca123'),(687,'admin','Login Field Choose','2016-08-22 16:40:45','b2821f257fef313a82b04bc003eca123'),(688,'admin','Login Field Choose','2016-08-22 16:40:45','b2821f257fef313a82b04bc003eca123'),(689,'admin',' Login View Choosess','2016-08-22 16:40:46','b2821f257fef313a82b04bc003eca123'),(690,'admin',' Login View Choosess','2016-08-22 16:40:54','b2821f257fef313a82b04bc003eca123'),(691,'admin',' Login View Choosess','2016-08-22 16:40:54','b2821f257fef313a82b04bc003eca123'),(692,'admin','Group Management Choose','2016-08-22 16:40:57','b2821f257fef313a82b04bc003eca123'),(693,'admin','Login Field Choose','2016-08-22 16:41:02','b2821f257fef313a82b04bc003eca123'),(694,'admin','Group Management Choose','2016-08-22 16:41:02','b2821f257fef313a82b04bc003eca123'),(695,'admin','Group Management Choose','2016-08-22 16:41:02','b2821f257fef313a82b04bc003eca123'),(696,'admin','','2016-08-22 16:41:18','b2821f257fef313a82b04bc003eca123'),(697,'admin','','2016-08-22 16:41:23','b2821f257fef313a82b04bc003eca123'),(698,'admin','','2016-08-22 16:41:23','b2821f257fef313a82b04bc003eca123'),(699,'admin','','2016-08-22 16:47:46','b2821f257fef313a82b04bc003eca123'),(700,'admin','','2016-08-22 16:47:46','b2821f257fef313a82b04bc003eca123'),(701,'admin','','2016-08-22 16:56:39','b2821f257fef313a82b04bc003eca123'),(702,'admin','Login Success!!!','2016-08-22 17:04:43','03ee4a2f715b63d4f53f2019a2d95fdc'),(703,'admin','Login Success!!!','2016-08-23 13:21:58','e376eef2dc38a7b6ca80dd06a66d0d0c'),(704,'admin','Login Success!!!','2016-08-23 13:31:35','a411f0a288c4c3954838a9475812e402'),(705,'admin','Group Management Choose','2016-08-23 13:42:06','a411f0a288c4c3954838a9475812e402'),(706,'admin','Group Creation Choose','2016-08-23 13:42:12','a411f0a288c4c3954838a9475812e402'),(707,'admin','pramod Group View Choosess','2016-08-23 13:42:14','a411f0a288c4c3954838a9475812e402'),(708,'admin','kumar Sub Group View Choose','2016-08-23 13:42:18','a411f0a288c4c3954838a9475812e402'),(709,'admin','Group Creation Choose','2016-08-23 13:42:30','a411f0a288c4c3954838a9475812e402'),(710,'admin','idt Group Successfully Created!','2016-08-23 13:43:56','a411f0a288c4c3954838a9475812e402'),(711,'admin','Sub Group Creation Choose','2016-08-23 13:44:08','a411f0a288c4c3954838a9475812e402'),(712,'admin','idt_loai Sub Group Successfully Created!','2016-08-23 13:44:40','a411f0a288c4c3954838a9475812e402'),(713,'admin','Map Field Choose','2016-08-23 13:44:48','a411f0a288c4c3954838a9475812e402'),(714,'admin','','2016-08-23 13:44:53','a411f0a288c4c3954838a9475812e402'),(715,'admin','Target Buildup Choose','2016-08-23 14:04:57','a411f0a288c4c3954838a9475812e402'),(716,'admin','Group Creation Choose','2016-08-23 14:05:08','a411f0a288c4c3954838a9475812e402'),(717,'admin','Login Success!!!','2016-08-23 14:11:22','714737a5982eae38f8dc8b8c5e0dac09'),(718,'admin','Group Management Choose','2016-08-23 14:11:24','714737a5982eae38f8dc8b8c5e0dac09'),(719,'admin','idt Group View Choosess','2016-08-23 14:11:29','714737a5982eae38f8dc8b8c5e0dac09'),(720,'admin','Group Management Choose','2016-08-23 14:11:31','714737a5982eae38f8dc8b8c5e0dac09'),(721,'admin','Group Management Choose','2016-08-23 14:11:31','714737a5982eae38f8dc8b8c5e0dac09'),(722,'admin','idt_loai Sub Group View Choose','2016-08-23 14:11:32','714737a5982eae38f8dc8b8c5e0dac09'),(723,'admin','Target Buildup Choose','2016-08-23 14:11:35','714737a5982eae38f8dc8b8c5e0dac09'),(724,'admin','idt Group View Choosess','2016-08-23 14:11:36','714737a5982eae38f8dc8b8c5e0dac09'),(725,'admin','idt Group View Choosess','2016-08-23 14:11:36','714737a5982eae38f8dc8b8c5e0dac09'),(726,'admin','','2016-08-23 14:11:39','714737a5982eae38f8dc8b8c5e0dac09'),(727,'admin','idt_loai Sub Group View Choose','2016-08-23 14:11:41','714737a5982eae38f8dc8b8c5e0dac09'),(728,'admin','idt_loai Sub Group View Choose','2016-08-23 14:11:41','714737a5982eae38f8dc8b8c5e0dac09'),(729,'admin','','2016-08-23 14:11:41','714737a5982eae38f8dc8b8c5e0dac09'),(730,'admin','','2016-08-23 14:11:43','714737a5982eae38f8dc8b8c5e0dac09'),(731,'admin','Target Buildup Choose','2016-08-23 14:11:46','714737a5982eae38f8dc8b8c5e0dac09'),(732,'admin','Target Buildup Choose','2016-08-23 14:11:46','714737a5982eae38f8dc8b8c5e0dac09'),(733,'admin','Group Creation Choose','2016-08-23 14:11:48','714737a5982eae38f8dc8b8c5e0dac09'),(734,'admin','','2016-08-23 14:11:51','714737a5982eae38f8dc8b8c5e0dac09'),(735,'admin','','2016-08-23 14:11:51','714737a5982eae38f8dc8b8c5e0dac09'),(736,'admin','Group Creation Choose','2016-08-23 14:11:56','714737a5982eae38f8dc8b8c5e0dac09'),(737,'admin','Group Creation Choose','2016-08-23 14:11:57','714737a5982eae38f8dc8b8c5e0dac09'),(738,'admin','Target Buildup Choose','2016-08-23 14:12:35','714737a5982eae38f8dc8b8c5e0dac09'),(739,'admin','Target Buildup Choose','2016-08-23 14:12:50','714737a5982eae38f8dc8b8c5e0dac09'),(740,'admin','Target Buildup Choose','2016-08-23 14:12:51','714737a5982eae38f8dc8b8c5e0dac09'),(741,'admin','Target Buildup Choose','2016-08-23 14:12:52','714737a5982eae38f8dc8b8c5e0dac09'),(742,'admin','','2016-08-23 14:12:54','714737a5982eae38f8dc8b8c5e0dac09'),(743,'admin','','2016-08-23 14:12:59','714737a5982eae38f8dc8b8c5e0dac09'),(744,'admin','','2016-08-23 14:13:00','714737a5982eae38f8dc8b8c5e0dac09'),(745,'admin','','2016-08-23 14:13:51','714737a5982eae38f8dc8b8c5e0dac09'),(746,'admin','Contest Management Choose','2016-08-23 14:13:57','714737a5982eae38f8dc8b8c5e0dac09'),(747,'admin','','2016-08-23 14:14:02','714737a5982eae38f8dc8b8c5e0dac09'),(748,'admin','Map Field Choose','2016-08-23 14:14:04','714737a5982eae38f8dc8b8c5e0dac09'),(749,'admin','Contest Management Choose','2016-08-23 14:14:04','714737a5982eae38f8dc8b8c5e0dac09'),(750,'admin','Contest Management Choose','2016-08-23 14:14:05','714737a5982eae38f8dc8b8c5e0dac09'),(751,'admin','Group Management Choose','2016-08-23 14:14:07','714737a5982eae38f8dc8b8c5e0dac09'),(752,'admin','Target Buildup Choose','2016-08-23 14:14:09','714737a5982eae38f8dc8b8c5e0dac09'),(753,'admin','','2016-08-23 14:14:09','714737a5982eae38f8dc8b8c5e0dac09'),(754,'admin','','2016-08-23 14:14:10','714737a5982eae38f8dc8b8c5e0dac09'),(755,'admin','Group Management Choose','2016-08-23 14:14:15','714737a5982eae38f8dc8b8c5e0dac09'),(756,'admin','Group Management Choose','2016-08-23 14:14:15','714737a5982eae38f8dc8b8c5e0dac09'),(757,'admin','Target Buildup Choose','2016-08-23 14:14:22','714737a5982eae38f8dc8b8c5e0dac09'),(758,'admin','Target Buildup Choose','2016-08-23 14:14:26','714737a5982eae38f8dc8b8c5e0dac09'),(759,'admin','Target Buildup Choose','2016-08-23 14:14:26','714737a5982eae38f8dc8b8c5e0dac09'),(760,'admin','','2016-08-23 14:14:27','714737a5982eae38f8dc8b8c5e0dac09'),(761,'admin','','2016-08-23 14:14:36','714737a5982eae38f8dc8b8c5e0dac09'),(762,'admin','','2016-08-23 14:14:36','714737a5982eae38f8dc8b8c5e0dac09'),(763,'admin','','2016-08-23 14:15:32','714737a5982eae38f8dc8b8c5e0dac09'),(764,'admin','','2016-08-23 14:15:34','714737a5982eae38f8dc8b8c5e0dac09'),(765,'admin','','2016-08-23 14:15:40','714737a5982eae38f8dc8b8c5e0dac09'),(766,'admin','','2016-08-23 14:15:48','714737a5982eae38f8dc8b8c5e0dac09'),(767,'admin','','2016-08-23 14:15:49','714737a5982eae38f8dc8b8c5e0dac09'),(768,'admin','','2016-08-23 14:15:53','714737a5982eae38f8dc8b8c5e0dac09'),(769,'admin','','2016-08-23 14:16:00','714737a5982eae38f8dc8b8c5e0dac09'),(770,'admin','','2016-08-23 14:16:00','714737a5982eae38f8dc8b8c5e0dac09'),(771,'admin','Group Creation Choose','2016-08-23 14:16:07','714737a5982eae38f8dc8b8c5e0dac09'),(772,'admin','Group Creation Choose','2016-08-23 14:16:13','714737a5982eae38f8dc8b8c5e0dac09'),(773,'admin','Group Creation Choose','2016-08-23 14:16:13','714737a5982eae38f8dc8b8c5e0dac09'),(774,'admin','Login Success!!!','2016-09-05 14:09:59','a912bb49a2c59549f3e27fe62666a2e4'),(775,'admin','Target Buildup Choose','2016-09-05 14:10:02','a912bb49a2c59549f3e27fe62666a2e4'),(776,'admin','Group Creation Choose','2016-09-05 14:10:04','a912bb49a2c59549f3e27fe62666a2e4'),(777,'admin','Group Creation Choose','2016-09-05 14:13:05','a912bb49a2c59549f3e27fe62666a2e4'),(778,'admin','Login Success!!!','2016-09-20 16:29:13','63c5315e7d7c1de0e8b9d75d44f9018a'),(779,'admin','Login Success!!!','2016-09-20 16:29:25','a5aaaa4f004fe53c679a7113a7adb05a'),(780,'admin','Login Field Choose','2016-09-20 16:29:32','a5aaaa4f004fe53c679a7113a7adb05a'),(781,'admin','Login Creation Choose','2016-09-20 16:29:33','a5aaaa4f004fe53c679a7113a7adb05a'),(782,'admin',' Login View Choosess','2016-09-20 16:29:36','a5aaaa4f004fe53c679a7113a7adb05a'),(783,'admin','Group Management Choose','2016-09-20 16:29:37','a5aaaa4f004fe53c679a7113a7adb05a'),(784,'admin','Map Field Choose','2016-09-20 16:29:38','a5aaaa4f004fe53c679a7113a7adb05a'),(785,'admin',' Login View Choosess','2016-09-20 16:29:39','a5aaaa4f004fe53c679a7113a7adb05a'),(786,'admin',' Login View Choosess','2016-09-20 16:29:39','a5aaaa4f004fe53c679a7113a7adb05a'),(787,'admin','Target Buildup Choose','2016-09-20 16:29:40','a5aaaa4f004fe53c679a7113a7adb05a'),(788,'admin','Bulk SMS Broadcast Choose','2016-09-20 16:29:40','a5aaaa4f004fe53c679a7113a7adb05a'),(789,'admin','Target Buildup Choose','2016-09-20 16:29:43','a5aaaa4f004fe53c679a7113a7adb05a'),(790,'admin','Target Buildup Choose','2016-09-20 16:29:43','a5aaaa4f004fe53c679a7113a7adb05a'),(791,'admin','Bulk SMS Broadcast Choose','2016-09-20 16:29:48','a5aaaa4f004fe53c679a7113a7adb05a'),(792,'admin','Bulk SMS Broadcast Choose','2016-09-20 16:29:48','a5aaaa4f004fe53c679a7113a7adb05a'),(793,'admin','Login Success!!!','2016-09-20 16:37:05','5630c29100fd3fe36a9a819e6c20dd85'),(794,'admin','Login Field Choose','2016-09-20 16:38:38','5630c29100fd3fe36a9a819e6c20dd85'),(795,'admin',' Login View Choosess','2016-09-20 16:38:46','5630c29100fd3fe36a9a819e6c20dd85'),(796,'admin','Group Management Choose','2016-09-20 16:38:49','5630c29100fd3fe36a9a819e6c20dd85'),(797,'admin','Map Field Choose','2016-09-20 16:38:51','5630c29100fd3fe36a9a819e6c20dd85'),(798,'admin','Target Buildup Choose','2016-09-20 16:38:52','5630c29100fd3fe36a9a819e6c20dd85'),(799,'admin','Bulk SMS Broadcast Choose','2016-09-20 16:38:53','5630c29100fd3fe36a9a819e6c20dd85'),(800,'admin','Login Field Choose','2016-09-20 16:39:17','5630c29100fd3fe36a9a819e6c20dd85'),(801,'admin','Group Management Choose','2016-09-20 16:39:19','5630c29100fd3fe36a9a819e6c20dd85'),(802,'admin','','2016-09-20 16:39:21','5630c29100fd3fe36a9a819e6c20dd85'),(803,'admin','Bulk SMS Broadcast Choose','2016-09-20 16:39:24','5630c29100fd3fe36a9a819e6c20dd85'),(804,'admin','Bulk SMS Creation Choose','2016-09-20 16:39:33','5630c29100fd3fe36a9a819e6c20dd85'),(805,'admin','Message Successfully Created','2016-09-20 16:40:18','5630c29100fd3fe36a9a819e6c20dd85'),(806,'admin','Contest Management Choose','2016-09-20 16:40:21','5630c29100fd3fe36a9a819e6c20dd85'),(807,'admin','Contest Question View Choosess','2016-09-20 16:40:26','5630c29100fd3fe36a9a819e6c20dd85'),(808,'admin','Contest Question View Choosess','2016-09-20 16:40:31','5630c29100fd3fe36a9a819e6c20dd85'),(809,'admin','Contest Question View Choosess','2016-09-20 16:40:32','5630c29100fd3fe36a9a819e6c20dd85'),(810,'admin','Contest UnArchive Choosess','2016-09-20 16:40:33','5630c29100fd3fe36a9a819e6c20dd85'),(811,'admin','Contest Creation Choosess','2016-09-20 16:40:34','5630c29100fd3fe36a9a819e6c20dd85'),(812,'admin','Contest Question View Choosess','2016-09-20 16:40:50','5630c29100fd3fe36a9a819e6c20dd85'),(813,'admin','Bulk SMS Broadcast Choose','2016-09-20 16:40:54','5630c29100fd3fe36a9a819e6c20dd85'),(814,'admin','Target Buildup Choose','2016-09-20 16:40:55','5630c29100fd3fe36a9a819e6c20dd85'),(815,'admin','','2016-09-20 16:40:57','5630c29100fd3fe36a9a819e6c20dd85'),(816,'admin','','2016-09-20 16:41:12','5630c29100fd3fe36a9a819e6c20dd85'),(817,'admin','Map Field Choose','2016-09-20 16:41:16','5630c29100fd3fe36a9a819e6c20dd85'),(818,'admin','Target Buildup Choose','2016-09-20 16:41:17','5630c29100fd3fe36a9a819e6c20dd85'),(819,'admin','Bulk SMS Broadcast Choose','2016-09-20 16:41:20','5630c29100fd3fe36a9a819e6c20dd85'),(820,'admin','Scheduler Choose','2016-09-20 16:41:21','5630c29100fd3fe36a9a819e6c20dd85'),(821,'admin','','2016-09-20 16:41:45','5630c29100fd3fe36a9a819e6c20dd85'),(822,'admin','','2016-09-20 16:41:59','5630c29100fd3fe36a9a819e6c20dd85'),(823,'admin','Login Field Choose','2016-09-20 16:42:02','5630c29100fd3fe36a9a819e6c20dd85'),(824,'admin','Group Management Choose','2016-09-20 16:42:03','5630c29100fd3fe36a9a819e6c20dd85'),(825,'admin','Map Field Choose','2016-09-20 16:42:03','5630c29100fd3fe36a9a819e6c20dd85'),(826,'admin','Target Buildup Choose','2016-09-20 16:42:10','5630c29100fd3fe36a9a819e6c20dd85'),(827,'admin','Bulk SMS Broadcast Choose','2016-09-20 16:42:13','5630c29100fd3fe36a9a819e6c20dd85'),(828,'admin','Scheduler Choose','2016-09-20 16:42:16','5630c29100fd3fe36a9a819e6c20dd85'),(829,'admin','','2016-09-20 16:42:21','5630c29100fd3fe36a9a819e6c20dd85'),(830,'admin','','2016-09-20 16:42:25','5630c29100fd3fe36a9a819e6c20dd85'),(831,'admin','Contest Management Choose','2016-09-20 16:42:33','5630c29100fd3fe36a9a819e6c20dd85'),(832,'admin','','2016-09-20 16:42:35','5630c29100fd3fe36a9a819e6c20dd85'),(833,'admin','','2016-09-20 16:42:40','5630c29100fd3fe36a9a819e6c20dd85'),(834,'admin','Contest Question View Choosess','2016-09-20 16:42:43','5630c29100fd3fe36a9a819e6c20dd85'),(835,'admin','Contest Question View Choosess','2016-09-20 16:42:45','5630c29100fd3fe36a9a819e6c20dd85'),(836,'admin','Contest Question View Choosess','2016-09-20 16:42:47','5630c29100fd3fe36a9a819e6c20dd85'),(837,'admin','Contest Question View Choosess','2016-09-20 16:43:23','5630c29100fd3fe36a9a819e6c20dd85'),(838,'admin','Contest Question View Choosess','2016-09-20 16:43:37','5630c29100fd3fe36a9a819e6c20dd85'),(839,'admin','Contest Question View Choosess','2016-09-20 16:43:39','5630c29100fd3fe36a9a819e6c20dd85'),(840,'admin','Contest Question View Choosess','2016-09-20 16:43:40','5630c29100fd3fe36a9a819e6c20dd85'),(841,'admin','Bulk SMS Broadcast Choose','2016-09-20 16:43:42','5630c29100fd3fe36a9a819e6c20dd85'),(842,'admin','Target Buildup Choose','2016-09-20 16:43:49','5630c29100fd3fe36a9a819e6c20dd85'),(843,'admin','Group Creation Choose','2016-09-20 16:43:51','5630c29100fd3fe36a9a819e6c20dd85'),(844,'admin','Group Creation Choose','2016-09-20 16:46:33','5630c29100fd3fe36a9a819e6c20dd85'),(845,'admin','Login Field Choose','2016-09-20 16:46:37','5630c29100fd3fe36a9a819e6c20dd85'),(846,'admin','','2016-09-20 16:46:40','5630c29100fd3fe36a9a819e6c20dd85'),(847,'admin','Contest UnArchive Choosess','2016-09-20 16:46:43','5630c29100fd3fe36a9a819e6c20dd85'),(848,'admin','','2016-09-20 16:46:47','5630c29100fd3fe36a9a819e6c20dd85'),(849,'admin','Voting Creation Choosess','2016-09-20 16:46:48','5630c29100fd3fe36a9a819e6c20dd85'),(850,'admin','Bulk SMS Broadcast Choose','2016-09-20 16:47:29','5630c29100fd3fe36a9a819e6c20dd85'),(851,'admin','Target Buildup Choose','2016-09-20 16:47:32','5630c29100fd3fe36a9a819e6c20dd85'),(852,'admin','Group Creation Choose','2016-09-20 16:47:34','5630c29100fd3fe36a9a819e6c20dd85'),(853,'admin','Group Creation Choose','2016-09-20 16:48:00','5630c29100fd3fe36a9a819e6c20dd85'),(854,'admin','Map Field Choose','2016-09-20 16:48:03','5630c29100fd3fe36a9a819e6c20dd85'),(855,'admin','','2016-09-20 16:48:04','5630c29100fd3fe36a9a819e6c20dd85'),(856,'admin','Group Management Choose','2016-09-20 16:48:20','5630c29100fd3fe36a9a819e6c20dd85'),(857,'admin','Group UnArchive Choosess','2016-09-20 16:48:23','5630c29100fd3fe36a9a819e6c20dd85'),(858,'admin','kumar Sub Group View Choose','2016-09-20 16:48:29','5630c29100fd3fe36a9a819e6c20dd85'),(859,'admin','idt_loai Sub Group View Choose','2016-09-20 16:48:34','5630c29100fd3fe36a9a819e6c20dd85'),(860,'admin','Sub Group Creation Choose','2016-09-20 16:48:36','5630c29100fd3fe36a9a819e6c20dd85'),(861,'admin','gaurav Sub Group Successfully Created!','2016-09-20 16:48:57','5630c29100fd3fe36a9a819e6c20dd85'),(862,'admin','gaurav Sub Group View Choose','2016-09-20 16:49:02','5630c29100fd3fe36a9a819e6c20dd85'),(863,'admin','Scheduler Choose','2016-09-20 16:49:06','5630c29100fd3fe36a9a819e6c20dd85'),(864,'admin','','2016-09-20 16:49:09','5630c29100fd3fe36a9a819e6c20dd85'),(865,'admin','Target Buildup Choose','2016-09-20 16:49:14','5630c29100fd3fe36a9a819e6c20dd85'),(866,'admin','','2016-09-20 16:49:17','5630c29100fd3fe36a9a819e6c20dd85'),(867,'admin','','2016-09-20 16:49:46','5630c29100fd3fe36a9a819e6c20dd85'),(868,'admin','','2016-09-20 16:49:48','5630c29100fd3fe36a9a819e6c20dd85'),(869,'admin','Contest Question View Choosess','2016-09-20 16:49:51','5630c29100fd3fe36a9a819e6c20dd85'),(870,'admin','Contest Question View Choosess','2016-09-20 16:50:06','5630c29100fd3fe36a9a819e6c20dd85'),(871,'admin','Contest Question View Choosess','2016-09-20 16:50:32','5630c29100fd3fe36a9a819e6c20dd85'),(872,'admin','Contest Question View Choosess','2016-09-20 16:50:34','5630c29100fd3fe36a9a819e6c20dd85'),(873,'admin','Contest Question View Choosess','2016-09-20 16:50:35','5630c29100fd3fe36a9a819e6c20dd85'),(874,'admin','Contest Question View Choosess','2016-09-20 16:50:37','5630c29100fd3fe36a9a819e6c20dd85'),(875,'admin','Contest Question View Choosess','2016-09-20 16:50:39','5630c29100fd3fe36a9a819e6c20dd85'),(876,'admin','Contest UnArchive Choosess','2016-09-20 16:50:46','5630c29100fd3fe36a9a819e6c20dd85'),(877,'admin','Group Management Choose','2016-09-20 16:51:06','5630c29100fd3fe36a9a819e6c20dd85'),(878,'admin','Group UnArchive Choosess','2016-09-20 16:51:11','5630c29100fd3fe36a9a819e6c20dd85'),(879,'admin','Group Creation Choose','2016-09-20 16:51:12','5630c29100fd3fe36a9a819e6c20dd85'),(880,'admin','gaurav Group Successfully Created!','2016-09-20 16:51:26','5630c29100fd3fe36a9a819e6c20dd85'),(881,'admin','Sub Group Creation Choose','2016-09-20 16:51:30','5630c29100fd3fe36a9a819e6c20dd85'),(882,'admin','mysubgroup Sub Group Successfully Created!','2016-09-20 16:51:39','5630c29100fd3fe36a9a819e6c20dd85'),(883,'admin','mysubgroup Sub Group View Choose','2016-09-20 16:51:41','5630c29100fd3fe36a9a819e6c20dd85'),(884,'admin','Group Management Choose','2016-09-20 16:51:52','5630c29100fd3fe36a9a819e6c20dd85'),(885,'admin','Map Field Choose','2016-09-20 16:51:55','5630c29100fd3fe36a9a819e6c20dd85'),(886,'admin','','2016-09-20 16:51:57','5630c29100fd3fe36a9a819e6c20dd85'),(887,'admin','Login Success!!!','2016-09-20 17:55:05','f5c2bb28c21affe45ac3717bbb96de2e'),(888,'admin','Login Field Choose','2016-09-20 17:55:15','f5c2bb28c21affe45ac3717bbb96de2e'),(889,'admin','Group Management Choose','2016-09-20 17:55:21','f5c2bb28c21affe45ac3717bbb96de2e'),(890,'admin','Target Buildup Choose','2016-09-20 17:55:29','f5c2bb28c21affe45ac3717bbb96de2e'),(891,'admin','Target Buildup Choose','2016-09-20 17:55:39','f5c2bb28c21affe45ac3717bbb96de2e'),(892,'admin','Bulk SMS Broadcast Choose','2016-09-20 17:55:42','f5c2bb28c21affe45ac3717bbb96de2e'),(893,'admin','Bulk SMS Broadcast Choose','2016-09-20 17:55:45','f5c2bb28c21affe45ac3717bbb96de2e'),(894,'admin','Scheduler Choose','2016-09-20 17:55:47','f5c2bb28c21affe45ac3717bbb96de2e'),(895,'admin','Contest Management Choose','2016-09-20 17:55:59','f5c2bb28c21affe45ac3717bbb96de2e'),(896,'admin','','2016-09-20 17:56:12','f5c2bb28c21affe45ac3717bbb96de2e'),(897,'admin','Contest Question View Choosess','2016-09-20 17:56:21','f5c2bb28c21affe45ac3717bbb96de2e'),(898,'admin','Contest Question View Choosess','2016-09-20 17:56:25','f5c2bb28c21affe45ac3717bbb96de2e'),(899,'admin','Login Success!!!','2016-09-22 14:13:16','55e5738116b8c088f5882a509925579d'),(900,'admin','Login Field Choose','2016-09-22 14:13:30','55e5738116b8c088f5882a509925579d'),(901,'admin',' Login View Choosess','2016-09-22 14:13:34','55e5738116b8c088f5882a509925579d'),(902,'admin','Login Creation Choose','2016-09-22 14:13:42','55e5738116b8c088f5882a509925579d'),(903,'admin','MSL Login Successfully Created!','2016-09-22 14:14:01','55e5738116b8c088f5882a509925579d'),(904,'admin',' Login View Choosess','2016-09-22 14:14:05','55e5738116b8c088f5882a509925579d'),(905,'admin','Group Management Choose','2016-09-22 14:14:10','55e5738116b8c088f5882a509925579d'),(906,'MSL','Login Success!!!','2016-09-22 17:12:43','4519d401ed8ea7feb59755bbafe98e79'),(907,'MSL','Group Management Choose','2016-09-22 17:12:49','4519d401ed8ea7feb59755bbafe98e79'),(908,'MSL','Group Creation Choose','2016-09-22 17:12:58','4519d401ed8ea7feb59755bbafe98e79'),(909,'admin','Login Success!!!','2016-09-22 17:13:16','3f620496aea97287274a14cf1206e494'),(910,'admin','Login Field Choose','2016-09-22 17:13:19','3f620496aea97287274a14cf1206e494'),(911,'admin','Group Management Choose','2016-09-22 17:13:22','3f620496aea97287274a14cf1206e494'),(912,'admin','Group Creation Choose','2016-09-22 17:13:55','3f620496aea97287274a14cf1206e494'),(913,'admin','abc Group Successfully Created!','2016-09-22 17:14:58','3f620496aea97287274a14cf1206e494'),(914,'admin','abc Group View Choosess','2016-09-22 17:15:04','3f620496aea97287274a14cf1206e494'),(915,'admin','Sub Group Creation Choose','2016-09-22 17:15:07','3f620496aea97287274a14cf1206e494'),(916,'admin','cba Sub Group Successfully Created!','2016-09-22 17:15:28','3f620496aea97287274a14cf1206e494'),(917,'admin','cba Sub Group View Choose','2016-09-22 17:15:31','3f620496aea97287274a14cf1206e494'),(918,'admin','Sub Group Modify Choose','2016-09-22 17:15:42','3f620496aea97287274a14cf1206e494'),(919,'admin','Sub Group Successfully Updated!','2016-09-22 17:15:46','3f620496aea97287274a14cf1206e494'),(920,'admin','abc Group View Choosess','2016-09-22 17:15:51','3f620496aea97287274a14cf1206e494'),(921,'admin','abc Group View Choosess','2016-09-22 17:15:51','3f620496aea97287274a14cf1206e494'),(922,'admin','cba Sub Group View Choose','2016-09-22 17:15:52','3f620496aea97287274a14cf1206e494'),(923,'admin','Sub Group Modify Choose','2016-09-22 17:15:57','3f620496aea97287274a14cf1206e494'),(924,'admin','Sub Group Successfully Updated!','2016-09-22 17:16:02','3f620496aea97287274a14cf1206e494'),(925,'admin','abc Group View Choosess','2016-09-22 17:16:05','3f620496aea97287274a14cf1206e494'),(926,'admin','cba Sub Group View Choose','2016-09-22 17:16:07','3f620496aea97287274a14cf1206e494'),(927,'admin','cba Group Successfully Deleted!','2016-09-22 17:16:18','3f620496aea97287274a14cf1206e494'),(928,'admin','Group Management Choose','2016-09-22 17:16:27','3f620496aea97287274a14cf1206e494'),(929,'admin','Group Management Choose','2016-09-22 17:17:31','3f620496aea97287274a14cf1206e494'),(930,'admin','Map Field Choose','2016-09-22 17:17:33','3f620496aea97287274a14cf1206e494'),(931,'admin','Target Buildup Choose','2016-09-22 17:17:42','3f620496aea97287274a14cf1206e494'),(932,'admin','Target Buildup Choose','2016-09-22 17:17:59','3f620496aea97287274a14cf1206e494'),(933,'admin','Target Buildup Choose','2016-09-22 17:18:03','3f620496aea97287274a14cf1206e494'),(934,'admin','Target Buildup Choose','2016-09-22 17:18:15','3f620496aea97287274a14cf1206e494'),(935,'admin','Target UnArchive Choosess','2016-09-22 17:18:17','3f620496aea97287274a14cf1206e494'),(936,'admin','Target UnArchive Choosess','2016-09-22 17:20:17','3f620496aea97287274a14cf1206e494'),(937,'admin','Group Creation Choose','2016-09-22 17:20:55','3f620496aea97287274a14cf1206e494'),(938,'admin','Login Success!!!','2016-09-28 12:31:37','766c7014c3106881da2bbf972c579e16'),(939,'admin','Login Success!!!','2016-09-28 12:31:58','82b34720f542a119c9da8579264ef205'),(940,'admin','Login Field Choose','2016-09-28 12:32:00','82b34720f542a119c9da8579264ef205'),(941,'admin','Login Creation Choose','2016-09-28 12:32:08','82b34720f542a119c9da8579264ef205'),(942,'admin',' Login View Choosess','2016-09-28 12:32:25','82b34720f542a119c9da8579264ef205'),(943,'admin',' Login View Choosess','2016-09-28 12:33:06','82b34720f542a119c9da8579264ef205'),(944,'admin',' Login View Choosess','2016-09-28 12:33:08','82b34720f542a119c9da8579264ef205'),(945,'admin','Login Creation Choose','2016-09-28 12:33:09','82b34720f542a119c9da8579264ef205'),(946,'admin','Group Management Choose','2016-09-28 12:33:12','82b34720f542a119c9da8579264ef205'),(947,'admin','Contest Management Choose','2016-09-28 13:12:39','82b34720f542a119c9da8579264ef205'),(948,'admin','Scheduler Choose','2016-09-28 13:12:44','82b34720f542a119c9da8579264ef205'),(949,'admin','Login Field Choose','2016-09-28 13:22:26','82b34720f542a119c9da8579264ef205'),(950,'admin','Scheduler Choose','2016-09-28 13:22:32','82b34720f542a119c9da8579264ef205'),(951,'admin','Scheduler Choose','2016-09-28 13:22:53','82b34720f542a119c9da8579264ef205'),(952,'admin','Login Field Choose','2016-09-28 13:22:58','82b34720f542a119c9da8579264ef205'),(953,'admin','Login Field Choose','2016-09-28 13:23:02','82b34720f542a119c9da8579264ef205'),(954,'admin','Bulk SMS Broadcast Choose','2016-09-28 13:23:04','82b34720f542a119c9da8579264ef205'),(955,'admin','Target Buildup Choose','2016-09-28 13:23:07','82b34720f542a119c9da8579264ef205'),(956,'admin','Group Creation Choose','2016-09-28 13:23:15','82b34720f542a119c9da8579264ef205'),(957,'admin','Scheduler Choose','2016-09-28 13:23:45','82b34720f542a119c9da8579264ef205'),(958,'admin','Login Field Choose','2016-09-28 13:23:48','82b34720f542a119c9da8579264ef205'),(959,'admin','Login Success!!!','2016-09-28 16:47:35','cf350636a308ef41e076aead782aff6f'),(960,'admin','Login Field Choose','2016-09-28 16:47:44','cf350636a308ef41e076aead782aff6f'),(961,'admin','Login Creation Choose','2016-09-28 16:47:46','cf350636a308ef41e076aead782aff6f'),(962,'admin',' Login View Choosess','2016-09-28 16:47:50','cf350636a308ef41e076aead782aff6f'),(963,'admin','Login Creation Choose','2016-09-28 16:47:56','cf350636a308ef41e076aead782aff6f'),(964,'admin',' Login View Choosess','2016-09-28 16:48:03','cf350636a308ef41e076aead782aff6f'),(965,'admin',' Login View Choosess','2016-09-28 16:48:05','cf350636a308ef41e076aead782aff6f'),(966,'admin','Login Creation Choose','2016-09-28 16:48:06','cf350636a308ef41e076aead782aff6f'),(967,'admin','hello Login Successfully Created!','2016-09-28 16:48:27','cf350636a308ef41e076aead782aff6f'),(968,'admin','Login Modify Choose','2016-09-28 16:48:36','cf350636a308ef41e076aead782aff6f'),(969,'admin','Login Name Already Exists!','2016-09-28 16:48:52','cf350636a308ef41e076aead782aff6f'),(970,'admin','Bulk SMS Broadcast Choose','2016-09-28 16:49:04','cf350636a308ef41e076aead782aff6f'),(971,'admin','Target Buildup Choose','2016-09-28 16:49:06','cf350636a308ef41e076aead782aff6f'),(972,'admin','Map Field Choose','2016-09-28 16:49:07','cf350636a308ef41e076aead782aff6f'),(973,'admin','Map UnArchive Choosess','2016-09-28 16:49:12','cf350636a308ef41e076aead782aff6f'),(974,'admin','Group Management Choose','2016-09-28 16:49:18','cf350636a308ef41e076aead782aff6f'),(975,'admin','Login Field Choose','2016-09-28 16:49:19','cf350636a308ef41e076aead782aff6f'),(976,'admin',' Login View Choosess','2016-09-28 16:49:22','cf350636a308ef41e076aead782aff6f'),(977,'admin','Login Modify Choose','2016-09-28 16:49:25','cf350636a308ef41e076aead782aff6f'),(978,'admin','Login Name Already Exists!','2016-09-28 16:49:44','cf350636a308ef41e076aead782aff6f'),(979,'admin',' Login View Choosess','2016-09-28 16:49:59','cf350636a308ef41e076aead782aff6f'),(980,'admin','Login Successfully Deleted','2016-09-28 16:50:04','cf350636a308ef41e076aead782aff6f'),(981,'admin',' Login View Choosess','2016-09-28 16:50:07','cf350636a308ef41e076aead782aff6f'),(982,'admin',' Login View Choosess','2016-09-28 16:50:09','cf350636a308ef41e076aead782aff6f'),(983,'admin','Login Creation Choose','2016-09-28 16:50:15','cf350636a308ef41e076aead782aff6f'),(984,'admin','Login Creation Choose','2016-09-28 16:51:02','cf350636a308ef41e076aead782aff6f'),(985,'admin','hi Login Successfully Created!','2016-09-28 16:51:17','cf350636a308ef41e076aead782aff6f'),(986,'admin','hi Login Successfully Created!','2016-09-28 16:51:26','cf350636a308ef41e076aead782aff6f'),(987,'admin','Group Management Choose','2016-09-28 16:51:29','cf350636a308ef41e076aead782aff6f'),(988,'admin','Group Management Choose','2016-09-28 16:51:36','cf350636a308ef41e076aead782aff6f'),(989,'hi','Login Success!!!','2016-09-28 16:52:03','cbac497128105ae351b49c5491af8b8a'),(990,'hi','Group Management Choose','2016-09-28 16:52:09','cbac497128105ae351b49c5491af8b8a'),(991,'hi','Map Field Choose','2016-09-28 16:52:15','cbac497128105ae351b49c5491af8b8a'),(992,'hi','Target Buildup Choose','2016-09-28 16:52:16','cbac497128105ae351b49c5491af8b8a'),(993,'hi','Bulk SMS Broadcast Choose','2016-09-28 16:52:18','cbac497128105ae351b49c5491af8b8a'),(994,'hi','Scheduler Choose','2016-09-28 16:52:19','cbac497128105ae351b49c5491af8b8a'),(995,'hi','Contest Management Choose','2016-09-28 16:52:26','cbac497128105ae351b49c5491af8b8a'),(996,'hi','','2016-09-28 16:52:27','cbac497128105ae351b49c5491af8b8a'),(997,'hi','','2016-09-28 16:52:29','cbac497128105ae351b49c5491af8b8a'),(998,'hi','','2016-09-28 16:52:33','cbac497128105ae351b49c5491af8b8a'),(999,'hi','Contest Question View Choosess','2016-09-28 16:52:39','cbac497128105ae351b49c5491af8b8a'),(1000,'hi','Contest Question View Choosess','2016-09-28 16:52:47','cbac497128105ae351b49c5491af8b8a'),(1001,'hi','','2016-09-28 16:53:33','cbac497128105ae351b49c5491af8b8a'),(1002,'hi','Contest Management Choose','2016-09-28 16:53:35','cbac497128105ae351b49c5491af8b8a'),(1003,'hi','Scheduler Choose','2016-09-28 16:53:37','cbac497128105ae351b49c5491af8b8a'),(1004,'hi','Target Buildup Choose','2016-09-28 16:53:42','cbac497128105ae351b49c5491af8b8a'),(1005,'hi','Map Field Choose','2016-09-28 16:53:44','cbac497128105ae351b49c5491af8b8a'),(1006,'hi','Group Management Choose','2016-09-28 16:53:57','cbac497128105ae351b49c5491af8b8a'),(1007,'hi','Map Field Choose','2016-09-28 16:53:58','cbac497128105ae351b49c5491af8b8a'),(1008,'hi','Group Management Choose','2016-09-28 16:54:00','cbac497128105ae351b49c5491af8b8a'),(1009,'hi','Group Management Choose','2016-09-28 16:54:37','cbac497128105ae351b49c5491af8b8a'),(1010,'hi','Map Field Choose','2016-09-28 16:54:40','cbac497128105ae351b49c5491af8b8a'),(1011,'hi','Group Management Choose','2016-09-28 16:54:55','cbac497128105ae351b49c5491af8b8a'),(1012,'admin','Login Success!!!','2016-09-28 16:56:18','6867f315ad73b3716961060f3f01f872'),(1013,'hi','Login Success!!!','2016-09-28 16:58:14','0b821b1fc84a7b0dc8918eeee3cf84cb'),(1014,'admin','Login Field Choose','2016-09-28 16:59:00','6867f315ad73b3716961060f3f01f872'),(1015,'admin','Login Creation Choose','2016-09-28 16:59:03','6867f315ad73b3716961060f3f01f872'),(1016,'admin','Group Management Choose','2016-09-28 16:59:06','6867f315ad73b3716961060f3f01f872'),(1017,'admin','Login Field Choose','2016-09-28 16:59:06','6867f315ad73b3716961060f3f01f872'),(1018,'admin','Login Creation Choose','2016-09-28 16:59:08','6867f315ad73b3716961060f3f01f872'),(1019,'hi','','2016-09-28 16:59:21','0b821b1fc84a7b0dc8918eeee3cf84cb'),(1020,'admin','','2016-09-28 16:59:27','6867f315ad73b3716961060f3f01f872'),(1021,'admin','Contest Management Choose','2016-09-28 16:59:30','6867f315ad73b3716961060f3f01f872'),(1022,'admin','Contest Question View Choosess','2016-09-28 16:59:38','6867f315ad73b3716961060f3f01f872'),(1023,'admin','Contest Management Choose','2016-09-28 16:59:52','6867f315ad73b3716961060f3f01f872'),(1024,'admin','Contest UnArchive Choosess','2016-09-28 17:00:01','6867f315ad73b3716961060f3f01f872'),(1025,'admin','Contest Creation Choosess','2016-09-28 17:00:09','6867f315ad73b3716961060f3f01f872'),(1026,'admin','Bulk SMS Broadcast Choose','2016-09-28 17:03:27','6867f315ad73b3716961060f3f01f872'),(1027,'admin','Target Buildup Choose','2016-09-28 17:03:28','6867f315ad73b3716961060f3f01f872'),(1028,'admin','Login Success!!!','2016-10-12 13:22:20','55bb9ad2d18962eb6de0b084d2dd7a4f'),(1029,'admin','Login Field Choose','2016-10-12 13:22:23','55bb9ad2d18962eb6de0b084d2dd7a4f'),(1030,'admin','Group Management Choose','2016-10-12 13:22:26','55bb9ad2d18962eb6de0b084d2dd7a4f'),(1031,'admin','Map Field Choose','2016-10-12 13:22:28','55bb9ad2d18962eb6de0b084d2dd7a4f'),(1032,'admin','Target Buildup Choose','2016-10-12 13:22:29','55bb9ad2d18962eb6de0b084d2dd7a4f'),(1033,'admin','Bulk SMS Broadcast Choose','2016-10-12 13:22:30','55bb9ad2d18962eb6de0b084d2dd7a4f'),(1034,'admin','Group Management Choose','2016-10-12 13:22:31','55bb9ad2d18962eb6de0b084d2dd7a4f'),(1035,'admin','Group Management Choose','2016-10-12 13:22:32','55bb9ad2d18962eb6de0b084d2dd7a4f'),(1036,'admin','Bulk SMS Broadcast Choose','2016-10-12 13:22:35','55bb9ad2d18962eb6de0b084d2dd7a4f'),(1037,'admin','Bulk SMS Broadcast Choose','2016-10-12 13:22:35','55bb9ad2d18962eb6de0b084d2dd7a4f'),(1038,'admin','Login Success!!!','2016-10-12 14:59:01','172325168fc1628729b9568d509a1490');
/*!40000 ALTER TABLE `mmc_session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mytable`
--

DROP TABLE IF EXISTS `mytable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mytable` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `data` varchar(500) CHARACTER SET utf8 DEFAULT '""',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mytable`
--

LOCK TABLES `mytable` WRITE;
/*!40000 ALTER TABLE `mytable` DISABLE KEYS */;
/*!40000 ALTER TABLE `mytable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question_log`
--

DROP TABLE IF EXISTS `question_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question_log` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `request_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `msisdn` varchar(20) NOT NULL,
  `ques_no` int(4) NOT NULL DEFAULT '0',
  `user_answer` char(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ind_request_datetime` (`request_datetime`),
  KEY `ind_msisdn` (`msisdn`),
  KEY `ind_ques_no` (`ques_no`),
  KEY `ind_user_answer` (`user_answer`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question_log`
--

LOCK TABLES `question_log` WRITE;
/*!40000 ALTER TABLE `question_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `question_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rules_detail`
--

DROP TABLE IF EXISTS `rules_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rules_detail` (
  `sms_id` bigint(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(850) DEFAULT NULL,
  `footer_url` varchar(600) DEFAULT NULL,
  `sms_mode` int(1) DEFAULT '1',
  `archive` int(1) DEFAULT '0',
  `login` varchar(20) DEFAULT NULL,
  `language` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`sms_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rules_detail`
--

LOCK TABLES `rules_detail` WRITE;
/*!40000 ALTER TABLE `rules_detail` DISABLE KEYS */;
INSERT INTO `rules_detail` VALUES (1,'test one','test one footer',1,0,'admin','English'),(2,'This is test msg','testing footer',1,0,'admin','English'),(3,'this is the test message for testing','testing footer',1,0,'admin','English'),(4,'Hello Gaurav,\r\nWe have a offer for you.\r\n\r\nRegards,\r\nGaurav','Nextgen',1,0,'admin','English');
/*!40000 ALTER TABLE `rules_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedular_delivery_log`
--

DROP TABLE IF EXISTS `schedular_delivery_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schedular_delivery_log` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `msisdn` varchar(20) DEFAULT NULL,
  `message_id` varchar(100) DEFAULT NULL,
  `smsc_message_id` varchar(100) DEFAULT NULL,
  `smsc_status` varchar(20) DEFAULT NULL,
  `status_string` varchar(100) DEFAULT NULL,
  `time_stamp` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedular_delivery_log`
--

LOCK TABLES `schedular_delivery_log` WRITE;
/*!40000 ALTER TABLE `schedular_delivery_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `schedular_delivery_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedular_req_log`
--

DROP TABLE IF EXISTS `schedular_req_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schedular_req_log` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `schedular_id` bigint(10) DEFAULT NULL,
  `msisdn` varchar(20) DEFAULT NULL,
  `message` varchar(400) DEFAULT NULL,
  `push_url` varchar(200) DEFAULT NULL,
  `response` varchar(200) DEFAULT NULL,
  `response_message_id` varchar(100) DEFAULT NULL,
  `status` varchar(5) DEFAULT NULL,
  `time_stamp` datetime DEFAULT NULL,
  `sms_mode` varchar(5) DEFAULT NULL,
  `login_created` varchar(50) DEFAULT NULL,
  `schedular_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedular_req_log`
--

LOCK TABLES `schedular_req_log` WRITE;
/*!40000 ALTER TABLE `schedular_req_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `schedular_req_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_detail`
--

DROP TABLE IF EXISTS `service_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_detail` (
  `service_id` bigint(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `keyword` varchar(50) DEFAULT NULL,
  `login` varchar(50) NOT NULL,
  `active_status` int(1) DEFAULT '1',
  PRIMARY KEY (`service_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_detail`
--

LOCK TABLES `service_detail` WRITE;
/*!40000 ALTER TABLE `service_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `service_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_detail_alias`
--

DROP TABLE IF EXISTS `service_detail_alias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_detail_alias` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `service_id` bigint(11) DEFAULT NULL,
  `alias_keyword` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_detail_alias`
--

LOCK TABLES `service_detail_alias` WRITE;
/*!40000 ALTER TABLE `service_detail_alias` DISABLE KEYS */;
/*!40000 ALTER TABLE `service_detail_alias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subgroup_detail`
--

DROP TABLE IF EXISTS `subgroup_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subgroup_detail` (
  `subgroup_id` bigint(11) NOT NULL AUTO_INCREMENT,
  `group_id` bigint(11) NOT NULL,
  `subgroup_name` varchar(50) NOT NULL,
  `description` varchar(160) NOT NULL,
  `login` varchar(50) NOT NULL,
  `active_status` int(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`subgroup_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subgroup_detail`
--

LOCK TABLES `subgroup_detail` WRITE;
/*!40000 ALTER TABLE `subgroup_detail` DISABLE KEYS */;
INSERT INTO `subgroup_detail` VALUES (1,1,'kumar','sub group one','admin',1),(2,2,'idt_loai','IDT Loai','admin',1),(3,2,'gaurav','Gaurav Bhandari','admin',1),(4,3,'mysubgroup','ff','admin',1);
/*!40000 ALTER TABLE `subgroup_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `target_detail`
--

DROP TABLE IF EXISTS `target_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `target_detail` (
  `target_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `target_name` varchar(50) NOT NULL,
  `file_path` varchar(150) DEFAULT NULL,
  `group_id` int(4) NOT NULL,
  `subgroup_id` int(4) DEFAULT NULL,
  `target_status` int(11) DEFAULT NULL,
  `archive` int(1) DEFAULT '0',
  `login` varchar(20) DEFAULT NULL,
  `daily_new_target` int(1) DEFAULT '0',
  `date_field` varchar(100) DEFAULT NULL,
  `target_query` varchar(2000) DEFAULT NULL,
  `cron_start_date` datetime DEFAULT NULL,
  `target_date` datetime DEFAULT NULL,
  `cron_flag` int(11) DEFAULT NULL,
  PRIMARY KEY (`target_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `target_detail`
--

LOCK TABLES `target_detail` WRITE;
/*!40000 ALTER TABLE `target_detail` DISABLE KEYS */;
INSERT INTO `target_detail` VALUES (1,'target_one','C:wampwwwcampaign/uploads/admin/pramod/kumar/target_one/test-msisdn.csv',1,1,1,0,'admin',1,NULL,NULL,'2012-06-25 00:00:00','2012-06-25 15:42:44',NULL),(2,'target1','/opt/www/campaign/uploads/admin/pramod/kumar/target1/msisdn.csv',1,1,1,0,'admin',0,NULL,NULL,NULL,'2012-07-13 16:20:34',NULL),(3,'target11','/opt/www/campaign/uploads/admin/pramod/kumar/target11/test-msisdn.csv',1,1,1,0,'admin',0,NULL,NULL,NULL,'2012-07-13 16:21:17',NULL);
/*!40000 ALTER TABLE `target_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testtable`
--

DROP TABLE IF EXISTS `testtable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testtable` (
  `i` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testtable`
--

LOCK TABLES `testtable` WRITE;
/*!40000 ALTER TABLE `testtable` DISABLE KEYS */;
INSERT INTO `testtable` VALUES (1),(2);
/*!40000 ALTER TABLE `testtable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testtable1`
--

DROP TABLE IF EXISTS `testtable1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testtable1` (
  `i` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testtable1`
--

LOCK TABLES `testtable1` WRITE;
/*!40000 ALTER TABLE `testtable1` DISABLE KEYS */;
/*!40000 ALTER TABLE `testtable1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `today_score`
--

DROP TABLE IF EXISTS `today_score`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `today_score` (
  `id` bigint(11) NOT NULL DEFAULT '0',
  `entry_date` date NOT NULL DEFAULT '0000-00-00',
  `msisdn` varchar(20) NOT NULL DEFAULT '',
  `contest_id` bigint(11) NOT NULL DEFAULT '0',
  `score` int(4) NOT NULL DEFAULT '0',
  `keyword` varchar(20) DEFAULT NULL,
  `shortcode` int(4) DEFAULT NULL,
  `sms_type` int(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `today_score`
--

LOCK TABLES `today_score` WRITE;
/*!40000 ALTER TABLE `today_score` DISABLE KEYS */;
/*!40000 ALTER TABLE `today_score` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `value_map_host_detail`
--

DROP TABLE IF EXISTS `value_map_host_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `value_map_host_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `host` varchar(20) NOT NULL,
  `db_name` varchar(40) NOT NULL,
  `db_table` varchar(40) NOT NULL,
  `table_field` varchar(40) NOT NULL,
  `login` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `value_map_host_detail`
--

LOCK TABLES `value_map_host_detail` WRITE;
/*!40000 ALTER TABLE `value_map_host_detail` DISABLE KEYS */;
INSERT INTO `value_map_host_detail` VALUES (1,'127.0.0.1','campaign','testtable','i','admin');
/*!40000 ALTER TABLE `value_map_host_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `value_map_info`
--

DROP TABLE IF EXISTS `value_map_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `value_map_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vmap_id` int(11) NOT NULL,
  `vmap_value` varchar(50) DEFAULT NULL,
  `map_with` varchar(50) DEFAULT NULL,
  `archive` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `value_map_info`
--

LOCK TABLES `value_map_info` WRITE;
/*!40000 ALTER TABLE `value_map_info` DISABLE KEYS */;
INSERT INTO `value_map_info` VALUES (1,1,'1','2',0);
/*!40000 ALTER TABLE `value_map_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `voting_banner`
--

DROP TABLE IF EXISTS `voting_banner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voting_banner` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `voting_id` bigint(11) NOT NULL,
  `label` varchar(50) NOT NULL,
  `format` varchar(10) NOT NULL,
  `width` bigint(5) NOT NULL,
  `height` bigint(5) NOT NULL,
  `path` varchar(200) NOT NULL,
  `type` varchar(10) NOT NULL,
  `login` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voting_banner`
--

LOCK TABLES `voting_banner` WRITE;
/*!40000 ALTER TABLE `voting_banner` DISABLE KEYS */;
/*!40000 ALTER TABLE `voting_banner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `voting_detail`
--

DROP TABLE IF EXISTS `voting_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voting_detail` (
  `voting_id` bigint(11) NOT NULL AUTO_INCREMENT,
  `voting_name` varchar(50) NOT NULL,
  `welcome_message` varchar(160) NOT NULL,
  `voting_type` int(2) NOT NULL DEFAULT '0',
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `key_status` int(1) DEFAULT NULL,
  `keyword` varchar(20) DEFAULT NULL,
  `key_alias_status` int(1) DEFAULT NULL,
  `keyword_alias` varchar(20) DEFAULT NULL,
  `short_code` int(5) DEFAULT NULL,
  `score` int(2) NOT NULL DEFAULT '0',
  `score_neg_status` int(1) DEFAULT '0',
  `negative_marking` int(2) DEFAULT NULL,
  `cummilative_score` int(1) DEFAULT '0',
  `today_score` int(1) DEFAULT '0',
  `weekly_score` int(1) DEFAULT '0',
  `bill_status` int(1) DEFAULT '0',
  `application_id` varchar(20) DEFAULT NULL,
  `price_status` int(1) DEFAULT '0',
  `price_pt` int(3) DEFAULT '0',
  `question_status` int(1) DEFAULT '0',
  `question_size` bigint(4) DEFAULT '0',
  `score_type` int(1) DEFAULT '0',
  `max_options` int(1) NOT NULL DEFAULT '2',
  `off_message` varchar(160) NOT NULL,
  `voting_over_message` varchar(160) NOT NULL,
  `voting_footer_message` varchar(160) NOT NULL,
  `active_status` int(1) NOT NULL DEFAULT '0',
  `archive` int(1) DEFAULT '0',
  `footer_status` int(1) DEFAULT '0',
  `footer_sept` int(1) DEFAULT '0',
  `diplay_add` int(1) DEFAULT '0',
  `footer_link` int(1) DEFAULT NULL,
  `header_upload` varchar(50) NOT NULL,
  `footer_upload` varchar(50) NOT NULL,
  `login` varchar(20) DEFAULT NULL,
  `voting_question_type` int(1) DEFAULT NULL,
  PRIMARY KEY (`voting_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voting_detail`
--

LOCK TABLES `voting_detail` WRITE;
/*!40000 ALTER TABLE `voting_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `voting_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `voting_flink`
--

DROP TABLE IF EXISTS `voting_flink`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voting_flink` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `voting_id` bigint(11) NOT NULL,
  `footer_text` varchar(50) DEFAULT NULL,
  `footer_link` varchar(150) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voting_flink`
--

LOCK TABLES `voting_flink` WRITE;
/*!40000 ALTER TABLE `voting_flink` DISABLE KEYS */;
/*!40000 ALTER TABLE `voting_flink` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `voting_questions`
--

DROP TABLE IF EXISTS `voting_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voting_questions` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `voting_id` bigint(11) NOT NULL,
  `ques_no` bigint(11) NOT NULL,
  `question` varchar(1000) NOT NULL,
  `a` varchar(20) NOT NULL,
  `b` varchar(20) NOT NULL,
  `c` varchar(20) DEFAULT NULL,
  `d` varchar(20) DEFAULT NULL,
  `max_options` int(4) NOT NULL,
  `active_status` int(4) NOT NULL DEFAULT '1',
  `voting_seq` varchar(200) DEFAULT NULL,
  `header` varchar(1000) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voting_questions`
--

LOCK TABLES `voting_questions` WRITE;
/*!40000 ALTER TABLE `voting_questions` DISABLE KEYS */;
/*!40000 ALTER TABLE `voting_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `voting_session`
--

DROP TABLE IF EXISTS `voting_session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voting_session` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `entry_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `msisdn` varchar(15) NOT NULL DEFAULT '',
  `voting_id` bigint(11) NOT NULL DEFAULT '0',
  `question_counter` bigint(11) NOT NULL DEFAULT '0',
  `question_no_asked` int(4) NOT NULL DEFAULT '0',
  `active_status` int(4) DEFAULT '1',
  `question_asked_datetime` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voting_session`
--

LOCK TABLES `voting_session` WRITE;
/*!40000 ALTER TABLE `voting_session` DISABLE KEYS */;
/*!40000 ALTER TABLE `voting_session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `voting_transaction_log`
--

DROP TABLE IF EXISTS `voting_transaction_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voting_transaction_log` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `request_datetime` datetime NOT NULL,
  `msisdn` varchar(20) DEFAULT NULL,
  `user_request` varchar(100) DEFAULT NULL,
  `server_response` varchar(500) DEFAULT NULL,
  `billing_url` varchar(1000) DEFAULT NULL,
  `billing_response` varchar(1000) DEFAULT NULL,
  `voting_id` bigint(11) DEFAULT '0',
  PRIMARY KEY (`id`,`request_datetime`),
  KEY `ind_request_datetime` (`request_datetime`),
  KEY `ind_msisdn` (`msisdn`),
  KEY `ind_user_request` (`user_request`),
  KEY `ind_billing_response` (`billing_response`),
  KEY `ind_contest_id` (`voting_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voting_transaction_log`
--

LOCK TABLES `voting_transaction_log` WRITE;
/*!40000 ALTER TABLE `voting_transaction_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `voting_transaction_log` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-10-12 15:18:57
