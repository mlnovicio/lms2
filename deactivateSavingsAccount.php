<?php
	require_once'class.php';
	session_start();
	
	if(ISSET($_REQUEST['account_id'])){
		$account_id = $_REQUEST['account_id'];
		$db = new db_class();
		$success = $db->deactivate_savings_account($account_id);
		header('location:saving.php?account_deactivated=' . $success);
	}
?>	