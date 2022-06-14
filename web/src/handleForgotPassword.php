<?php

echo isset($_GET['token']);
require_once @realpath(dirname(__FILE__) . '/services/decodeJWT.php');
require_once @realpath(dirname(__FILE__) . '/services/updateUser.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['password']) && isset($_GET['token'])) {
  $jwt = $_GET['token'];
  $password = $_POST['password'];

  $payload = decodeJWT($jwt);
  $jwtExpiry = $payload->exp;

  if ($jwtExpiry - time() > 0) {
    header("Location: " . "../login.php");
    echo "JWT still valid";
    updateUserPassword($payload->preferred_username, $payload->email, $password);
  } else {
    echo "JWT not valid";
  }
}