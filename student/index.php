<?php
session_start();
require 'db.php'; // Database connection file

// Fetch courses
$query = "SELECT * FROM courses";
$result = mysqli_query($conn, $query);
$courses = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="text-center">Available Courses</h1>
    <div class="row">
        <?php foreach ($courses as $course): ?>
            <div class="col-md-4">
                <div class="card mb-4">
                   <!--  <img src="<?= $course['image_url'] ?>" class="card-img-top" alt="Course Image"> -->
                    <div class="card-body">
                        <h5 class="card-title"><?= $course['title'] ?></h5>
                        <p class="card-text"><?= $course['description'] ?></p>
                        <p><strong>Duration:</strong> <?= $course['duration'] ?></p>
                        <p><strong>Level:</strong> <?= $course['level'] ?></p>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <form method="POST" action="enroll.php">
                                <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                                <button class="btn btn-primary w-50 rounded-pill">Enroll</button>
                            </form>
                        <?php else: ?>
                            <p class="text-muted">Login to enroll</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
