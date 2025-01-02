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

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "confluent_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch courses from the database
$sql = "SELECT id, title FROM courses";
$result = $conn->query($sql);
$courses = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Teacher Dashboard</title>
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
                        <i class="fas fa-user"></i> Hello, <?php echo htmlspecialchars($user_email); ?>!
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
  <!--**************************************************************************************************************
# Create Quiz
**************************************************************************************************************-->
<div class="container mt-5">
    <h2>Create a Quiz</h2>
    <form action="create_quiz.php" method="post">
        <div class="form-group">
            <label for="course_id">Select Course:</label>
            <select name="title" id="title" class="form-control" required>
                <option value="">-- Select a Course --</option>
                <?php foreach ($courses as $course): ?>
                    <option value="<?php echo htmlspecialchars($course['title']); ?>">
                        <?php echo htmlspecialchars($course['title']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="time_limit">Time Limit (minutes):</label>
            <input type="number" name="time_limit" id="time_limit" class="form-control" required>
        </div>
        <div id="questions">
            <h4>Questions:</h4>
            <div class="form-group">
                <label for="question_text">Question:</label>
                <input type="text" name="question_text[]" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="options">Options:</label>
                <input type="text" name="option_a[]" placeholder="Option A" class="form-control" required>
                <input type="text" name="option_b[]" placeholder="Option B" class="form-control" required>
                <input type="text" name="option_c[]" placeholder="Option C" class="form-control" required>
                <input type="text" name="option_d[]" placeholder="Option D" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="correct_answer">Correct Answer:</label>
                <select name="correct_answer[]" class="form-control" required>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
            </div>
        </div>
        <button type="button" class="btn btn-primary rounded-pill mt-3" onclick="addQuestion()">Add Another Question</button>
        <button type="submit" class="btn btn-success rounded-pill mt-3">Save Quiz</button>
    </form>
</div>
    
<script>
    function addQuestion() {
        const questionHTML = `
            <div class="form-group">
                <label for="question_text">Question:</label>
                <input type="text" name="question_text[]" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="options">Options:</label>
                <input type="text" name="option_a[]" placeholder="Option A" class="form-control" required>
                <input type="text" name="option_b[]" placeholder="Option B" class="form-control" required>
                <input type="text" name="option_c[]" placeholder="Option C" class="form-control" required>
                <input type="text" name="option_d[]" placeholder="Option D" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="correct_answer">Correct Answer:</label>
                <select name="correct_answer[]" class="form-control" required>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
            </div>`;
        document.getElementById('questions').innerHTML += questionHTML;
    }
</script>
</body>
</html>
