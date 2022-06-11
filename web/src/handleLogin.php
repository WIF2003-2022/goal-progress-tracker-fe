<?php
require_once './services/findUser.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
  $id = $_POST['id'];
  $password = $_POST['password'];

  echo $id . " " . $password;

  require_once '../config/databaseConn.php';

  $user = findUserByEmailOrUsername($conn, $id);
  var_dump($user['password_hash']);

  var_dump (password_verify($password, $user['password_hash']));
  if (password_verify($password, $user['password_hash'])) {
    session_start();
    $val = "true";
    $_SESSION['auth'] = $val;
    echo $_SESSION['auth'];
    echo "match";
    header("Location: ../index.html");
    exit();
  }

  header("Location: ../login.html");
}
