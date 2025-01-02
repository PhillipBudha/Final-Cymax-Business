<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$database = "Confluent_Database";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all uploaded records
$query = "SELECT u.id, u.test_id, t.course_name, u.student_name, u.file_name, u.file_path, u.uploaded_at, g.grade 
          FROM uploads u 
          LEFT JOIN tests t ON u.test_id = t.id 
          LEFT JOIN grades g ON u.id = g.upload_id 
          ORDER BY u.uploaded_at DESC";
$result = $conn->query($query);

$uploads = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $uploads[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded Tests and Grades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 20px;
            background-color: #f8f9fa;
        }
        table {
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Uploaded Tests and Grades</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Course Name</th>
                        <th>Test ID</th>
                        <th>Student Name</th>
                        <th>File Name</th>
                        <th>Uploaded At</th>
                        <th>Grade</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($uploads) > 0): ?>
                        <?php foreach ($uploads as $index => $upload): ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo htmlspecialchars($upload['course_name'] ?? 'N/A'); ?></td>
                                <td><?php echo htmlspecialchars($upload['test_id']); ?></td>
                                <td><?php echo htmlspecialchars($upload['student_name']); ?></td>
                                <td>
                                    <a href="<?php echo htmlspecialchars($upload['file_path']); ?>" target="_blank">
                                        <?php echo htmlspecialchars($upload['file_name']); ?>
                                    </a>
                                </td>
                                <td><?php echo htmlspecialchars($upload['uploaded_at']); ?></td>
                                <td>
                                    <form id="gradeForm_<?php echo $upload['id']; ?>" onsubmit="event.preventDefault(); saveGrade(<?php echo $upload['id']; ?>);">
                                        <input type="text" name="grade" value="<?php echo htmlspecialchars($upload['grade'] ?? 'N/A'); ?>" class="form-control form-control-sm">
                                    </form>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-danger" onclick="deleteUpload(<?php echo $upload['id']; ?>)">Delete Upload</button>
                                    <button class="btn btn-sm btn-success" onclick="saveGrade(<?php echo $upload['id']; ?>)">Save Grade</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center">No uploads found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function deleteUpload(uploadId) {
            if (confirm("Are you sure you want to delete this upload?")) {
                fetch('delete_upload.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `id=${uploadId}`
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    location.reload();
                })
                .catch(error => console.error('Error:', error));
            }
        }

        function saveGrade(uploadId) {
            const form = document.getElementById(`gradeForm_${uploadId}`);
            const grade = form.grade.value;

            fetch('save_grade.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `upload_id=${uploadId}&grade=${grade}`
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                location.reload();
            })
            .catch(error => console.error('Error:', error));
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
