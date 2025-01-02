<?php
include('db_connect.php');

// Ensure uploads directory exists
$uploadDir = realpath(__DIR__ . '/../uploads') . '/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Handle Create, Update, Delete, and Download operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    // File upload handling
    function uploadFile($file, $allowedTypes) {
        global $uploadDir;
        if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
            $fileType = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if (!in_array($fileType, $allowedTypes)) {
                return null; // Invalid file type
            }

            $filename = uniqid() . "_" . basename($file['name']);
            $targetPath = $uploadDir . $filename;
            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                return $targetPath; // Return the absolute path
            }
        }
        return null;
    }

    if ($action === 'add') {
        $lesson_id = $_POST['lesson_id'];
        $subheading_title = $_POST['subheading_title'];
        $subheading_content = $_POST['subheading_content'];
        $video_url = uploadFile($_FILES['video_url'], ['mp4', 'avi', 'mov']);
        $image_url = uploadFile($_FILES['image_url'], ['jpg', 'jpeg', 'png', 'gif']);
        $pdf_url = uploadFile($_FILES['pdf_url'], ['pdf']);

        $sql = "INSERT INTO Subheadings (lesson_id, subheading_title, subheading_content, video_url, image_url, pdf_url) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssss", $lesson_id, $subheading_title, $subheading_content, $video_url, $image_url, $pdf_url);
        $stmt->execute();

    } elseif ($action === 'edit') {
        $subheading_id = $_POST['subheading_id'];
        $lesson_id = $_POST['lesson_id'];
        $subheading_title = $_POST['subheading_title'];
        $subheading_content = $_POST['subheading_content'];

        $video_url = uploadFile($_FILES['video_url'], ['mp4', 'avi', 'mov']) ?? $_POST['existing_video_url'];
        $image_url = uploadFile($_FILES['image_url'], ['jpg', 'jpeg', 'png', 'gif']) ?? $_POST['existing_image_url'];
        $pdf_url = uploadFile($_FILES['pdf_url'], ['pdf']) ?? $_POST['existing_pdf_url'];

        $sql = "UPDATE Subheadings SET lesson_id = ?, subheading_title = ?, subheading_content = ?, video_url = ?, image_url = ?, pdf_url = ? WHERE subheading_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssssi", $lesson_id, $subheading_title, $subheading_content, $video_url, $image_url, $pdf_url, $subheading_id);
        $stmt->execute();

    } elseif ($action === 'delete') {
        $subheading_id = $_POST['subheading_id'];

        $sql = "DELETE FROM Subheadings WHERE subheading_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $subheading_id);
        $stmt->execute();

    } elseif ($action === 'download') {
        $pdf_url = $_POST['pdf_url'];
        if (file_exists($pdf_url)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . basename($pdf_url) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($pdf_url));
            readfile($pdf_url);
            exit;
        } else {
            echo "File does not exist.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Subheadings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Manage Subheadings</h2>

        <!-- Add Subheading Form -->
        <form method="POST" enctype="multipart/form-data" class="mb-4">
            <input type="hidden" name="action" value="add">
            <div class="mb-3">
                <label for="lesson_id" class="form-label">Select Lesson</label>
                <select class="form-select" id="lesson_id" name="lesson_id" required>
                    <option value="">-- Select Lesson --</option>
                    <?php
                    $lessons = $conn->query("SELECT lesson_id, lesson_title FROM Lessons");
                    while ($lesson = $lessons->fetch_assoc()) {
                        echo "<option value='{$lesson['lesson_id']}'>{$lesson['lesson_title']}</option>";
                    }
                    ?>
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
                <label for="video_url" class="form-label">Upload Video</label>
                <input type="file" class="form-control" id="video_url" name="video_url" accept="video/*">
            </div>
            <div class="mb-3">
                <label for="image_url" class="form-label">Upload Image</label>
                <input type="file" class="form-control" id="image_url" name="image_url" accept="image/*">
            </div>
            <div class="mb-3">
                <label for="pdf_url" class="form-label">Upload PDF</label>
                <input type="file" class="form-control" id="pdf_url" name="pdf_url" accept="application/pdf">
            </div>
            <button type="submit" class="btn btn-primary">Add Subheading</button>
        </form>

        <!-- Subheadings Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Lesson</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Video</th>
                    <th>Image</th>
                    <th>PDF</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query(
                    "SELECT s.*, l.lesson_title 
                    FROM Subheadings s
                    JOIN Lessons l ON s.lesson_id = l.lesson_id"
                );
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['subheading_id']}</td>
                        <td>{$row['lesson_title']}</td>
                        <td>{$row['subheading_title']}</td>
                        <td>{$row['subheading_content']}</td>
                        <td><a href='{$row['video_url']}' target='_blank'>Video</a></td>
                        <td><a href='{$row['image_url']}' target='_blank'>Image</a></td>
                        <td>
                            <form method='POST' class='d-inline'>
                                <input type='hidden' name='action' value='download'>
                                <input type='hidden' name='pdf_url' value='{$row['pdf_url']}'>
                                <button type='submit' class='btn btn-info btn-sm                                '>Download PDF</button>
                            </form>
                        </td>
                        <td>
                            <form method='POST' class='d-inline'>
                                <input type='hidden' name='action' value='delete'>
                                <input type='hidden' name='subheading_id' value='{$row['subheading_id']}'>
                                <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                            </form>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
