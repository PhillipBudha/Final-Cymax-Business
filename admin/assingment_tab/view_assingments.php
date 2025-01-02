<?php
session_start(); // Start the session

// Check if user is logged in by checking session variables
if (!isset($_SESSION['user_id']) || !isset($_SESSION['email'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

// If logged in, retrieve user data
$user_id = $_SESSION['user_id'];
$user_email = $_SESSION['email'];

?>

<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "confluent_database"; // Database for assignments
$submission_dbname = "confluent_database"; // Database for submissions

// Establish database connection for assignments
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection for assignments
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Establish database connection for submissions
$conn_submission = new mysqli($servername, $username, $password, $submission_dbname);

// Check connection for submissions
if ($conn_submission->connect_error) {
    die("Connection to submission database failed: " . $conn_submission->connect_error);
}

// Handle file upload for submissions
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['assignment_id'])) {
    $assignment_id = intval($_POST['assignment_id']);
    $student_name = isset($_POST['student_name']) ? $conn_submission->real_escape_string($_POST['student_name']) : '';
    $target_dir = "submissions/";
    $file_name = basename($_FILES["student_file"]["name"]);
    $target_file = $target_dir . $file_name;
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Ensure the submissions directory exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Allow only specific file types
    if (in_array($file_type, ['ppt', 'pptx', 'doc', 'docx', 'pdf'])) {
        if (move_uploaded_file($_FILES["student_file"]["tmp_name"], $target_file)) {
            // Insert submission into the database
            $sql_submission = "INSERT INTO submission (assignment_id, student_name, file_path, submitted_at)
                               VALUES ('$assignment_id', '$student_name', '$target_file', NOW())";

            if ($conn_submission->query($sql_submission) === TRUE) {
                echo "<script>alert('Assignment uploaded successfully!');</script>";
            } else {
                echo "<script>alert('Database Error: " . $conn_submission->error . "');</script>";
            }
        } else {
            echo "<script>alert('File upload error: Unable to move file.');</script>";
        }
    } else {
        echo "<script>alert('Invalid file type. Only PPT, Word, and PDF files are allowed.');</script>";
    }
}

// Fetch assignments from the database
$sql = "SELECT id, course_name, assignment_title, time_limit, file_path, instructions, created_at FROM assignments ORDER BY created_at DESC";
$result = $conn->query($sql);
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Learning Dashboard -Cymax Business School</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>

        :root {
  --cisco-blue: #049fd9;
  --notification-gradient: linear-gradient(90deg, #004d40 0%, #00796b 100%);
}
.assignment-card {
            margin-bottom: 20px;
        }
        .card-header {
            font-weight: bold;
        }

.notification-banner {
  background: var(--notification-gradient);
  color: white;
  padding: 1rem;
}

.navbar {
  border-bottom: 1px solid #e0e0e0;
  padding: 0.5rem 1rem;
}

.search-bar {
  max-width: 400px;
  position: relative;
}

.search-bar .form-control {
  padding-left: 2.5rem;
  border-radius: 4px;
  background-color: #f5f5f5;
}

.search-bar .bi-search {
  position: absolute;
  left: 0.75rem;
  top: 50%;
  transform: translateY(-50%);
  color: #666;
}

.course-card {
  position: relative;
  border-radius: 8px;
  overflow: hidden;
  transition: transform 0.2s;
}

.course-card:hover {
  transform: translateY(-2px);
}

.course-thumbnail {
  position: relative;
  padding-top: 56.25%;
  background-size: cover;
  background-position: center;
}

.course-level {
  position: absolute;
  top: 1rem;
  left: 1rem;
  padding: 0.25rem 0.75rem;
  border-radius: 4px;
  font-size: 0.75rem;
  font-weight: 600;
}

.level-beginner {
  background-color: #4caf50;
  color: white;
}

.level-intermediate {
  background-color: #ff9800;
  color: white;
}

.play-button {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 48px;
  height: 48px;
  background-color: rgba(255, 255, 255, 0.9);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.course-info {
  padding: 1rem;
  background-color: white;
  border: 1px solid #e0e0e0;
  border-top: none;
}

.provider-logo {
  height: 24px;
  width: auto;
}

.sidebar {
  background-color: #f8f9fa;
  padding: 1rem;
  height: calc(100vh - 120px);
}

.sidebar-link {
  display: flex;
  align-items: center;
  padding: 0.5rem 1rem;
  color: #333;
  text-decoration: none;
  border-radius: 4px;
}

.sidebar-link:hover {
  background-color: #e9ecef;
}

.sidebar-link.active {
  background-color: #e9ecef;
  font-weight: 500;
}

.logout-btn {
  background-color: #4caf50;
  color: white;
  border: none;
  padding: 0.375rem 1rem;
  border-radius: 4px;
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
                <a  href="javascript:void(0);" onclick="history.back();" class="sidebar-link active">
                        <i class="bi bi-grid me-2"></i> Return Dashboard
                    </a>
            </div>
        </div>

            <main class="col-md-9 col-lg-10 ms-sm-auto px-4 ">
                
 <!--**************************************************************************************************************
# View Assingments
**************************************************************************************************************-->
    <div class="container">
        <h2 class="text-center text-white display-5 fw-bold mb-4">View Assignments</h2>
        <div class="row">
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="col-md-4">
                        <div class="card assignment-card shadow-sm">
                            <div class="card-header text-white bg-primary">
                                <?php echo htmlspecialchars($row['course_name']); ?>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($row['assignment_title']); ?></h5>
                                <p class="card-text">
                                    <strong>Time Limit:</strong> <?php echo htmlspecialchars($row['time_limit']); ?> hours<br>
                                    <strong>Instructions:</strong> <?php echo htmlspecialchars($row['instructions']); ?>
                                </p>
                                <a href="<?php echo htmlspecialchars($row['file_path']); ?>" class="btn btn-success mb-3" download>Download</a>

                                <!-- Upload Assignment Form -->
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="assignment_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                    <div class="mb-3">
                                        <label for="student_file" class="form-label">Upload Your Assignment</label>
                                        <input type="file" class="form-control" name="student_file" accept=".ppt,.pptx,.doc,.docx,.pdf" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="student_name" class="form-label">Your Name</label>
                                        <input type="text" class="form-control" name="student_name" placeholder="Enter your name" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </form>
                            </div>
                            <div class="card-footer text-muted">
                                Uploaded on: <?php echo htmlspecialchars(date('F d, Y', strtotime($row['created_at']))); ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        No assignments available to display.
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Close database connections -->
    <?php 
    $conn->close();
    $conn_submission->close();
    ?>
              
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
