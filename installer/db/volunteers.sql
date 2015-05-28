CREATE TABLE IF NOT EXISTS `volunteers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `phone_home` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_work` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_cell` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `preferred_contact_method` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  KEY(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;