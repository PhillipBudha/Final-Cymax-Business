<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confluent Academy</title>
    <!-- css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- bootsrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- font awesome -->
    <!--  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="assets/vendor/fontawesome-free-5.15.4-web/css/all.min.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <style>
        .card img {
            height: 150px;
            object-fit: cover;
        }
    </style>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js">
    </script>
    <script type="text/javascript">
        (function () {
            emailjs.init({
                publicKey: "Hb7llvscmWEDgj7XJ",
            });
        })();
    </script>
    <script>
        function sendMail() {
  let params = {
    name: document.getElementById("name").value,
    email: document.getElementById("email_id").value,
    message: document.getElementById("message").value,
  };
  emailjs
    .send("service_xepdick", "template_vtlthae", params)
    .then(function (res) {
      alert("Email Sent !!" + res.status);
    });
}
    </script>

</head>

<body>
    <!--**************************************************************************************************************
    # Navigation
    **************************************************************************************************************-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="assets/img/Cymax-Logo.jpg" alt="Study Logo" class="me-2" style="height: 40px; width: 120px;">

            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
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
                            <li><a class="dropdown-item" href="student/index.php">Staff Login</a></li>
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
    <!--**************************************************************************************************************
    # Carousel
    **************************************************************************************************************-->
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
        <!--   <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true"
                aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div> -->
        <div class="carousel-inner">
            <div class="carousel-item carousel-height active">
                <img src="assets/img/Cymax-Logo.jpg" bd-image width=" 100%" height="100%" aria-hidden="true"
                    preserveAspectRatio="xMidYMid slice" focusable="false">
                <rect width="100%" height="100%" fill="#777" />

                <div class="container">
                    <div class="carousel-caption text-start mb-4 pb-5">
                        <!--  <h1 class="display-1 fw-bold lead">Confluent Academy</h1> -->
                        <!--   <h2>Hi, there!</h2> -->
                        <!--  <h1 class="mb-4">"The future belongs to those who prepare for it today."
                            — Malcolm X</h1> -->
                        <!--   <p><a class="btn btn-lg btn-outline-success rounded-pill" href="#services">View More</a></p> -->
                    </div>
                </div>
            </div>
            <div class="carousel-item  carousel-height c-height">
                <img src="assets/img/carousel/image-2.jpg" class="bd-image" width="100%" height="100%"
                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice"
                    focusable="false">
                <rect width="100%" height="100%" fill="#777" />


            </div>
            <div class="carousel-item carousel-height c-height">
                <img src="assets/img/carousel/image-3.jpg" class="bd-image" width="100%" height="100%"
                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice"
                    focusable="false">
                <rect width="100%" height="100%" fill="#777" />

                <div class="container">
                    <div class="carousel-caption text-end">
                        <h1 class="display-1 fw-bold lead">Cymax Business School</h1>
                        <h1>Empowering Minds, Anywhere</h1>
                        <p><a class="btn btn-lg btn-primary rounded-pill" href="#about">View More</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--**************************************************************************************************************
# Courses Offered
**************************************************************************************************************-->
    <div class="container my-5" id="courses">
        <section>
            <h2 class="text-center mb-5 text-center display-5 fw-bold mb-4">Courses Offered</h2>
            <div class="row g-4">
                <!-- Course 1 -->
                <div class="col-md-6">
                    <div class="card">
                        <img src="assets/img/accca.jpg" class="card-img-top" alt="ACCA">
                        <div class="card-body">
                            <h5 class="card-title">ACCA</h5>
                            <p class="card-text">Master financial accounting, management, auditing, and taxation with
                                ACCA to excel in global financial reporting and risk management..</p>
                            <a href="#" class="btn btn-primary rounded-pill w-50" id="acca-form">Enrol
                                Now</a>
                        </div>
                    </div>
                </div>
                <!-- Course 2 -->
                <div class="col-md-6">
                    <div class="card">
                        <img src="assets/img/cgiz.jpg" class="card-img-top" alt="CGIZ">
                        <div class="card-body">
                            <h5 class="card-title">CGIZ</h5>
                            <p class="card-text">Master computer graphics, imaging techniques, and visualization tools
                                with CGIZ to excel in creative design, 3D modeling, and rendering.</p>
                            <a href="#" class="btn btn-primary rounded-pill w-50" id="cgiz-form">Enrol
                                Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!--**************************************************************************************************************
# Courses Offered
**************************************************************************************************************-->
    <!--  <div class="container my-5">
        <h2 class="text-center display-5 fw-bold mb-4">Courses Offered</h2>
        <div class="row">
            <!-- Course 1 --
            <div class="col-md-6 mb-4">
                <div class="course-box">
                    <img src="assets/img/courses/image-1.jpg" class="img-fluid" alt="Course Image">
                    <button class="btn btn-primary mt-3 w-100" id="acca-form">View Courses</button>
                </div>
            </div>

            <!-- Course 2 --
            <div class="col-md-6 mb-4">
                <div class="course-box">
                    <img src="assets/img/courses/image-2.jpg" class="img-fluid" alt="Course Image">
                    <button class="btn btn-primary mt-3 w-100" id="cgiz-form">View Courses</button>
                </div>
                <button class="btn-outline-success"></button>
            </div>
 -->
    <!-- Additional courses can be added here following the same structure 
        </div>
    </div>-->

    <!--**************************************************************************************************************
# Why Us
**************************************************************************************************************-->
    <div class="container my-5">
        <div class="why-choose-us-section mx-auto p-4">
            <h1 class="text-center display-5 lead fw-bold mb-4">Why Choose CYMAX Business School</h1>
            <div class="row">
                <!-- Image Section -->
                <div class="col-md-6 d-flex justify-content-center">
                    <img src="assets/img/why-us/why-choose-us.jpg" alt="Why Choose Us"
                        class="why-choose-us-image img-fluid">
                </div>

                <!-- Text Section -->
                <div class="col-md-6 text-content">
                    <!--        <h2 class="mb-3">Why Choose Us</h2> -->
                    <!--  <ul class="list-unstyled">
                        <li class="stylish-list-item p-2"><!-- <i class="fas fa-user-graduate me-2 icon-large"></i> --
                            To unlock your potential, gain expert guidance, and achieve graduate-level success with a
                            flexible, top-tier online education tailored to your goals..</li>
                        <li class="stylish-list-item"><!-- <i class="fa fa-graduation-cap icon-large"></i></i> -- For a
                            world-class
                            online education that drives you to graduation and opens doors to high-paying, prestigious
                            career opportunities in today’s competitive job market</li>
                        <li class="stylish-list-item"><!-- <i class="fa fa-book-open me-2 icon-large"></i>  --Choose us
                            for
                            innovative
                            solutions tailored to your needs, backed by a customer service experience that is second to
                            none.</li>
                    </ul> -->
                    <div class="why-choose-us">
                        <h2>Why Choose Us</h2>
                        <p><i class="fas fa-graduation-cap"></i> Unlock your potential, gain expert guidance, and
                            achieve graduate-level success with a flexible, top-tier online education tailored to your
                            goals.</p>
                        <p><i class="fas fa-briefcase"></i> Experience a world-class online education that drives you to
                            graduation and opens doors to high-paying, prestigious career opportunities in today’s
                            competitive job market.</p>
                        <p><i class="fas fa-lightbulb"></i> Choose us for innovative solutions tailored to your needs,
                            backed by a customer service experience that is second to none.</p>
                    </div>

                </div>
            </div>
        </div>
    </div>




    <!--**************************************************************************************************************
# About Us
**************************************************************************************************************-->
    <div class="about-us-section d-flex align-items-center text-white" id="about">
        <div class="container text-center">
            <h1 class="display-5 fw-bold mb-4">About Us</h1>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <p>Our online school system is dedicated to providing accessible and high-quality education to
                        students around the globe. We empower learners through comprehensive and engaging courses.</p>
                    <p>With a diverse curriculum and experienced instructors, we aim to make learning flexible, allowing
                        students to achieve their goals at their own pace and convenience.</p>
                    <p>We believe in using innovative teaching methods and cutting-edge technology to enhance the
                        educational experience and make learning a rewarding journey for everyone.</p>
                </div>
            </div>
        </div>
    </div>

    <!--**************************************************************************************************************
# Testimonials
**************************************************************************************************************-->
    <section class="my-5">
        <div class="container">
            <h1 class="display-5 fw-bold mb-4 text-center">Testimonials</h1>
            <div class="row">
                <div class="col-12">
                    <div id="craouselContainer" class="swiper-container">
                        <div class="swiper-wrapper" id="slideHolder">
                            <!-- Slides -->
                            <!--  <div class="swiper-slide">Slide 1</div>
                            <div class="swiper-slide">Slide 2</div>
                            <div class="swiper-slide">Slide 3</div> -->
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!--**************************************************************************************************************
# News & Events
**************************************************************************************************************-->
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

// Fetch the latest record for each category
$sql = "
    SELECT NewsEvents, CreatedAt 
    FROM NewsAndEvents 
    WHERE NewsEvents IS NOT NULL 
    ORDER BY CreatedAt DESC LIMIT 1;

    SELECT LatestNews, CreatedAt 
    FROM NewsAndEvents 
    WHERE LatestNews IS NOT NULL 
    ORDER BY CreatedAt DESC LIMIT 1;

    SELECT UpcomingEvents, CreatedAt 
    FROM NewsAndEvents 
    WHERE UpcomingEvents IS NOT NULL 
    ORDER BY CreatedAt DESC LIMIT 1;
";

// Execute queries
$conn->multi_query($sql);

// Get NewsEvents record
$newsEvents = $conn->store_result()->fetch_assoc();
$conn->next_result();

// Get LatestNews record
$latestNews = $conn->store_result()->fetch_assoc();
$conn->next_result();

// Get UpcomingEvents record
$upcomingEvents = $conn->store_result()->fetch_assoc();

$conn->close();
?>

    <div class="container my-5 news-events-section" id="new&events">
        <h2 class="news-events-title">News & Events</h2>
        <div class="row">
            <!-- News Card 1 (News Events) -->
            <div class="col-md-4 mb-4">
                <div class="news-card">
                    <img src="assets/img/blog/image-1.jpg" alt="Event Image">
                    <div class="news-card-body">
                        <h5 class="news-card-title">News Event</h5>
                        <p class="news-card-text">
                            <?php echo htmlspecialchars($newsEvents['NewsEvents']); ?>
                        </p>
                    </div>
                    <div class="news-card-footer"></div>
                </div>
            </div>

            <!-- News Card 2 (Latest News) -->
            <div class="col-md-4 mb-4">
                <div class="news-card">
                    <img src="assets/img/blog/image-3.jpg" alt="Event Image">
                    <div class="news-card-body">
                        <h5 class="news-card-title">Latest News</h5>
                        <p class="news-card-text">
                            <?php echo htmlspecialchars($latestNews['LatestNews']); ?>
                        </p>
                    </div>
                    <div class="news-card-footer"></div>
                </div>
            </div>

            <!-- News Card 3 (Upcoming Events) -->
            <div class="col-md-4 mb-4">
                <div class="news-card">
                    <img src="assets/img/blog/image-2.jpg" alt="Event Image">
                    <div class="news-card-body">
                        <h5 class="news-card-title">Upcoming Event</h5>
                        <p class="news-card-text">
                            <?php echo htmlspecialchars($upcomingEvents['UpcomingEvents']); ?>
                        </p>
                    </div>
                    <div class="news-card-footer"></div>
                </div>
            </div>
        </div>
    </div>

    <!--**************************************************************************************************************
# Feedback
**************************************************************************************************************-->
    <section class="feedback-section" id="feedback">
        <div class="container feedback-content">
            <h1 class="text-center mb-4">Feedback</h1>
            <div class="row">
                <!-- Left Column with Contact Information -->
                <div class="col-md-6 mb-4 contact-info">
                    <h3 class="fw-bold pb-5">For More Information Visit or Call:</h3>
                    <p><i class="fas fa-phone"></i> +263 772 979 148</p>
                    <p><i class="fas fa-phone"></i> +263 772 979 148</p>
                    <p><i class="fas fa-envelope"></i>Mundendereg@gmail.com</p>
                    <p><i class="fas fa-map-marker-alt"></i> 110 Leopold Takawira Street Harare, Zimbabwe</p>
                </div>
                <!-- Right Column with Form -->
                <div class="col-md-6">
                    <form action="https://formsubmit.co/mundendereg@gmail.com" method="POST">
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Name" name="name" id="name" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Email" name="email" id="email_id" required>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" rows="4" placeholder="Message" name="subject" id="subject" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>



    <!--**************************************************************************************************************
# Footer
**************************************************************************************************************-->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <!-- About Us -->
                <div class="col-md-4 mb-4">
                    <h5>About Us</h5>
                    <p>Our online school system is dedicated to providing accessible and high-quality education to
                        students around the globe. We empower learners through comprehensive and engaging courses.</p>
                </div>
                <!-- Quick Links -->
                <div class="col-md-4 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
                <!-- Social Media Links -->
                <div class="col-md-4 mb-4">
                    <h5>Follow Us</h5>
                    <div class="social-icons">
                        <a href="https://www.facebook.com/profile.php?id=61569965236469&sfnsn=wa&mibextid=RUbZ1f"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <!-- Copyright -->
            <div class="row">
                <div class="col-12">
                    <p class="copyright">© 2024 Smartvoid Technologies. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>







    <!-- Include Bootstrap JS (make sure to include Popper.js as well) -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/email.js"></script>
    <script src="assets/js/index.js"></script>


</body>