<?php
session_start(); // Start the session

// Check if user is logged in by checking session variables
if (!isset($_SESSION['user_id']) || !isset($_SESSION['email'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

// If logged in, retrieve user data
$user_email = $_SESSION['email'];

// Database connection details
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "confluent_database";

// Establish database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch courses from the database
$course_query = "SELECT id, title FROM courses";
$course_result = $conn->query($course_query);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_id = intval($_POST['courseId']);
    $assignment_title = $conn->real_escape_string($_POST['assignmentTitle']);
    $time_limit = intval($_POST['timeLimit']);
    $instructions = $conn->real_escape_string($_POST['instructions']);

    // File upload handling
    $target_dir = "uploads/";
    $file_name = basename($_FILES["fileUpload"]["name"]);
    $target_file = $target_dir . $file_name;
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Allow only PPT, Word, and PDF files
    if (!in_array($file_type, ['ppt', 'pptx', 'doc', 'docx', 'pdf'])) {
        $error_message = "Only PPT, Word, and PDF files are allowed.";
    } elseif (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
        // Insert data into database
        $sql = "INSERT INTO assignments (course_id, assignment_title, time_limit, file_path, instructions) 
                VALUES ('$course_id', '$assignment_title', '$time_limit', '$target_file', '$instructions')";

        if ($conn->query($sql) === TRUE) {
            $success_message = "New assignment created successfully.";
        } else {
            $error_message = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $error_message = "There was an error uploading your file.";
    }
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Assignment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .assignment-form {
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="javascript:void(0);" onclick="history.back();">
                <img src="../Cymax-Logo.jpg" alt="Study Logo" class="me-2" style="height: 40px; width: 120px;">
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);" onclick="history.back();">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-user"></i> Hello, <?php echo htmlspecialchars($user_email); ?>!
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="assignment-form">
            <h2 class="text-center mb-4 display-5 fw-bold">Create Assignment</h2>

            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger"> <?php echo $error_message; ?> </div>
            <?php elseif (isset($success_message)): ?>
                <div class="alert alert-success"> <?php echo $success_message; ?> </div>
            <?php endif; ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="courseId" class="form-label">Course</label>
                    <select class="form-control" id="courseId" name="courseId" required>
                        <option value="" disabled selected>Select a course</option>
                        <?php while ($course_row = $course_result->fetch_assoc()): ?>
                            <option value="<?php echo $course_row['id']; ?>">
                                <?php echo htmlspecialchars($course_row['title']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="assignmentTitle" class="form-label">Assignment Title</label>
                    <input type="text" class="form-control" id="assignmentTitle" name="assignmentTitle" required>
                </div>

                <div class="mb-3">
                    <label for="timeLimit" class="form-label">Time Limit (in hours)</label>
                    <input type="number" class="form-control" id="timeLimit" name="timeLimit" required>
                </div>

                <div class="mb-3">
                    <label for="fileUpload" class="form-label">Upload Documents (PPT, Word, PDF)</label>
                    <input type="file" class="form-control" id="fileUpload" name="fileUpload" accept=".ppt,.pptx,.doc,.docx,.pdf" required>
                </div>

                <div class="mb-3">
                    <label for="instructions" class="form-label">Additional Instructions</label>
                    <textarea class="form-control" id="instructions" name="instructions"></textarea>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary rounded-pill">Create Assignment</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
