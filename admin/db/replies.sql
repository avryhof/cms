CREATE TABLE IF NOT EXISTS `replies` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user` varchar(256) DEFAULT NULL,
  `content` text,
  `ip_address` varchar(32) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `contact` int(11) DEFAULT NULL,
  KEY(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;