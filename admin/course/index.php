<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confluent Academy</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include  CSS -->
     <link rel="stylesheet" href="bootstrap/css/style.css">
    <style>
      
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
               <!--  <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);" onclick="history.back();">Dashboard</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);" onclick="history.back();">Home</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


    <div class="jumbotron">
        <div class="container">
            <h1>Welcome to Confluent Academy</h1>
            <a class="btn btn-success rounded-pill w-50" href="create-user.php" role="button">Create account</a>
            <a class="btn btn-primary rounded-pill w-50" href="login.php" role="button">Login</a>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>
