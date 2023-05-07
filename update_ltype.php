<?php
	require_once'class.php';
	if(ISSET($_POST['update'])){
		$db=new db_class();
		$ltype_id=$_POST['ltype_id'];
		$ltype_name=$_POST['ltype_name'];
		$minloan=$_POST['minloan'];
		$maxloan=$_POST['maxloan'];
		$success = $db->update_ltype($ltype_id,$ltype_name,$minloan,$maxloan);
		
		header("location: loan_type.php?ltype_updated=" . $success);
	}
?>