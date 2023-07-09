<?php
// MySQL server configuration
$host = "localhost";
$user = "root";
$password = "";
$database = "easyservice";

// Establish a connection to the MySQL server
$conn = mysqli_connect($host, $user, $password, $database);

// Check if the connection was successful
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Start the session
session_start();
?>
