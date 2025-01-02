<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "confluent_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form fields are set
    $course_name = isset($_POST['course_name']) ? $_POST['course_name'] : '';
    $short_description = isset($_POST['short_description']) ? $_POST['short_description'] : '';
    $duration = isset($_POST['duration']) ? $_POST['duration'] : '';
    
    // Handle video upload
    if (isset($_FILES['video']) && $_FILES['video']['error'] == 0) {
        $video_name = $_FILES['video']['name'];
        $video_tmp_name = $_FILES['video']['tmp_name'];
        $video_path = "uploads/videos/" . $video_name;
        move_uploaded_file($video_tmp_name, $video_path);
    } else {
        $video_path = '';
    }

    // Insert course details into the database
    $sql = "INSERT INTO course (course_name, short_description, duration, video_url) VALUES ('$course_name', '$short_description', '$duration', '$video_path')";
    
    if ($conn->query($sql) === TRUE) {
        $course_id = $conn->insert_id;
        
        // Handle document uploads (PDF, Word)
        if (isset($_FILES['documents']) && !empty($_FILES['documents']['name'])) {
            foreach ($_FILES['documents']['name'] as $key => $doc_name) {
                if ($_FILES['documents']['error'][$key] == 0) {
                    $file_tmp_name = $_FILES['documents']['tmp_name'][$key];
                    $file_path = "uploads/documents/" . $doc_name;
                    $file_type = pathinfo($doc_name, PATHINFO_EXTENSION);
                    move_uploaded_file($file_tmp_name, $file_path);
                    
                    // Insert document into the database
                    $sql_doc = "INSERT INTO course_documents (course_id, file_name, file_path, file_type) VALUES ('$course_id', '$doc_name', '$file_path', '$file_type')";
                    $conn->query($sql_doc);
                }
            }
        }
        
        echo "Course and documents uploaded successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
