<?php
	date_default_timezone_set("Etc/GMT+8");
	require_once'class.php';
	if(ISSET($_POST['apply'])){
		$db=new db_class();
		$account_owner=$_POST['account_owner'];
		$account_name=$_POST['account_name'];
		$success = $db->save_savings_account($account_owner, $account_name);
		
		header("location: saving.php?account_added=" . $success);
	}
?>