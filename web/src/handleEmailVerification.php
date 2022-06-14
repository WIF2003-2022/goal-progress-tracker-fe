<?php
require_once @realpath(dirname(__FILE__) . "/services/decodeJWT.php");
require_once @realpath(dirname(__FILE__) . "/services/verifyEmail.php");

$jwt = $_GET['token'];
$payload = decodeJWT($jwt);

var_dump($payload);

$jwtExpiry = $payload->exp;

if ($jwtExpiry - time() > 0) {
  header("Location: " . "../login.php");
  echo "JWT still valid";
  verifyEmail($payload->preferred_username, $payload->email);
} else {
  echo "JWT not valid";
}
