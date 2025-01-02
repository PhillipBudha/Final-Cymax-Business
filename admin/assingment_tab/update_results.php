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
$dbname = "confluent_database"; // Database name

// Establish database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Create and Update actions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    $assignment_id = intval($_POST['assignment_id']);
    $student_name = $conn->real_escape_string($_POST['student_name']);
    $score = floatval($_POST['score']);
    $feedback = $conn->real_escape_string($_POST['feedback']);

    if ($action === "create") {
        $sql_insert = "INSERT INTO results (assignment_id, student_name, score, feedback, evaluated_at)
                       VALUES ('$assignment_id', '$student_name', '$score', '$feedback', NOW())";
        if ($conn->query($sql_insert) === TRUE) {
            $message = "Result added successfully!";
        } else {
            $message = "Error: " . $conn->error;
        }
    } elseif ($action === "update") {
        $result_id = intval($_POST['result_id']);
        $sql_update = "UPDATE results 
                       SET assignment_id='$assignment_id', student_name='$student_name', score='$score', feedback='$feedback'
                       WHERE id='$result_id'";
        if ($conn->query($sql_update) === TRUE) {
            $message = "Result updated successfully!";
        } else {
            $message = "Error: " . $conn->error;
        }
    }
}

// Handle Delete action
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $sql_delete = "DELETE FROM results WHERE id='$delete_id'";
    if ($conn->query($sql_delete) === TRUE) {
        $message = "Result deleted successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
}

// Fetch results and assignments for display and dropdown
$sql_results = "SELECT r.id, r.assignment_id, r.student_name, r.score, r.feedback, r.evaluated_at, 
                a.assignment_title, a.course_name 
                FROM results r 
                JOIN assignments a ON r.assignment_id = a.id 
                ORDER BY r.evaluated_at DESC";
$results = $conn->query($sql_results);

$sql_assignments = "SELECT id, assignment_title, course_name FROM assignments ORDER BY course_name ASC, assignment_title ASC";
$assignments = $conn->query($sql_assignments);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Results</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container, .table-container {
            margin-top: 30px;
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
# Table
**************************************************************************************************************-->
    <div class="container">
        <!-- Form for Create/Update -->
        <div class="form-container">
            <h2 class="text-center display-5 fw-bold ">Add or Update Results</h2>
            <?php if (isset($message)): ?>
                <div class="alert alert-info text-center"><?php echo htmlspecialchars($message); ?></div>
            <?php endif; ?>
            <form method="POST" action="">
                <input type="hidden" name="action" id="action" value="create">
                <input type="hidden" name="result_id" id="result_id" value="">
                <div class="mb-3">
                    <label for="assignment_id" class="form-label">Select Assignment</label>
                    <select name="assignment_id" id="assignment_id" class="form-select" required>
                        <option value="">-- Select Assignment --</option>
                        <?php while ($row = $assignments->fetch_assoc()): ?>
                            <option value="<?php echo $row['id']; ?>">
                                <?php echo htmlspecialchars($row['course_name'] . " - " . $row['assignment_title']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="student_name" class="form-label">Student Name</label>
                    <input type="text" name="student_name" id="student_name" class="form-control" placeholder="Enter student name" required>
                </div>
                <div class="mb-3">
                    <label for="score" class="form-label">Score (%)</label>
                    <input type="number" step="0.01" name="score" id="score" class="form-control" placeholder="Enter score (e.g., 85.50)" required>
                </div>
                <div class="mb-3">
                    <label for="feedback" class="form-label">Feedback</label>
                    <textarea name="feedback" id="feedback" rows="3" class="form-control" placeholder="Enter feedback (optional)"></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>

        <!-- Results Table -->
        <div class="table-container">
            <h2 class="text-center">Results</h2>
            <table class="table table-bordered table-hover">
                <thead class="table-success">
                    <tr>
                        <th>#</th>
                        <th>Course</th>
                        <th>Assignment Title</th>
                        <th>Student Name</th>
                        <th>Score (%)</th>
                        <th>Feedback</th>
                        <th>Evaluated At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $results->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['assignment_title']); ?></td>
                            <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['score']); ?>%</td>
                            <td><?php echo htmlspecialchars($row['feedback'] ?: 'No feedback'); ?></td>
                            <td><?php echo htmlspecialchars(date('F d, Y H:i:s', strtotime($row['evaluated_at']))); ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="editResult(
                                    <?php echo htmlspecialchars($row['id']); ?>,
                                    <?php echo htmlspecialchars($row['assignment_id']); ?>,
                                    '<?php echo htmlspecialchars($row['student_name']); ?>',
                                    '<?php echo htmlspecialchars($row['score']); ?>',
                                    '<?php echo htmlspecialchars($row['feedback']); ?>'
                                )">Edit</button>
                                <a href="?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- JavaScript for Edit Functionality -->
    <script>
        function editResult(id, assignment_id, student_name, score, feedback) {
            document.getElementById('action').value = 'update';
            document.getElementById('result_id').value = id;
            document.getElementById('assignment_id').value = assignment_id;
            document.getElementById('student_name').value = student_name;
            document.getElementById('score').value = score;
            document.getElementById('feedback').value = feedback;
        }
    </script>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
