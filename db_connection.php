<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "finalproject";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Set character set to utf8
$connection->set_charset("utf8");
?> 