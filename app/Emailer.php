<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
namespace App;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Emailer {

// Instantiation and passing `true` enables exceptions
    private $mail;

    function __construct() {
        $this->mail = new PHPMailer(true);
        //Server settings
        $this->mail->SMTPDebug = 0;                      
        // Enable verbose debug output
        $this->mail->isSMTP();                                            // Send using SMTP
        $this->mail->Host = env('MAIL_HOST');                    // Set the SMTP server to send through
        $this->mail->SMTPAuth = true;                                // Enable SMTP authentication
        $this->mail->Username = env('MAIL_USERNAME');                     // SMTP username
        $this->mail->Password = env('MAIL_PASSWORD');                               // SMTP password
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $this->mail->Port = env('MAIL_PORT');   
        
        $this->mail->CharSet = 'UTF-8';
        $this->mail->Encoding = 'base64';
    }

    function sendEmail($sendTo, $subject, $body) {

        try {
        //Recipients
        $this->mail->setFrom(env('MAIL_USERNAME'), 'Savex');
        // $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
        $this->mail->addAddress($sendTo);               // Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        // Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        // $mail->isHTML(true);                                  // Set email format to HTML
        $this->mail->Subject = $subject;
        $this->mail->Body    = $body;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $this->mail->send();

        } catch (Exception $e) {

        }
    }
}