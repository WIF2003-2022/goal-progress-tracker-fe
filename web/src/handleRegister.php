<?php
require_once @realpath(dirname(__FILE__) .'/services/createUser.php');
require_once @realpath(dirname(__FILE__) .'/services/sendEmail.php');
require_once @realpath(dirname(__FILE__) .'/services/generateEmailVerificationLink.php');

require "../../loadEnvVar.php";
require @realpath(dirname(__FILE__) . "/services/checkIsSetAndNotEmpty.php");

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (!isset($_POST['_token']) || $_POST['_token'] !== $_SESSION['_token']) {
    http_response_code(403);
    die("Invalid CSRF token");
  }
  if (!checkIsSetAndNotEmpty($_POST, ['username', 'email', 'password'])) {
    http_response_code(400);
    die("Some of the fields are not provided.");
  }
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  $smtpAuthUsername = $_ENV['MAILING_USERNAME'];
  $smtpAuthPassword = $_ENV['MAILING_PASSWORD'];

  $requestURI = $_SERVER['REQUEST_URI'];
  $tokens = explode("/", $requestURI);
  $tokens[count($tokens) - 1] = 'handleEmailVerification.php';
  $verifyEmailURI = implode("/", $tokens);
  unset($tokens[count($tokens) - 1]);
  unset($tokens[count($tokens) - 1]);
  $documentRootPath = implode("/", $tokens);

  $host = $_SERVER['HTTP_HOST'];
  $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://';

  $verifyEmailURL = $protocol . $host . $verifyEmailURI;

  require_once "../config/databaseConn.php";
  try {
    createUser($conn, $username, $email, $password);
    echo json_encode('');
  } catch (Exception $e) {
    http_response_code(500);
    die("Register failed. Please try again later.");
  }

  $link = generateEmailVerificationLink($username, $email, $verifyEmailURL);

  $sendMail = mailerObjFactory(
    $smtpAuthUsername, 
    $smtpAuthPassword, 
    'goalprogresstracker2022@gmail.com', 
    'Goal Progress Tracker Support', 
    'goalprogresstracker2022@gmail.com', 
    'Goal Progress Tracker Support', 
    $username, 
    $email,
    true
  );

  $subject = "Welcome to Goal Progress Tracker";
  $templateFileName = "../email_templates/verify-email-template.html";
    $context = array("LINK" => $link, "REQUEST_ORIGIN" => $protocol.$host.$documentRootPath);
  $altBody = "Copy and paste this link to the browser: $link";
  $imgFileName = "email.png";
  $imgCid = "email";

  if(!$sendMail(
    $subject,
    $templateFileName,
    $context,
    $altBody,
    $imgFileName,
    $imgCid
  ))
  {
    http_response_code(500);
    die("We are not able to send you the verification email. Please contact the administrator for assistance.");
  }

}