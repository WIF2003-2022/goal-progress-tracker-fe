<?php
function updateUserPassword($username, $email, $newPassword, $token) {
  require_once @realpath(dirname(__FILE__) . "/../../config/databaseConn.php");
  $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
  $stmt = $conn->prepare(
    "UPDATE user SET password_hash = ?, forgot_password_token = NULL WHERE name = ? AND email = ? AND forgot_password_token = ?"
  );
  $stmt->bind_param("ssss", $hashedNewPassword, $username, $email, $token);
  return $stmt -> execute();
}