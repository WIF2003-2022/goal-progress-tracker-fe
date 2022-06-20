<?php
  include_once @realpath(dirname(__FILE__) . "/../web/config/databaseConn.php");
  require_once @realpath(dirname(__FILE__) . "/src/services/checkAuthenticated.php");
  $userID = json_decode($_SESSION['auth'],true)['user_id'];
  $ap_name = $_GET["ap_name"];
  $ap_id = $_GET["ap_id"];
  $title = $_POST["a_title"];
  $description = $_POST["a_description"];
  $start = $_POST["a_start_date"];
  $due = $_POST["a_due_date"];
  $time = $_POST["a_times"];
  $day = $_POST["a_days"];
  if(isset($_POST["a_reminder"])) {
    $reminder = 1;
  }
  else {
    $reminder = 0;
  } 
  $complete = 0;
  
  $priority = $_POST["stars"];

  if($due < $start) {
    header("Location: activity-add.php?ap_name=$ap_name&ap_id=$ap_id&a_id=$a_id&error2");
    exit();
  }

  date_default_timezone_set('Asia/Kuala_Lumpur');
  $timestamp = date("Y-m-d H:i:s",time());
  $difference = date_diff(new DateTime($start), new DateTime($due), true);
  $daysDiff = $difference -> days;
  $click = 0;
  $maxClick = ceil(($daysDiff+1)/$day)*$time;

  
  $sql = "INSERT INTO activity (ap_id, a_timestamp, a_start_date, a_due_date, a_title, a_description, a_times, a_days, a_priority, a_reminder, a_complete, a_click, a_max_click) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
  $stmt = $conn -> prepare($sql);
  $stmt -> bind_param ("issssssssiiii", $ap_id, $timestamp, $start, $due, $title, $description, $time, $day, $priority, $reminder, $complete, $click, $maxClick);
  $stmt -> execute();

  $lastId = mysqli_insert_id($conn);
  $recentsql = "INSERT INTO `recent` (`r_type`, `user_id`, `updated_id`, `action`) 
                     values('activity', '$userID', '$lastId', 'add')";
  mysqli_query($conn,$recentsql);

  $stmt -> close();
  $conn -> close();
  header("Location: activity.html?ap_name=$ap_name&ap_id=$ap_id");
?>