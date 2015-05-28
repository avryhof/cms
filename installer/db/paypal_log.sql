CREATE TABLE IF NOT EXISTS `paypal_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `action` text,
  `get` text,
  `post` text,
  `request` text,
  `created` datetime DEFAULT NULL,
  `server` text,
  KEY(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;