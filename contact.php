<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
   
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .feedback-section {
            background: #fff;
            padding: 40px 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 20px 0;
        }

        h1 {
            color: #007bff;
            font-size: 2.5em;
        }

        .contact-info p {
            font-size: 1.1em;
            margin: 10px 0;
        }

        .contact-info a {
            color: inherit;
            text-decoration: none;
        }

        form .btn {
            background: #007bff;
            color: #fff;
            transition: background 0.3s;
        }

        form .btn:hover {
            background: #0056b3;
        }

        .success {
            color: green;
            margin-top: 10px;
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
                        <a class="nav-link" href="index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#courses">Courses</a>
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
                        <a class="nav-link" href="#new&events">News & Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about_us.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <section class="feedback-section" id="feedback">
            <h1 class="text-center mb-4">Contact Us</h1>
            <div class="row">
                <!-- Left Column with Contact Information -->
                <div class="col-md-6 contact-info">
                    <p><i class="fas fa-phone"></i> +263 772 979 148</p>
                    <p><i class="fas fa-phone"></i> +263 772 110 248</p>
                    <p><i class="fas fa-envelope"></i> <a href="mailto:Mundendereg@gmail.com">Mundendereg@gmail.com</a></p>
                    <p><i class="fas fa-map-marker-alt"></i> 110 Leopold Takawira Street, Harare, Zimbabwe</p>
                </div>
                <!-- Right Column with Form -->
                <div class="col-md-6">
                    <form method="post" action="index.php">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="name" placeholder="Name" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="message" rows="4" placeholder="Message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $name = htmlspecialchars($_POST['name']);
                        $email = htmlspecialchars($_POST['email']);
                        $message = htmlspecialchars($_POST['message']);

                        echo "<p class='success'>Thank you, $name. We have received your message!</p>";
                    }
                    ?>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
