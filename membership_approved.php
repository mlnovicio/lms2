<?php

include 'connectMySql.php';

$sql = "UPDATE `membership` SET `status`='3' WHERE `membership_id`='".$_COOKIE['membership_id']."'";
$result = mysqli_query($conn,$sql);


$query = "SELECT * FROM `membership`  WHERE `membership_id`='".$_COOKIE['membership_id']."'";
$result1 = $conn->query($query);
while($row = $result1->fetch_assoc())
{
$username = $row['email'];
$password = '123';
$firstname = $row['name'];
$middlename = '';
$lastname = '';
$email =  $row['email'];
$address =  $row['address'];
date_default_timezone_set('Asia/Manila');
$date = date('Y/m/d H:i:s');
$mem_fee = 1;
$sql = "INSERT INTO `user` (`username`, `password`, `firstname`,`middlename`, `lastname`,`email`, `user_type`,`is_mem_fee_paid`,`registration_date`,`address`) 
VALUES ('". $username ."','". $password ."','". $firstname ."','". $middlename ."', '". $lastname ."','". $email ."', '3', '".$mem_fee."', '".$date."', '".$address."')";
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
 require_once('PHPMailer/PHPMailerAutoload.php');
   
   //use PHPMailer\PHPMailer\PHPMailer;
   $mail = new PHPMailer;
   $mail->isSMTP();
   //$mail->SMTPDebug = 2;
   $mail->Host = 'smtp.gmail.com';
   $mail->Port = 587;
   $mail->SMTPAuth = true;
   $mail->Username = 'sender.otp100@gmail.com';
   $mail->Password = 'usximldwktdiiwbs';
   $mail->setFrom('sender.otp100@gmail.com', 'LUECCO');
   $mail->addReplyTo('sender.otp100@gmail.com', 'SENDER');
   $mail->addAddress($email, 'Receiver Name');
   $mail->Subject = 'APPROVED';
   $mail->Body = 
   'YOUR MEMBERSHIP SUBSCRTION IS APPROVED
   USERNAME: '.$username .'
   PASSWORD: '.$password .'';
   if (!$mail->send()) {
       echo 'Email not valid : ' . $mail->ErrorInfo;
       return;
   } else {
       echo 'The email is sent.';
   }

    include 'user.php';
}










    
?>
