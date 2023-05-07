<?php
$servername = "localhost"; 
$username = "root";
$password = "";
$db = "db_lms";
$conn = mysqli_connect($servername, $username, $password,$db);
// Check connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['password'])){


$password = $_POST['password'];
$user_id = $_POST['user_id'];
$sql = "UPDATE `user` SET `password`='".$password ."' WHERE `user_id`='".$user_id."'";
$result = mysqli_query($conn,$sql);
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <body onload='save()'></body>
    <script> 
    function save(){
    Swal.fire(
         'Password changed!',
         '',
         'success'
       )
    }</script>";
include('password.php');
}
?>
