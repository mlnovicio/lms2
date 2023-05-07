<?php
	require_once'class.php';
	session_start();
	
	if(ISSET($_REQUEST['savings_id'])){
		$savings_id = $_REQUEST['savings_id'];
		$db = new db_class();
		$success = $db->delete_savings($savings_id);
		header('location:saving.php?saving_updated=' . $success);
	}
?>	