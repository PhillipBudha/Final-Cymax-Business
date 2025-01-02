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

include 'config.php'; // Database connection configuration

// Fetch courses from the database for the dropdown
$query = "SELECT id, title FROM courses"; // Adjust the table name and column names as necessary
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Upload and Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<!--************************************************************************************************************** 
# Navigation
**************************************************************************************************************-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="javascript:void(0);" onclick="history.back();">
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
# Upload & Manage Videos
**************************************************************************************************************-->
<div class="container mt-4">
    <h2 class="text-center display-5 fw-bold mb-5">Upload and Manage Videos</h2>

    <!-- Upload Form -->
    <form action="upload.php" method="post" enctype="multipart/form-data" class="mt-4">
        <div class="mb-3">
            <label for="title" class="form-label">Video Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        
        <!-- Dropdown for Courses -->
        <div class="mb-3">
            <label for="course" class="form-label">Select Course</label>
            <select name="course" id="course" class="form-control" required>
                <option value="">-- Select a Course --</option>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['title']); ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="video" class="form-label">Select Video</label>
            <input type="file" class="form-control" id="video" name="video" accept="video/*" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Short Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Upload Video</button>
    </form>

    <!-- Display Uploaded Videos -->
    <div class="mt-5">
        <h3>Uploaded Videos</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Video</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM videos"; // Adjust the table name as needed
                $result = $conn->query($query);
                while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td>
                            <video width="200" controls>
                                <source src="uploads/<?php echo $row['video']; ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
