<?php

require_once @realpath(dirname(__FILE__) . '/services/decodeJWT.php');
require_once @realpath(dirname(__FILE__) . '/services/updateUser.php');
require_once @realpath(dirname(__FILE__) . "/services/checkIsSetAndNotEmpty.php");

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['password']) && isset($_GET['token'])) {
  if (!isset($_POST['_token']) || $_POST['_token'] !== $_SESSION['_token']) {
    http_response_code(403);
    die("Invalid CSRF token");
  }
  if (!checkIsSetAndNotEmpty($_POST, ['password']) && !checkIsSetAndNotEmpty($_GET, ['token'])) {
    header("Location: ../email-verification-failed.html");
  }
  $jwt = $_GET['token'];
  $password = $_POST['password'];

  try {
    $payload = decodeJWT($jwt);
    $jwtExpiry = $payload->exp;
  
    if ($jwtExpiry - time() > 0) {
      if (updateUserPassword($payload->preferred_username, $payload->email, $password, $jwt)) { 
        header("Location: " . "../reset-password-success.html");
        exit();
      }
    } else {
      error_log("JWT not valid");
    }
  } catch (Exception $e) {
    http_response_code(500);
    header("Location: " . "../reset-password-failed.html");
    exit();
  }
}
http_response_code(500);
header("Location: " . "../reset-password-failed.html");
