<?php
// Database connection settings
$servername = "localhost"; 
$username = "root"; // Update with your actual username
$password = ""; // Update with your actual password
$database = "confluent_database"; // Update with your actual database name

// Create database connection
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the ID is provided
if (isset($_GET['id'])) {
    $test_id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM tests WHERE id = ?");
    $stmt->bind_param("i", $test_id);
    if ($stmt->execute()) {
        echo "Test deleted successfully.";
    } else {
        echo "Error deleting test: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "No ID provided.";
}

$conn->close();
?>