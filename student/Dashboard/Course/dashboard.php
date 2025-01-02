<?php
require_once 'config.php';

// Handle course enrollment
if (isset($_POST['enroll'])) {
    $course_id = $_POST['course_id'];
    // User ID will be assumed to be available or defined elsewhere now
    $user_id = 1;  // Replace this with the actual user ID

    $stmt = $pdo->prepare("INSERT INTO user_courses (user_id, course_id) VALUES (?, ?)");
    $stmt->execute([$user_id, $course_id]);
    
    header("Location: dashboard.php");
    exit();
}

// Get user's enrolled courses
$stmt = $pdo->prepare("
    SELECT c.* 
    FROM courses c
    JOIN user_courses uc ON c.id = uc.course_id
    WHERE uc.user_id = ?
");
$stmt->execute([1]); // Replace with the actual user ID
$my_courses = $stmt->fetchAll();

// Get all available courses
$stmt = $pdo->prepare("
    SELECT c.*, 
    CASE WHEN uc.id IS NOT NULL THEN 1 ELSE 0 END as is_enrolled
    FROM courses c
    LEFT JOIN user_courses uc ON c.id = uc.course_id AND uc.user_id = ?
");
$stmt->execute([1]); // Replace with the actual user ID
$all_courses = $stmt->fetchAll();
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

                <div class="search-bar flex-grow-1 mx-3">
                    <i class="bi bi-search"></i>
                    <input type="search" class="form-control" placeholder="Search for courses, articles and...">
                </div>

                <div class="d-flex align-items-center">
                    <span class="me-4"><i class="bi bi-lightbulb"></i> My Learning</span>
                    <span class="me-4"><i class="bi bi-translate"></i> EN</span>
                    <div class="d-flex align-items-center">
                        <img src="https://via.placeholder.com/32" class="rounded-circle me-2" alt="Profile">
                        <span><i class="bi bi-person-circle me-1"></i>Takudzwa Emmanuel Mundendere</span>
                        <button class="logout-btn ms-3"><i class="bi bi-box-arrow-right"></i> Logout</button>
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
                <!-- My Courses Section -->
                <h4>My Courses</h4>
                <div class="row g-4 mb-5">
                    <?php if (empty($my_courses)): ?>
                        <div class="col-12">
                            <div class="alert alert-info">You haven't enrolled in any courses yet.</div>
                        </div>
                    <?php else: ?>
                        <?php foreach ($my_courses as $course): ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="course-card">
                                   <!--  <div class="course-thumbnail" style="background-image: url('<?php echo htmlspecialchars($course['image_url']); ?>');">
                                        <span class="course-level level-beginner">BEGINNER</span>
                                    </div> -->
                                    <div class="course-info">
                                        <h5><?php echo htmlspecialchars($course['title']); ?></h5>
                                        <p><?php echo htmlspecialchars($course['description']); ?></p>
                                        <button class="btn btn-primary">View Course</button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- Available Courses Section -->
                <h4>Available Courses</h4>
                <div class="row g-4">
                    <?php foreach ($all_courses as $course): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="course-card">
                                <div class="course-thumbnail" style="background-image: url('<?php echo htmlspecialchars($course['image_url']); ?>');">
                                    <span class="course-level level-beginner">BEGINNER</span>
                                </div>
                                <div class="course-info">
                                    <h5><?php echo htmlspecialchars($course['title']); ?></h5>
                                    <p><?php echo htmlspecialchars($course['description']); ?></p>
                                    <?php if (!$course['is_enrolled']): ?>
                                        <form method="POST">
                                            <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
                                            <button type="submit" name="enroll" class="btn btn-success">Enroll Now</button>
                                        </form>
                                    <?php else: ?>
                                        <button class="btn btn-secondary" disabled>Enrolled</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
