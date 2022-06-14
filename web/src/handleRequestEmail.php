<?php

require_once @realpath(dirname(__FILE__) . "/services/findUser.php");
require_once @realpath(dirname(__FILE__) . "/../config/databaseConn.php");
require_once @realpath(dirname(__FILE__) . "/services/generateResetPasswordLink.php");
require_once @realpath(dirname(__FILE__) . "/services/sendEmail.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
  $email = $_POST['email'];

  $user = findUserByEmail($conn, $email);

  if (!$user) {
    exit();
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

  header("Location: ../login.php");

  if(!$mailer(
    $subject,
    $body,
    $altBody
  ))
  {
      echo 'Mailer Error: ' . $mail->ErrorInfo;
  } else {
      echo 'Message sent!';
  }
}

?>
