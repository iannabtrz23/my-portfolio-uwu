<?php
// Replace these values with your actual database configuration
$db_host = "localhost";
$db_name = "potatoplushies";
$db_user = "root";
$db_password = "";


// Create connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>