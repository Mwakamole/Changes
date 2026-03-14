<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Point directly to the files inside your src folder
require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = new PHPMailer(true);

    try {
        // --- Server Settings ---
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'mwakamoledaniel@gmail.com'; // Your Gmail
        $mail->Password   = 'ihyy nqpz xszb zydj';   // Your 16-character App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // --- Recipients ---
        $mail->setFrom($_POST['email'], $_POST['name']);
        $mail->addAddress('mwakamoledaniel@gmail.com'); 

        // --- Content ---
        $mail->isHTML(false); 
        $mail->Subject = $_POST['subject'];
        $mail->Body    = "Name: " . $_POST['name'] . "\n" .
                         "Email: " . $_POST['email'] . "\n\n" .
                         "Message:\n" . $_POST['message'];

        $mail->send();
        echo "Message sent successfully!";
    } catch (Exception $e) {
        echo "Message failed to send. Error: {$mail->ErrorInfo}";
    }
}
?>