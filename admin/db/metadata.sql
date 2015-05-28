CREATE TABLE IF NOT EXISTS `metadata` (
  `var` varchar(256) NOT NULL,
  `val` text NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;