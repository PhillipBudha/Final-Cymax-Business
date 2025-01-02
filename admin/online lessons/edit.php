<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM videos WHERE id = $id";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();

    if (isset($_POST['update'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $video = $_FILES['video']['name'];
        
        if ($video != "") {
            $target = "uploads/" . basename($video);
            move_uploaded_file($_FILES['video']['tmp_name'], $target);
            $sql = "UPDATE videos SET title='$title', description='$description', video='$video' WHERE id=$id";
        } else {
            $sql = "UPDATE videos SET title='$title', description='$description' WHERE id=$id";
        }

        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Video</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Video</h2>
        <form action="edit.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Video Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $row['title']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="video" class="form-label">Select Video (leave empty to keep existing video)</label>
                <input type="file" class="form-control" id="video" name="video" accept="video/*">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Short Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $row['description']; ?></textarea>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update Video</button>
        </form>
    </div>
</body>
</html>
