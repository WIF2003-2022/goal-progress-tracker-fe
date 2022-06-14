<?php

require "../../loadEnvVar.php";

$dbServerName = $_ENV["DB_HOST"];
$dbUsername = $_ENV["DB_USERNAME"];
$dbPassword = $_ENV["DB_PASSWORD"];
$dbName = $_ENV["DB_NAME"];

$conn = new mysqli($dbServerName, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
  die("Connection failed" . $conn->connect_error);
}

// echo "Connection Successful";
