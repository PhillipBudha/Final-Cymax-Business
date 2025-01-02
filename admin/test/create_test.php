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

// Database connection settings
$servername = "localhost"; // Your server name
$username = "root";     // Your database username
$password = "";             // Your database password
$database = "confluent_database"; // Your database name

// Create database connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch courses from the database
$course_query = "SELECT id, title FROM courses";
$course_result = $conn->query($course_query);
if (!$course_result) {
    die("Error fetching courses: " . $conn->error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $course_id = intval($_POST['course_id']);
    $days = (int)$_POST['days'];
    $hours = (int)$_POST['hours'];
    $seconds = (int)$_POST['seconds'];

    // Calculate total time limit in seconds
    $time_limit = ($days * 86400) + ($hours * 3600) + $seconds;
    $document_blob = null;

    // Handle file upload
    if (isset($_FILES['test_document']) && $_FILES['test_document']['error'] == 0) {
        // Read the file content
        $document_blob = file_get_contents($_FILES['test_document']['tmp_name']);
    } else {
        die("Sorry, there was an error uploading your file.");
    }

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO tests (course_id, time_limit, document_blob) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $course_id, $time_limit, $document_blob);

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Test created successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Test</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="javascript:void(0);" onclick="history.back();">
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
                    <a class="nav-link" href="#">
                        <i class="fas fa-user"></i> Hello, <?php echo htmlspecialchars($user_email); ?>!</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="text-center display-5 fw-bold mb-4">Create a Test</h2>
    <form method="post" enctype="multipart/form-data" class="border p-4 rounded shadow">
        <div class="form-group pb-5">
            <label for="course_id" class="pb-2">Course Name:</label>
            <select class="form-control" id="course_id" name="course_id" required>
                <option value="" disabled selected>Select a course</option>
                <?php while ($course_row = $course_result->fetch_assoc()): ?>
                    <option value="<?php echo $course_row['id']; ?>">
                        <?php echo htmlspecialchars($course_row['title']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group row pb-5">
            <label class="col-sm-2 col-form-label">Time Limit:</label>
            <div class="col-sm-3">
                <input type="number" class="form-control" id="days" name="days" min="0" value="" required placeholder="Days">
            </div>
            <div class="col-sm-3">
                <input type="number" class="form-control" id="hours" name="hours" min="0" max="23" value="" required placeholder="Hours">
            </div>
            <div class="col-sm-3">
                <input type="number" class="form-control" id="seconds" name="seconds" min="0" max="59" value="" required placeholder="Seconds">
            </div>
        </div>
        <div class="form-group pb-3">
            <label for="test_document">Upload Document (PDF/Word):</label>
            <input type="file" class="form-control-file" id="test_document" name="test_document" accept=".pdf,.doc,.docx" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block rounded-pill">Create Test</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
