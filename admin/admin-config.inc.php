<?
  require_once("../config.inc.php");
  
  $admin_user = "avryhof";
  
  $enabled_modules = $db->query("SHOW TABLES FROM `".DB_NAME."`");
  $modules = array();
  $module_key = 'Tables_in_'.DB_NAME;
  while($enabled_module = $enabled_modules->fetch_assoc()) {
	  $modules[] = $enabled_module[$module_key];
  }
  $admin_modules = array('articles','events','slides','contacts','metadata','paypal');
?>