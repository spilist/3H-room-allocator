SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


DROP TABLE IF EXISTS `3h_sessions`;
CREATE TABLE `3h_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `3h_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('18374a91c06a7b8d9e1536c2de05e0be', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.101 Safari/537.36', 1383651958, 'a:5:{s:9:"user_data";s:0:"";s:8:"is_login";b:1;s:3:"num";i:1;s:4:"name";s:11:"Hwidong Bae";s:2:"id";s:7:"spilist";}'),
('7bd01d0653bb6cfbd0f4ef9884e1beb2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.101 Safari/537.36', 1383207658, 'a:6:{s:9:"user_data";s:0:"";s:8:"is_login";b:1;s:3:"num";s:1:"4";s:4:"name";s:11:"Hwidong Bae";s:2:"id";s:7:"spilist";s:17:"flash:old:message";s:23:"Successfully signed in.";}'),
('bcdf698ce2fdd8b72f0af30063e51250', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.101 Safari/537.36', 1383616155, 'a:5:{s:9:"user_data";s:0:"";s:8:"is_login";b:1;s:3:"num";i:1;s:4:"name";s:11:"Hwidong Bae";s:2:"id";s:7:"spilist";}');

DROP TABLE IF EXISTS `allocate_result`;
CREATE TABLE `allocate_result` (
  `mem_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `seat_id` int(11) NOT NULL,
  KEY `mem_id` (`mem_id`),
  KEY `mem_id_2` (`mem_id`,`group_id`,`seat_id`),
  KEY `group_id` (`group_id`),
  KEY `seat_id` (`seat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `application`;
CREATE TABLE `application` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `seat_id` int(11) NOT NULL,
  `seat_priority` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_application_seat1_idx` (`seat_id`),
  KEY `fk_application_member1_idx` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `group`;
CREATE TABLE `group` (
  `id` int(11) NOT NULL,
  `group_owner_id` int(11) NOT NULL,
  `group_name` varchar(45) NOT NULL,
  `group_pw` varchar(45) NOT NULL,
  `selectable_seat_numbers` int(11) NOT NULL,
  `all_members_appliced` tinyint(1) NOT NULL DEFAULT '0',
  `allocation_done` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_name_UNIQUE` (`group_name`),
  KEY `fk_group_member1_idx` (`group_owner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `group_has_member`;
CREATE TABLE `group_has_member` (
  `group_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  PRIMARY KEY (`group_id`,`member_id`),
  KEY `fk_group_has_member_member1_idx` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` varchar(11) NOT NULL,
  `member_name` varchar(45) NOT NULL,
  `member_pw` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `member_name_UNIQUE` (`member_name`),
  UNIQUE KEY `member_id` (`member_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

INSERT INTO `member` (`id`, `member_id`, `member_name`, `member_pw`) VALUES
(4, 'spilist', 'Hwidong Bae', '$2y$10$5VZOSDgyxCQk7pZGdWWC6O/o2Rl2WR8JbN6ElBC46msB4WCZB6beC');

DROP TABLE IF EXISTS `object`;
CREATE TABLE `object` (
  `id` int(11) NOT NULL,
  `object_type` tinyint(4) NOT NULL,
  `object_location_x` int(11) NOT NULL,
  `object_location_y` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_object_room1_idx` (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `room`;
CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `room_name` varchar(45) NOT NULL,
  `room_shape` tinyint(4) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_room_lab1_idx` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `seat`;
CREATE TABLE `seat` (
  `id` int(11) NOT NULL,
  `seat_location_x` int(11) NOT NULL,
  `seat_location_y` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `seat_owner_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_seat_room1_idx` (`room_id`),
  KEY `fk_seat_member1_idx` (`seat_owner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `allocate_result`
  ADD CONSTRAINT `allocate_result_ibfk_3` FOREIGN KEY (`seat_id`) REFERENCES `seat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `allocate_result_ibfk_1` FOREIGN KEY (`mem_id`) REFERENCES `member` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `allocate_result_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `room` (`group_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `application`
  ADD CONSTRAINT `fk_application_member1` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_application_seat1` FOREIGN KEY (`seat_id`) REFERENCES `seat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `group`
  ADD CONSTRAINT `fk_group_member1` FOREIGN KEY (`group_owner_id`) REFERENCES `member` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `group_has_member`
  ADD CONSTRAINT `fk_group_has_member_group1` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_group_has_member_member1` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `object`
  ADD CONSTRAINT `fk_object_room1` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `room`
  ADD CONSTRAINT `fk_room_lab1` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `seat`
  ADD CONSTRAINT `fk_seat_member1` FOREIGN KEY (`seat_owner_id`) REFERENCES `member` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_seat_room1` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
