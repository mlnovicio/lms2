<?php
	date_default_timezone_set("Etc/GMT+8");
	require_once'class.php';
	if(ISSET($_POST['save-saving'])){
		$db=new db_class();
		$account_id=$_POST['account_id'];
		$tx_type=$_POST['tx_type'];
		$amount=$_POST['amount'];
		$success = $db->save_savings($account_id, $tx_type, $amount);
		
		header("location: saving.php?saving_updated=" . $success);
	}
	if(ISSET($_POST['update-saving'])){
		$db=new db_class();
		$account_id=$_POST['account_id_update'];
		$tx_type=$_POST['tx_type_update'];
		$savings_id=$_POST['savings_id'];
		$amount=$_POST['amount_update'];
		$success = $db->update_savings($account_id, $tx_type, $amount, $savings_id);
		
		header("location: saving.php?saving_updated=" . $success);
	}
?>