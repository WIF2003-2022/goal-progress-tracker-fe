<?php
require @realpath(dirname(__FILE__) . "/../../loadEnvVar.php");

$dbServerName = $_ENV["DB_HOST"];
$dbUsername = $_ENV["DB_USERNAME"];
$dbPassword = $_ENV["DB_PASSWORD"];
$dbName = $_ENV["DB_NAME"];

$conn = new mysqli($dbServerName, $dbUsername, $dbPassword, $dbName);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($conn->connect_error) {
  die("Database connection failed. Please try again later.");
}

// echo "Connection Successful";