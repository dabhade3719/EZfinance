<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    if (!empty($name) && !empty($email) && !empty($message)) {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'yash.gadhave0205@gmail.com'; // Replace with your Gmail ID
            $mail->Password = 'dpel cwtx xzmh kuqf'; // Replace with your Gmail App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom($email, $name);
            $mail->addAddress('yash.gadhave0205@gmail.com'); // Replace with your Gmail ID to receive feedback

            $mail->isHTML(true);
            $mail->Subject = 'New EZfinance Feedback';
            $mail->Body = "<strong>Name:</strong> $name <br>
                          <strong>Email:</strong> $email <br>
                          <strong>Message:</strong> $message";

            $mail->send();
            echo "<script>alert('Feedback Sent Successfully!'); window.location.href='feedback.html';</script>";
        } catch (Exception $e) {
            echo "<script>alert('Error: Could not send feedback. Try again later.'); window.location.href='feedback.html';</script>";
        }
    } else {
        echo "<script>alert('All fields are required!'); window.location.href='feedback.html';</script>";
    }
} else {
    header("Location: feedback.html");
    exit();
}
?>
