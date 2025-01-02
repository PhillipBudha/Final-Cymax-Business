<?php
session_start(); // Start the session
require 'db.php';

// Check if user is logged in by checking session variables
if (!isset($_SESSION['user_id']) || !isset($_SESSION['email'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

// If logged in, retrieve user data
//$user_id = $_SESSION['user_id'];
$user_id = $_SESSION['user_id'];
$user_email = $_SESSION['email'];
$query = "
    SELECT courses.* FROM courses
    INNER JOIN enrollments ON courses.id = enrollments.course_id
    WHERE enrollments.user_id = $user_id
";
$result = mysqli_query($conn, $query);
$courses = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Learning Dashboard - Cymax Business School</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .full-image {
             width: 100%;
             height: 80%;
             object-fit: fill;
         }
    </style>
</head>

<body>
    <!-- Notification Banner -->
    <div class="notification-banner">
        <!-- Existing Banner Code -->
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="assets/img/Cymax-Logo.jpg" height="40" alt="Cymax Business School">
            </a>

            <div class="d-flex align-items-center flex-grow-1 justify-content-between">
                <button class="btn btn-outline-secondary me-3">
                    <i class="bi bi-grid"></i> Explore
                </button>
<!-- 
                <div class="search-bar flex-grow-1 mx-3">
                    <i class="bi bi-search"></i>
                    <input type="search" class="form-control" placeholder="Search for courses, articles and...">
                </div> -->

                <div class="d-flex align-items-center">
                    <span class="me-4"><i class="bi bi-lightbulb"></i> My Learning</span>
                    <span class="me-4"><i class="bi bi-translate"></i> EN</span>
                    <div class="d-flex align-items-center">
                      <!--   <img src="https://via.placeholder.com/32" class="rounded-circle me-2" alt="Profile"> -->
                        <span><i class="bi bi-person-circle me-1"></i> Hello, <?php echo htmlspecialchars($user_email); ?>!</span>
                        <a class="btn logout-btn ms-3" href="logout.php"> <i class="bi bi-box-arrow-right"> </i> Logout </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-lg-2 d-none d-md-block sidebar">
                <!-- Sidebar Navigation -->
                <h5 class="mb-4">
                    <i class="bi bi-book"></i> My Learning
                </h5>
                <div class="mb-4">
                    <a href="#" class="sidebar-link active">
                        <i class="bi bi-grid me-2"></i> Dashboard
                    </a>
                    <a href="Course/index.php" class="sidebar-link">
                        <i class="bi bi-mortarboard me-2"></i> My Learning
                    </a>
                    <a href="course.php" class="sidebar-link">
                        <i class="bi bi-pencil me-2"></i> Course
                    </a>
                    <a href="results.php" class="sidebar-link">
                        <i class="bi bi-book me-2"></i> Results
                    </a>
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-newspaper me-2"></i> News
                    </a>
                    <a href="profile.php" class="sidebar-link">
                        <i class="bi bi-person me-2"></i> Profile
                    </a>
                </div>
            </div>

            <main class="col-md-9 col-lg-10 ms-sm-auto px-4 py-3">
            <div class="container mt-4">
    <h1 class="text-center">Your Enrolled Courses</h1>
    <div class="row">
        <?php foreach ($courses as $course): ?>
            <div class="col-md-4">
                <div class="card mb-4">
                  <!--   <img src="<?= $course['image_url'] ?>" class="card-img-top" alt="Course Image"> -->
                    <div class="card-body">
                        <h5 class="card-title"><?= $course['title'] ?></h5>
                        <p class="card-text"><?= $course['description'] ?></p>
                        <p><strong>Duration:</strong> <?= $course['duration'] ?></p>
                        <p><strong>Level:</strong> <?= $course['level'] ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
                <!--   <img src="../assets/img/dashboard-1.png" alt="" class="full-image"> -->
            </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
