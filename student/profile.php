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
// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "confluent_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $language = $_POST['language'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $disability = $_POST['disability'];
    $subscribe = isset($_POST['subscribe']) ? 1 : 0;

    // Insert or update the profile
    $sql = "INSERT INTO profiles (first_name, last_name, language, country, state, email, gender, disability, subscribe)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE
                first_name = VALUES(first_name),
                last_name = VALUES(last_name),
                language = VALUES(language),
                country = VALUES(country),
                state = VALUES(state),
                gender = VALUES(gender),
                disability = VALUES(disability),
                subscribe = VALUES(subscribe)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssi", $firstName, $lastName, $language, $country, $state, $email, $gender, $disability, $subscribe);

    if ($stmt->execute()) {
        $message = "Profile saved successfully!";
        $messageType = "success";
    } else {
        $message = "Error: " . $stmt->error;
        $messageType = "danger";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Dashboard - Cisco Networking Academy</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
  <style>
    .notification-banner {
      background: linear-gradient(90deg, #004d40 0%, #00796b 100%);
      color: white;
    }

    .profile-header {
      background: linear-gradient(135deg, #001f3f 0%, #006064 100%);
      color: white;
      position: relative;
      overflow: hidden;
    }

    .profile-header::after {
      content: '';
      position: absolute;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      background: url('data:image/svg+xml,<svg viewBox="0 0 1000 200" xmlns="http://www.w3.org/2000/svg"><path d="M0,100 C150,0 350,200 500,100 C650,0 850,200 1000,100" fill="none" stroke="rgba(0,255,255,0.1)" stroke-width="2"/></svg>') repeat-x;
      opacity: 0.3;
    }

    .nav-tabs .nav-link {
      color: #666;
      border: none;
      padding: 1rem 1.5rem;
      position: relative;
    }

    .nav-tabs .nav-link.active {
      color: #2ea44f;
      border: none;
      font-weight: 500;
    }

    .nav-tabs .nav-link.active::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 2px;
      background-color: #2ea44f;
    }

    .profile-avatar {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      border: 3px solid rgba(255, 255, 255, 0.2);
    }

    .stat-box {
      text-align: center;
      padding: 1rem;
      border-left: 1px solid rgba(255, 255, 255, 0.1);
    }

    .badge-placeholder {
      text-align: center;
      padding: 3rem;
      background-color: #f8f9fa;
      border-radius: 8px;
    }

    .badge-icon {
      width: 80px;
      height: 80px;
      background-color: #e9ecef;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1rem;
    }

    .form-container {
      max-width: 800px;
      margin: 0 auto;
    }

    .modal-badge-details img {
      width: 120px;
      height: 120px;
      margin-bottom: 1rem;
    }
  </style>
</head>

<body>
  <!-- Notification Banner -->
  <div class="notification-banner py-3">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h6 class="mb-0"><i class="fas fa-bell"></i> UPDATE Downtime Schedule - December 2024</h6>
          <small>- Friday, 20 December 2024 at 5:30 p.m. to 9:30 p.m. PST (UTC-8)...</small>
        </div>
        <button class="btn btn-outline-light btn-sm"><i class="fas fa-arrow-right"></i> Read more</button>
      </div>
    </div>
  </div>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="assets/img/Cymax-Logo.jpg" height="40"
          alt="Cymax Business Academy">
      </a>
      <div class="d-flex align-items-center">
        <button class="btn btn-outline-secondary me-2"><i class="fas fa-compass"></i> Explore</button>
        <input type="search" class="form-control me-2" placeholder="Search for courses, articles and...">
        <div class="d-flex align-items-center gap-3">
          <span><i class="fas fa-book"></i> My Learning</span>
          <span><i class="fas fa-globe"></i> EN</span>
          <span><i class="fas fa-user"></i> Learner</span>
        </div>
      </div>
    </div>
  </nav>

  <!-- Profile Header -->
  <div class="profile-header py-4">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6 d-flex align-items-center gap-4">
          <img src="https://via.placeholder.com/120" alt="Profile" class="profile-avatar">
          <div>
            <p class="mb-0"><i class="fas fa-smile"></i> Welcome,</p>
            <h2 class="mb-0"> <?php echo htmlspecialchars($user_email); ?>!</h2>
           <!--  <h3 class="mb-0">Mundendere</h3> -->
            <small><i class="fas fa-graduation-cap"></i> Learner • Networking Academy</small>
          </div>
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-6 stat-box">
              <h3 class="mb-0"><i class="fas fa-medal"></i> 0</h3>
              <small>Badges Earned</small>
            </div>
            <div class="col-6 stat-box">
              <h3 class="mb-0"><i class="fas fa-check-circle"></i> 0</h3>
              <small>Courses Completed</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="container py-4">
    <!-- Tabs -->
    <ul class="nav nav-tabs mb-4">
      <li class="nav-item">
        <a class="nav-link active" href="#profile" data-bs-toggle="tab">
          <i class="fas fa-user"></i> Profile
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#badges" data-bs-toggle="tab">
          <i class="fas fa-trophy"></i> Badges & Certificates
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#discounts" data-bs-toggle="tab">
          <i class="fas fa-tag"></i> Discounts
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#history" data-bs-toggle="tab">
          <i class="fas fa-history"></i> Learning History
        </a>
      </li>
    </ul>

    <!-- Tab Content -->
    <!-- Tab Content -->
    <div class="tab-content">
  <!-- Profile Tab -->
  <div class="tab-pane fade show active" id="profile">
    <div class="form-container bg-light p-4 rounded shadow-sm">
      <h5 class="mb-4">Basic Information</h5>
      <form action="" method="POST">
        <div class="row mb-3">
          <div class="col-md-6">
            <label for="first_name" class="form-label">First Name:</label>
            <input type="text" class="form-control" name="first_name" id="first_name" required>
          </div>
          <div class="col-md-6">
            <label for="last_name" class="form-label">Last Name:</label>
            <input type="text" class="form-control" name="last_name" id="last_name" required>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-4">
            <label for="language" class="form-label">Default Language:</label>
            <select class="form-select" name="language" id="language">
              <option value="English">English</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="country" class="form-label">Country:</label>
            <select class="form-select" name="country" id="country">
              <option value="Zimbabwe">Zimbabwe</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="state" class="form-label">State:</label>
            <select class="form-select" name="state" id="state">
              <option value="Harare Province">Harare Province</option>
            </select>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" name="email" id="email" required>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="gender" class="form-label">Gender:</label>
            <select class="form-select" name="gender" id="gender">
              <option value="Prefer not to say">Male</option>
              <option value="Prefer not to say">Female</option>
              <option value="Prefer not to say">Prefer not to say</option>
            </select>
            <small class="text-muted">Gender is used for impact reporting, in support of education research, and to
            award top instructors.</small>
          </div>
          <div class="col-md-6">
            <label for="disability" class="form-label">Disability:</label>
            <select class="form-select" name="disability" id="disability">
              <option value="Prefer not to say">Yes</option>
              <option value="Prefer not to say">No</option>
              <option value="Prefer not to say">Prefer not to say</option>
            </select>
            <small class="text-muted">Disability information is used for impact reporting purposes only and is not
            associated with your account.</small>
          </div>
        </div>
        <h5 class="mb-4 mt-5">Subscribe to Cymax Business School</h5>
            <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" name="subscribe" id="subscribe" checked>
            <label for="subscribe" class="form-check-label">Subscribe:</label>
              
                I would like to receive communications and updates about the program, including information about
                functionality and learning offerings from Cymax Business School. I understand I can unsubscribe at
                any time.
              </label>
            </div>
           <!--  <small class="text-muted d-block mb-4">
              By not subscribing you will not receive Cisco Networking Academy promotional communications, including
              updates and the latest news regarding netacad.com. You will still receive critical operational updates and
              updates about your learning journey and account status by email.
            </small> -->

        <button type="submit" class="btn btn-primary w-100">Save</button>
      </form>
    </div>
  </div>
</div>

     <!--  <div class="tab-pane fade show active" id="profile">
        <div class="form-container">
          <h5 class="mb-4">Basic Information</h5>
          <form>
            
              <div class="col-md-6">
                <label class="form-label">Last Name*</label>
                <input type="text" name="last_name" id="last_name" class="form-control"  required><br>
              </div>
            </div>

            <div class="row mb-3">
             

            <h5 class="mb-4 mt-5">Contact Information</h5>
            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" name="email" id="email"  class="form-control" required><br>
              </div>
              <div class="col-md-6 d-flex align-items-end">
                <button type="button" class="btn btn-link">Change Email</button>
              </div>
            </div>

            <h5 class="mb-4 mt-5">Additional Information</h5>
            <div class="form-check mb-3">
              <input type="checkbox" class="form-check-input" id="additionalInfo">
              <label class="form-check-label" for="additionalInfo">
                I agree to provide more information about myself.
              </label>
            </div>

            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label">Gender</label>
                <select class="form-select" name="gender" id="gender">
                  <option>Prefer not to say</option>
                </select>
                <small class="text-muted">Gender is used for impact reporting, in support of education research, and to
                  award top instructors.</small>
              </div>
              <div class="col-md-6">
                <label class="form-label"  name="disability" id="disability">Disability</label>
                <label for="subscribe">Subscribe:</label>
                <input type="checkbox" name="subscribe" id="subscribe" checked><br>
                <small class="text-muted">Disability information is used for impact reporting purposes only and is not
                  associated with your account.</small>
              </div>
            </div>

          

            <button type="submit" class="btn btn-primary">Save Changes</button>
          </form>
        </div>
      </div>
 -->
      <!-- Badges Tab -->
      <div class="tab-pane fade" id="badges">
        <div class="badge-placeholder">
          <div class="badge-icon">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="10" />
              <path d="M12 8v8" />
              <path d="M8 12h8" />
            </svg>
          </div>
          <h4>No badges and certificates to display!</h4>
          <p class="text-muted">Enroll into a course to earn your badge and certificate.</p>
        </div>
      </div>

      <!-- Discounts Tab -->
      <div class="tab-pane fade" id="discounts">
        <div class="alert alert-info">
          No discounts available at this time.
        </div>
      </div>

      <!-- Learning History Tab -->
      <div class="tab-pane fade" id="history">
        <div class="alert alert-info">
          No learning history to display.
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <?php if (!empty($message)): ?>
    <script>
        let message = "<?= $message ?>";
        let messageType = "<?= $messageType ?>";
        
        alert(message);  // Display JavaScript alert based on PHP message
    </script>
<?php endif; ?>
  <script>
    // Badge click handler
    document.addEventListener('DOMContentLoaded', function () {
      const badges = document.querySelectorAll('.badge-item');
      badges.forEach(badge => {
        badge.addEventListener('click', function () {
          const badgeModal = new bootstrap.Modal(document.getElementById('badgeModal'));
          badgeModal.show();
        });
      });
    });
  </script>

  
</body>

</html>