<?php
require_once './services/createUser.php';
require_once './services/sendEmail.php';
require_once './services/generateEmailVerificationLink.php';

require "../../loadEnvVar.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  $smtpAuthUsername = $_ENV['MAILING_USERNAME'];
  $smtpAuthPassword = $_ENV['MAILING_PASSWORD'];

  $requestURI = $_SERVER['REQUEST_URI'];
  $tokens = explode("/", $requestURI);
  $tokens[count($tokens) - 1] = 'handleEmailVerification.php';
  $verifyEmailURI = implode("/", $tokens);

  $host = $_SERVER['HTTP_HOST'];
  $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://';

  $verifyEmailURL = $protocol . $host . $verifyEmailURI;

  require_once "../config/databaseConn.php";
  createUser($conn, $username, $email, $password);

  $link = generateEmailVerificationLink($username, $email, $verifyEmailURL);

  $sendMail = mailerObjFactory(
    $smtpAuthUsername, 
    $smtpAuthPassword, 
    'goalprogresstracker2022@gmail.com', 
    'Goal Progress Tracker Support', 
    'goalprogresstracker2022@gmail.com', 
    'Goal Progress Tracker Support', 
    $username, 
    $email
  );

  $subject = "Welcome to Goal Progress Tracker";

  $body = "Please verify your account here $link";
  
  $altBody = "Copy and paste this link to the browser: $link";

  header("Location: ../email-verification.html");

  if($sendMail(
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
