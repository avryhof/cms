<? 
	require_once("admin-config.inc.php");
	
	$action = $_REQUEST['action'];
	
	if ($action == "order") {
		$table = "slides";
		$id = intval($_GET['id']);
		$where = "`id` = $id";
		$data = array( "order" => intval($_GET['order']) );
		$db->update($table, $data, $where);
		echo json_encode($db->query("SELECT * FROM `$table` WHERE $where")->fetch_assoc());
	}
?>