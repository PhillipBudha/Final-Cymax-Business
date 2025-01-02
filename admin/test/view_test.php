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
$username = "root"; // Update with your actual username
$password = ""; // Update with your actual password
$database = "confluent_database"; // Update with your actual database name

// Create database connection
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
     <!-- Include Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>View Tests</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        a{
            text-decoration: none;
        }
    </style>
    <script>
        function startCountdown(timeLimit, testId) {
            const countdown = () => {
                if (timeLimit <= 0) {
                    clearInterval(timerInterval);
                    document.getElementById(`uploadBtn_${testId}`).disabled = true;
                    return;
                }
                timeLimit--;
                const minutes = Math.floor(timeLimit / 60);
                const seconds = timeLimit % 60;
                document.getElementById(`time_${testId}`).innerText = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
            };

            const timerInterval = setInterval(countdown, 1000);
        }

        const handleUpload = (testId) => {
            const formData = new FormData(document.getElementById(`uploadForm_${testId}`));
            fetch('upload_submission.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                document.getElementById(`uploadBtn_${testId}`).disabled = true;
            });
        };

        const handleDelete = (testId) => {
            if (confirm("Are you sure you want to delete this test?")) {
                fetch(`delete_test.php?id=${testId}`, {
                    method: 'DELETE'
                })
                .then(response => {
                    if (response.ok) {
                        alert("Test deleted successfully!");
                        location.reload(); // Reload the page to refresh the data
                    } else {
                        alert("Error deleting test.");
                    }
                });
            }
        };
    </script>
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
# AVailable Test
**************************************************************************************************************-->
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <h2 class="display-5 text-center fw-bold pb-5">Available Tests</h2>
    <table  class="table table-bordered table-hover">
        <thead class="table-primary">
            <tr>
                <th>Course Name</th>
                <th>Time Limit (seconds)</th>
                <th>Document</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tests as $test): ?>
                <tr>
                    <td><?php echo htmlspecialchars($test['course_name']); ?></td>
                    <td><?php echo htmlspecialchars($test['time_limit']); ?></td>
                    <td>
                        <a href="view_document.php?id=<?php echo $test['id']; ?>" target="_blank">View Document</a>
                    </td>
                    <td>
                        <div>Time Remaining: <span id="time_<?php echo $test['id']; ?>">Loading...</span></div>
                        <form id="uploadForm_<?php echo $test['id']; ?>" onsubmit="event.preventDefault(); handleUpload(<?php echo $test['id']; ?>);">
                            <input type="hidden" name="test_id" value="<?php echo $test['id']; ?>">
                            <input type="hidden" name="student_name" value="Student Name"> <!-- Replace with actual student name -->
                            <label>Upload Your Assignment:</label>
                            <input type="file" name="submission_file" accept=".pdf,.doc,.docx" required>
                            <button type="submit" class="btn btn-primary rounded-pill" id="uploadBtn_<?php echo $test['id']; ?>">Upload</button>
                        </form>
                        <button class="btn btn-primary rounded-pill" onclick="handleDelete(<?php echo $test['id']; ?>)">Delete</button>
                        <script>
                            startCountdown(<?php echo $test['time_limit']; ?>, <?php echo $test['id']; ?>);
                        </script>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
        </div>
    </div>

</div>
   
</body>
</html>