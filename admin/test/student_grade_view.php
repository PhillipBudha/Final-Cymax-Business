<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$database = "test";

// Create database connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch grades and associated test and student data
$sql = "
    SELECT g.id AS grade_id, g.student_name, g.grade, t.course_name
    FROM grades g
    JOIN uploads u ON g.upload_id = u.id
    JOIN tests t ON u.test_id = t.id
";
$result = $conn->query($sql);

$grades = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $grades[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Grades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container my-5">
    <h2 class="text-center mb-4">Student Grades</h2>

    <div class="row">
        <?php foreach ($grades as $grade): ?>
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($grade['course_name']); ?></h5>
                        <p class="card-text"><strong>Student:</strong> <?php echo htmlspecialchars($grade['student_name']); ?></p>
                        <p class="card-text"><strong>Grade:</strong> <?php echo htmlspecialchars($grade['grade']); ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
