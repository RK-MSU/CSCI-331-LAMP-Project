-- ------------------------------------------------------
-- Initialize LAMP Stack Project Database
-- ------------------------------------------------------

-- CREATE DATABASE IF NOT EXISTS `db36`;

-- USE `db36`;

DROP TABLE IF EXISTS `friends`;
DROP TABLE IF EXISTS `messages`;
DROP TABLE IF EXISTS `posts`;
DROP TABLE IF EXISTS `profiles`;
DROP TABLE IF EXISTS `members`;

--
-- Table structure for table `friends`
--
CREATE TABLE `friends` (
  `member_id` int(10) unsigned NOT NULL,
  `friend_id` int(10) unsigned NOT NULL,
  KEY `member_id` (`member_id`),
  KEY `friend_id` (`friend_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `members`
--
CREATE TABLE `members` (
  `member_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `password` varchar(16) NOT NULL,
  PRIMARY KEY (`member_id`),
  UNIQUE KEY `UC_Member` (`username`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `messages`
--
CREATE TABLE `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `auth` varchar(16) DEFAULT NULL,
  `recip` varchar(16) DEFAULT NULL,
  `pm` char(1) DEFAULT NULL,
  `time` int(10) unsigned DEFAULT NULL,
  `message` varchar(4096) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `auth` (`auth`(6)),
  KEY `recip` (`recip`(6))
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Table structure for table `posts`
--
CREATE TABLE `posts` (
  `post_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(10) unsigned NOT NULL,
  `data` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`post_id`),
  KEY `member_id` (`member_id`),
  KEY `created` (`created`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `profiles`
--
CREATE TABLE `profiles` (
  `member_id` int(10) unsigned NOT NULL,
  `bio` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  KEY `member_id` (`member_id`),
  KEY `first_name` (`first_name`),
  KEY `last_name` (`last_name`),
  CONSTRAINT `FK_profile_member_id` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data for table `friends`
--
LOCK TABLES `friends` WRITE;
INSERT INTO `friends` VALUES
    (2,1),
    (2,4),
    (3,2),
    (1,2),
    (1,7),
    (1,3),
    (1,5),
    (8,3),
    (8,4);
UNLOCK TABLES;

--
-- Data for table `members`
--
LOCK TABLES `members` WRITE;
INSERT INTO `members` VALUES
    (1,'RK311y','password'),
    (2,'member1','password'),
    (3,'member2','password'),
    (4,'member3','password'),
    (5,'member4','password'),
    (6,'member5','password'),
    (7,'member6','password'),
    (8,'dan','password');
UNLOCK TABLES;

--
-- Data for table `messages`
--
LOCK TABLES `messages` WRITE;
INSERT INTO `messages` VALUES
    (13,'RK311y','member2','y',1634327741,'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\nDuis aute irure dolor in r'),
    (14,'RK311y','member4','y',1634327860,'asdfasdfas df asd f asd fa sd fa sdf asd f asd fa sd fasdfasdf'),
    (15,'member1','RK311y','',1634330482,'asdfasdf as df as df as df asasdfasdf as df as df as df asasdfasdf as df as df as df asasdfasdf as df as df as df as'),
    (16,'member1','member3','',1634333065,'asdfasdfasd fa sdf as df asd fas asdfasdfasd fa sdf as df asd fas asdfasdfasd fa sdf as df asd fas asdfasdfasd fa sdf as df asd fas asdfasdfasd fa sdf as df asd fas '),
    (17,'member1','RK311y','',1634333073,'asdfa sdf asd fa sdf asd fa sdasdfa sdf asd fa sdf asd fa sdasdfa sdf asd fa sdf asd fa sdasdfa sdf asd fa sdf asd fa sdasdfa sdf asd fa sdf asd fa sdasdfa sdf asd fa sdf asd fa sd'),
    (18,'member1','member4','n',1634333181,'asdfasd asd asdfas asd f asd f asd f asd fa sd fa sdf as dfafasdfasd'),
    (19,'RK311y','member2','n',1634333203,'asd f asd fa sd fa sdf asd fasd f asd fa sd fa sdf asd fasd f asd fa sd fa sdf asd fasd f asd fa sd fa sdf asd fasd f asd fa sd fa sdf asd fasd f asd fa sd fa sdf asd fasd f asd fa sd fa sdf asd fasd f asd fa sd fa sdf asd fasd f asd fa sd fa sdf asd fasd f asd fa sd fa sdf asd fasd f asd fa sd fa sdf asd fasd f asd fa sd fa sdf asd fasd f asd fa sd fa sdf asd fasd f asd fa sd fa sdf asd fasd f asd fa sd fa sdf asd f'),
    (20,'RK311y','member1','n',1634333212,'asd f asd f asd fas df asd fa sd fa sda sd fa sd asd fa sdf asd fa'),
    (21,'member3','member6','n',1634334846,'Hacks d s a edge a a a f g. Saw s');
UNLOCK TABLES;

--
-- Data for table `posts`
--
LOCK TABLES `posts` WRITE;
UNLOCK TABLES;

--
-- Data for table `profiles`
--
LOCK TABLES `profiles` WRITE;
INSERT INTO `profiles` VALUES
    (1,'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\nDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.\r\n\r\nExcepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','River','Kelly'),
    (2,NULL,'John','Smith'),
    (3,NULL,'Abby','Sutton'),
    (4,'Ha sssdd a as. D a a a a a','Connor','Rogers'),
    (5,NULL,'Lydia','Ash'),
    (7,NULL,'Test','Testing'),
    (8,'Teacher by day. Grader by night.','Daniel','DeFrance');
UNLOCK TABLES;
