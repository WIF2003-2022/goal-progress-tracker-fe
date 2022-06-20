<?php
  include_once @realpath(dirname(__FILE__) . "/../web/config/databaseConn.php");
  require_once @realpath(dirname(__FILE__) . "/src/services/checkAuthenticated.php");
  $userID = json_decode($_SESSION['auth'],true)['user_id'];
  $ap_name = $_POST["ap_name"];
  $ap_id = $_POST["ap_id"];
  $a_id = $_POST["a_id"];
  $title = $_POST["a_title"];
  $description = $_POST["a_description"];
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

  date_default_timezone_set('Asia/Kuala_Lumpur');
  $timestamp = date("Y-m-d H:i:s",time());
  
  $sql = "UPDATE activity SET a_title=?, a_description=?, a_priority=?, a_reminder=? WHERE a_id=?";
  $stmt = $conn -> prepare($sql);
  $stmt -> bind_param ("ssiii", $title, $description, $priority, $reminder, $a_id);
  $stmt -> execute();

  $recentsql = "INSERT INTO `recent` (`r_type`, `user_id`, `updated_id`, `action`) 
                    values('activity', '$userID', '$a_id', 'edit')";
  mysqli_query($conn,$recentsql);

  $stmt -> close();
  $conn -> close();
  header("Location: activity.html?ap_name=$ap_name&ap_id=$ap_id");
?>