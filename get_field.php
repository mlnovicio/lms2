<?php
	date_default_timezone_set("Etc/GMT+8");
	require_once'session.php'; 
admin();
	require_once'class.php';
	$db=new db_class(); 
	if(ISSET($_REQUEST['loan_id'])){
		$loan_id=$_REQUEST['loan_id'];
	}else{
		header("location: payment.php");
	}
	
	$tbl_loan=$db->display_loanUserPlan($loan_id);
	$fetch=$tbl_loan->fetch_array();
	// echo $fetch['date_released'];
	$dt = new DateTime($fetch['date_released']);
	// echo $fetch['paymentNumber'];
	if($fetch['paymentNumber']==0){
		$dt->modify('+1 month');
		$num = 1;
	}else{
		$dt->modify('+'.$fetch['paymentNumber'].'month');
		$num = $fetch['paymentNumber']+1;
	}
	
	$duedate = $dt->format('m/d/Y');
	$date_now = date("m/d/Y");

	$due_date = new DateTime($duedate);
	//  echo $date_now;
	//  echo $duedate;
	$currdate = new DateTime($date_now);
	// print_r($currdate <= $due_date);

?>
<hr />
<div class="form-row">
	<div class="form-group col-xl-6 col-md-6">
		<label>Payee<label>
		<input type="text" value="<?php echo ucfirst($fetch['lastname']).", ".ucfirst($fetch['firstname'])." ".substr(ucfirst($fetch['middlename']), 0, 1)?>." name="payee" class="form-control" readonly="readonly"/>
		<input type="hidden" value="<?php echo number_format($add, 2)?>" name="penalty"/>
		<input type="hidden" value="<?php echo number_format($monthly+$add, 2)?>" name="payable"/>
		<input type="hidden" value="<?php echo $fetch['lplan_month'];?>" name="month"/>
		<input type="hidden" value="<?php echo round($fetch['balance'])?>" name="balance">
		<input type="hidden" value="<?php echo $num?>" name="paymentNumber">

	</div>
</div>

<hr />

<div class="form-row">
	<div class="form-group col-xl-6 col-md-6">
	<?php
		if ($date_now >= $duedate) {

			//if due date
			$diff = $currdate->diff($due_date);
			$numberDue=$diff->m;
			// echo $diff['m'];
			// print_r($diff) ;
			$basetotal = $fetch['amount'];
			$interest = $fetch['lplan_interest']/100;
			$interest2 = $fetch['lplan_penalty']/100;


			$totalinterest = $basetotal * $interest;
			$totalinterest2 = $basetotal * $interest;
			$penalty= $totalinterest2 / $fetch['lplan_month'];
			// echo $penalty;

			$penalty = $penalty * $numberDue;

			$totalpermonth=$basetotal+$totalinterest;
			$totalpermonth2=$basetotal+$totalinterest2;

			$totalpermonth = $totalpermonth / $fetch['lplan_month'];
			$totalpermonthdue = $totalpermonth+$penalty;

			?>
						<input type="hidden" value="<?php echo $totalpermonthdue?>" id="minVal">
						<input type="hidden" value="<?php echo $fetch['balance']?>" id="maxVal">
						<input type="hidden" value="<?php echo $penalty?>" name="PenaltyAmt">
						<input type="hidden" value="<?php echo $numberDue?>" name="PenaltyMonths">

							<p>Monthly Amount: <strong><?php echo "&#8369; ".number_format($totalpermonth, 0);?></strong></p>
							<p>Duedate Amount: <strong><?php echo "&#8369; ".number_format($totalpermonthdue, 0);?></strong></p>
							<p>Payable Amount: <strong>&#8369; <?php echo number_format($fetch['balance'], 0)?></strong></p>
						</div>
						<div class="form-group col-xl-6 col-md-6">
							<label>Amount<label>
							<input type="number" id="paymentVal" class="form-control" name="payment" required/>
						</div>

		<?php }else{
			//if not due date
			$basetotal = $fetch['amount'] ;
			$interest = $fetch['lplan_interest']/100;
			$totalinterest = $basetotal * $interest;
			$totalpermonth=$basetotal+$totalinterest;
			$totalpermonth = $totalpermonth / $fetch['lplan_month'];
			$totalpermonth2 = number_format($totalpermonth, 0);
			$bal = round($fetch['balance']);
			?>
				<input type="hidden" value="<?php echo $totalpermonth?>" id="minVal">
				<input type="hidden" value="<?php echo $bal ?>" id="maxVal">

					<p>Montly Amount: <strong><?php echo "&#8369; ".number_format($totalpermonth, 0);?></strong></p>
					<p>Payable Amount: <strong>&#8369; <?php echo number_format($fetch['balance'], 0)?></strong></p>
				</div>
				<div class="form-group col-xl-6 col-md-6">
					<label>Amount<label>
					<input type="number" id="paymentVal" class="form-control"  step='0.01' name="payment" required/>
				</div>
	<?php	}
	 ?>

</div>

<script>
	$('#paymentVal').attr("min",parseInt($('#minVal').val())+1)
	$('#paymentVal').attr("max",parseInt($('#maxVal').val()))

</script>