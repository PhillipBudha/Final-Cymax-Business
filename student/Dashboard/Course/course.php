<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Learning Dashboard -Cymax Business School</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        /* Existing CSS here... */
        :root {
  --cisco-blue: #049fd9;
  --notification-gradient: linear-gradient(90deg, #004d40 0%, #00796b 100%);
}

.notification-banner {
  background: var(--notification-gradient);
  color: white;
  padding: 1rem;
}

.navbar {
  border-bottom: 1px solid #e0e0e0;
  padding: 0.5rem 1rem;
}

.search-bar {
  max-width: 400px;
  position: relative;
}

.search-bar .form-control {
  padding-left: 2.5rem;
  border-radius: 4px;
  background-color: #f5f5f5;
}

.search-bar .bi-search {
  position: absolute;
  left: 0.75rem;
  top: 50%;
  transform: translateY(-50%);
  color: #666;
}

.course-card {
  position: relative;
  border-radius: 8px;
  overflow: hidden;
  transition: transform 0.2s;
}

.course-card:hover {
  transform: translateY(-2px);
}

.course-thumbnail {
  position: relative;
  padding-top: 56.25%;
  background-size: cover;
  background-position: center;
}

.course-level {
  position: absolute;
  top: 1rem;
  left: 1rem;
  padding: 0.25rem 0.75rem;
  border-radius: 4px;
  font-size: 0.75rem;
  font-weight: 600;
}

.level-beginner {
  background-color: #4caf50;
  color: white;
}

.level-intermediate {
  background-color: #ff9800;
  color: white;
}

.play-button {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 48px;
  height: 48px;
  background-color: rgba(255, 255, 255, 0.9);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.course-info {
  padding: 1rem;
  background-color: white;
  border: 1px solid #e0e0e0;
  border-top: none;
}

.provider-logo {
  height: 24px;
  width: auto;
}

.sidebar {
  background-color: #f8f9fa;
  padding: 1rem;
  height: calc(100vh - 120px);
}

.sidebar-link {
  display: flex;
  align-items: center;
  padding: 0.5rem 1rem;
  color: #333;
  text-decoration: none;
  border-radius: 4px;
}

.sidebar-link:hover {
  background-color: #e9ecef;
}

.sidebar-link.active {
  background-color: #e9ecef;
  font-weight: 500;
}

.logout-btn {
  background-color: #4caf50;
  color: white;
  border: none;
  padding: 0.375rem 1rem;
  border-radius: 4px;
}

    </style>
</head>

<body>
    <!-- Notification Banner -->
    <div class="notification-banner">
        <!-- Existing Banner Code -->
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="assets/img/Cymax-Logo.jpg"
                    height="40" alt="Cisco Networking Academy">
            </a>

            <div class="d-flex align-items-center flex-grow-1 justify-content-between">
                <button class="btn btn-outline-secondary me-3">
                    <i class="bi bi-grid"></i> Explore
                </button>

                <div class="search-bar flex-grow-1 mx-3">
                    <i class="bi bi-search"></i>
                    <input type="search" class="form-control" placeholder="Search for courses, articles and...">
                </div>

                <div class="d-flex align-items-center">
                    <span class="me-4"><i class="bi bi-lightbulb"></i> My Learning</span>
                    <span class="me-4"><i class="bi bi-translate"></i> EN</span>
                    <div class="d-flex align-items-center">
                        <img src="https://via.placeholder.com/32" class="rounded-circle me-2" alt="Profile">
                        <span><i class="bi bi-person-circle me-1"></i>Takudzwa Emmanuel Mundendere</span>
                        <button class="logout-btn ms-3"><i class="bi bi-box-arrow-right"></i> Logout</button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-lg-2 d-none d-md-block sidebar">
                <!-- Sidebar Navigation -->
                <h5 class="mb-4">
                    <i class="bi bi-book"></i> My Learning
                </h5>
                <div class="mb-4">
                    <a href="../assingment_tab/" class="sidebar-link active">
                        <i class="bi bi-grid me-2"></i> Dashboard
                    </a>
                    <a href="Course/index.php" class="sidebar-link">
                        <i class="bi bi-mortarboard me-2"></i> Assingments
                    </a>
                    <a href="Course/course.php" class="sidebar-link">
                        <i class="bi bi-pencil me-2"></i> Exams
                    </a>
                    <a href="Course/results.php" class="sidebar-link">
                        <i class="bi bi-book me-2"></i> Quizes
                    </a>
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-newspaper me-2"></i>Resources
                    </a>
                  <!--   <a href="profile.php" class="sidebar-link">
                        <i class="bi bi-person me-2"></i> Transcipt
                    </a>
                    <a href="profile.php" class="sidebar-link">
                        <i class="bi bi-person me-2"></i> Certificate
                    </a> -->
                    
            </div>
        </div>

            <main class="col-md-9 col-lg-10 ms-sm-auto px-4 py-3">
              
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
