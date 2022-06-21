<?php
  include_once @realpath(dirname(__FILE__) . "/../web/config/databaseConn.php");
  require_once @realpath(dirname(__FILE__) . "/src/services/checkAuthenticated.php");
  $userID = json_decode($_SESSION['auth'],true)['user_id'];
  $ap_name = $_POST["ap_name"];
  $ap_id = $_POST["ap_id"];
  $a_id = $_POST["a_id"];
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
  
  if($due < $start) {
    header("Location: activity-edit.php?ap_name=$ap_name&ap_id=$ap_id&a_id=$a_id&error2");
    exit();
  }

  $priority = $_POST["stars"];

  $sql = "SELECT * FROM activity WHERE a_id = $a_id";
  $result = $conn -> query($sql);
  $row = $result -> fetch_assoc();
  $click = $row["a_click"];

  $difference = date_diff(new DateTime($start), new DateTime($due), true);
  $daysDiff = $difference -> days;
  $maxClick = ceil(($daysDiff)/$day)*$time;
  $complete = round(1/$maxClick*$click*100*100)/100;
  if($complete > 100) {
    $complete = 100;
  }
  
  $sql = "UPDATE activity SET a_start_date=?, a_due_date=?, a_title=?, a_description=?, a_times=?, a_days=?, a_priority=?, a_reminder=?, a_complete=?, a_max_click=? WHERE a_id=?";
  $stmt = $conn -> prepare($sql);
  $stmt -> bind_param ("ssssssiidii", $start, $due, $title, $description, $time, $day, $priority, $reminder, $complete, $maxClick, $a_id);
  $stmt -> execute();

  $recentsql = "INSERT INTO `recent` (`r_type`, `user_id`, `updated_id`, `action`) 
                    values('activity', '$userID', '$a_id', 'edit')";
  mysqli_query($conn,$recentsql);

  $stmt -> close();
  $conn -> close();
  header("Location: activity.php?ap_name=$ap_name&ap_id=$ap_id");
?>