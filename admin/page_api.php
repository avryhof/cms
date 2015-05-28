<? 
	require_once("admin-config.inc.php");
	
	$action = $_REQUEST['action'];
	
	if ($action == "order") {
		$table = "pages";
		$id = intval($_GET['id']);
		$where = "`id` = $id";
		$data = array( "order" => intval($_GET['order']) );
		$db->update($table, $data, $where);
		echo json_encode($db->query("SELECT * FROM `$table` WHERE $where")->fetch_assoc());
	}
	
	if ($action = "inlinesave") {
		$table = "pages";
		$id = intval($_POST['id']);
		$where = "`id` = $id";
		$data = array(
			"updated"        => date("Y-m-d H:i:s"),
			"content"        => $_POST['content']
		);
		$db->update($table, $data, $where);
		if ($db->errno > 0) {
			echo json_encode(array("respnse" => "failure", "error" => $db->error));
		} else {
			echo json_encode(array("response" => "success"));
		}
	}
	
	if ($action == "order_sections") {
		$table = "sections";
		$id = intval($_GET['id']);
		$where = "`id` = $id";
		$data = array( "order" => intval($_GET['order']) );
		$db->update($table, $data, $where);
		echo json_encode($db->query("SELECT * FROM `$table` WHERE $where")->fetch_assoc());
	}
?>