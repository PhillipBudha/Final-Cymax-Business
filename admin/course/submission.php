<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Submission</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- bootsrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- font awesome -->
    <!--  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="../assets/vendor/fontawesome-free-5.15.4-web/css/all.min.css">
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
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Courses</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="portalDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Portal
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="portalDropdown">
                            <li><a class="dropdown-item" href="student/sign-in.php">Student Login</a></li>
                            <li><a class="dropdown-item" href="#">Staff Login</a></li>
                            <li><a class="dropdown-item" href="#">Administrator Login</a></li>
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
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h4 class="text-primary">Course: <span id="courseName">Mathematics 101</span></h4>
        <p class="font-weight-bold">Time Remaining: <span id="timeRemaining">00:10:00</span></p>
        <button id="openAssignmentBtn" class="btn btn-primary mb-3">Open Assignment</button>

        <div class="file-upload-box border p-3" id="uploadSection" style="display:none;">
            <p class="font-weight-bold">File submissions</p>

            <div class="d-flex justify-content-between align-items-center mb-2">
                <div>
                    <button class="btn btn-outline-secondary btn-sm mr-1"><i class="fa fa-folder"></i> Browse</button>
                </div>
                <p class="mb-0 text-muted">Maximum file size: 100 MB, maximum number of files: 20</p>
            </div>

            <div class="upload-area border border-danger rounded p-5 text-center" id="uploadArea">
                <i class="fa fa-cloud-upload fa-3x text-muted"></i>
                <p class="mt-2">Drop files here to upload</p>
                <input type="file" id="fileInput" multiple>
                <div id="fileDetails"></div> <!-- Area to display file details -->
                <button id="uploadBtn" class="btn btn-success mt-3">Upload</button>
            </div>
        </div>
    </div>

    <script>
        // Timer setup
        let duration = 600; // 10 minutes in seconds
        const timerDisplay = document.getElementById('timeRemaining');
        const uploadBtn = document.getElementById('uploadBtn');

        const countdown = setInterval(() => {
            if (duration <= 0) {
                clearInterval(countdown);
                alert("Time is up!");
                uploadBtn.disabled = true; // Disable upload button when time is up
            } else {
                let minutes = Math.floor(duration / 60);
                let seconds = duration % 60;
                timerDisplay.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
                duration--;
            }
        }, 1000);

        // Show upload section when assignment is opened
        document.getElementById('openAssignmentBtn').addEventListener('click', () => {
            document.getElementById('uploadSection').style.display = 'block';
        });

        // Handle file upload
        uploadBtn.addEventListener('click', () => {
            const files = document.getElementById('fileInput').files;
            if (files.length === 0) {
                alert("Please select a file to upload.");
                return;
            }

            const formData = new FormData();
            for (let file of files) {
                formData.append('files[]', file);
            }

            fetch('upload.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Files uploaded successfully!");
                        uploadBtn.disabled = true; // Disable button after successful upload
                        // Optionally, you can clear the file input and details here
                    } else {
                        alert("Error uploading files: " + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert("An error occurred while uploading files.");
                });
        });
    </script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/index.js"></script>
</body>

</html>