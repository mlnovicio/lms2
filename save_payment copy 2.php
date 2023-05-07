<?php
	date_default_timezone_set("Etc/GMT+8");
	require_once'class.php';
	if(ISSET($_POST['save'])){
		$db=new db_class();
		$loan_id=$_POST['loan_id'];
		$payee=$_POST['payee'];
		$penalty=$_POST['penalty'];
		$payable=str_replace(",", "", $_POST['payable']);
		$payment=$_POST['payment'];
		$month=$_POST['month'];
		$balance=$_POST['balance'];
		$currbal = $balance - $payment;
		if($penalty == 0){
			$overdue=0;
		}else{
			$overdue=1;
		}
			if($balance==$payment){
				$db->update_payment($loan_id,$currbal);
				$db->paymentComplete($loan_id);
				$db->save_payment($loan_id, $payee, $payment, $penalty, $overdue);
				header("location: payment.php");
			}else{
				$db->update_payment($loan_id,$currbal);
				$db->save_payment($loan_id, $payee, $payment, $penalty, $overdue);
				header("location: payment.php");
			}
}
?>