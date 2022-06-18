<?php
  include_once @realpath(dirname(__FILE__) . "/../web/config/databaseConn.php");
  $foreign = $_POST["a_id"];
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
  
  $priority = $_POST["stars"];
  echo($priority);

  date_default_timezone_set('Asia/Kuala_Lumpur');
  $timestamp = date("Y-m-d H:i:s",time());
  
  $sql = "UPDATE activity SET a_start_date=?, a_due_date=?, a_title=?, a_description=?, a_times=?, a_days=?, a_priority=?, a_reminder=? WHERE a_id=?";
  $stmt = $conn -> prepare($sql);
  $stmt -> bind_param ("ssssssiii", $start, $due, $title, $description, $time, $day, $priority, $reminder, $foreign);
  $stmt -> execute();
  $stmt -> close();
  $conn -> close();
  header("Location: activity.html");
?>