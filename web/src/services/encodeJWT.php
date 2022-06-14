<?php

require_once @realpath(dirname(__FILE__) . "/../../../loadEnvVar.php");

use Firebase\JWT\JWT; 
use Firebase\JWT\Key;

function encodeJWT($publicClaims, $expirationHours) {
  $issueAt = time();
  $expiration = $issueAt + $expirationHours * 60 * 60;

  $key = $_ENV['JWT_KEY'];
  $registeredClaims = [
    'iss' => $_SERVER['SERVER_NAME'],
    'aud' => $_SERVER['SERVER_NAME'],
    'iat' => $issueAt,
    'exp' => $expiration,
  ];

  $payload = array_merge($registeredClaims, $publicClaims);

  /**
   * IMPORTANT:
   * You must specify supported algorithms for your application. See
   * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
   * for a list of spec-compliant algorithms.
   */
  $jwt = JWT::encode($payload, $key, 'HS256');

  return $jwt;
}