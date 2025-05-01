<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Or use path to PHPMailer if not using Composer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $_POST['name'] ?? '';
    $email   = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';
    $datetime = $_POST['datetime'] ?? '';
    $select1 = $_POST['select1'] ?? '';



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
        // Set email format to HTML
        $mail->isHTML(true);
        $mail->Subject = $subject;
        // Email body in HTML format
        $mail->Body = "
                        <!DOCTYPE html>
                        <html>
                        <head>
                        <meta charset='UTF-8'>
                        </head>
                        <body>
                        <table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse; width: 100%; font-family: Arial, sans-serif;'>
                            <tr style='background-color: #f2f2f2;'>
                                <th align='left'>Name</th>
                                <td>$name</td>
                            </tr>
                            <tr>
                                <th align='left'>Email</th>
                                <td>$email</td>
                            </tr>
                            <tr style='background-color: #f2f2f2;'>
                                <th align='left'>Message</th>
                                <td>$message</td>
                            </tr>
                            <tr>
                                <th align='left'>Datetime</th>
                                <td>$datetime</td>
                            </tr>
                            <tr style='background-color: #f2f2f2;'>
                                <th align='left'>Designation</th>
                                <td>$select1</td>
                            </tr>
                        </table>
                        </body>
                        </html>
                        ";
        $mail->send();
        // Redirect with success flag
        header("Location: package.html?success=1");
        exit();
        echo "Message has been sent successfully!";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
