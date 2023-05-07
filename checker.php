<?php date_default_timezone_set("Etc/GMT+8");


include 'connectMySql.php';
$query = "SELECT * FROM user 
WHERE email = '".$_POST['email']."'";
$result = $conn->query($query);
if ($result->num_rows <= 0) 
{
  echo '<p style="color:black">Account not found please enter valid email </p> <a class="btn btn-danger"href="index.php">OK</a>';
  return;
}
else
{
    $email='';
    $query = "SELECT * FROM user 
    WHERE email = '".$_POST['email']."'";
    $result1 = $conn->query($query);
    while($row = $result1->fetch_assoc())
    {
        $sql = "UPDATE `user` SET `password`='".$_POST['otp']."' WHERE user_id=".$row['user_id']."";
        $result = mysqli_query($conn,$sql);

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
   $mail->addAddress($row['email'], 'Receiver Name');
   $mail->Subject = 'CHANGE PASSWORD';
   $mail->Body = 
   'YOUR TEMPORARY PASSWORD PLEASE CHANGE YOUR PASSWORD ONCE LOGIN :
   USERNAME: '.$row['username'] .'
   PASSWORD: '.$_POST['otp'] .'';
   if (!$mail->send()) {
       echo 'Email not valid : ' . $mail->ErrorInfo;
       return;
   } else {
       echo 'The email is sent.';
   }
    }
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <body onload='save()'></body>
    <script> 
    function save(){
    Swal.fire(
         'Please check your email!',
         '',
         'success'
       )
    }</script>";
    include 'index.php';
}
 ?>
