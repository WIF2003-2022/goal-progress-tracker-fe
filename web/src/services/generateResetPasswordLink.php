<?php
require_once @realpath(dirname(__FILE__) . '/encodeJWT.php');
require_once @realpath(dirname(__FILE__) . '/../../../loadEnvVar.php');
require_once @realpath(dirname(__FILE__) . '/saveResetPasswordToken.php');

function generateAndSaveResetPasswordLink($id, $username, $email, $resetPasswordURL) {

  $jwt = encodeJWT([
    'preferred_username' => $username,
    'email' => $email
  ], $_ENV['JWT_RESET_PASSWORD_EXPIRATION_MINUTES']);

  saveResetPasswordToken($id, $jwt);

  $link = $resetPasswordURL . "?token=" . $jwt;

  return $link;
}