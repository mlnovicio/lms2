<?php
require_once '../session.php';
user();
require_once '../class.php';
$db = new db_class();
$id = $_SESSION['user_id'];
include '../connectMySql2.php';
date_default_timezone_set('Asia/Manila');

$loanInstance = $_POST['loanInstance'];
$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$middlename= $_POST['middlename'];
$address= $_POST['address'];
$contact_no= $_POST['contact_no'];
$loanType= $_POST['loanType'];
$paymentTerms= $_POST['paymentTerms'];
$comaker1= $_POST['comaker1'];
$comaker2= $_POST['comaker2'];
$home1= $_POST['home1'];
$home2= $_POST['home2'];
$compute1= $_POST['compute1'];
$compute2= $_POST['compute2'];
$compute3= $_POST['compute3'];
$compute4= $_POST['compute4'];
$compute5= $_POST['compute5'];
$processor1= $_POST['processor1'];
$processor2= $_POST['processor2'];
$admin1= $_POST['admin1'];
$admin2= $_POST['admin2'];
$input1 = $_POST['input1'];
$user_id = $_SESSION['user_id'];
$date = date('Y/m/d H:i:s');

$sql = "INSERT INTO `loans` 
(
   	is_new,
	lastname,
	firstname,
	middlename,
	address,
	contact_no,
	type_of_loan,
	term_of_payment,
	input1,
	comaker1,
	comaker2,
	home1,
	home2,
	compute1,
	compute2,
	compute3,
	compute4,
	compute5,
	processor1,
	processor2,
	admin1,
	admin2,
	date,
	user_id
) 
VALUES (
	'".$loanInstance."',
	'".$lastname."',
	'".$firstname."',
	'".$middlename."',
	'".$address."',
	'".$contact_no."',
	'".$loanType."',
	'".$paymentTerms."',
	'".$input1."',
	'".$comaker1."',
	'".$comaker2."',
	'".$home1."',
	'".$home2."',
	'".$compute1."',
	'".$compute2."',
	'".$compute3."',
	'".$compute4."',
	'".$compute5."',
	'".$processor1."',
	'".$processor2."',
	'".$admin1."',
	'".$admin2."',
	'".$date."',
	'".$user_id."'

)";
$result = mysqli_query($conn,$sql);


$loan_id = "0";
$query = "SELECT * FROM `loans` a order by loan_id desc limit 1";
$result1 = $conn->query($query);
while($row = $result1->fetch_assoc())
{
	$loan_id = $row['loan_id'];
}


$sql = "INSERT INTO `loan_comaker` 
(
	comaker_id,
	loan_id
) 
VALUES (
	'".$comaker1."',
	'".$loan_id."'
	
)";
$result2 = mysqli_query($conn,$sql);

$sql = "INSERT INTO `loan_comaker` 
(
	comaker_id,
	loan_id
) 
VALUES (
	'".$comaker2."',
	'".$loan_id."'
	
)";
$result2 = mysqli_query($conn,$sql);



echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <body onload='save()'></body>
    <script> 
    function save(){
    Swal.fire(
         'Registered!',
         '',
         'success'
       )
    }</script>";
    include 'loan.php';
?>