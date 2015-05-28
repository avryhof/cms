<? 
	require_once("admin-config.inc.php");
	
	$action = $_REQUEST['action'];
	
	$table = 'pages';
	$returnbase = "page";

	if ($action == "edit" || $action == "delete") {
		$id =  intval($_REQUEST['id']);
		$where = "`id` = $id";
	}
	
	if ($action == "add" || $action == "edit") {
		$data = array(
			"active"         => (intval($_POST['active']) == 1 ? 1 :0),
			"order"          => intval($_POST['order']),
			"homepage"       => intval($_POST['homepage']),
			"title"          => $_POST['title'],
			"alt_url"        => $_POST['alt_url'],
			"visits"         => intval($_POST['visits']),
			"lang"           => $_POST['lang'],
			"updated"        => date("Y-m-d H:i:s"),
			"content"        => $_POST['content'],
			"parent"		 => intval($_POST['parent'])
		);
		if ($action == "add") { 
			$data["created"] = date("Y-m-d H:i:s"); 
		}
	}
	
	if ($action == "add")	{ $db->insert($table, $data); }
	if ($action == "edit")	{ $db->update($table, $data, $where); }
	if ($action == "delete"){ $db->delete($table, $where); }
	
	if ($db->errno > 0) {
		echo "<h1>Error</h1><p>Database Error</p><pre>" . $db->error . "\n" . $db->last_query . "</pre>";
		if ($action == "add") {
			$returnlink = $returnbase.".php?action=add";
		} elseif ($action == "edit" || $action == "delete") {
			$returnlink = $returnbase.".php?id=$id";
		}
		echo "<p><a href='$returnlink'>Continue</a></p>";
		die("<pre>Action: $action\nID: $id\nWHERE: $where\nREQUEST: " . print_r($_REQUEST,true) . "\nDATA: " . print_r($data,true) . "</pre>");
	} else {
		header('Location: ./index.php');
	}
?>