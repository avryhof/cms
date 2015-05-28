<? 
	require_once("admin-config.inc.php");
	
	$table = "metadata";
	
	foreach($_POST as $var => $val) {
		$existing = $db->query("SELECT * FROM `$table` WHERE `var` = '$var'");
		if ($existing->num_rows > 0) {
			// Update
			$db->update($table, array("var" => $var, "val" => $val, "updated" => date("Y-m-d H:i:s")), "`var` = '$var'");
		} else {
			// Add
			$db->insert($table, array("var" => $var, "val" => $val, "updated" => date("Y-m-d H:i:s"), "created" => date("Y-m-d H:i:s")));
		}
	}
	header("Location:metadata.php");
?>