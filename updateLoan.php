<?php
	date_default_timezone_set("Etc/GMT+8");
	require_once'class.php';
	if(ISSET($_POST['update'])){
		$db=new db_class();
		$loan_id=$_POST['loan_id'];
		$loan_status=$_POST['loan_status'];

		if($loan_status==2){
			// echo date("d");
			$db->update_release($loan_id, $loan_status,$_POST['balancer']);
			$db->loansched($loan_id, date("d"));

		}else{
			$db->update_loan($loan_id, $loan_status);
		}
		
		echo"<script>alert('Update Loan successfully')</script>";
		echo"<script>window.location='loan.php'</script>";
	}
?>