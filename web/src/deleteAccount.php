<?php
require @realpath(dirname(__FILE__) . "/../config/databaseConn.php");
session_start();

if (isset($_POST['user_delete'])) //check the button is clicked or not
{
  $id = $_POST['user_delete']; //get user id from value 
  $del = "DELETE FROM user WHERE user_id = $id";
  $result = mysqli_query($conn, $del);

  //logout and redirect to login page if account is deleted
  if ($result) {
    // $_SESSION['message'] = "Deleted Successfully";
    if (isset($_SESSION['auth'])) {
      unset($_SESSION['auth']);
      header('Location: ../login.php');
    }
    exit();
  }
  else {
    // $_SESSION['message'] = "Something went wrong";
    header("Location: ../profile.php");
    exit();
  }
}
?>