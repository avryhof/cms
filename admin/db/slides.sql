CREATE TABLE IF NOT EXISTS `slides` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `active` int(1) NOT NULL,
  `order` int(4) NOT NULL,
  `src` text NOT NULL,
  `alt` varchar(128) NOT NULL,
  `caption` text NOT NULL,
  `lang` varchar(4) NOT NULL DEFAULT 'en',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `orientation` int(1) DEFAULT NULL,
  KEY(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;