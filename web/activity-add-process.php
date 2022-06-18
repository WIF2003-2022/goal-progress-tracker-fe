<?php
  include_once @realpath(dirname(__FILE__) . "/../web/config/databaseConn.php");
  $ap_name = $_GET["ap_name"];
  $ap_id = $_GET["ap_id"];
  $title = $_POST["a_title"];
  $description = $_POST["a_description"];
  $start = $_POST["a_start_date"];
  $due = $_POST["a_due_date"];
  $time = $_POST["a_times"];
  $day = $_POST["a_days"];
  $reminder = $_POST["a_reminder"];
  $reminder = 0;
  if(isset($_POST["a_reminder"])) {
    $reminder = 1;
  }
  $complete = 0;
  
  $priority = $_POST["stars"];

  if($due < $start) {
    header("Location: activity-add.html?ap_name=$ap_name&ap_id=$ap_id&a_id=$a_id&error2");
    exit();
  }

  date_default_timezone_set('Asia/Kuala_Lumpur');
  $timestamp = date("Y-m-d H:i:s",time());
  
  $sql = "INSERT INTO activity (ap_id, a_timestamp, a_start_date, a_due_date, a_title, a_description, a_times, a_days, a_priority, a_reminder, a_complete) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
  $stmt = $conn -> prepare($sql);
  $stmt -> bind_param ("issssssssii", $ap_id, $timestamp, $start, $due, $title, $description, $time, $day, $priority, $reminder, $complete);
  $stmt -> execute();
  $stmt -> close();
  $conn -> close();
  header("Location: activity.html?ap_name=$ap_name&ap_id=$ap_id");
?>