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
$goal= "SELECT * FROM goal WHERE mentee_id = $user->user_id";
$actionplan = "SELECT * FROM `action plan` INNER JOIN goal ON `action plan`.goal_id = goal.goal_id";
$queryResult = $conn -> query($goal);
$queryResult1 = $conn -> query($actionplan);
$result = $queryResult -> fetch_all(MYSQLI_ASSOC); 
$result1 = $queryResult1 -> fetch_all(MYSQLI_ASSOC);
echo json_encode($result);
echo json_encode($result1);
$queryResult -> free_result();
$queryResult1 -> free_result();
$conn -> close();