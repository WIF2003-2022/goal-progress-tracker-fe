<?php
  include_once @realpath(dirname(__FILE__) . "/../web/config/databaseConn.php");
  $a_id = $_GET["id"];
  $sql = "DELETE FROM activity WHERE a_id = $a_id";
  $result = $conn -> query($sql);
  header("Location: activity.html");
?>