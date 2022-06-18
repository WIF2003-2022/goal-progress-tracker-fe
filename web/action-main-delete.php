<?php
  include_once @realpath(dirname(__FILE__) . "/../web/config/databaseConn.php");
  $ap_id = $_GET["id"];
  $sql = "DELETE FROM `action plan` WHERE ap_id = $ap_id";
  $result = $conn -> query($sql);
  header("Location: action-main.html");
?>