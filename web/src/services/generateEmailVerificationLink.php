<?php
require_once @realpath(dirname(__FILE__) . '/encodeJWT.php');

function generateEmailVerificationLink($username, $email, $verifyEmailURL) {

  $jwt = encodeJWT([
    'preferred_username' => $username,
    'email' => $email
  ], $_ENV['JWT_EXPIRATION_HOURS']);

  $link = $verifyEmailURL . "?token=" . $jwt;

  return $link;
}