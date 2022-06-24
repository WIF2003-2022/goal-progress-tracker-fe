<?php
require_once @realpath(dirname(__FILE__) . "/../config/databaseConn.php");
session_start();
$user = json_decode($_SESSION['auth']);
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  if($_GET['data'] == "activities"){
    $queryActivities = "SELECT activity.ap_id,a_start_date,a_due_date,a_title,a_days,a_times FROM activity 
    INNER JOIN `action plan` ON activity.ap_id = `action plan`.ap_id
    INNER JOIN goal ON `action plan`.goal_id = goal.goal_id
    WHERE goal.mentee_id =$user->user_id";
  } else if($_GET['data'] == "reminders"){
    $queryActivities = "SELECT activity.ap_id,a_start_date,a_due_date,a_title,a_days,a_times,a_description FROM activity 
    INNER JOIN `action plan` ON activity.ap_id = `action plan`.ap_id
    INNER JOIN goal ON `action plan`.goal_id = goal.goal_id
    WHERE goal.mentee_id =$user->user_id AND a_reminder=1 AND a_complete<100";
  }
  $res = mysqli_query($conn, $queryActivities);
  $data = $res -> fetch_all(MYSQLI_ASSOC); 
  echo json_encode($data);
} else if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $goal_id = $_POST['goal_id'];
  $goal_pinned = $_POST['goal_pinned'];
  if(is_numeric($goal_pinned)){
    $updateGoal = "UPDATE goal SET goal_pinned='$goal_pinned' WHERE goal_id=$goal_id";
  } else{
    $updateGoal = "UPDATE goal SET goal_pinned=NULL WHERE goal_id=$goal_id";
  }
  $res = mysqli_query($conn, $updateGoal);
}
$conn -> close();