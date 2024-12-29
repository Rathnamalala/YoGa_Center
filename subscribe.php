<?php
header('Content-Type: application/json');

require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $email = htmlspecialchars($input['email']);

    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = "kanchanasaranga11@gmail.com"; // Your Gmail address
        $mail->Password = "bvikpzytxegjbkme"; // Your Gmail app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender and recipient settings
        $mail->setFrom('kanchanasaranga11@gmail.com', 'Subscription Service');
        $mail->addAddress("kanchanasaranga33@gmail.com", "Admin"); // Your email to receive the subscriptions

        // Email content
        $mail->isHTML(true);
        $mail->Subject = "New Subscription Request";
        $mail->Body = "
            <h2>New Subscription</h2>
            <p><strong>Email:</strong> $email</p>
        ";

        $mail->send();
        echo json_encode(["status" => "success", "message" => "Thank you for subscribing!"]);
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => "Error sending subscription: " . $mail->ErrorInfo]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}
