<?php
require_once @realpath(dirname(__FILE__) . "/../config/databaseConn.php");
session_start();
$user = json_decode($_SESSION['auth']);
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $queryGoals = "SELECT goal.goal_id,goal_title,goal_progress,GROUP_CONCAT( `action plan`.`ap_title`) as `action_plans`,goal_pinned 
  FROM goal LEFT JOIN `action plan` ON `action plan`.`goal_id`=goal.goal_id WHERE mentee_id=$user->user_id GROUP BY goal_id";
  $res = mysqli_query($conn, $queryGoals);
  $goals = $res -> fetch_all(MYSQLI_ASSOC); 
  $goalsArr = array();
  $pinnedGoalsArr = array();
  foreach ($goals as $goal) {
    $goal['action_plans'] = explode(',',$goal['action_plans']);
    if(is_null($goal['goal_pinned'])){
      $goalsArr[] = $goal;
    } else{
      $pinnedGoalsArr[] =  $goal;
    }
  }
  echo json_encode(array("goals"=>$goalsArr,"pinnedGoals"=>$pinnedGoalsArr));
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