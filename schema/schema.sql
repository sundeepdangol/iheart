CREATE DATABASE IF NOT EXISTS iheart;

USE iheart;

--
-- Table structure for table `todo_items`
--

DROP TABLE IF EXISTS `todo_items`;
CREATE TABLE IF NOT EXISTS `todo_items` (
  `item_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(1000) NOT NULL,
  `image` varchar(200) NOT NULL,
  `completed` tinyint(4) NOT NULL,
  `date_submitted` datetime NOT NULL,
  PRIMARY KEY (`item_id`),
  KEY `user_id` (`user_id`,`completed`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
