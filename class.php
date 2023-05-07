<?php
require_once 'config.php';

class db_class extends db_connect
{

	public function __construct()
	{
		$this->connect();
	}


	/* User Function */
	public function add_user2($username, $password, $firstname, $middlename, $lastname, $email, $address, $contact)
	{
		$username = $this->conn->real_escape_string(trim($username));
		$password = $this->conn->real_escape_string(trim($password));
		$firstname = $this->conn->real_escape_string($firstname);
		$middlename = $this->conn->real_escape_string($middlename);
		$lastname = $this->conn->real_escape_string($lastname);
		$contact = $this->conn->real_escape_string($contact);
		$address = $this->conn->real_escape_string($address);
		$email = $this->conn->real_escape_string($email);
		$query = $this->conn->prepare("INSERT INTO `user` (`username`, `password`, `firstname`,middlename, `lastname`,contact_no,address,email) VALUES(?,?,?,?,?,?,?,?)") or die($this->conn->error);
		$query->bind_param("ssssssss", $username, $password, $firstname, $middlename, $lastname, $contact, $address, $email);

		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}

	public function add_user($username, $password, $firstname, $lastname, $type, $mem_fee)
	{
		$username = $this->conn->real_escape_string(trim($username));
		$password = $this->conn->real_escape_string(trim($password));
		$firstname = $this->conn->real_escape_string($firstname);
		$lastname = $this->conn->real_escape_string($lastname);
		$type = $this->conn->real_escape_string($type);
		$mem_fee = $this->conn->real_escape_string($mem_fee);
		$query = $this->conn->prepare("INSERT INTO `user` (`username`, `password`, `firstname`, `lastname`, `user_type`, `is_mem_fee_paid`) VALUES(?, ?, ?, ?, ?, ?)") or die($this->conn->error);
		$query->bind_param("sssssi", $username, $password, $firstname, $lastname, $type, $mem_fee);
		echo $query;
		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}

	public function update_user($user_id, $username, $password, $firstname, $lastname, $mem_fee)
	{
		$query = $this->conn->prepare("UPDATE `user` SET `username`=?, `password`=?, `firstname`=?, `lastname`=?, `is_mem_fee_paid`=? WHERE `user_id`=?") or die($this->conn->error);
		$query->bind_param("ssssii", $username, $password, $firstname, $lastname, $mem_fee, $user_id);

		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}

	public function login($username, $password)
	{
		$username = trim(htmlentities($username));
		$password = trim(htmlentities($password));

		$query = $this->conn->prepare("SELECT * FROM `user` WHERE `username`='$username' && `password`='$password'") or die($this->conn->error);
		if ($query->execute()) {

			$result = $query->get_result();

			$valid = $result->num_rows;

			$fetch = $result->fetch_array();

			return array(
				'user_id' => isset($fetch['user_id']) ? $fetch['user_id'] : 0,
				'count' => isset($valid) ? $valid : 0,
				'user_type' => isset($fetch['user_type']) ? $fetch['user_type'] : 0

			);
		}
	}

	public function user_acc($user_id)
	{
		$query = $this->conn->prepare("SELECT * FROM `user` WHERE `user_id`='$user_id'") or die($this->conn->error);
		if ($query->execute()) {
			$result = $query->get_result();

			$valid = $result->num_rows;

			$fetch = $result->fetch_array();

			return $fetch['firstname'] . " " . $fetch['lastname'];
		}
	}

	function hide_pass($str)
	{
		$len = strlen($str);

		return str_repeat('*', $len);
	}

	public function display_user()
	{
		$sql = "SELECT u.*
					   , CONCAT(U.firstname, ' ', U.middlename, ' ', U.lastname) AS name
					   , UT.name AS user_type
					   , MS.name AS payment_status
					FROM `user` U
					INNER JOIN user_type UT ON U.user_type = UT.id
					INNER JOIN membership_payment_status MS ON MS.id = U.is_mem_fee_paid";

		$query = $this->conn->prepare($sql) or die($this->conn->error);
		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}

	public function display_user_for_report($from = null, $to = null)
	{
		$range = '';
		if ($from != null && $to != null) {
			$range = " AND registration_date BETWEEN '" . $from . "  00:00:00' AND '" . $to . "  23:59:59'";
		}
		$query = $this->conn->prepare("SELECT *, 
		(SELECT COUNT(loan_id) FROM loan WHERE `status` = 2 AND borrower_id = user.user_id) active_loans, 
		(SELECT COUNT(loan_id) FROM loan WHERE `status` != 2 AND borrower_id = user.user_id) inactive_loans
		FROM `user` WHERE user_type = 3 $range") or die($this->conn->error);
		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}


	public function delete_user($user_id)
	{
		$query = $this->conn->prepare("DELETE FROM `user` WHERE `user_id` = '$user_id'") or die($this->conn->error);
		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}


	/* Loan Type Function */

	public function save_ltype($ltype_name, $min, $max)
	{
		$query = $this->conn->prepare("INSERT INTO `loan_type` (`ltype_name`, minloan,maxloan) VALUES(?, ?,?)") or die($this->conn->error);
		$query->bind_param("sii", $ltype_name, $min, $max);

		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}

	public function display_ltype()
	{
		$query = $this->conn->prepare("SELECT * FROM `loan_type`") or die($this->conn->error);
		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}

	public function delete_ltype($ltype_id)
	{
		$query = $this->conn->prepare("DELETE FROM `loan_type` WHERE `ltype_id` = '$ltype_id'") or die($this->conn->error);
		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}

	public function update_ltype($ltype_id, $ltype_name, $minloan, $maxloan)
	{
		$query = $this->conn->prepare("UPDATE `loan_type` SET `ltype_name`=?, `minloan`=?, `maxloan`=?  WHERE `ltype_id`=?") or die($this->conn->error);
		$query->bind_param("siii", $ltype_name, $minloan, $maxloan, $ltype_id);

		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}


	/* Loan Plan Function */

	public function save_lplan($lplan_month, $lplan_interest, $lplan_penalty)
	{
		$query = $this->conn->prepare("INSERT INTO `loan_plan` (`lplan_month`, `lplan_interest`, `lplan_penalty`) VALUES(?, ?, ?)") or die($this->conn->error);
		$query->bind_param("sss", $lplan_month, $lplan_interest, $lplan_penalty);

		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}


	public function display_lplan()
	{
		$query = $this->conn->prepare("SELECT * FROM `loan_plan`") or die($this->conn->error);
		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}


	public function delete_lplan($lplan_id)
	{
		$query = $this->conn->prepare("DELETE FROM `loan_plan` WHERE `lplan_id` = '$lplan_id'") or die($this->conn->error);
		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}

	public function update_lplan($lplan_id, $lplan_month, $lplan_interest, $lplan_penalty)
	{
		$query = $this->conn->prepare("UPDATE `loan_plan` SET `lplan_month`=?, `lplan_interest`=?, `lplan_penalty`=? WHERE `lplan_id`=?") or die($this->conn->error);
		$query->bind_param("idii", $lplan_month, $lplan_interest, $lplan_penalty, $lplan_id);

		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}

	/* Borrower Function */

	public function save_borrower($firstname, $middlename, $lastname, $contact_no, $address, $email, $tax_id)
	{
		$query = $this->conn->prepare("INSERT INTO `borrower` (`firstname`, `middlename`, `lastname`, `contact_no`, `address`, `email`, `tax_id`) VALUES(?, ?, ?, ?, ?, ?, ?)") or die($this->conn->error);
		$query->bind_param("ssssssi", $firstname, $middlename, $lastname, $contact_no, $address, $email, $tax_id);

		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}

	public function display_borrower()
	{
		$query = $this->conn->prepare("SELECT * FROM `user` WHERE user_type = 0") or die($this->conn->error);
		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}
	public function display_borrower_user($id)
	{
		$query = $this->conn->prepare("SELECT * FROM `user` where user_id='$id'") or die($this->conn->error);
		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}

	public function delete_borrower($borrower_id)
	{
		$query = $this->conn->prepare("DELETE FROM `borrower` WHERE `borrower_id` = '$borrower_id'") or die($this->conn->error);
		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}

	public function update_borrower($borrower_id, $firstname, $middlename, $lastname, $contact_no, $address, $email, $tax_id)
	{
		$query = $this->conn->prepare("UPDATE `borrower` SET `firstname`=?, `middlename`=?, `lastname`=?, `contact_no`=?, `address`=?, `email`=?, `tax_id`=? WHERE `borrower_id`=?") or die($this->conn->error);
		$query->bind_param("ssssssii", $firstname, $middlename, $lastname, $contact_no, $address, $email, $tax_id, $borrower_id);

		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}

	/* Loan Function */

	public function save_loan($borrower, $ltype, $lplan, $loan_amount, $purpose, $date_created)
	{
		$ref_no = mt_rand(1, 99999999);

		$i = 1;

		while ($i == 1) {
			$query = $this->conn->prepare("SELECT * FROM `loan` WHERE `ref_no` ='$ref_no' ") or die($this->conn->error);

			$check = $query->num_rows;
			if ($check > 0) {
				$ref_no = mt_rand(1, 99999999);
			} else {
				$i = 0;
			}

		}

		$query = $this->conn->prepare("INSERT INTO `loan` (`ref_no`, `ltype_id`, `borrower_id`, `purpose`, `amount`, `lplan_id`, `date_created`) VALUES(?, ?, ?, ?, ?, ?, ?)") or die($this->conn->error);
		$query->bind_param("siisiis", $ref_no, $ltype, $borrower, $purpose, $loan_amount, $lplan, $date_created);

		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}

	// public function display_loan(){
	// 	$query=$this->conn->prepare("SELECT * FROM `loan` INNER JOIN `borrower` ON loan.borrower_id=borrower.borrower_id INNER JOIN `loan_type` ON loan.ltype_id=loan_type.ltype_id INNER JOIN `loan_plan` ON loan.lplan_id=loan_plan.lplan_id") or die($this->conn->error);
	// 	if($query->execute()){
	// 		$result = $query->get_result();
	// 		return $result;
	// 	}
	// }
	public function display_loan($from = null, $to = null)
	{
		$range = '';
		if ($from != null && $to != null) {
			$range = " AND date_created BETWEEN '" . $from . "  00:00:00' AND '" . $to . "  23:59:59'";
		}
		$query = $this->conn->prepare("SELECT *,CAST(date_released AS DATE) as date_rel FROM `loan` INNER JOIN `user` ON loan.borrower_id=user.user_id LEFT JOIN loan_plan ON loan.lplan_id = loan_plan.lplan_id LEFT JOIN loan_type ON loan_type.ltype_id = loan.ltype_id 
			" . $range) or die($this->conn->error);
		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}
	public function display_loanUser($user)
	{
		$query = $this->conn->prepare("SELECT * FROM `loan` INNER JOIN `user` ON loan.borrower_id=user.user_id LEFT JOIN loan_type ON loan_type.ltype_id = loan.ltype_id where user.user_id='$user' 
			") or die($this->conn->error);
		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}
	public function display_loanUser2($user)
	{
		$query = $this->conn->prepare("SELECT *,CAST(date_released AS DATE) as date_rel FROM `loan` INNER JOIN `user` ON loan.borrower_id=user.user_id LEFT JOIN loan_plan ON loan.lplan_id = loan_plan.lplan_id LEFT JOIN loan_type ON loan_type.ltype_id = loan.ltype_id where user.user_id='$user' 
			") or die($this->conn->error);
		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}
	public function display_loan_by_loan_id($loan_id)
	{
		$loan_id = $this->conn->real_escape_string($loan_id);
		$query = $this->conn->prepare("SELECT *,CAST(date_released AS DATE) as date_rel FROM `loan` INNER JOIN `user` ON loan.borrower_id=user.user_id LEFT JOIN loan_plan ON loan.lplan_id = loan_plan.lplan_id LEFT JOIN loan_type ON loan_type.ltype_id = loan.ltype_id where loan.loan_id=$loan_id 
			") or die($this->conn->error);
		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}
	public function display_loanUserPlan($user)
	{
		// $query=$this->conn->prepare("SELECT * FROM `loan` INNER JOIN `user` ON loan.borrower_id=user.user_id where user.user_id='$user' 
		// ") or die($this->conn->error);
		$query = $this->conn->prepare("SELECT * 
						FROM `loan` 
						INNER JOIN `loan_plan` 
						ON loan.lplan_id=loan_plan.lplan_id
						INNER JOIN `loan_type` 
						ON loan.ltype_id=loan_type.ltype_id
						INNER JOIN `user` 
						ON loan.borrower_id=user.user_id 
						where loan_id='$user' 
						") or die($this->conn->error);
		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}

	public function delete_loan($loan_id)
	{
		$query = $this->conn->prepare("DELETE FROM `loan` WHERE `loan_id` = '$loan_id'") or die($this->conn->error);
		if ($query->execute()) {
			$query->close();
			$query2 = $this->conn->prepare("DELETE FROM `loan_comaker` WHERE `loan_id` = '$loan_id'") or die($this->conn->error);
			if ($query2->execute()) {
				$query2->close();
				$this->conn->close();
				return true;
			}
		}
	}


	// public function update_loan($loan_id, $borrower, $ltype, $lplan, $loan_amount, $purpose, $status, $date_released){
	// 	$query=$this->conn->prepare("UPDATE `loan` SET `ltype_id`=?, `borrower_id`=?, `purpose`=?, `amount`=?, `lplan_id`=?, `status`=?, `date_released`=? WHERE `loan_id`=?") or die($this->conn->error);
	// 	$query->bind_param("iisiiisi", $ltype, $borrower, $purpose, $loan_amount, $lplan, $status, $date_released, $loan_id);

	// 	if($query->execute()){
	// 		$query->close();
	// 		$this->conn->close();
	// 		return true;
	// 	}
	// }
	public function update_loan($loan_id, $loan_status)
	{
		$query = $this->conn->prepare("UPDATE `loan` SET `status`=? WHERE `loan_id`=?") or die($this->conn->error);
		$query->bind_param("ii", $loan_status, $loan_id);

		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}
	public function update_release($loan_id, $loan_status, $balance)
	{
		$balance = htmlentities($balance);
		$query = $this->conn->prepare("UPDATE `loan` SET `status`=?,date_released=current_timestamp(),balance=? WHERE `loan_id`=?") or die($this->conn->error);
		$query->bind_param("iss", $loan_status, $balance, $loan_id);

		if ($query->execute()) {
			$query->close();
			return true;
		}
	}
	public function update_payment($loan_id, $payment, $paymentNumber)
	{
		$query = $this->conn->prepare("UPDATE `loan` SET `balance` = ?, paymentNumber = ? WHERE `loan`.`loan_id` = ?") or die($this->conn->error);
		$query->bind_param("iii", $payment, $paymentNumber, $loan_id);

		if ($query->execute()) {
			return true;
		}
	}
	public function check_loan($loan_id)
	{
		$query = $this->conn->prepare("SELECT * FROM `loan` WHERE `loan_id`='$loan_id'") or die($this->conn->error);
		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	} 

	public function check_lplan($lplan)
	{
		$query = $this->conn->prepare("SELECT * FROM `loan_plan` WHERE `lplan_id`='$lplan'") or die($this->conn->error);
		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}

	/* Loan Schedule Function */

	public function save_date_sched($loan_id, $date_schedule)
	{
		$query = $this->conn->prepare("INSERT INTO `loan_schedule` (`loan_id`, `due_date`) VALUES(?, ?)") or die($this->conn->error);
		$query->bind_param("is", $loan_id, $date_schedule);

		if ($query->execute()) {
			return true;
		}
	}
	public function loansched($loan_id, $date_schedule)
	{
		$query = $this->conn->prepare("INSERT INTO `loan_schedule` (`loan_id`, `due_date`) VALUES(?, ?)") or die($this->conn->error);
		$query->bind_param("is", $loan_id, $date_schedule);

		if ($query->execute()) {
			return true;
		}
	}

	/* Payment Function */

	public function display_payment()
	{
		$query = $this->conn->prepare("SELECT * FROM `payment`") or die($this->conn->error);
		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}

	public function display_loan_payments($ref_no, $from = null, $to = null)
	{
		$range = '';
		if ($from != null && $to != null) {
			$range = " AND payment.date_created BETWEEN '" . $from . "  00:00:00' AND '" . $to . "  23:59:59'";
		}
		$loan = '';
		if ($ref_no != 'all') {
			$loan = " AND loan.ref_no = '$ref_no' ";
		}
		$query = $this->conn->prepare("SELECT payment.*, loan.*, loan_type.ltype_name,  payment.date_created as payment_date FROM `payment` LEFT JOIN loan ON loan.loan_id = payment.loan_id LEFT JOIN loan_type ON loan_type.ltype_id = loan.ltype_id WHERE loan.loan_id IS NOT NULL " . $loan . $range) or die($this->conn->error);
		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}

	public function display_type()
	{
		$query = $this->conn->prepare("SELECT * FROM `loan_type`") or die($this->conn->error);
		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}

	public function save_payment($loan_id, $payee, $payment, $penalty, $overdue)
	{
		$query = $this->conn->prepare("INSERT INTO `payment` (`loan_id`, `payee`, `pay_amount`, `penalty`, `overdue`) VALUES(?, ?, ?, ?, ?)") or die($this->conn->error);
		$query->bind_param("isssi", $loan_id, $payee, $payment, $penalty, $overdue);

		if ($query->execute()) {
			return true;
		}
	}

	// Message Functions

	public function sendMessage($user_id1, $message1)
	{
		$user_id = $this->conn->real_escape_string($user_id1);
		$message = $this->conn->real_escape_string($message1);
		$query = $this->conn->prepare("INSERT INTO `message` (`user_id`, `message`) VALUES (?,?)") or die($this->conn->error);
		$query->bind_param("is", $user_id, $message);

		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}
	public function sendMessageAdmin($user_id1, $message1)
	{
		$user_id = $this->conn->real_escape_string($user_id1);
		$message = $this->conn->real_escape_string($message1);
		$admin = "admin";
		$query = $this->conn->prepare("INSERT INTO `message` (`user_id`,sent, `message`) VALUES (?,?,?)") or die($this->conn->error);
		$query->bind_param("iss", $user_id, $admin, $message);

		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}
	public function displayMessage($user)
	{
		$query = $this->conn->prepare("SELECT *
			FROM ( SELECT a.*,b.firstname,b.middlename,b.lastname
				  FROM message as a
				  LEFT JOIN user as b 
				  ON a.user_id = b.user_id
				  WHERE a.user_id='$user'
				  ORDER BY message_date DESC LIMIT 5 )Var1
			WHERE user_id='$user'
			ORDER BY message_date ASC") or die($this->conn->error);
		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}

	public function displayAllMessageUser()
	{
		$query = $this->conn->prepare("SELECT a.*,b.firstname,b.middlename,b.lastname 
			FROM message as a
			LEFT JOIN user as b
			ON a.user_id=b.user_id
			GROUP BY a.user_id
			") or die($this->conn->error);
		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}
	public function displayAllMessage($user)
	{
		$query = $this->conn->prepare("SELECT *
			FROM ( SELECT * FROM message  ORDER BY message_date DESC )Var1 WHERE user_id='$user'
			ORDER BY message_date ASC") or die($this->conn->error);
		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}
	// user Loan Functions

	public function userLoan($ref_no, $type, $plan, $user, $loan, $rate, $comakers)
	{
		$type_id = $this->conn->real_escape_string($type);
		$plan_id = $this->conn->real_escape_string($plan);

		$user_id = $this->conn->real_escape_string($user);
		$loan = $this->conn->real_escape_string($loan);
		$ref_no = $this->conn->real_escape_string($ref_no);
		$rate = $this->conn->real_escape_string($rate);
		$comakers = explode(',', $this->conn->real_escape_string($comakers));

		$status = 0;
		$query = $this->conn->prepare("INSERT INTO `loan` (ref_no,ltype_id,`borrower_id`,amount,lplan_id, `status`,balance,loan_rate) VALUES (?,?,?,?,?,?,?,?)") or die($this->conn->error);
		$query->bind_param("ssiiiiis", $ref_no, $type_id, $user_id, $loan, $plan_id, $status, $loan, $rate);

		if ($query->execute()) {
			$query->close();
			$last_inserted_id = $this->conn->insert_id;
			$query2 = $this->conn->prepare("INSERT INTO `loan_comaker` (loan_id,comaker_id) VALUES (?,?),(?,?)") or die($this->conn->error);
			$query2->bind_param("iiii", $last_inserted_id, $comakers[0], $last_inserted_id, $comakers[1]);
			if ($query2->execute()) {
				$this->conn->close();
				return true;
			}
		}
	}

	public function display_loan_comakers($loan_id)
	{
		$loan_id = $this->conn->real_escape_string($loan_id);
		$query = $this->conn->prepare("SELECT * FROM `loan_comaker` LEFT JOIN user ON user.user_id = loan_comaker.comaker_id WHERE loan_comaker.loan_id = '$loan_id'") or die($this->conn->error);
		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}


	// Announcement Functions

	public function addAnnouncement($details, $image)
	{
		$details = $this->conn->real_escape_string($details);
		$query = $this->conn->prepare("INSERT INTO `announcement` (`announcement_details`,img) VALUES (?,?)") or die($this->conn->error);
		$query->bind_param("ss", $details, $image);

		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}
	public function displayAnnouncement()
	{
		$query = $this->conn->prepare("SELECT * FROM `announcement`") or die($this->conn->error);
		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}
	public function updateAnnouncement($details, $id)
	{
		$details = $this->conn->real_escape_string($details);
		$query = $this->conn->prepare("UPDATE `announcement` SET `announcement_details`=? where announcement_id=$id") or die($this->conn->error);
		$query->bind_param("s", $details);

		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}

	public function VerifyEmail($email, $uid)
	{

		$email = htmlentities($email);
		$uid = $this->conn->real_escape_string($uid);

		$query = $this->conn->prepare("UPDATE `loan` SET `comakerStatus` = '1' WHERE `loan`.`comakerUid` = ? and comakerEmail = ?") or die($this->conn->error);
		$query->bind_param("ss", $uid, $email);

		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}
	public function VerifyEmail2($email, $uid)
	{

		$email = htmlentities($email);
		$uid = $this->conn->real_escape_string($uid);

		$query = $this->conn->prepare("UPDATE `loan` SET `cm2status` = '1' WHERE `loan`.`cmuid2` = ? and cmemail2 = ?") or die($this->conn->error);
		$query->bind_param("ss", $uid, $email);

		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}

	public function paymentComplete($uid)
	{
		$uid = $this->conn->real_escape_string($uid);

		$query = $this->conn->prepare("UPDATE `loan` SET `status` = '3' WHERE `loan`.`loan_id` = ?") or die($this->conn->error);
		$query->bind_param("s", $uid);

		if ($query->execute()) {
			$query->close();
			return true;
		}
	}
	public function deleteAnnouncement($id)
	{
		$id = $this->conn->real_escape_string($id);
		$query = $this->conn->prepare("DELETE FROM `announcement` WHERE `announcement_id` = '$id'") or die($this->conn->error);
		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}

	// new
	public function checkLoanVerifier($id)
	{
		$id = $this->conn->real_escape_string($id);
		$query = $this->conn->prepare("SELECT * FROM `loan` WHERE `borrower_id`= '$id' and ( status =0 or status =2 or status  =1)");
		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}

	public function checkMembershipFee($id)
	{
		$id = $this->conn->real_escape_string($id);
		$query = $this->conn->prepare("SELECT is_mem_fee_paid FROM `user` WHERE `user_id`= '$id'");
		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}

	public function checkLoan($loan_id)
	{
		$loan_id = htmlentities($loan_id);

		$query = $this->conn->prepare("SELECT a.*,b.lplan_month 
				FROM loan as a 
				LEFT JOIN loan_plan as b 
				ON a.lplan_id = b.lplan_id
				WHERE a.loan_id = '$loan_id'");

		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}

	public function save_savings_account($owner, $accountName)
	{
		$owner = $this->conn->real_escape_string($owner);
		$accountName = $this->conn->real_escape_string($accountName);
		$query = $this->conn->prepare("INSERT INTO `savings_account` (`owner_id`,`account_name`) VALUES (?,?)") or die($this->conn->error);
		$query->bind_param("is", $owner, $accountName);
		if ($query->execute()) {
			$result = $query->get_result();
			return true;
		}
	}

	public function deactivate_savings_account($saving_account_id)
	{
		$saving_account_id = $this->conn->real_escape_string($saving_account_id);
		$query = $this->conn->prepare("UPDATE `savings_account` SET status = 0 WHERE `saving_account_id` = '$saving_account_id' AND status = 1") or die($this->conn->error);
		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}

	public function display_all_savings_account($from = null, $to = null)
	{
		$range = '';
		if ($from != null && $to != null) {
			$range = " AND sa.date_created BETWEEN '" . $from . "  00:00:00' AND '" . $to . "  23:59:59'";
		}
		$query = $this->conn->prepare("SELECT sa.*, sum(s.amount) total_balance, u.*
				FROM savings_account as sa
				LEFT JOIN saving as s
				ON s.saving_account_id = sa.saving_account_id
				LEFT JOIN user as u
				ON u.user_id = sa.owner_id
				WHERE sa.status = 1 $range
				GROUP BY sa.saving_account_id
				ORDER BY sa.saving_account_id ASC") or die($this->conn->error);

		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}

	public function display_savings_by_account_id($saving_account_id)
	{
		$saving_account_id = $this->conn->real_escape_string($saving_account_id);

		$query = $this->conn->prepare("SELECT s.*
				FROM saving as s 
				LEFT JOIN savings_account as sa
				ON sa.saving_account_id = s.saving_account_id
				WHERE s.saving_account_id = '$saving_account_id'
				AND sa.status = 1
				ORDER BY sa.saving_account_id, s.savings_id ASC");

		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}

	public function display_savings_transactions($from = null, $to = null, $user_id = null)
	{
		$range = '';
		if ($from != null && $to != null) {
			$range = " WHERE s.tx_date BETWEEN '" . $from . "  00:00:00' AND '" . $to . "  23:59:59'";
		}
		$userFilter = '';
		if ($user_id != null) {
			$prefix = $from != null && $to != null ? ' AND ' : ' WHERE ';
			$userFilter = $prefix . "u.user_id = '$user_id'";
		}
		$query = $this->conn->prepare("SELECT *, u.*,
		(SELECT sum(amount) total_balance FROM saving WHERE saving_account_id = s.saving_account_id) total_balance
				FROM saving as s 
				LEFT JOIN savings_account as sa
				ON sa.saving_account_id = s.saving_account_id
				LEFT JOIN user as u
				ON u.user_id = sa.owner_id
				" . $range . $userFilter ."
				ORDER BY tx_date DESC");

		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}

	public function display_savings_by_owner_id($owner_id)
	{
		$owner_id = $this->conn->real_escape_string($owner_id);

		$query = $this->conn->prepare("SELECT *, sum(s.amount) total_balance
				FROM savings_account as sa 
				LEFT JOIN saving as s
				ON s.saving_account_id = sa.saving_account_id
				LEFT JOIN user as u
				ON u.user_id = sa.owner_id
				WHERE sa.owner_id = '$owner_id'
				AND sa.status = 1
				GROUP BY sa.saving_account_id
				ORDER BY sa.saving_account_id, s.savings_id ASC");

		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}

	public function save_savings($accountId, $tx_type, $amount)
	{
		$accountId = $this->conn->real_escape_string($accountId);
		$tx_type = $this->conn->real_escape_string($tx_type);
		$amount = abs($this->conn->real_escape_string($amount));
		if ($tx_type == 0) {
			$amount = $amount * -1;
		}
		$query = $this->conn->prepare("INSERT INTO `saving` (`saving_account_id`,`tx_type`,`amount`) VALUES (?,?,?)") or die($this->conn->error);
		$query->bind_param("iid", $accountId, $tx_type, $amount);
		if ($query->execute()) {
			$result = $query->get_result();
			return true;
		}
	}

	public function update_savings($accountId, $tx_type, $amount, $savings_id)
	{
		$accountId = $this->conn->real_escape_string($accountId);
		$savings_id = $this->conn->real_escape_string($savings_id);
		$tx_type = $this->conn->real_escape_string($tx_type);
		$amount = abs($this->conn->real_escape_string($amount));
		if ($tx_type == 0) {
			$amount = $amount * -1;
		}
		$query = $this->conn->prepare("UPDATE `saving` SET `tx_type` = ?, `amount` = ? WHERE `saving_account_id` = ? AND `savings_id` = ?") or die($this->conn->error);
		$query->bind_param("idii", $tx_type, $amount, $accountId, $savings_id);
		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}

	public function delete_savings($savings_id)
	{
		$savings_id = $this->conn->real_escape_string($savings_id);
		$query = $this->conn->prepare("DELETE FROM `saving` WHERE `savings_id` = '$savings_id'") or die($this->conn->error);
		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}

	public function display_members_capital_shares()
	{
		$query = $this->conn->prepare("SELECT u.*,
				cs.amount,
				sum(cs.amount) total_balance
				FROM user as u 
				LEFT JOIN capital_share as cs
				ON cs.user_id = u.user_id
				WHERE u.user_type = 0
				GROUP BY u.user_id
				ORDER BY sum(cs.amount) DESC");

		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}

	public function display_members_capital_shares_transactions($from = null, $to = null, $user_id = null)
	{
		$range = '';
		if ($from != null && $to != null) {
			$range = " AND cs.date_created BETWEEN '" . $from . "  00:00:00' AND '" . $to . "  23:59:59'";
		}
		$userFilter = '';
		if ($user_id != null) {
			$userFilter = " AND u.user_id = '$user_id'";
		}
		$query = $this->conn->prepare("SELECT *,
				sum(cs.amount) total_balance,
				cs.date_created as tx_date
				FROM capital_share as cs 
				LEFT JOIN user as u
				ON u.user_id = cs.user_id
				WHERE u.user_type = 0
				" . $range . $userFilter ."
				GROUP BY cs.capital_share_id
				ORDER BY cs.date_created DESC");

		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}

	public function display_members_capital_shares_transactions_by_user_id($user_id)
	{
		$user_id = $this->conn->real_escape_string($user_id);
		$query = $this->conn->prepare("SELECT *,
				sum(cs.amount) total_balance,
				cs.date_created as tx_date
				FROM capital_share as cs 
				LEFT JOIN user as u
				ON u.user_id = cs.user_id
				WHERE u.user_type = 0
				AND u.user_id = '$user_id'
				GROUP BY cs.capital_share_id
				ORDER BY cs.date_created DESC");

		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}

	public function display_capital_shares_by_user_id($user_id)
	{
		$user_id = $this->conn->real_escape_string($user_id);

		$query = $this->conn->prepare("SELECT *,
				sum(cs.amount) total_balance,
				cs.date_created as tx_date
				FROM capital_share as cs 
				LEFT JOIN user as u
				ON u.user_id = cs.user_id
				WHERE u.user_type = 0 and u.user_id = '$user_id'
				GROUP BY cs.capital_share_id
				ORDER BY cs.date_created ASC
				");

		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}

	public function save_share($user_id, $amount)
	{
		$user_id = $this->conn->real_escape_string($user_id);
		$amount = abs($this->conn->real_escape_string($amount));

		$query = $this->conn->prepare("INSERT INTO `capital_share` (`user_id`,`amount`) VALUES (?,?)") or die($this->conn->error);
		$query->bind_param("id", $user_id, $amount);
		if ($query->execute()) {
			$query->get_result();
			return true;
		}
	}

	public function update_share($amount, $capital_share_id)
	{
		$capital_share_id = $this->conn->real_escape_string($capital_share_id);
		$amount = abs($this->conn->real_escape_string($amount));

		$query = $this->conn->prepare("UPDATE `capital_share` SET `amount` = ? WHERE `capital_share_id` = ?") or die($this->conn->error);
		$query->bind_param("di", $amount, $capital_share_id);
		if ($query->execute()) {
			$result = $query->get_result();
			return true;
		}
	}

	public function delete_share($capital_share_id)
	{
		$capital_share_id = $this->conn->real_escape_string($capital_share_id);
		$query = $this->conn->prepare("DELETE FROM `capital_share` WHERE `capital_share_id` = '$capital_share_id'") or die($this->conn->error);
		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}

}

?>