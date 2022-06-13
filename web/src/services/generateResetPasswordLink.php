<?php
require_once @realpath(dirname(__FILE__) . '/encodeJWT.php');
require_once @realpath(dirname(__FILE__) . '/../../../loadEnvVar.php');

function generateAndSaveResetPasswordLink($username, $email, $resetPasswordURL) {

  $jwt = encodeJWT([
    'preferred_username' => $username,
    'email' => $email
  ], $_ENV['JWT_RESET_PASSWORD_EXPIRATION_MINUTES']);

  $link = $resetPasswordURL . "?token=" . $jwt;

  return $link;
}