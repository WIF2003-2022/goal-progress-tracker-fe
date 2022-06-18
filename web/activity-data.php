<?php
  include_once @realpath(dirname(__FILE__) . "/../web/config/databaseConn.php");
  $ap_id = $_GET["id"];
  $sql = "SELECT * FROM activity WHERE ap_id = $ap_id";
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