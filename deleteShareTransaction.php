<?php
	require_once'class.php';
	session_start();
	
	if(ISSET($_REQUEST['capital_share_id'])){
		$capital_share_id = $_REQUEST['capital_share_id'];
		$db = new db_class();
		$success = $db->delete_share($capital_share_id);
		header('location:capital_share.php?share_updated=' . $success);
	}
?>	