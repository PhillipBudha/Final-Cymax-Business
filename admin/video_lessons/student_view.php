<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Replace with your database password
$dbname = "confluent_database"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all courses from the database
$sql = "SELECT * FROM course";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student View</title>
    <!-- Bootstrap CSS -->
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
                    <a class="nav-link" href="javascript:void(0);" onclick="history.back();">Back</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


    <div class="container mt-5">
        <h1 class="text-center mb-4">Available Courses</h1>
        <div class="row">
        <?php
while ($row = $result->fetch_assoc()) {
    $documents = !empty($row['documents']) ? json_decode($row['documents'], true) : [];
    ?>
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <!-- Course Name -->
                <h5 class="card-title">
                    <strong>Course Name:</strong> 
                    <?php echo isset($row['course_name']) ? htmlspecialchars($row['course_name']) : "Unnamed Course"; ?>
                </h5>

                <!-- Description -->
                <p class="card-text">
                    <strong>Description:</strong> 
                    <?php echo isset($row['description']) ? htmlspecialchars($row['description']) : "No description available."; ?>
                </p>

                <!-- Duration -->
                <p class="card-text">
                    <strong>Duration:</strong> 
                    <?php echo isset($row['duration']) ? htmlspecialchars($row['duration']) : "No duration specified."; ?>
                </p>

                <!-- Access to View Videos -->
                <?php if (!empty($row['video'])): ?>
                    <a href="#viewVideos<?php echo $row['id']; ?>" class="btn btn-primary btn-sm" data-bs-toggle="collapse">Access to View Videos</a>
                    <div id="viewVideos<?php echo $row['id']; ?>" class="collapse mt-3">
                        <p><strong>Available Video:</strong></p>
                        <video controls width="100%">
                            <source src="<?php echo htmlspecialchars($row['video']); ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                <?php else: ?>
                    <p class="text-muted"><strong>Video:</strong> No video uploaded.</p>
                <?php endif; ?>

                <!-- Documents -->
                <?php if (!empty($documents)): ?>
                    <p><strong>Documents:</strong></p>
                    <ul>
                        <?php foreach ($documents as $doc): ?>
                            <li>
                                <a href="<?php echo htmlspecialchars($doc); ?>" target="_blank">
                                    <?php echo basename($doc); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p><strong>Documents:</strong> No documents uploaded.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
}
?>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>