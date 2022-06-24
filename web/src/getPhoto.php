<?php
require_once @realpath(dirname(__FILE__) . "/../config/databaseConn.php");
session_start();
$user = json_decode($_SESSION['auth']);
$queryPhoto = "SELECT photo FROM user WHERE user_id=$user->user_id";
$res = mysqli_query($conn, $queryPhoto);
$data = $res->fetch_assoc();
echo json_encode($data);
$conn -> close();