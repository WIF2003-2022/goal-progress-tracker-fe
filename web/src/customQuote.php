<?php 
require_once @realpath(dirname(__FILE__) . "../../config/databaseConn.php");
session_start();
$user = json_decode($_SESSION['auth']);
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $queryQuote = "SELECT name,quote FROM user WHERE user_id=$user->user_id";
  $res = mysqli_query($conn, $queryQuote);
  if($res->num_rows > 0){
    $row = $res->fetch_assoc();
    echo json_encode(array("author"=>$row['name'], "quote"=>$row['quote']));
  }
} else if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $quote = $_POST['quote'];
  if(!empty($quote)){
    $updateQuote = "UPDATE user SET quote='$quote' WHERE user_id=$user->user_id";
  } else{
    $updateQuote = "UPDATE user SET quote=NULL WHERE user_id=$user->user_id";
  }
  $res = mysqli_query($conn, $updateQuote);
  if($res){
    echo json_encode(array("author"=>$user->name, "quote"=>$quote));
  }
}
$conn -> close();