<?php
  include_once @realpath(dirname(__FILE__) . "/../web/config/databaseConn.php");
  $ap_id = $_GET["ap_id"];
  $sql = "SELECT ap_start_date, ap_due_date, ap_title, COUNT(`action plan`.ap_id) AS count, AVG(activity.a_complete) AS avg FROM `action plan` INNER JOIN activity ON `action plan`.ap_id = activity.ap_id WHERE `action plan`.ap_id=$ap_id;";
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