<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$course_id = $_POST['course_id'];

// Check if the user is already enrolled
$query = "SELECT * FROM enrollments WHERE user_id = $user_id AND course_id = $course_id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    // Enroll the user
    $query = "INSERT INTO enrollments (user_id, course_id) VALUES ($user_id, $course_id)";
    mysqli_query($conn, $query);
}

header("Location: dashboard.php");
exit;
?>
