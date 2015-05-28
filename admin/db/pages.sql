CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `active` int(1) NOT NULL,
  `order` int(5) NOT NULL,
  `homepage` int(1) NOT NULL,
  `title` varchar(128) NOT NULL,
  `alt_url` varchar(128) NOT NULL,
  `visits` bigint(20) NOT NULL,
  `lang` varchar(4) NOT NULL DEFAULT 'en',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `content` text,
  `parent` int(11) DEFAULT NULL,
  KEY(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;