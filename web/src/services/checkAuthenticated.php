<?php 
  session_start();
  if ($_SESSION['auth'] == null) {
    header("Location: ./login.php");
  }
?>