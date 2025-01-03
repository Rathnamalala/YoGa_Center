<?php
header('Content-Type: application/json');

require "vendor/autoload.php"; // Adjust path as needed

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $review = htmlspecialchars($_POST['review']);

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP host
        $mail->SMTPAuth = true;

        $mail->Username = "indikayoga@gmail.com";
        $mail->Password = "lxyseimaszuzuare"; // Ensure your app password is correct
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender and recipient settings
        $mail->setFrom($email, $name);
        $mail->addAddress("indikayoga@gmail.com", "IndikaYoga");

        // Email content
        $mail->isHTML(true);
        $mail->Subject = "New Review Submitted by $name";
        $mail->Body = "
            <h2>New Review</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Review:</strong><br>$review</p>
        ";

        $mail->send();
        echo json_encode(["status" => "success", "message" => "Thank you for your review!"]);
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => "Error sending email: " . $mail->ErrorInfo]);
    }
}
