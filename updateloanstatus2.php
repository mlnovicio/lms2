<?php
include 'connectMySql.php';
date_default_timezone_set('Asia/Manila');

$admin1= 'Marlon Atanacio';
$admin2 = 'Marlon Atanacio';
$status = $_POST['status'];
$sql = "UPDATE `loans` SET `admin1`='".$admin1."',`admin2`='".$admin2."',`status`='".$status."' WHERE loan_id=".$_COOKIE['loan_id']."";
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