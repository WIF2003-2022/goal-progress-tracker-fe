<?php

function verifyEmail($username, $email) {
  require_once @realpath(dirname(__FILE__) . "/../../config/databaseConn.php");
  
  $stmt = $conn->prepare("
    UPDATE user SET verified=TRUE WHERE name = ? AND email = ?
  ");

  $stmt->bind_param("ss", $username, $email);

  return $stmt -> execute();
}
