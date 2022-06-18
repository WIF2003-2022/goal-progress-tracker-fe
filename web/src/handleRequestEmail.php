<?php

require_once @realpath(dirname(__FILE__) . "/services/findUser.php");
require_once @realpath(dirname(__FILE__) . "/../config/databaseConn.php");
require_once @realpath(dirname(__FILE__) . "/services/generateResetPasswordLink.php");
require_once @realpath(dirname(__FILE__) . "/services/sendEmail.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
  $email = $_POST['email'];

  try {
    $user = findUserByEmail($conn, $email);

    if (!$user) {
      http_response_code(404);
      die('You might not have an account with this email address. Create one now!');
    }

    $requestURI = $_SERVER['REQUEST_URI'];
    $tokens = explode("/", $requestURI);
    $tokens[count($tokens) - 2] = 'forgot-password.php';
    unset($tokens[count($tokens) - 1]);
    $resetPasswordURI = implode("/", $tokens);
  
    $host = $_SERVER['HTTP_HOST'];
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://';
  
    $resetPasswordURL = $protocol . $host . $resetPasswordURI;
  
    $resetPasswordLink = generateAndSaveResetPasswordLink($user['user_id'], $user['name'], $user['email'], $resetPasswordURL);
  
    $mailingEmail = $_ENV['MAILING_USERNAME'];
    $mailingPassword = $_ENV['MAILING_PASSWORD'];
  
    $mailer = mailerObjFactory(
      $mailingEmail,
      $mailingPassword,
      $mailingEmail,
      'Goal Progress Tracker Support',
      $mailingEmail,
      'Goal Progress Tracker Support',
      $user['name'],
      $user['email'],
    );
  
    $subject = "Reset your password";
    $body = "You have requested to reset your password. Go to this link to proceed $resetPasswordLink";
    $altBody = "Reset your password";
  
    if(!$mailer(
      $subject,
      $body,
      $altBody
    ))
    {
      error_log('Mailer Error: ' . $mail->ErrorInfo);
      http_response_code(500);
      die("We are not able to send email to you for the moment.");
    }
    echo json_encode("");
  } catch (Exception $e) {
    http_response_code(500);
    die("We are not able to reset your password for the moment. Please try again later.");
  }
}

?>
