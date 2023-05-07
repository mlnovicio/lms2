<?php
	require_once'class.php';
	if(ISSET($_POST['save'])){
		$db=new db_class();
		$ltype_name=$_POST['ltype_name'];
		// $ltype_desc=$_POST['ltype_desc'];
		$maxloan=$_POST['maxloan'];
		$minloan=$_POST['minloan'];
		$success = $db->save_ltype($ltype_name,$minloan,$maxloan);
		
		header("location: loan_type.php?ltype_added=" . $success);
	}
?>