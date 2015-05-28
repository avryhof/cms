<?
	require_once("admin-config.inc.php");
	
	$fields = array("get","post","server","request");
	
	$transactions = $db->query("SELECT * FROM `paypal_log` ORDER BY `created`");
	
	while($trans = $transactions->fetch_assoc()) {
		if ($trans['action'] !== "notify") {
			$db->delete("paypal_log", "`id` = $trans[id]");
		} else {
		  foreach($fields as $field) {
			  $trans_json = print_r_to_json($trans[$field]);
			  echo "<pre>" . $trans_json . "</pre>";
			  
			  if (substr($trans[$field],0,5) == "Array") { 
			  	echo "<pre>Update Field</pre>";
				  $db->update("paypal_log", array($field =>$trans_json), "`id` = $trans[id]"); 
				  if ($db->errno > 0) {
					  echo "<pre>" . $db->error ."\n\n" . $db->last_query . "</pre>";
				  }
			  }
		  }
		}
	}
?>