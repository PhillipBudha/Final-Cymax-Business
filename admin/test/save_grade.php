<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "Confluent_Database";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload_id']) && isset($_POST['grade'])) {
    $uploadId = $_POST['upload_id'];
    $grade = $_POST['grade'];

    // Check if the grade already exists
    $checkQuery = "SELECT * FROM grades WHERE upload_id = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("i", $uploadId);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        // Update existing grade
        $updateQuery = "UPDATE grades SET grade = ? WHERE upload_id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("si", $grade, $uploadId);
    } else {
        // Insert new grade
        $insertQuery = "INSERT INTO grades (upload_id, grade) VALUES (?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("is", $uploadId, $grade);
    }

    if ($stmt->execute()) {
        echo "Grade saved successfully!";
    } else {
        echo "Error saving the grade.";
    }
    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
