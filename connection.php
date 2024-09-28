<?php

$server = "localhost";
$username = "praktikan";
$password = "praktikan123";
$db = "responsi1_pemweb";

$conn = new mysqli($server, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed with error: " . $conn->connect_error);
}

?>