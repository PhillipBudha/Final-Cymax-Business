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
$conn = new mysqli("localhost", "root", "", "confluent_database");

// Fetch all quizzes
$quizzes = $conn->query("SELECT quizzes.id, courses.title AS title FROM quizzes 
                          JOIN courses ON quizzes.id = courses.id");
$quiz_id = isset($_GET['quiz_id']) ? $_GET['quiz_id'] : null;

if ($quiz_id) {
    $quiz = $conn->query("SELECT * FROM quizzes WHERE id = $quiz_id")->fetch_assoc();
    $questions = $conn->query("SELECT * FROM questions WHERE quiz_id = $quiz_id");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
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
                    <a class="nav-link" href="javascript:void(0);" onclick="history.back();">Back</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-lg-2 d-none d-md-block sidebar">
                <h5 class="mb-4">
                    <i class="bi bi-book"></i> My Learning
                </h5>
            </div>

            <main class="col-md-9 col-lg-10 ms-sm-auto px-4">
                <div class="container">
                    <h1 class="text-white display-5 fw-bold mb-5">Select a Quiz</h1>
                    <form method="get" action="student_view.php" class="mb-4">
                        <div class="form-group mb-5">
                            <label for="quiz_id" class="text-white mb-5">Choose a quiz:</label>
                            <select name="quiz_id" id="quiz_id" class="form-control" required>
                                <option value="">-- Select a Quiz --</option>
                                <?php while ($row = $quizzes->fetch_assoc()): ?>
                                    <option value="<?= $row['id'] ?>" <?= $quiz_id == $row['id'] ? 'selected' : '' ?>>
                                        <?= $row['title'] ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Load Quiz</button>
                    </form>

                    <?php if ($quiz_id && $quiz): ?>
                        <h2>Quiz: <?= $quiz['course_name'] ?></h2>
                        <form action="submit_quiz.php" method="post">
                            <input type="hidden" name="quiz_id" value="<?= $quiz_id ?>">
                            <input type="hidden" name="student_name" value="<?= htmlspecialchars($user_email); ?>">

                            <?php while ($q = $questions->fetch_assoc()): ?>
                                <div class="form-group">
                                    <p><?= $q['question_text'] ?></p>
                                    <input type="radio" name="answers[<?= $q['id'] ?>]" value="A" required> <?= $q['option_a'] ?><br>
                                    <input type="radio" name="answers[<?= $q['id'] ?>]" value="B" required> <?= $q['option_b'] ?><br>
                                    <input type="radio" name="answers[<?= $q['id'] ?>]" value="C" required> <?= $q['option_c'] ?><br>
                                    <input type="radio" name="answers[<?= $q['id'] ?>]" value="D" required> <?= $q['option_d'] ?><br>
                                </div>
                            <?php endwhile; ?>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    <?php elseif ($quiz_id): ?>
                        <p class="text-danger">Invalid quiz selected. Please try again.</p>
                    <?php endif; ?>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
