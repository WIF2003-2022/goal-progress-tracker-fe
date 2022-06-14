<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require @realpath(dirname(__FILE__) . '/../../../vendor/autoload.php');

$mail;

function mailerObjFactory(
    $email, 
    $password, 
    $senderEmail, 
    $senderName, 
    $replyToEmail, 
    $replyToName,
    $recipientName,
    $recipientEmail
) {
    global $mail;

    $mail = new PHPMailer();

    //Tell PHPMailer to use SMTP
    $mail->isSMTP();

    //Enable SMTP debugging
    //SMTP::DEBUG_OFF = off (for production use)
    //SMTP::DEBUG_CLIENT = client messages
    //SMTP::DEBUG_SERVER = client and server messages
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;

    //Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';
    //Use `$mail->Host = gethostbyname('smtp.gmail.com');`
    //if your network does not support SMTP over IPv6,
    //though this may cause issues with TLS

    //Set the SMTP port number:
    // - 465 for SMTP with implicit TLS, a.k.a. RFC8314 SMTPS or
    // - 587 for SMTP+STARTTLS
    $mail->Port = 465;

    //Set the encryption mechanism to use:
    // - SMTPS (implicit TLS on port 465) or
    // - STARTTLS (explicit TLS on port 587)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;

    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = $email;

    //Password to use for SMTP authentication
    $mail->Password = $password;

    //Set who the message is to be sent from
    //Note that with gmail you can only use your account address (same as `Username`)
    //or predefined aliases that you have configured within your account.
    //Do not use user-submitted addresses in here
    $mail->setFrom($senderEmail, $senderName);

    //Set an alternative reply-to address
    //This is a good place to put user-submitted addresses
    $mail->addReplyTo($replyToEmail, $replyToName);

    //Set who the message is to be sent to
    $mail->addAddress($recipientEmail, $recipientName);

    
    return function($subject, $body, $altBody) {
        
        global $mail;
        //Set the subject line
        $mail->Subject = $subject;

        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        // $mail->msgHTML(file_get_contents('contents.html'), __DIR__);
        $mail->Body = $body;

        //Replace the plain text body with one created manually
        $mail->AltBody = $altBody;

        //Attach an image file
        // $mail->addAttachment('images/phpmailer_mini.png');

        //send the message, check for errors
        return $mail->send();
    };
}
