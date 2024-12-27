<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Basic validation
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        header("Location: contact.php?error=All fields are required!");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: contact.php?error=Invalid email format!");
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'kanchanasaranga11@gmail.com'; // Your Gmail address
        $mail->Password = 'yoozbtjcobmrmjvp'; // Your App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email settings
        $mail->setFrom($email, $name);
        $mail->addAddress('kanchanasaranga11@gmail.com'); // Your recipient email
        $mail->Subject = $subject;
        $mail->Body = "
            You have received a new message from the contact form.\n\n
            Name: $name\n
            Email: $email\n
            Subject: $subject\n
            Message:\n$message
        ";
        $mail->AltBody = "Name: $name\nEmail: $email\nSubject: $subject\nMessage:\n$message";

        $mail->send();
        header("Location: contact.php?success=Message sent successfully!");
    } catch (Exception $e) {
        header("Location: contact.php?error=Message could not be sent. Mailer Error: " . $mail->ErrorInfo);
    }
}
?>
