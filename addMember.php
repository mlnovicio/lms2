<?php
include 'connectMySql.php';
$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$bday= $_POST['bday'];
$bplace= $_POST['bplace'];
$age= $_POST['age'];
$gender= $_POST['gender'];
$civil_status= $_POST['civil_status'];
$married_info= $_POST['married_info'];
$education= $_POST['education'];
$department= $_POST['department'];
$position= $_POST['position'];
$salary= $_POST['salary'];
$other_source= $_POST['other_source'];
$monthly_income= $_POST['monthly_income'];
$nearest_relative= $_POST['nearest_relative'];
$relation = $_POST['relation'];
$dependents= $_POST['dependents'];
$religion= $_POST['religion'];
$name_dependents= $_POST['name_dependents'];
$tin= $_POST['tin'];
$input1= $_POST['input1'];
$input2= $_POST['input2'];
$input3= $_POST['input3'];
$input4= $_POST['input4'];
$secretary= $_POST['secretary'];
$amount1= $_POST['amount1'];
$amount2= $_POST['amount2'];
$date1= $_POST['date1'];
$date2= $_POST['date2'];
$date3= $_POST['date3'];
$printed_name= $_POST['printed_name'];
date_default_timezone_set('Asia/Manila');
$date = date('Y/m/d H:i:s');
$sql = "INSERT INTO `membership` 
(
   	name,
	email,
	address,
	bday,
	bplace,
	age,
	gender,
	civil_status,
	married_info,
	education,
	department,
	postion,
	salary,
	other_source,
	monthly_income,
	nearest_relative,
	relation,
	dependents,
	religion,
	name_dependents,
	tin,
	input1,
	input2,
	input3,
	input4,
	secretary,
	amount1,
	amount2,
	date1,
	date2,
	date3,
	printed_name,
	date
) 
VALUES (
	'".$name."',
	'".$email."',
	'".$address."',
	'".$bday."',
	'".$bplace."',
	'".$age."',
	'".$gender."',
	'".$civil_status."',
	'".$married_info."',
	'".$education."',
	'".$department."',
	'".$position."',
	'".$salary."',
	'".$other_source."',
	'".$monthly_income."',
	'".$nearest_relative."',
	'".$relation."',
	'".$dependents."',
	'".$religion."',
	'".$name_dependents."',
	'".$tin."',
	'".$input1."',
	'".$input2."',
	'".$input3."',
	'".$input4."',
	'".$secretary."',
	'".$amount1."',
	'".$amount2."',
	'".$date1."',
	'".$date2."',
	'".$date3."',
	'".$printed_name."',
	'".$date."'
)";
$result = mysqli_query($conn,$sql);
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
    include 'index.php';
?>