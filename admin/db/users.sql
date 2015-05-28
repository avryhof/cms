CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `htpassword` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` text NOT NULL,
  KEY(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;