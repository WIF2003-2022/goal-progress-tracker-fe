<?php
  include_once @realpath(dirname(__FILE__) . "/../web/config/databaseConn.php");
  $ap_id = $_GET["ap_id"];
  $sql = "SELECT * FROM `action plan` WHERE ap_id = $ap_id";
  $result = $conn -> query($sql);
  $row = $result -> fetch_assoc();
  $goal_id = $row["goal_id"];
  $sql = "DELETE FROM `action plan` WHERE ap_id = $ap_id";
  $result = $conn -> query($sql);
  $sql = "SELECT * FROM goal WHERE goal_id = $goal_id";
  $result = $conn -> query($sql);
  $row = $result -> fetch_assoc();
  $goal_name = $row["goal_title"];
  header("Location: action-main.php?goal_name=$goal_name&goal_id=$goal_id");
?>
