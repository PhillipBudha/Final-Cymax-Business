<?php
include 'config.php';

if (isset($_POST['submit'])) {
    // Retrieve form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $course_id = $_POST['course'];  // Capture the selected course ID
    $video = $_FILES['video']['name'];
    $target = "uploads/" . basename($video);

    // Insert into database, including the course_id
    $sql = "INSERT INTO videos (title, description, video, course_id) 
            VALUES ('$title', '$description', '$video', '$course_id')";
    
    if ($conn->query($sql) === TRUE) {
        // Move the uploaded video to the target folder
        if (move_uploaded_file($_FILES['video']['tmp_name'], $target)) {
            echo "Video uploaded successfully.";
            header("Location: index.php");  // Redirect to index page after successful upload
        } else {
            echo "Failed to upload video.";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
