<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Upload</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Upload Course</h2>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="course_name">Course Name</label>
        <input type="text" class="form-control" id="course_name" name="course_name" required>
    </div>
    <div class="form-group">
        <label for="short_description">Short Description</label>
        <textarea class="form-control" id="short_description" name="short_description" rows="3" required></textarea>
    </div>
    <div class="form-group">
        <label for="duration">Duration</label>
        <input type="text" class="form-control" id="duration" name="duration" required>
    </div>
    <div class="form-group">
        <label for="video">Upload Video</label>
        <input type="file" class="form-control-file" id="video" name="video">
    </div>
    <div class="form-group">
        <label for="documents">Upload Documents (PDF/Word)</label>
        <input type="file" class="form-control-file" id="documents" name="documents[]" multiple>
        <small class="form-text text-muted">You can upload multiple files.</small>
    </div>
    <button type="submit" class="btn btn-primary">Upload Course</button>
</form>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
