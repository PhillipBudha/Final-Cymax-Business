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
// Database connection settings
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "confluent_database"; 

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all test data
$result = $conn->query("SELECT * FROM tests");
$tests = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $tests[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Tests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background-color:#001F3F;
          
        }
    </style>
</head>
<body>
<!--**************************************************************************************************************
# Navigation
**************************************************************************************************************-->
<!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand"  href="javascript:void(0);" onclick="history.back();">
            <img src="../Cymax-Logo.jpg" alt="Study Logo" class="me-2" style="height: 40px; width: 120px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);" onclick="history.back();">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);" onclick="history.back();">Back</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

</body>
</html> -->


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

            <main class="col-md-9 col-lg-10 ms-sm-auto py-3">
              
<!--**************************************************************************************************************
# Availabe Test
**************************************************************************************************************-->
    <div class="container my-5">
        <h2 class="text-center text-white display-5 fw-bold mb-4">Available Tests</h2>
        <div class="row gy-4">
            <?php foreach ($tests as $test): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($test['course_name']); ?></h5>
                            <p class="card-text">
                                <strong>Time Remaining:</strong> 
                                <span id="time_<?php echo $test['id']; ?>">Loading...</span>
                            </p>
                            <a href="view_document.php?id=<?php echo $test['id']; ?>" target="_blank" class="btn btn-primary btn-sm mb-3">
                                View Document
                            </a>
                            <form id="uploadForm_<?php echo $test['id']; ?>" method="POST" enctype="multipart/form-data" action="upload_submission.php">
                              <input type="hidden" name="test_id" value="<?php echo $test['id']; ?>">
                                  <input type="hidden" name="student_name" value="John Doe"> <!-- Replace with actual student name -->
                                      <div class="mb-3">
                                        <label for="submission_file_<?php echo $test['id']; ?>" class="form-label">Upload Your Assignment:</label>
                                        <input type="file" id="submission_file_<?php echo $test['id']; ?>" name="submission_file" class="form-control" accept=".pdf,.doc,.docx" required>
                                         </div>
                                         <button type="submit" class="btn btn-outline-success w-50 rounded-pill">Upload</button>
                            </form>

                           <!--  <button class="btn btn-danger" onclick="deleteLastUpload()">Delete Last Upload</button> -->
                        </div>
                    </div>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        startCountdown(<?php echo $test['time_limit']; ?>, <?php echo $test['id']; ?>);
                    });
                </script>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
