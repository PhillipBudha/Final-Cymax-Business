<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-google {
            display: flex;
            align-items: center;
        }

        .btn-google img {
            width: 20px;
            height: 20px;
            margin-right: 8px;
        }
    </style>
</head>

<body>

    <?php
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'confluent_database');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM users WHERE email = ? AND password = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<div class='alert alert-success'>Login successful!</div>";
        } else {
            echo "<div class='alert alert-danger'>Invalid email or password.</div>";
        }

        $stmt->close();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        $query = "SELECT * FROM users WHERE email = ? AND password = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            // Redirect to another form (e.g., dashboard.php)
            header("Location: dashboard.php");
            exit(); // Ensure no further code is executed after the redirect
        } else {
            echo "<div class='alert alert-danger'>Invalid email or password.</div>";
        }
    
        $stmt->close();
    }
    
    ?>

    <!-- Login Form -->
    <div class="card">
        <h3 class="text-center">Admin Login</h3>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary w-100">Sign In</button>
        </form>

        <hr>
        <p class="text-center">OR</p>

        <div class="d-grid gap-2">
            <button class="btn btn-outline-secondary btn-google">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png"
                    alt="Google Logo">
                Continue with Google
            </button>
            <button class="btn btn-outline-secondary">Continue with GitHub</button>
            <button class="btn btn-outline-secondary">Continue with Microsoft</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>