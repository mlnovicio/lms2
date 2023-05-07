  <?php
 $to = "omnirayventures01@gmail.com";
$subject = 'Test email';
$message = 'This is a test email sent using PHP mail() function';
$headers = 'From: sender@example.com' . "\r\n" .
           'Reply-To: sender@example.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

if (mail($to, $subject, $message, $headers)) {
    echo 'Email sent successfully.';
} else {
    echo 'Email could not be sent.';
}
?>
