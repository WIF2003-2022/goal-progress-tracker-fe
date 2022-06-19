<?php
include_once @realpath(dirname(__FILE__) . "/../web/config/databaseConn.php");
$a_id = $_GET["a_id"];
$a_complete = $_GET["a_complete"];
$sql = "SELECT * FROM activity WHERE a_id = $a_id";
$result = $conn -> query($sql);
$row = $result -> fetch_assoc();
$ap_id = $row["ap_id"];
$a_click = $row["a_click"]+1;
echo $a_click;
$sql = "UPDATE activity SET a_complete=?, a_click=? WHERE a_id=?";
$stmt = $conn -> prepare($sql);
$stmt -> bind_param("dii", $a_complete, $a_click, $a_id);
$stmt -> execute();
$sql = "SELECT * FROM `action plan` WHERE ap_id = $ap_id";
$result = $conn -> query($sql);
$row = $result -> fetch_assoc();
$ap_name = $row["ap_title"];
header("Location: activity.html?ap_name=$ap_name&ap_id=$ap_id");
?>