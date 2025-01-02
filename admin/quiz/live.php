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
// live_data.php
$conn = new mysqli("localhost", "root", "", "confluent_database");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch quiz results
$results = $conn->query("SELECT * FROM quiz_results ORDER BY submission_time DESC");

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Quiz Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
# Live Quiz Results
**************************************************************************************************************-->
    <div class="container mt-2">
        <h1 class="text-center display-5 fw-bold mb-4">Live Quiz Results</h1>
        <div class="table-responsive">
            <table class="table table-bordered  table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Quiz ID</th>
                        <th>Student Name</th>
                        <th>Score</th>
                        <th>Total Questions</th>
                        <th>Submission Time</th>
                    </tr>
                </thead>
                <tbody >
                    <?php if ($results && $results->num_rows > 0): ?>
                        <?php while ($row = $results->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['id']) ?></td>
                                <td><?= htmlspecialchars($row['quiz_id']) ?></td>
                                <td><?= htmlspecialchars($row['student_name']) ?></td>
                                <td><?= htmlspecialchars($row['score']) ?></td>
                                <td><?= htmlspecialchars($row['total']) ?></td>
                                <td><?= htmlspecialchars($row['submission_time']) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">No results available</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
