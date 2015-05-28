<?
	$debug = (isset($_GET['debug']) && !empty($_GET['debug']));
	if ($debug) { error_reporting(E_ALL); }

	$local = !($_SERVER['REQUEST_METHOD'] == "POST" || $_SERVER['REQUEST_METHOD'] == "GET");
	
	$pagename = basename($_SERVER['PHP_SELF']);
	
	$basepath = $_SERVER['DOCUMENT_ROOT'];	
	$baseurl = "http" . ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? "s" : "") . "://" . $_SERVER['HTTP_HOST'];
	
	$configfile = $basepath . "/config/database.ini";
	if (file_exists($configfile)) {
		$config = parse_ini_file($configfile);
		
		define('DB_HOST', $config['db_host']);
		define('DB_USER', $config['db_user']);
		define('DB_PASS', $config['db_pass']);
		define('DB_NAME', $config['db_name']);
	}
	
	require_once($basepath . "/lib/functions.php");
	require_once($basepath . "/vendor/autoload.php");
	
	$db = new Database("mysqli://".DB_USER.":".DB_PASS."@".DB_HOST."/".DB_NAME);

	$admin_folder = "admin";
	if (!empty($_SERVER['PHP_AUTH_USER'])) {
		if ($db->query("SELECT * FROM `users` WHERE `username` = '".$_SERVER['PHP_AUTH_USER']."'")->num_rows > 0) {
			setcookie("admin_logged_in",$_SERVER['PHP_AUTH_USER'],strtotime("+8 hours"),'/',$_SERVER['HTTP_HOST']);
		}
	}
	
	$meta_datas = $db->query("SELECT * FROM `metadata`");
	$metadata = array();
	if ($meta_datas ->num_rows > 0) {
	  while($meta_data = $meta_datas->fetch_assoc()) {
		  
		  $keys = explode("_",$meta_data['var']);
		  if (count($keys) == 1) {
			  $metadata[$keys[0]] = $meta_data['val'];
		  } elseif (count($keys) == 2) {
			  $metadata[$keys[0]][$keys[1]] = $meta_data['val'];
		  } elseif (count($keys) == 3) {
			  $metadata[$keys[0]][$keys[1]][$keys[2]] = $meta_data['val'];
		  }
	  }
	  
	  date_default_timezone_set($metadata['location']['timezone']);
	}
	$bootstrap = $metadata['bootstrap'];
	
	$email_signup = false;
	
?>