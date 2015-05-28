CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(256) DEFAULT NULL,
  `phone` varchar(32) DEFAULT NULL,
  `comments` text,
  `ip_address` varchar(32) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `name` varchar(512) DEFAULT NULL,
  KEY(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;