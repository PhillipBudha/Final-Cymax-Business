<?php
require_once "config.php";
require_once 'head.php';
require_once 'validation.php';

// Define variables and set to empty values
$email = $password = '';
$email_err = $password_err = '';

if (isset($_POST['submitted'])) {
    $email = test_input($_POST["email"]);

    if (empty($_POST["email"])) {
        $email_err = "* Email is required";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = :email";
        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":email", $param_email);

            // Set parameters
            $param_email = $email;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if (!$stmt->rowCount() == 1) {
                    $email_err = "This email doesn't exist.";
                }
            } else {
                echo "<div class='alert alert-danger text-center'>Something went wrong. Please try again later.</div>";
            }
            unset($stmt);
        }
    }

    if (empty($_POST["password"])) {
        $password_err = "* Password is required";
    } else {
        $password = md5(test_input($_POST["password"]));
    }

    // Check if the user details pass validation
    if (empty($email_err) && empty($password_err)) {
        // Prepare an update statement
        $sql = "UPDATE users SET password = :password WHERE email = :email";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":password", $param_password);
            $stmt->bindParam(":email", $param_email);

            // Set parameters
            $param_password = $password;
            $param_email = $email;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                echo "<div class='alert alert-success text-center'>Password changed successfully.</div>";
            } else {
                echo "<div class='alert alert-danger text-center'>Something went wrong. Please try again later.</div>";
            }
            unset($stmt);
        }
    }
    unset($pdo);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Password Reset</title>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow-lg p-4 w-50">
            <h2 class="text-center text-danger mb-5">Password Reset</h2>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="mb-5">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                    <small class="text-danger"><?php echo $email_err; ?></small>
                </div>
                <div class="mb-5">
                    <label for="password" class="form-label">New Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="New Password">
                    <small class="text-danger"><?php echo $password_err; ?></small>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-danger rounded-pill mb-5" name="submitted">Reset</button>
                    <a href="login.php" class="btn btn-primary rounded-pill">Back</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
