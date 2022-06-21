<?php 
  require_once @realpath(dirname(__FILE__) . "/config/databaseConn.php");
  require_once @realpath(dirname(__FILE__) . "/src/services/checkAuthenticated.php");
  $goal = $_POST["id"];
  $rowsql = "SELECT * FROM goal WHERE goal_id= $goal LIMIT 1"; //retrieve the data which the id is matched with the limit of 1 row
  $rowquery = mysqli_query($conn,$rowsql);
  $row = mysqli_fetch_assoc($rowquery);
  echo json_encode($row);         //convert PHP object into JSON representation
?>