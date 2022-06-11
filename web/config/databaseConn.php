<?php

require "../../loadEnvVar.php";

$servername = $_ENV["DB_HOST"];
$username = $_ENV["DB_USERNAME"];
$password = $_ENV["DB_PASSWORD"];
$database = $_ENV["DB_NAME"];

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
  die("Connection failed" . $conn->connect_error);
}

echo "Connection Successful";
?>