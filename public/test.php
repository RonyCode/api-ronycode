<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

//Load Composer's autoloader
require '../vendor/autoload.php';

//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
//    $mail->SMTPDebug = 4;
    $mail->isSMTP();
    $mail->Host = HOST_MAIL;
    $mail->SMTPAuth = true;
    $mail->Username = USER_MAIL;
    $mail->Password = PASS_MAIL;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = PORT_MAIL;
    $mail->setLanguage('pt-br');
    $mail->CharSet = 'UTF-8';

    //Recipients
    $mail->setFrom(FROM_EMAIL_MAIL, FROM_NAME_MAIL);
    $mail->addAddress('espaco.educar.palmas@gmail.com', 'RonyCode');     //Add a recipient
//    $mail->addAddress('ellen@example.com');               //Name is optional
//    $mail->addReplyTo('info@example.com', 'Information');
//    $mail->addCC('cc@example.com');
//    $mail->addBCC('bcc@example.com');


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = SUBJET_MAIL;
    $mail->Body = BODY;
    $mail->AltBody = ALT_BODY;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}



