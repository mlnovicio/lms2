<?php
include 'connectMySql.php';
require_once 'class.php';
session_start();

if (isset($_POST['login'])) {

	$db = new db_class();
	$username = $_POST['username'];
	$password = $_POST['password'];
	$get_id = $db->login($username, $password);

	echo var_dump($get_id);

	if ($get_id['count'] > 0) {

		$_SESSION['user_id'] = $get_id['user_id'];
		$_SESSION['user_type'] = $get_id['user_type'];
		unset($_SESSION['message']);
		if ($get_id['user_type'] == 1) {
			// echo"<script>alert('Login Successful')</script>";
			// echo "<script>window.location='home.php'</script>";
			header("Location: home.php");
		} else if ($get_id['user_type'] == 2) {
			// echo"<script>alert('Login Successful')</script>";
			// echo "<script>window.location='home.php'</script>";
			header("Location: home.php");
		} else if ($get_id['user_type'] == 3) {
			// echo"<script>alert('Login Successful')</script>";
			// echo "<script>window.location='user/home.php'</script>";

			$sum = "";
			
			$query = "SELECT count(payment_id) as count,sum(amount) as amount FROM `payment_list`
			WHERE type_of_payment = 'CAPITAL SHARE' and payee_id = '".$_SESSION['user_id']."'";
			$result = $conn->query($query);
			while($row = $result->fetch_assoc())
			{
			 if($row['amount'] == 0 || $row['amount'] == '' || $row['amount'] == null )
			 {
				$sum = 0;
			 }
			 else
			 {
				$sum = $row['amount'];
			 }
			}
			setcookie("total_share",$sum);
			header("Location: user/home.php");
		}
		else if ($get_id['user_type'] == 4) {
			// echo"<script>alert('Login Successful')</script>";
			// echo "<script>window.location='home.php'</script>";
			header("Location: home.php");


		}
	} else {
		$_SESSION['message'] = "Invalid Username or Password";

		// echo "<script>window.location='index.php'</script>";
		header("Location:index.php");
	}
}
?>