<?php 
require_once @realpath(dirname(__FILE__) . "../../config/databaseConn.php");
session_start();
$user = json_decode($_SESSION['auth']);
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $query = "SELECT `n_text`,`n_timestamp`,`n_status` FROM notification WHERE user_id=35";
  $res = mysqli_query($conn, $query);
  $data = $res -> fetch_all(MYSQLI_ASSOC); 
  echo json_encode($data);
} else if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $update = "UPDATE notification SET n_status='0'";
  $res = mysqli_query($conn, $update);
}
$conn -> close();