<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Or use path to PHPMailer if not using Composer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $_POST['name'] ?? '';
    $email   = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';



    $mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'karthismart2412@gmail.com';
    $mail->Password   = 'xxnitxbygkkehxra';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom('sriannamalai2003@gmail.com', 'Website Contact Form');
    $mail->addReplyTo($email, $name); // Safe way to use user's input

    $mail->addAddress('sriannamalai2003@gmail.com');
    $mail->Subject = $subject;
    $mail->Body    = "Name: $name\nEmail: $email\n\nMessage:\n$message";

    $mail->send();
         // Redirect with success flag
         header("Location: contact.html?success=1");
         exit();
    echo "Message has been sent successfully!";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}
?>
