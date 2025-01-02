
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
// Database connection
$host = 'localhost'; // Update with your host
$username = 'root';  // Update with your username
$password = '';      // Update with your password
$dbname = 'confluent_database'; // Database name

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data
if (isset($_POST['insert'])) {
    $name = $_POST['name'];
    $newsEvents = $_POST['newsEvents'];
    $latestNews = $_POST['latestNews'];
    $upcomingEvents = $_POST['upcomingEvents'];

    $sql = "INSERT INTO NewsAndEvents (Name, NewsEvents, LatestNews, UpcomingEvents) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $newsEvents, $latestNews, $upcomingEvents);

    if ($stmt->execute()) {
        echo "Record inserted successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
    $stmt->close();
}

// Update data
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $newsEvents = $_POST['newsEvents'];
    $latestNews = $_POST['latestNews'];
    $upcomingEvents = $_POST['upcomingEvents'];

    $sql = "UPDATE NewsAndEvents SET Name=?, NewsEvents=?, LatestNews=?, UpcomingEvents=? WHERE ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $name, $newsEvents, $latestNews, $upcomingEvents, $id);

    if ($stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
    $stmt->close();
}

// Delete data
if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM NewsAndEvents WHERE ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
    $stmt->close();
}

// Fetch data for display
$result = $conn->query("SELECT * FROM NewsAndEvents");

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Manage News and Events</title>
     <!-- bootsrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <style>
         body {
            background-color:#001F3F;
            
          
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
                <a class="nav-link" href="#">
                 <i class="fas fa-user"></i> Hello, <?php echo htmlspecialchars($user_email); ?>!</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!--**************************************************************************************************************
# Manage News & Events
**************************************************************************************************************-->

    <h1 class="pt-2 pb-5 fw-bold display-5 text-white">Manage News and Events</h1>

    <h2 class="text-white">Insert New Event Record</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Name" required>
        <textarea name="newsEvents" placeholder="News Events" required></textarea>
        <textarea name="latestNews" placeholder="Latest News"></textarea>
        <textarea name="upcomingEvents" placeholder="Upcoming Events"></textarea>
        <button type="submit" name="insert" class="btn btn-outline-success rounded-pill">Insert</button>
    </form>

    <h2 class="text-white">Update Existing Events Record</h2>
    <form method="POST">
        <input type="number" name="id" placeholder="ID" required>
        <input type="text" name="name" placeholder="Name">
        <textarea name="newsEvents" placeholder="News Events"></textarea>
        <textarea name="latestNews" placeholder="Latest News"></textarea>
        <textarea name="upcomingEvents" placeholder="Upcoming Events"></textarea>
        <button type="submit" name="update" class="btn btn-outline-primary rounded-pill">Update</button>
    </form>

    <h2 class="text-white">Delete Events Record</h2>
    <form method="POST">
        <input type="number" name="id" placeholder="ID" required>
        <button type="submit" name="delete" class="btn btn-outline-danger rounded-pill">Delete</button>
    </form>

    <h2 class="text-white">All Records</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>News Events</th>
            <th>Latest News</th>
            <th>Upcoming Events</th>
            <th>Created At</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['ID']; ?></td>
            <td><?php echo $row['Name']; ?></td>
            <td><?php echo $row['NewsEvents']; ?></td>
            <td><?php echo $row['LatestNews']; ?></td>
            <td><?php echo $row['UpcomingEvents']; ?></td>
            <td><?php echo $row['CreatedAt']; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
