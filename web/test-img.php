<?php
include_once @realpath(dirname(__FILE__) . "/../web/config/databaseConn.php");
$sql = "SELECT * FROM `action plan`";
$result = $conn -> query($sql);
while($row = $result -> fetch_array()) {
  $image = $row["ap_image"];
  echo "<img src = $image>";  
  echo "</br>";
}
$conn -> close();
?>