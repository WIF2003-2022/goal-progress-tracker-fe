<?php 
  session_start();
  if (!isset($_SESSION['auth']) || $_SESSION['auth'] == null) {
    header("Location: ./login.php");
  }
  session_write_close();
?>