<?php
require_once @realpath(dirname(__FILE__) . "/../config/databaseConn.php");

session_start();
$userstr = $_SESSION['auth']; 
$user = json_decode($userstr);
if (!$user) {
    header("Location: ./login.php");
    exit();
}

// select all goal by the user
// for each goal, find its action plans
// for each action plan, find its activities

$actionplan = "SELECT goal.goal_id, ap.ap_id, activity.a_id, goal.goal_status, goal.goal_title, goal.goal_start_date, goal.goal_due_date, ap.ap_title, activity.a_title, activity.a_progress FROM `action plan` AS ap INNER JOIN goal ON ap.goal_id = goal.goal_id INNER JOIN activity ON ap.ap_id = activity.ap_id WHERE mentee_id = 100;";
$queryResult = $conn -> query($actionplan);
$result = $queryResult -> fetch_all(MYSQLI_ASSOC);

$goals = array();
foreach ($result as $goal) {
    // var_dump($result);
    // echo "<br>";
    if (!isset($goals[$goal['goal_id']])) {
        $goals[$goal['goal_id']] = array(
            "goal_id" => $goal['goal_id'],
            "goal_title" => $goal['goal_title'],
            "goal_status" => $goal['goal_status'],
            "goal_start_date" => $goal['goal_start_date'],
            "goal_due_date" => $goal['goal_due_date'],
            "action_plans" => array()
        );
    }
    if (!isset($goals[$goal['goal_id']]['action_plans'][$goal['ap_id']])) {
        $goals[$goal['goal_id']]['action_plans'] += array($goal['ap_id'] => array(
            "ap_id" => $goal['ap_id'],
            "ap_title" => $goal['ap_title'],
            "activities" => array()
        ));
    }
    $currActivity = array(
        "a_id" => $goal['a_id'],
        "a_title" => $goal['a_title'],
        "a_progress" => $goal["a_progress"],
    );
    array_push($goals[$goal['goal_id']]['action_plans'][$goal['ap_id']]['activities'], $currActivity);
}

echo json_encode($goals);
$queryResult -> free_result();
$conn -> close();