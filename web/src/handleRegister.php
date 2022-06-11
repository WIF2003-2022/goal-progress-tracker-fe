<?php
require_once './services/createUser.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  
  require_once "../config/databaseConn.php";
  createUser($conn, $username, $email, $password);
  header("Location: ../login.html");
}
