<? 
	require_once("admin-config.inc.php");
	
	$action = $_REQUEST['action'];
	
	$table = 'replies';
	
	if ($action == "edit" || $action == "delete") {
		$id =  intval($_REQUEST['id']);
		$where = "`id` = $id";
	}
	
	if ($action == "add" || $action == "edit") {
		$data = array(
			"user"           => $_POST['user'],
			"content"        => $_POST['content'],
			"ip_address"     => $_SERVER['REMOTE_ADDR'],
			"contact"        => intval($_POST['contact'])
		);
		if ($action == "add") { 
			$data["created"] = date("Y-m-d H:i:s"); 
		}
	}
	
	if ($action == "add")	{
		$contact = $db->query("SELECT * FROM `contact` WHERE `id` = $data[contact]")->fetch_assoc();
		$sender = $db->query("SELECT * FROM `users` WHERE `username` = '$data[user]'")->fetch_assoc(); 
		$db->insert($table, $data); 
		if (!empty($contact['email'])) {
			htmlmail("$contact[name] <$contact[email]>", "Re: Your Question for Edward Szczesniak", $data['content'], "$sender[name] <$sender[email]>");
		}
	}
	if ($action == "edit")	{ $db->update($table, $data, $where); }
	if ($action == "delete"){ $db->delete($table, $where); }
	
	if ($db->errno > 0) {
		echo "<h1>Error</h1><p>Database Error</p><pre>" . $db->error . "\n" . $db->last_query . "</pre>";
		if ($action == "add") {
			$returnlink = "contact_reply.php?action=add";
		} elseif ($action == "edit" || $action == "delete") {
			$returnlink = "contact.php?id=$id";
		}
		echo "<p><a href='$returnlink'>Continue</a></p>";
		die("<pre>Action: $action\nID: $id\nWHERE: $where\nREQUEST: " . print_r($_REQUEST,true) . "\nDATA: " . print_r($data,true) . "</pre>");
	} else {
		header('Location: ./contact.php?id='.$data['contact']);
	}
?>