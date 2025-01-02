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
$submission_dbname = "confluent_database"; // Database for submissions

// Establish database connection
$conn = new mysqli($servername, $username, $password, $submission_dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle CRUD operations
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete'])) {
        $submission_id = intval($_POST['delete']);
        $sql = "DELETE FROM submission WHERE id = $submission_id";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Submission deleted successfully.');</script>";
        } else {
            echo "<script>alert('Error deleting submission: " . $conn->error . "');</script>";
        }
    }

    if (isset($_POST['update'])) {
        $submission_id = intval($_POST['update']);
        $student_name = $conn->real_escape_string($_POST['student_name']);
        $sql = "UPDATE submission SET student_name = '$student_name' WHERE id = $submission_id";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Submission updated successfully.');</script>";
        } else {
            echo "<script>alert('Error updating submission: " . $conn->error . "');</script>";
        }
    }
}

// Fetch submissions from the database
$sql = "SELECT s.id, s.assignment_id, s.student_name, s.file_path, s.submitted_at, 
        a.assignment_title, a.course_name 
        FROM submission s 
        JOIN assignments a ON s.assignment_id = a.id 
        ORDER BY s.submitted_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Submissions</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table-container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
<!--**************************************************************************************************************
# Navigation
**************************************************************************************************************-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
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
                <a class="nav-link" href="#">
                 <i class="fas fa-user"></i> Hello, <?php echo htmlspecialchars($user_email); ?>!</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!--**************************************************************************************************************
# Manage Submissions
**************************************************************************************************************-->
    <div class="container table-container">
        <h2 class="text-center mb-4 display-5 fw-bold mb-5">Manage Submissions</h2>
        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Course</th>
                        <th>Assignment Title</th>
                        <th>Student Name</th>
                        <th>File</th>
                        <th>Submitted At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['assignment_title']); ?></td>
                            <td>
                                <form method="POST" class="d-flex align-items-center">
                                    <input type="text" class="form-control form-control-sm me-2" name="student_name" value="<?php echo htmlspecialchars($row['student_name']); ?>" required>
                                    <button type="submit" name="update" value="<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-sm btn-warning">Update</button>
                                </form>
                            </td>
                            <td>
                                <a href="<?php echo htmlspecialchars($row['file_path']); ?>" class="btn btn-sm btn-success" download>View</a>
                            </td>
                            <td><?php echo htmlspecialchars(date('F d, Y H:i:s', strtotime($row['submitted_at']))); ?></td>
                            <td>
                                <form method="POST" style="display:inline;">
                                    <button type="submit" name="delete" value="<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this submission?');">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-warning text-center">No submissions available to display.</div>
        <?php endif; ?>
    </div>

    <!-- Close database connection -->
    <?php $conn->close(); ?>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
