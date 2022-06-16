<?php
  include_once @realpath(dirname(__FILE__) . "/../web/config/databaseConn.php");
  $sql = "SELECT * FROM `action plan` WHERE goal_id = '1'";
  $data = array();
  $result = $conn -> query($sql);
  while($row = $result -> fetch_array()) {
    $data[] = $row;
  }
  echo json_encode($data);
?>