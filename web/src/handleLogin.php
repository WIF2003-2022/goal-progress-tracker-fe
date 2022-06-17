<?php
require_once @realpath(dirname(__FILE__) .'/services/findUser.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (!isset($_POST['id']) || !isset($_POST['password']) || $_POST['id'] == '' || $_POST['password'] == '') {
    http_response_code(400);
    die("Email or username and password could not be empty");
  }
  $id = $_POST['id'];
  $password = $_POST['password'];

  require_once '../config/databaseConn.php';
  try {
    $user = findUserByEmailOrUsername($conn, $id);
  
    if ($user && password_verify($password, $user['password_hash']) && $user['verified']) {
      session_start();
      $_SESSION['auth'] = json_encode($user);
      echo json_encode($user);
    } else {
      http_response_code(401);
      echo json_encode("Email or username and password is incorrect. Please try again.");
    }
  } catch (Exception $e) {
    http_response_code(500);
    die("Sorry, we could not log you in at the moment. Please try again later.");
  }
} else {
  http_response_code(400);
  echo json_encode("Bad request");
}
