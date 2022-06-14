<?php

function createUser($conn, $username, $email, $password) {
  $stmt = $conn->prepare("
  INSERT INTO user (
    name, email, password_hash
    ) VALUES (
      ?, ?, ?
    );
  ");
  $password_hash = password_hash($password, PASSWORD_DEFAULT);
  $stmt->bind_param("sss", $username, $email, $password_hash);
  if (!($stmt->execute())) {
    echo ("Database Error: " . $stmt->error );
  }
}