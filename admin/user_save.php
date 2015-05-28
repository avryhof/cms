<? 
	require_once("admin-config.inc.php");
	
	$action = $_REQUEST['action'];
	
	$table = "users";
	
	if ($action == "edit" || $action == "delete") {
		$id =  $_REQUEST['username'];
		$where = "`username` = '$id'";
		$old_user = $db->query("SELECT * FROM `$table` WHERE $where")->fetch_assoc();
	}
	
	if ($action == "add" || $action == "edit") {
		if (!empty($_POST['password'])) {
			$data = array(
				"name" => $_POST['name'],
				"username" => $_POST['username'],
				"htpassword" => crypt($_POST['password']),
				"password" => md5($_POST['password']),
				"email" => $_POST['email']
			);
		} else {
			$data = array(
				"name" => $_POST['name'],
				"username" => $_POST['username'],
				"email" => $_POST['email']
			);
		}
	}
	
	if ($action == "add")	{ $db->insert($table, $data); }
	if ($action == "edit")	{ $db->update($table, $data, $where); }
	if ($action == "delete"){ $db->delete($table, $where); }
	
	$htlines = array();
	$htusers = $db->query("SELECT * FROM `users` ORDER BY `username`");
	while($htuser = $htusers->fetch_assoc()) {
		$htlines[] = $htuser['username'].":".$htuser['htpassword'];
	}
	file_put_contents(".htpasswd",implode("\n",$htlines));
	
	if (!file_exists(".htaccess")) {
		file_put_contents(".htaccess","AuthUserFile ".__DIR__."/.htpasswd\nAuthType Basic\nAuthName \"Admin\"\n\nrequire valid-user");
	}
	
	if ($db->errno > 0) {
		echo "<h1>Error</h1><p>Database Error</p><pre>" . $db->error . "\n" . $db->last_query . "</pre>";
		if ($action == "add") {
			$returnlink = "user.php?action=add";
		} elseif ($action == "edit" || $action == "delete") {
			$returnlink = "user.php?username=$id";
		}
		echo "<p><a href='$returnlink'>Continue</a></p>";
		die("<pre>Action: $action\nID: $id\nWHERE: $where\nREQUEST: " . print_r($_REQUEST,true) . "\nDATA: " . print_r($data,true) . "</pre>");
	} else {
		header('Location: ./users.php');
	}
?>