<?php
// Start the session to keep the user logged in after they successfully log in
session_start();

// Database connection
$servername = "localhost"; // Your database host
$username = "root";        // Your database username
$password = "";            // Your database password
$dbname = "confluent-database"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $email = $_POST['email'];
    $user_password = $_POST['password'];

    // Check if user exists in the database
    $sql = "SELECT id, username, password FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, now verify password
        $row = $result->fetch_assoc();
        if (password_verify($user_password, $row['password'])) {
            // Password is correct, set session variables
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("Location: dashboard.php"); // Redirect to a secure page (e.g., dashboard)
            exit();
        } else {
            $error_message = "Incorrect password!";
        }
    } else {
        $error_message = "No user found with this email!";
    }
    
    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fontawesome-free-5.15.4-web/css/all.min.css">
    <style>
        body {
            background-color: #f7f8fc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
    </style>
</head>

<body>

    <div class="signup-card">
        <h2>Login</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            </div>
            <!-- <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                    required>
            </div> -->
            <button type="submit" class="btn btn-primary w-100">Login</button>
            <?php if (isset($error_message)): ?>
            <div class="alert alert-danger mt-3">
                <?php echo $error_message; ?>
            </div>
            <?php endif; ?>
            <p class="mt-2">By logging in, you agree to our <a href="#">terms of service</a></p>
        </form>

        <div class="divider">OR</div>

        <div class="auth-buttons">
            <button class="btn btn-outline-secondary w-100">
                <img src="https://github.githubassets.com/images/modules/logos_page/GitHub-Mark.png" alt="GitHub"
                    style="width: 20px; margin-right: 8px;"> Continue with GitHub
            </button>
            <button class="btn btn-outline-secondary w-100">
                <img src="assets/img/google.jpg" alt="Google" style="width: 20px; margin-right: 8px;">
                Continue with Google
            </button>
            <button class="btn btn-outline-secondary w-100">
                <img src="https://upload.wikimedia.org/wikipedia/commons/4/44/Microsoft_logo.svg" alt="Microsoft"
                    style="width: 20px; margin-right: 8px;"> Continue with Microsoft
            </button>
        </div>
    </div>

</body>

</html>