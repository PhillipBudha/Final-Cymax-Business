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
    $stmt = $conn->prepare("SELECT document_blob, document_type FROM tests WHERE id = ?");
    $stmt->bind_param("i", $test_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($document_blob, $document_type);
        $stmt->fetch();

        // Set the appropriate headers
        header("Content-Type: $document_type");
        header("Content-Disposition: inline; filename=document");
        echo $document_blob; // Output the binary data
    } else {
        echo "Document not found.";
    }
    $stmt->close();
} else {
    echo "No ID provided.";
}

$conn->close();
?>