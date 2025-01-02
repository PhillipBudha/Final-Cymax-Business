<?php
session_start(); // Start the session

// Check if user is logged in by checking session variables
if (!isset($_SESSION['user_id']) || !isset($_SESSION['email'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

// If logged in, retrieve and sanitize user data
$user_id = htmlspecialchars($_SESSION['user_id']);
$user_email = htmlspecialchars($_SESSION['email']);
?>
<?php
include('db_connection.php');

// Check database connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Content Viewer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            height: 100vh;
        }
        

        #sidebar {
            width: 25%;
            background-color: #f8f9fa;
            overflow-y: auto;
        }

        #content {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .subheading-list {
            display: none;
            margin-left: 20px;
        }

        .subheading-item {
            cursor: pointer;
        }

        #progress-bar-container {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #f8f9fa;
            padding: 5px 0;
        }
        .custom-img {
          height: 400px;
           width: auto; /* Maintains aspect ratio */
}

    </style>
</head>

<body>
    <!-- Navigation -->
    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="assets/img/Cymax-Logo.jpg" height="40" alt="Cymax Business School">
            </a>

            <div class="d-flex align-items-center flex-grow-1 justify-content-between">
                <button class="btn btn-outline-secondary me-3">
                    <i class="bi bi-grid"></i> Explore
                </button>
                <div class="d-flex align-items-center">
                    <span class="me-4"><i class="bi bi-lightbulb"></i> My Learning</span>
                    <span class="me-4"><i class="bi bi-translate"></i> EN</span>
                    <div class="d-flex align-items-center">
                        <span><i class="bi bi-person-circle me-1"></i> Hello, <?php echo $user_email; ?>!</span>
                        <a class="btn logout-btn ms-3" href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </nav> -->

    <div id="sidebar" class="p-3 border-end">
        <h4>Course Content</h4>
        <ul class="list-group" id="course-headings">
            <?php
            $sql = "SELECT lesson_id, lesson_title FROM Lessons";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<li class='list-group-item'>";
                    echo "<span class='lesson-title' data-id='" . htmlspecialchars($row['lesson_id']) . "'>" . htmlspecialchars($row['lesson_title']) . "</span>";
                    echo "<ul class='subheading-list' data-lesson-id='" . htmlspecialchars($row['lesson_id']) . "'></ul>";
                    echo "</li>";
                }
            } else {
                echo "<li class='list-group-item'>No lessons available</li>";
            }
            ?>
        </ul>
    </div>

    <div id="content">
        <div id="content-area">
            <h4>Welcome</h4>
            <p>Select a topic from the left to view its content here.</p>
        </div>
    </div>

    <div id="progress-bar-container">
        <div class="progress">
            <div id="progress-bar" class="progress-bar" role="progressbar" style="width: 0%;">0%</div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
    const courseHeadings = document.getElementById('course-headings');
    const contentArea = document.getElementById('content-area');

    courseHeadings.addEventListener('click', function (event) {
        if (event.target && event.target.matches('.lesson-title')) {
            const lessonId = event.target.dataset.id;
            const subheadingList = document.querySelector(`.subheading-list[data-lesson-id='${lessonId}']`);

            if (subheadingList.childElementCount === 0) {
                fetch(`fetch_subheadings.php?lesson_id=${lessonId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.subheadings.length > 0) {
                            subheadingList.innerHTML = data.subheadings.map(sub => `
                                <li class='subheading-item' data-id='${sub.subheading_id}'>
                                    ${sub.subheading_title}
                                </li>`).join('');
                            subheadingList.style.display = 'block';
                        } else {
                            subheadingList.innerHTML = "<li>No subheadings available</li>";
                        }
                    })
                    .catch(error => console.error('Error fetching subheadings:', error));
            } else {
                subheadingList.style.display = subheadingList.style.display === 'none' ? 'block' : 'none';
            }
        }
    });

    courseHeadings.addEventListener('click', function (event) {
        if (event.target && event.target.matches('.subheading-item')) {
            const subheadingId = event.target.dataset.id;

            fetch(`fetch_content.php?subheading_id=${subheadingId}`)
                .then(response => response.text())
                .then(data => {
                    contentArea.innerHTML = data;
                })
                .catch(error => {
                    contentArea.innerHTML = "<p>Error loading content.</p>";
                    console.error('Error:', error);
                });
        }
    });

    const progressBar = document.getElementById('progress-bar');
    const content = document.getElementById('content');

    content.addEventListener('scroll', function () {
        const scrollTop = content.scrollTop;
        const scrollHeight = content.scrollHeight - content.clientHeight;
        const progress = (scrollTop / scrollHeight) * 100;

        progressBar.style.width = `${progress}%`;
        progressBar.textContent = `${Math.round(progress)}%`;
    });
});

    </script>
</body>

</html>
