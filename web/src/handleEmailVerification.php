<?php
require_once @realpath(dirname(__FILE__) . "/services/decodeJWT.php");
require_once @realpath(dirname(__FILE__) . "/services/verifyEmail.php");

if (isset($_GET['token'])) {
  $jwt = $_GET['token'];
  try {
    $payload = decodeJWT($jwt);
    $jwtExpiry = $payload->exp;
    
    if ($jwtExpiry - time() > 0) {
      if (verifyEmail($payload->preferred_username, $payload->email)) {
        header("Location: " . "../email-verification-success.html");
        exit();
      }
    } else {
      error_log("JWT not valid");
    }
  } catch (Exception $e) {
    http_response_code(500);
    header("Location: " . "../email-verification-failed.html");
    exit();
  }
  
}

http_response_code(500);
header("Location: " . "../email-verification-failed.html");
