<?php
require_once 'class.php';
if (isset($_POST['update'])) {
	$db = new db_class();
	$user_id = $_POST['user_id'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$mem_fee = isset($_POST['mem-fee-update']) && $_POST['mem-fee-update'] == 1 ? 1 : 0;
	$success = $db->update_user($user_id, $username, $password, $firstname, $lastname, $mem_fee);
	header("location: user.php?user_updated=" . $success);
}
?>