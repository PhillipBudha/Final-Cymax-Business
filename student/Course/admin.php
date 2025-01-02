<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

include('db_connection.php');

// Initialize message variables
$message = "";

// Ensure the video, image, and PDF are handled correctly
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'addLesson':
                $courseId = intval($_POST['course_id']);
                $lessonTitle = htmlspecialchars($_POST['lesson_title']);
                $stmt = $conn->prepare("INSERT INTO Lessons (lesson_title, course_id) VALUES (?, ?)");
                $stmt->bind_param("si", $lessonTitle, $courseId);
                if ($stmt->execute()) {
                    $message = "Lesson added successfully!";
                } else {
                    $message = "Error adding lesson.";
                }
                $stmt->close();
                break;

            case 'addSubheading':
                $lessonId = intval($_POST['lesson_id']);
                $subheadingTitle = htmlspecialchars($_POST['subheading_title']);
                $subheadingContent = htmlspecialchars($_POST['subheading_content']);

                $video = null;
                $image = null;
                $pdf = null;

                if (!empty($_FILES['video_file']['tmp_name'])) {
                    $video = file_get_contents($_FILES['video_file']['tmp_name']);
                }
                if (!empty($_FILES['image_file']['tmp_name'])) {
                    $image = file_get_contents($_FILES['image_file']['tmp_name']);
                }
                if (!empty($_FILES['pdf_file']['tmp_name'])) {
                    $pdf = file_get_contents($_FILES['pdf_file']['tmp_name']);
                }

                $stmt = $conn->prepare(
                    "INSERT INTO Subheadings (lesson_id, subheading_title, subheading_content, video_blob, image_blob, pdf_blob) 
                     VALUES (?, ?, ?, ?, ?, ?)"
                );
                $stmt->bind_param(
                    "isssss",
                    $lessonId,
                    $subheadingTitle,
                    $subheadingContent,
                    $video,
                    $image,
                    $pdf
                );

                if ($stmt->execute()) {
                    $message = "Subheading added successfully!";
                } else {
                    $message = "Error adding subheading.";
                }
                $stmt->close();
                break;
        }
    }
}


// Fetch courses for dropdown
$courses = [];
$courseResult = $conn->query("SELECT * FROM Courses");
while ($row = $courseResult->fetch_assoc()) {
    $courses[] = $row;
}

// Fetch lessons for dropdown
$lessons = [];
$lessonResult = $conn->query("SELECT * FROM Lessons");
while ($row = $lessonResult->fetch_assoc()) {
    $lessons[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="text-center mb-4">Admin Panel</h1>

        <!-- Display message -->
        <?php if (!empty($message)) : ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>

        <!-- Add Lesson -->
        <div class="card mb-4">
            <div class="card-header">Add Lesson</div>
            <div class="card-body">
                <form method="POST">
                    <input type="hidden" name="action" value="addLesson">
                    <div class="mb-3">
                        <label for="course_id" class="form-label">Select Course</label>
                        <select class="form-select" id="course_id" name="course_id" required>
                            <option value="" disabled selected>Select a course</option>
                            <?php foreach ($courses as $course) : ?>
                                <option value="<?php echo $course['id']; ?>">
                                    <?php echo htmlspecialchars($course['title']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="lesson_title" class="form-label">Lesson Title</label>
                        <input type="text" class="form-control" id="lesson_title" name="lesson_title" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Lesson</button>
                </form>
            </div>
        </div>

        <!-- Add Subheading -->
        <div class="card">
            <div class="card-header">Add Subheading</div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="addSubheading">
                    <div class="mb-3">
                        <label for="lesson_id" class="form-label">Select Lesson</label>
                        <select class="form-select" id="lesson_id" name="lesson_id" required>
                            <option value="" disabled selected>Select a lesson</option>
                            <?php foreach ($lessons as $lesson) : ?>
                                <option value="<?php echo $lesson['lesson_id']; ?>">
                                    <?php echo htmlspecialchars($lesson['lesson_title']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="subheading_title" class="form-label">Subheading Title</label>
                        <input type="text" class="form-control" id="subheading_title" name="subheading_title" required>
                    </div>
                    <div class="mb-3">
                        <label for="subheading_content" class="form-label">Subheading Content</label>
                        <textarea class="form-control" id="subheading_content" name="subheading_content" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="video_file" class="form-label">Upload Video</label>
                        <input type="file" class="form-control" id="video_file" name="video_file" accept="video/*">
                    </div>
                    <div class="mb-3">
                        <label for="image_file" class="form-label">Upload Image</label>
                        <input type="file" class="form-control" id="image_file" name="image_file" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="pdf_file" class="form-label">Upload PDF</label>
                        <input type="file" class="form-control" id="pdf_file" name="pdf_file" accept="application/pdf">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Subheading</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
