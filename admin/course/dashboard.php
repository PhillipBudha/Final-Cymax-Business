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
$user_id = $_SESSION['user_id'];
$user_email = $_SESSION['email'];

$query = "
    SELECT courses.* FROM courses
    INNER JOIN enrollments ON courses.id = enrollments.course_id
    WHERE enrollments.user_id = $user_id
";
$result = mysqli_query($conn, $query);
$courses = mysqli_fetch_all($result, MYSQLI_ASSOC);
require_once "head.php";


?> 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../course/fontawesome-free-6.6.0-web/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
 <!--    <link rel="stylesheet" href="../course/bootstrap/css/style.css"> -->
    <!-- <style>
        a {
  text-decoration: none;
}

    </style>
 -->
</head>
<body>

<!--======================================================
   # Navigation Bar
  =======================================================-->
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark " aria-label="Third navbar example">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Cymax Business School</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample03"
                aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample03">
                <ul class="navbar-nav me-auto mb-2 mb-sm-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Results</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Events Managements</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Finance</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Library</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Account Settings</a>
                    </li>
                </ul>

                <ul class="navbar-nav  mb-2 mb-sm-0 navbar-right">
                    <li class="nav-item">
                        <a class="nav-link"  href="logout.php"><span><i
                             class="fas fa-sign-out-alt mx-2" ></i></span>logout</a>
                    </li>
                </ul>
            </div>
    </nav>


          
    <!--======================================================
   # Header
  =======================================================-->
  <div class="header" id="header">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <h3 class="mt-3"><span><i class="fa fa-user"></i></span> Admin Dashboard</h3>
                </div>
                <div class="col-md-2">
                    <div class="dropdown create">
                        <button type="button" href="" class="btn btn-outline-light dropdown-toggle rounded-pill"
                            data-bs-toggle="dropdown" aria-expanded="false"><span><i
                                    class="fa fa-pencil mx-2"></i></span> Create Content</button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Add Pages</a></li>
                            <li><a class="dropdown-item" href="#">Add Post</a></li>
                            <li><a class="dropdown-item" href="#">Add Users</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--======================================================
   # main
  =======================================================-->
    <section id="main">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <!-- ======= Sidebar ======= -->
                    <aside id="sidebar" class="sidebar">

                        <ul class="sidebar-nav" id="sidebar-nav">
          </li><!-- End Dashboard Nav -->

                            <li class="nav-item">
                                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse"
                                    href="../course/login.php">
                                    <i class="fas fa-list-alt mx-2"></i><span>Courses</span><i
                                        class="bi bi-chevron-down ms-auto"></i>
                                </a>
                                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                                   <li>
                                        <a href="coursemanage.php">
                                            <i class="bi bi-circle"></i><span>Assign & Manage Courses</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../assingment_tab/create_assingment.php">
                                            <i class="bi bi-circle"></i><span>Upload Assingments</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../test/create_test.php">
                                            <i class="bi bi-circle"></i><span>Upload Exams</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../quiz/teacher.php">
                                            <i class="bi bi-circle"></i><span>Upload Quizes</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../online lessons/index.php">
                                            <i class="bi bi-circle"></i><span>Upload Resources</span>
                                        </a>
                                    </li>
                                </ul>
                            </li><!-- End Courses Nav -->

                            <li class="nav-item">
                                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse"
                                    href="#">
                                    <i class="fas fa-journal-whills mx-2"></i><span>Results</span><i
                                        class="bi bi-chevron-down ms-auto"></i>
                                </a>
                                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                                    <li>
                                        <a href="../assingment_tab/view_submission.php">
                                            <i class="bi bi-circle"></i><span>View Assingments</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../assingment_tab/update_results.php">
                                            <i class="bi bi-circle"></i><span>Update Student Test or Assingment</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../test/view_test.php">
                                            <i class="bi bi-circle"></i><span>View Test</span>
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a href="../quiz/live.php">
                                            <i class="bi bi-circle"></i><span>View Quizes</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="forms-validation.html">
                                            <i class="bi bi-circle"></i><span>View Transcript</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="forms-validation.html">
                                            <i class="bi bi-circle"></i><span>View Certificate</span>
                                        </a>
                                    </li>
                                </ul>
                            </li><!-- End results Nav -->

                            <li class="nav-item">
                                <a class="nav-link collapsed" href="../news/index.php">
                                    <i class="fas fa-bell mx-2"></i>
                                    <span>Events Managements</span>
                                </a>
                            </li><!-- End events Page Nav -->

                            <li class="nav-item">
                                <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse"
                                    href="#">
                                    <i class="fa fa-user mx-2"></i><span>Finance</span><i
                                        class="bi bi-chevron-down ms-auto"></i>
                                </a>
                                <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                                    <li>
                                        <a href="tables-general.html">
                                            <i class="bi bi-circle"></i><span>Tuition</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="tables-data.html">
                                            <i class="bi bi-circle"></i><span>Fees</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="tables-data.html">
                                            <i class="bi bi-circle"></i><span>Scholarship</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="tables-data.html">
                                            <i class="bi bi-circle"></i><span>Financial Aid</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="tables-data.html">
                                            <i class="bi bi-circle"></i><span>Payment Plans</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="tables-data.html">
                                            <i class="bi bi-circle"></i><span>Invoices</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="tables-data.html">
                                            <i class="bi bi-circle"></i><span>Receipts</span>
                                        </a>
                                    </li>
                                </ul>
                            </li><!-- End payments Nav -->

                            <li class="nav-item">
                                <a class="nav-link collapsed" href="users-profile.html">
                                    <i class="fa fa-book mx-2"></i>
                                    <span>Library</span>
                                </a>
                            </li><!-- End library Nav -->

                            <li class="nav-item">
                                <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse"
                                    href="#">
                                    <i class="fa fa-cog mx-2"></i><span>Account Settings</span><i
                                        class="bi bi-chevron-down ms-auto"></i>
                                </a>
                                <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                                    <li>
                                        <a href="passwordreset.php">
                                            <i class="bi bi-circle"></i><span>Update Email</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="passwordreset.php">
                                            <i class="bi bi-circle"></i><span>Change Password</span>
                                        </a>
                                    </li>
                                </ul>

                                <ul>
                                </ul>
                            </li><!-- End account settings Nav -->
                        </ul>

                    </aside><!-- End Sidebar-->
                </div>

                <div class="col-md-9">
                <div class="container">
    <div class="row">
        <div class="col-xs-6">
            <div class="alert alert-success">
                <p>
                    <?php 
                    if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
                        echo "Welcome " . htmlspecialchars($_SESSION['email']);
                    } else {
                        echo "Welcome, Guest!";
                    }
                    ?>
                </p>
            </div><!-- .alert alert-success -->
        </div><!-- .col-xs-6 -->
        <div class="col-xs-6">
                <p><a href="create-course.php" role="button" class="btn btn-success">Add course</a></p>
            </div>
            </div>
    </div><!-- .row -->
</div><!-- .container -->

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



    <!-- Include Bootstrap JS (make sure to include Popper.js as well) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
     <!-- Include Bootstrap JS (make sure to include Popper.js as well) -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>
