CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `active` int(1) NOT NULL,
  `date` date DEFAULT NULL,
  `title` varchar(128) NOT NULL,
  `desc` text,
  `content` text,
  `src_url` varchar(512) NOT NULL,
  `visits` bigint(20) NOT NULL,
  `lang` varchar(4) NOT NULL DEFAULT 'en',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `postedby` varchar(128) DEFAULT NULL,
  KEY(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;