<?php
  include_once @realpath(dirname(__FILE__) . "/../web/config/databaseConn.php");
  $a_id = $_GET["a_id"];
  $sql = "SELECT * FROM activity WHERE a_id = $a_id";
  $result = $conn -> query($sql);
  $row = $result -> fetch_assoc();
  $ap_id = $row["ap_id"];
  $sql = "DELETE FROM activity WHERE a_id = $a_id";
  $result = $conn -> query($sql);
  $sql = "SELECT * FROM `action plan` WHERE ap_id = $ap_id";
  $result = $conn -> query($sql);
  $row = $result -> fetch_assoc();
  $ap_name = $row["ap_title"];
  header("Location: activity.html?ap_name=$ap_name&ap_id=$ap_id");
?>