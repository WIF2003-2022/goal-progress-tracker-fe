<?php
require_once @realpath(dirname(__FILE__)) . "/../config/databaseConn.php";
require_once @realpath(dirname(__FILE__) . "/../src/services/checkAuthenticated.php");

if (isset($_POST['password'])) {
  $id = mysqli_escape_string($conn, $_POST['save_changes']);
  $password = $_POST['password'];
  $password_hash = password_hash($password, PASSWORD_DEFAULT);
  $sql = "UPDATE user 
          SET password_hash ='$password_hash'
          WHERE user_id = $id";
  $result = mysqli_query($conn, $sql);
}
?>