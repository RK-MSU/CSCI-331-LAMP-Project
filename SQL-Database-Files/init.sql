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
