<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Online School Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .hero-section {
            background: linear-gradient(to right, #4facfe, #00f2fe);
            color: white;
            padding: 80px 0;
            text-align: center;
        }

        .content-section {
            padding: 50px 15px;
        }

        .content-section h3 {
            color: #007bff;
            margin-bottom: 20px;
        }

        .content-section p {
            line-height: 1.8;
        }

        .mission-values {
            background: #f8f9fa;
            padding: 50px 15px;
        }

        .card {
            border: none;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-body h5 {
            color: #007bff;
        }

        .footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>

<body>
     <!--**************************************************************************************************************
    # Navigation
    **************************************************************************************************************-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="/placeholder.svg?height=40&width=40" alt="Study Logo" class="me-2">
                Confluent Academy
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Courses</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="portalDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Portal
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="portalDropdown">
                            <li><a class="dropdown-item" href="student/login.php">Student Login</a></li>
                            <li><a class="dropdown-item" href="sign_up.php">Staff Login</a></li>
                            <li><a class="dropdown-item" href="admin/course/index.php">Administrator Login</a></li>
                        </ul>
                    </li>

                    <!--   <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="admissionDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Admission
                        </a>
                        <ul class="dropdown-menu " aria-labelledby="dropdownMenuButton2">
                            <li><a class="dropdown-item " href="#">Entrance Application</a></li>
                            <li><a class="dropdown-item" href="#">Registration</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Training</a></li>
                            <li><a class="dropdown-item" href="#">Diploma</a></li>
                            <li><a class="dropdown-item" href="#">Degree</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Application Forms</a></li>
                        </ul>
                    </li> -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="programsDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Library
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="programsDropdown">
                            <li><a class="dropdown-item" href="#">E-Resources</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li><a class="dropdown-item" href="#">Library Services</a></li>
                            <li><a class="dropdown-item" href="#">Library Info</a></li>
                            <li><a class="dropdown-item" href="#">Catalogue</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">News & Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about_us.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact_us.php">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Hero Section -->
   <!--  <section class="hero-section">
        <div class="container">
            <h1 class="text-center">About Us</h1>
            <p>Your Gateway to Quality and Accessible Education</p>
        </div>
    </section>
 -->
    <!-- About Section -->
    <section class="content-section">
        <div class="container">
            <h3 class="text-center display-5 fw-bold" >Who We Are</h3>
            <p class="text-center px-5 display-5">
                Our online school system is dedicated to providing accessible and high-quality education to students around the globe. We empower learners through comprehensive and engaging courses.
            </p>
            <!-- <p>
                With a diverse curriculum and experienced instructors, we aim to make learning flexible, allowing students to achieve their goals at their own pace and convenience.
            </p>
            <p>
                We believe in using innovative teaching methods and cutting-edge technology to enhance the educational experience and make learning a rewarding journey for everyone.
            </p> -->
        </div>
    </section>

    <!-- Mission and Values Section -->
    <section class="mission-values">
        <div class="container">
            <div class="row">
            <h3 class="text-center display-5 fw-bold pb-5" >Our Core Values</h3>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="py-3">Our Mission</h5>
                            <p>To empower students through accessible, flexible, and engaging education, preparing them for a successful future.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="py-3">Our Vision</h5>
                            <p>To be the global leader in online education, shaping lives through innovative learning experiences.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="py-3">Our Values</h5>
                            <p>Innovation, accessibility, integrity, and student success are the pillars of our organization.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Online School Management System. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
