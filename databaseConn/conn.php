<?php

$servername = "127.0.0.1:3309";
$username = "root";
$password = "";
$database = "loginsystem";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
