<?php


function updateUserPassword($username, $email, $newPassword) {
  require_once @realpath(dirname(__FILE__) . "/../../config/databaseConn.php");
  $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
  $stmt = $conn->prepare("
    UPDATE user SET password_hash = ? WHERE name = ? AND email = ?
  ");
  $stmt->bind_param("sss", $hashedNewPassword, $username, $email);
  $stmt->execute();
  echo $stmt -> affected_rows;
}