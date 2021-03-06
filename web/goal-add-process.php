<?php 
require_once @realpath(dirname(__FILE__) . "/config/databaseConn.php");
require_once @realpath(dirname(__FILE__) . "/src/services/checkAuthenticated.php");
$title = $_POST['title'];
$target = $_POST['target'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
$tracking = $_POST['tracking'];
$description = $_POST['description'];
$category = $_POST['category'];
$mentor = $_POST['mentor'];
if ($mentor == "") {
  $mentor = null;
}
$mentee = $_POST['mentee'];
$status = "Active";
$progress = 0;

if ($mentor == "") {
  $addsql = "INSERT INTO `goal` (`mentee_id`,`mentor_id`,`goal_title`, `goal_target`, `goal_description`,`goal_category`,`goal_status`,`goal_progress`,`tracking_method`,`goal_start_date`,`goal_due_date`) 
                    values ('$mentee', null, '$title', '$target','$description','$category', '$status', '$progress', '$tracking', '$startDate', '$endDate' )";
}
else{
  $getSelfEmailSql = "SELECT email FROM user WHERE user_id = $mentee";
  $getSelfEmailQuery = mysqli_query($conn, $getSelfEmailSql);
  $getSelfEmail = mysqli_fetch_assoc($getSelfEmailQuery);
  $selfEmail = $getSelfEmail['email'];

  $checkEmailSql = "SELECT * FROM user WHERE email = '$mentor' AND email != '$selfEmail'";
  $checkEmailQuery = mysqli_query($conn, $checkEmailSql);
  if ($checkEmailQuery == true) {
    $checkEmail = mysqli_fetch_assoc($checkEmailQuery)['user_id'];
    $addsql = "INSERT INTO `goal` (`mentee_id`,`mentor_id`,`goal_title`,`goal_target`,`goal_description`,`goal_category`,`goal_status`,`goal_progress`,`tracking_method`,`goal_start_date`,`goal_due_date`) 
                      values ('$mentee', '$checkEmail', '$title','$target', '$description','$category', '$status', '$progress', '$tracking', '$startDate', '$endDate' )";
    $currTimestamp = date('Y-m-d H:i:s', time());
    session_start();
    $user = json_decode($_SESSION['auth']);
    $text = "$user->name invited you to mentor him/her on $title";
    $addNotification = "INSERT INTO `notification`(`n_text`, `n_timestamp`, `n_status`, `user_id`,`mentee_id`) VALUES ('$text','$currTimestamp','1','$checkEmail','$user->user_id')";
    mysqli_query($conn,$addNotification);
  }
  else {
    echo '<script>alert("Email Not Found")</script>';
  }
}

$addquery= mysqli_query($conn,$addsql);

$lastId = mysqli_insert_id($conn);
$recentsql = "INSERT INTO `recent` (`r_type`, `user_id`, `updated_id`, `action`) 
                    values('goal', '$mentee', '$lastId', 'add')";
                    
mysqli_query($conn,$recentsql);

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