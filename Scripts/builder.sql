
ALTER DATABASE `db36`
	CHARACTER SET utf8mb4
	COLLATE utf8mb4_general_ci;

USE `db36`;

DROP TABLE IF EXISTS `friends`;
DROP TABLE IF EXISTS `profiles`;
DROP TABLE IF EXISTS `posts`;
DROP TABLE IF EXISTS `members`;

SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE IF NOT EXISTS `members` (
	`member_id` int unsigned NOT NULL AUTO_INCREMENT,
	`username` varchar(16) NOT NULL,
	`password` varchar(16) NOT NULL,
	PRIMARY KEY (`member_id`),
	KEY `username` (`username`),
	CONSTRAINT UC_Member
		UNIQUE (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE IF NOT EXISTS `friends` (
	`member_id` int unsigned NOT NULL,
	`friend_id` int unsigned NOT NULL,
	KEY `member_id` (`member_id`),
	KEY `friend_id` (`friend_id`),
	CONSTRAINT FK_friends_member_id
		FOREIGN KEY (`member_id`)
		REFERENCES members(`member_id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	CONSTRAINT FK_friends_friend_id
		FOREIGN KEY (`friend_id`)
		REFERENCES members(`member_id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE IF NOT EXISTS `profiles` (
	`member_id` int unsigned NOT NULL,
	`bio` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
	`first_name` varchar(25) DEFAULT NULL,
	`last_name` varchar(25) DEFAULT NULL,
	KEY `member_id` (`member_id`),
	KEY `first_name` (`first_name`),
	KEY `last_name` (`last_name`),
	CONSTRAINT FK_profile_member_id
		FOREIGN KEY (`member_id`)
		REFERENCES members(`member_id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE IF NOT EXISTS `posts` (
	`post_id` int unsigned NOT NULL AUTO_INCREMENT,
	`member_id` int unsigned NOT NULL,
	`data` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
	`created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`post_id`),
	KEY `member_id` (`member_id`),
	KEY `created` (`created`),
	FOREIGN KEY (`member_id`)
		REFERENCES members(`member_id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ALTER TABLE profiles
-- DROP FOREIGN KEY FK_MemberID;
-- 
-- ALTER TABLE `profiles`
-- 	ADD CONSTRAINT FK_MemberID
-- 	FOREIGN KEY (`member_id`) REFERENCES members(`member_id`)
-- 	ON DELETE CASCADE
-- 	ON UPDATE CASCADE;

-- ALTER TABLE `friends`
-- ADD CHECK (`member_id`!=`friend_id`);

INSERT INTO `members` (`member_id`, `username`, `password`) VALUES
	(1, 'RK311y','p@$$w0rd123!!'),
	(2, 'member1','password'),
	(3, 'member2','password'),
	(4, 'member3','password'),
	(5, 'member4','password');


INSERT INTO `profiles` (`member_id`, `first_name`, `last_name`, `bio`) VALUES
	(1, 'River','Kelly', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\nDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.\r\n\r\nExcepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'),
	(2, 'John','Smith', NULL),
	(3, 'Abby','Sutton', NULL),
	(4, 'Connor','Rogers', NULL),
	(5, 'Lydia','Ash', NULL);


INSERT INTO `friends` (`member_id`, `friend_id`) VALUES
	(1, 2),
	(1, 3),
	(1, 5),
	(2, 1),
	(2, 4),
	(3, 2);



