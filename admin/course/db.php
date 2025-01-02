<?php
$servername = "localhost"; // Change if your database is hosted elsewhere
$username = "root";        // Your MySQL username
$password = "";            // Your MySQL password
$dbname = "confluent_database"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>