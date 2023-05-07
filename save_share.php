<?php
	date_default_timezone_set("Etc/GMT+8");
	require_once'class.php';
	if(ISSET($_POST['save-share'])){
		$db=new db_class();
		$user_id=$_POST['user_id'];
		$amount=$_POST['amount'];
		$success = $db->save_share($user_id, $amount);
		
		header("location: capital_share.php?share_updated=" . $success);
	}
	if(ISSET($_POST['update-share'])){
		$db=new db_class();
		$tx_type=$_POST['tx_type_update'];
		$capital_share_id=$_POST['capital_share_id'];
		$amount=$_POST['amount_update'];
		$success = $db->update_share($amount, $capital_share_id);
		
		header("location: capital_share.php?share_updated=" . $success);
	}
?>