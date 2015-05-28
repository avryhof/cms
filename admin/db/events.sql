CREATE TABLE IF NOT EXISTS `events` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `active` int(1) NOT NULL,
  `begin` datetime DEFAULT NULL,
  `complete` datetime DEFAULT NULL,
  `title` varchar(256) DEFAULT NULL,
  `desc` text NOT NULL,
  `lang` varchar(4) NOT NULL DEFAULT 'en',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  KEY(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;