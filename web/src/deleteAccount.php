<?php
require_once @realpath(dirname(__FILE__) . "../../config/databaseConn.php");

$id = $_POST['id']; //get id through query string
$del = mysqli_query($conn, "DELETE * FROM user WHERE user_id = '$id'");

if ($del) {
  mysqli_close($conn);
  header("location: login.php");
  exit;
}
else {
  echo "Fail to delete user account";
}
?>