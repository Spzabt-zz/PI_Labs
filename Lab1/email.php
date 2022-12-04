<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

$mail = new PHPMailer(true);

$address = htmlspecialchars($_POST['email']);
$massage = htmlspecialchars($_POST['message']);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'stoida.bohdan1119@vu.cdu.edu.ua';
    $mail->Password = 'password';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->setFrom('stoida.bohdan1119@vu.cdu.edu.ua', 'Bohdan Stoida');
    $mail->addAddress($address);
    $mail->Subject = 'Message';
    $mail->Body = $massage;
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
