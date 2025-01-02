<?php
include('db_connect.php');

// Handle Create, Update, and Delete operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'add') {
        $lesson_title = $_POST['lesson_title'];
        $lesson_content = $_POST['lesson_content'];
        $sql = "INSERT INTO Lessons (lesson_title, lesson_content) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $lesson_title, $lesson_content);
        $stmt->execute();
    } elseif ($action === 'edit') {
        $lesson_id = $_POST['lesson_id'];
        $lesson_title = $_POST['lesson_title'];
        $lesson_content = $_POST['lesson_content'];
        $sql = "UPDATE Lessons SET lesson_title = ?, lesson_content = ? WHERE lesson_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $lesson_title, $lesson_content, $lesson_id);
        $stmt->execute();
    } elseif ($action === 'delete') {
        $lesson_id = $_POST['lesson_id'];
        $sql = "DELETE FROM Lessons WHERE lesson_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $lesson_id);
        $stmt->execute();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Lessons</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Manage Lessons</h2>

        <!-- Add Lesson Form -->
        <form method="POST" class="mb-4">
            <input type="hidden" name="action" value="add">
            <div class="mb-3">
                <label for="lesson_title" class="form-label">Lesson Title</label>
                <input type="text" class="form-control" id="lesson_title" name="lesson_title" required>
            </div>
            <div class="mb-3">
                <label for="lesson_content" class="form-label">Lesson Content</label>
                <textarea class="form-control" id="lesson_content" name="lesson_content" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Lesson</button>
        </form>

        <!-- Lessons Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM Lessons");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['lesson_id']}</td>
                        <td>{$row['lesson_title']}</td>
                        <td>{$row['lesson_content']}</td>
                        <td>
                            <form method='POST' class='d-inline'>
                                <input type='hidden' name='action' value='delete'>
                                <input type='hidden' name='lesson_id' value='{$row['lesson_id']}'>
                                <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                            </form>
                            <button class='btn btn-warning btn-sm' onclick='editLesson({$row['lesson_id']}, \"{$row['lesson_title']}\", \"{$row['lesson_content']}\")'>Edit</button>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Edit Lesson Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Lesson</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" id="edit_lesson_id" name="lesson_id">
                        <div class="mb-3">
                            <label for="edit_lesson_title" class="form-label">Lesson Title</label>
                            <input type="text" class="form-control" id="edit_lesson_title" name="lesson_title" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_lesson_content" class="form-label">Lesson Content</label>
                            <textarea class="form-control" id="edit_lesson_content" name="lesson_content" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function editLesson(id, title, content) {
            document.getElementById('edit_lesson_id').value = id;
            document.getElementById('edit_lesson_title').value = title;
            document.getElementById('edit_lesson_content').value = content;
            new bootstrap.Modal(document.getElementById('editModal')).show();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
