<?php

require_once @realpath(dirname(__FILE__) . "/../../../loadEnvVar.php");

use Firebase\JWT\JWT; 
use Firebase\JWT\Key;

function decodeJWT($jwt) {
  $key = $_ENV['JWT_KEY'];

  $decoded = JWT::decode($jwt, new Key($key, 'HS256'));

  return $decoded;
}