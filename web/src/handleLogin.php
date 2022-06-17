<?php
require_once @realpath(dirname(__FILE__) .'/services/findUser.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
  $id = $_POST['id'];
  $password = $_POST['password'];

  require_once '../config/databaseConn.php';
  $user = findUserByEmailOrUsername($conn, $id);
  var_dump($user);

  if (password_verify($password, $user['password_hash']) && $user['verified']) {
    session_start();
    $_SESSION['auth'] = json_encode($user);
    header("Location: ../index.php");
    exit();
  }

  header("Location: ../login.php");
}