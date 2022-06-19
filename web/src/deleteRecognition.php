<?php
require_once @realpath(dirname(__FILE__) . "../../config/databaseConn.php");

if (isset($_POST['delete_exp'])) 
{
  $id = $_POST['delete_exp'];
  $delExp = "DELETE FROM expertise WHERE e_id=$id";
  $res1 = mysqli_query($conn, $delExp);
  header("Location: ../edit-profile.php");
  exit;
}

if (isset($_POST['delete_ach'])) 
{
  $id = $_POST['delete_ach'];
  $delAch = "DELETE FROM achievement WHERE ach_id=$id";
  $res2 = mysqli_query($conn, $delAch);
  header("Location: ../edit-profile.php");
  exit;
}

if (isset($_POST['delete_cert'])) 
{
  $id = $_POST['delete_cert'];
  $delCert = "DELETE FROM certificate WHERE c_id=$id";
  $res2 = mysqli_query($conn, $delCert);
  header("Location: ../edit-profile.php");
  exit;
}

mysqli_close($conn);

?>