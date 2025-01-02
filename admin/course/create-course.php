<?php
// Database configuration
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
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

// Display the user's email
//echo "Welcome, " . $_SESSION['email'];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_name = $_POST['course_name'];
    $category = $_POST['category'];
    $instructor = $_POST['instructor'];
    $department = $_POST['department'];
    $ratings = $_POST['ratings'];
    $reviews = $_POST['reviews'];
    $lessons = $_POST['lessons'];
    $price = $_POST['price'];

    // Handle image upload
    $image = $_FILES['image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        $image_path = $target_file;
    } else {
        die("Error uploading image.");
    }

    // Insert data into the database
    $sql = "INSERT INTO courses (name, category, instructor, department, ratings, reviews, lessons, price, image) 
            VALUES ('$course_name', '$category', '$instructor', '$department', '$ratings', '$reviews', '$lessons', '$price', '$image_path')";

    if ($conn->query($sql) === TRUE) {
        echo "Course added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .btn {
            width: 100px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create Course</h1>
        <form action="create-course.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <input type="text" class="form-control" name="course_name" placeholder="Course name" required>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="category" placeholder="Category" required>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="instructor" placeholder="Instructor" required>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="department" placeholder="Department" required>
            </div>
            <div class="mb-3">
                <input type="number" step="0.1" class="form-control" name="ratings" placeholder="Ratings" required>
            </div>
            <div class="mb-3">
                <textarea class="form-control" name="reviews" placeholder="Reviews"></textarea>
            </div>
            <div class="mb-3">
                <input type="number" class="form-control" name="lessons" placeholder="Lessons" required>
            </div>
            <div class="mb-3">
                <input type="number" class="form-control" name="price" placeholder="Price" required>
            </div>
            <div class="mb-3">
                <input type="file" class="form-control" name="image" required>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Add</button>
                <button type="button" class="btn btn-danger" onclick="history.back()">
                    Back</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
