<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM videos WHERE id = $id";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $videoPath = "uploads/" . $row['video'];

    // Delete video from database
    $sql = "DELETE FROM videos WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        unlink($videoPath);  // Delete the video file
        header("Location: index.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
