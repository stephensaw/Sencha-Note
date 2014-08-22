DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `categories` (`id`, `name`)
VALUES
	(1,'to do'),
	(2,'groceries'),
	(3,'important');

CREATE TABLE `notes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content` text,
  `categoryid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `notes` (`id`, `content`, `categoryid`)
VALUES
	(8,'sample note',1);
