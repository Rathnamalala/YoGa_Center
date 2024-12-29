<?php

$name = $_POST["name"];
$email = $_POST["email"];
$subject = $_POST["subject"];
$message = $_POST["message"];

require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

// $mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com"; // Updated SMTP host
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // STARTTLS encryption
$mail->Port = 587; // Port for STARTTLS

$mail->Username = "kanchanasaranga11@gmail.com";
$mail->Password = "bvikpzytxegjbkme"; // Ensure your app password is correct

$mail->setFrom($email, $name);
$mail->addAddress("kanchanasaranga33@gmail.com", "Dave");

$mail->Subject = $subject;
$mail->Body = $message;

if ($mail->send()) {
    header("Location: contact.html?status=success"); // Redirect with success message
    exit();
} else {
    header("Location: contact.html?status=error"); // Redirect with error message
    exit();
}



?>
