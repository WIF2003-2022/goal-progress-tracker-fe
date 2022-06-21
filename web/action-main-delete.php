<?php
  include_once @realpath(dirname(__FILE__) . "/../web/config/databaseConn.php");
  require_once @realpath(dirname(__FILE__) . "/src/services/checkAuthenticated.php");
  
  $userID = json_decode($_SESSION['auth'],true)['user_id'];
  $ap_id = $_GET["ap_id"];
  $sql = "SELECT * FROM `action plan` WHERE ap_id = $ap_id";
  $result = $conn -> query($sql);
  $row = $result -> fetch_assoc();
  $goal_id = $row["goal_id"];
  $sql = "DELETE FROM `action plan` WHERE ap_id = $ap_id";
  $result = $conn -> query($sql);
  $deleteRecentsql = "DELETE FROM recent WHERE updated_id = $ap_id AND user_id = $userID AND r_type = "."'action_plan'";
  $result = $conn -> query($deleteRecentsql);
  $sql = "SELECT * FROM goal WHERE goal_id = $goal_id";
  $result = $conn -> query($sql);
  $row = $result -> fetch_assoc();
  $goal_name = $row["goal_title"];
  header("Location: action-main.php?goal_name=$goal_name&goal_id=$goal_id");
?>
