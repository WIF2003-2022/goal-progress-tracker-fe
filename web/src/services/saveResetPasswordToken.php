<?php


function saveResetPasswordToken($id, $resetPasswordToken) {
  echo $resetPasswordToken . " " . $id;
  require @realpath(dirname(__FILE__) . "/../../config/databaseConn.php");
  $stmt = $conn -> prepare(
    "UPDATE user SET forgot_password_token = ?  WHERE user_id = ?"
  );
  $stmt -> bind_param("ss", $resetPasswordToken, $id);
  return $stmt->execute();
}