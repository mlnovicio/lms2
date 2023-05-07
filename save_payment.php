<?php
include 'connectMySql.php';
$type_of_payment = $_POST['type_of_payment'];
$payee_id = $_POST['payee_id'];
$amount = $_POST['amount'];
date_default_timezone_set('Asia/Manila');
$date = date('Y/m/d H:i:s');
$ref_no = rand(100000,999999);
$status = 1;

$sql = "INSERT INTO `payment_list` (`ref_no`, `type_of_payment`, `payee_id`,`amount`, `date`,`status`) 
VALUES ('". $ref_no ."','". $type_of_payment ."','". $payee_id ."','". $amount ."','". $date ."','".$status."')";
$result = mysqli_query($conn,$sql);

if($type_of_payment == 'LOAN')
{

    $query = "SELECT * FROM loans where user_id = '". $payee_id ."' ORDER BY loan_id DESC limit 1";
    $result = $conn->query($query);
    while($row = $result->fetch_assoc())
    {
        $new_payment = $row['payments'] + $amount;
        $sql = "UPDATE `loans` SET `payments`='".$new_payment."' WHERE loan_id=".$row['loan_id']."";
        $result1 = mysqli_query($conn,$sql);
    }

}

echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <body onload='save()'></body>
    <script> 
    function save(){
    Swal.fire(
         'Paid!',
         '',
         'success'
       )
    }</script>";
include('payment.php');
?>