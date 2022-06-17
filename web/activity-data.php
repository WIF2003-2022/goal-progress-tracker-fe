<?php
  include_once @realpath(dirname(__FILE__) . "/../web/config/databaseConn.php");
  $sql = "SELECT * FROM activity WHERE ap_id = '23'";
  $data = array();
  $result = $conn -> query($sql);
  $i=0;
  while($row = $result -> fetch_assoc()) {
    $data[$i] = $row;
    $i+=1;
  }
  echo json_encode($data);
  $conn -> close();
?>