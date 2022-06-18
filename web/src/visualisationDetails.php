<?php
require_once @realpath(dirname(__FILE__) . "/../config/databaseConn.php");

session_start();
$userstr = $_SESSION['auth']; 
$user = json_decode($userstr);
if (!$user) {
    header("Location: ./login.php");
    exit();
}

 //fetch info from db
// $actionplan = "SELECT * (SELECT * FROM `action plan` INNER JOIN goal ON `action plan`.goal_id = goal.goal_id) INNER JOIN activity ON ap_id = activity.ap_id  WHERE mentee_id = $user->user_id";
$actionplan = "SELECT * FROM `action plan` INNER JOIN goal ON `action plan`.goal_id = goal.goal_id INNER JOIN activity ON `action plan`.ap_id = activity.ap_id WHERE mentee_id = 100";
$queryResult = $conn -> query($actionplan);
$result = $queryResult -> fetch_all(MYSQLI_ASSOC); 
echo json_encode($result);
// $queryResult -> free_result();
// $queryResult1 -> free_result();
// $conn -> close();