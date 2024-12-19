<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    if (!$name || !$email || !$subject || !$message) {
        header("Location: contact.php?error=Please fill all fields correctly.");
        exit();
    }

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'kanchanasaranga11@gmail.com'; // Your Gmail email
        $mail->Password   = 'yoozbtjcobmrmjvp'; // Replace with your Gmail App password or token
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Recipient settings
        $mail->setFrom($email, $name);
        $mail->addAddress('kanchanasaranga11@gmail.com');
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        header("Location: contact.php?success=Your message was sent successfully.");
    } catch (Exception $e) {
        header("Location: contact.php?error=Unable to send your message. Error: " . $mail->ErrorInfo);
    }
}
?>
