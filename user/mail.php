<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<?php
session_start();
require_once'../class.php';
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
$mail2 = new PHPMailer(true);

if (isset($_GET['email']) && isset($_GET['unid']) ) {




// try {
    //Server settings

    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'epportal8@gmail.com';                     //SMTP username
    $mail->Password   = 'lnnhdgssianqgncm';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('epportal8@gmail.com', 'Loan Application');
    // $mail->addAddress('tester naten');               //Name is optional


      

        $recipent= htmlentities($_GET['email']);
        $id= htmlentities($_GET['unid']);
        $mail->Body    = 'If you are a Comaker on this application <b>#'.$id.'#</b><br>
        <a href="http://localhost/LMS/user/verify.php?email='.$recipent.'&uid='.$id.'">Click Here</a> If not Ignore this email Thankyou.';
        $mail->addAddress($recipent, 'User');     //Add a recipient
        $mail->addReplyTo($recipent, 'Information');
        $mail->addCC('cc@example.com');
        $mail->addBCC('bcc@example.com');
        $mail->isHTML(true); 
        $mail->Subject = 'Loan Application(Comaker)';
        $mail->send();


        $mail2->isSMTP();                                            //Send using SMTP
        $mail2->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail2->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail2->Username   = 'epportal8@gmail.com';                     //SMTP username
        $mail2->Password   = 'lnnhdgssianqgncm';                               //SMTP password
        $mail2->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail2->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail2->setFrom('epportal8@gmail.com', 'Loan Application');
        $recipent=htmlentities($_GET['email2']);
        $id=htmlentities($_GET['unid2']);
        $mail2->Body    = 'If you are a Comaker on this application <b>#'.$id.'#</b><br>
        <a href="http://localhost/LMS/user/verify.php?email2='.$recipent.'&uid2='.$id.'">Click Here</a> If not Ignore this email Thankyou.';
        $mail2->addAddress($recipent, 'User');     //Add a recipient
        $mail2->addReplyTo($recipent, 'Information');
        $mail2->addCC('cc@example.com');
        $mail2->addBCC('bcc@example.com');
        $mail2->isHTML(true); 
        $mail2->Subject = 'Loan Application(Comaker)';
        $mail2->send();
    

    echo ("<script LANGUAGE='JavaScript'>
			window.location.href='loan.php';
			</script>");
					
// } catch (Exception $e) {
//     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
// }
}else{
    
    echo ("<script LANGUAGE='JavaScript'>
			window.location.href='loan.php';
			</script>");
					
}
?>
