<?php
	$debug = (isset($_GET['debug']) && !empty($_GET['debug']));
	if ($debug) { error_reporting(E_ALL); }
	
	$configfile = $_SERVER['DOCUMENT_ROOT']."/config/database.ini";
	
	$basepath = __DIR__;	
	$baseurl = "http" . ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? "s" : "") . "://" . $_SERVER['HTTP_HOST'];
	
	require_once($_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php");

	if (file_exists($configfile)) {
		$config = parse_ini_file($configfile);
		
		define('DB_HOST', $config['db_host']);
		define('DB_USER', $config['db_user']);
		define('DB_PASS', $config['db_pass']);
		define('DB_NAME', $config['db_name']);

		$db = new Database("mysqli://".DB_USER.":".DB_PASS."@".DB_HOST."/".DB_NAME);
	}
?>