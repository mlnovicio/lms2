<?php
	require_once'payment.php';
	session_start();
	
	if(ISSET($_POST['payment'])){
	
		$db=new db_lms();
		
		if($get_id['count'] > 0){
			
			$_SESSION['payment_id']=$get_id['payment_id'];
			unset($_SESSION['message']);
			echo"<script>alert(' Payment Successful')</script>";
			echo"<script>window.location='payment.php'</script>";
		}else{
			$_SESSION['message']="Invalid Payment";

			echo"<script>window.location='payment.php'</script>";
		}
	}
?>