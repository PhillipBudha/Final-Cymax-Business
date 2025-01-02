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
include 'config.php';

$query = "SELECT * FROM videos";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student View - Videos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="style.css" rel="stylesheet"> -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            background-color:#001F3F;
        }

        .card {
            border-radius: 10px;
            overflow: hidden;
            height: 400px;
        }

        .card-title {
            font-weight: bold;
            color: #333;
        }

        .card-text {
            color: #555;
        }

        video {
            height: 240px;
            width: 100%;
            border-bottom: 1px solid #ddd;
        }
    </style>
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
                    <a class="nav-link" href="#"></i> Hello, <?php echo htmlspecialchars($user_email); ?>!</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <!--**************************************************************************************************************
# Available Courses
**************************************************************************************************************-->
    <div class="container mt-4">
        <h2 class="text-center display-5 fw-bold text-white m-5">Available Course Video</h2>
        <div class="row mt-4">
            <?php while ($row = $result->fetch_assoc()): ?>
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <video class="card-img-top" controls>
                        <source src="uploads/<?php echo $row['video']; ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <div class="card-body">
                        <h5 class="card-title">Title:
                            <?php echo htmlspecialchars($row['title']); ?>
                        </h5>
                        <p class="card-text"><strong>Description:</strong>
                            <?php echo htmlspecialchars($row['description']); ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>