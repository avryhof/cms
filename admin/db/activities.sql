CREATE TABLE IF NOT EXISTS `activities` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `volunteer` int(10) DEFAULT NULL,
  `activity` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hours_available` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  KEY(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;