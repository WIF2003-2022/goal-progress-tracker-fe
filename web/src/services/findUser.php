<?php

function findUserByEmailOrUsername($conn, $id) {
  $stmt = $conn->prepare("
    SELECT * FROM user WHERE name=? OR email=?;
  ");
  $stmt->bind_param("ss", $id, $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();
  var_dump($user);
  return $user;
}

function findUserByEmail($conn, $email) {
  $stmt = $conn->prepare("
    SELECT * FROM user WHERE email=?;
  ");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();
  var_dump($user);
  return $user;
}