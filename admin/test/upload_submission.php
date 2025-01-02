<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$database = "Confluent_Database";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if a file has been uploaded
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['submission_file'])) {
    $test_id = $_POST['test_id'];
    $student_name = $_POST['student_name'];
    $file = $_FILES['submission_file'];

    // Validate file
    $allowed_extensions = ['pdf', 'doc', 'docx'];
    $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);

    if (!in_array($file_extension, $allowed_extensions)) {
        echo "Invalid file type. Only PDF, DOC, and DOCX files are allowed.";
        exit;
    }

    // Create a directory for uploads if it doesn't exist
    $upload_dir = "uploads/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Save the file
    $file_name = time() . "_" . basename($file['name']);
    $file_path = $upload_dir . $file_name;

    if (move_uploaded_file($file['tmp_name'], $file_path)) {
        // Insert file details into the database
        $stmt = $conn->prepare("INSERT INTO uploads (test_id, student_name, file_name, file_path) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $test_id, $student_name, $file_name, $file_path);

        if ($stmt->execute()) {
            echo "File uploaded successfully!";
        } else {
            echo "Error uploading file to database.";
        }
        $stmt->close();
    } else {
        echo "Error moving the uploaded file.";
    }
} else {
    echo "No file uploaded.";
}

$conn->close();
?>
