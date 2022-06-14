<?php
require_once @realpath(dirname(__FILE__) . "/services/decodeJWT.php");
require_once @realpath(dirname(__FILE__) . "/services/verifyEmail.php");

$jwt = $_GET['token'];
$payload = decodeJWT($jwt);

var_dump($payload);

$jwtExpiry = $payload->exp;

if ($jwtExpiry - time() > 0) {
  if (verifyEmail($payload->preferred_username, $payload->email)) {
    header("Location: " . "../email-verification-success.html");
  }
} else {
  echo "JWT not valid";
}
