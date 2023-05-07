<?php
include 'connectMySql.php';
date_default_timezone_set('Asia/Manila');

$processor1= 'MS.CHRISNA FUCIO';
$processor2='MS.CHRISNA FUCIO';
$date = date('Y/m/d H:i:s');

$sql = "UPDATE `loans` SET `processor1`='".$processor1."',`processor2`='".$processor1."',`status`='ON PROCESS' WHERE loan_id=".$_COOKIE['loan_id']."";
$result = mysqli_query($conn,$sql);
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <body onload='save()'></body>
    <script> 
    function save(){
    Swal.fire(
         'Status updated!',
         '',
         'success'
       )
    }</script>";
    include 'loan.php';
?>