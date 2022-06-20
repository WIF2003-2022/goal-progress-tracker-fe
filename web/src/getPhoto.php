<?php
require_once @realpath(dirname(__FILE__) . "../../config/databaseConn.php");
session_start();
$user = json_decode($_SESSION['auth']);
echo json_encode($user->photo);