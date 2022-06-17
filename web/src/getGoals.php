<?php

require_once @realpath(dirname(__FILE__) . "../../config/databaseConn.php");

$queryString = "SELECT * from goal";
if (isset($_GET['accomplished_only']) && $_GET['accomplished_only'] == "true") {
  $queryString = "SELECT * from goal WHERE goal_status = 'Accomplished'";
}
$queryResult = $conn -> query($queryString);
$result = $queryResult -> fetch_all(MYSQLI_ASSOC);
echo json_encode($result);
$queryResult -> free_result();

$conn -> close();