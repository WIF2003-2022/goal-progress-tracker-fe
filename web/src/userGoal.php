<?php
require_once @realpath(dirname(__FILE__) . "/../config/databaseConn.php");
require_once @realpath(dirname(__FILE__) . "/services/checkAuthenticated.php");

session_start();
$userstr = $_SESSION['auth']; 
$user = json_decode($userstr);
if (!$user) {
    header("Location: ./login.php");
    exit();
}

 //fetch info from db
$userInfo = "SELECT * FROM goal WHERE mentee_id = $user->user_id";
if (isset($_GET['accomplished_only']) && $_GET['accomplished_only'] == "true") {
  $userInfo = "SELECT * FROM goal WHERE goal_status = 'Accomplished' AND mentee_id = $user->user_id ";
}
$queryResult = $conn -> query($userInfo);
$result = $queryResult -> fetch_all(MYSQLI_ASSOC); 
echo json_encode($result);
$queryResult -> free_result();
$conn -> close();