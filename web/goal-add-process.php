<?php 
require_once @realpath(dirname(__FILE__) . "/config/databaseConn.php");
$title = $_POST['title'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
$tracking = $_POST['tracking'];
// $description = $_POST['description'];
$category = $_POST['category'];
$mentor = $_POST['mentor'];
$mentee = $_POST['mentee'];
$status = "Active";
$progress = 0;

$addsql = "INSERT INTO `goal` (`mentee_id`,`mentor_id`,`goal_title`,`goal_category`,`goal_status`,`goal_progress`,`tracking_method`,`goal_start_date`,`goal_due_date`) 
                    values ('$mentee', '$mentor', '$title', '$category', '$status', '$progress', '$tracking', '$startDate', '$endDate' )";
$addquery= mysqli_query($conn,$addsql);
$lastId = mysqli_insert_id($conn);

if($addquery ==true){
  $data = array(
      'status'=>'true',
  );

  echo json_encode($data);
}
else{
    $data = array(
      'status'=>'false',
  );

  echo json_encode($data);
} 
?>