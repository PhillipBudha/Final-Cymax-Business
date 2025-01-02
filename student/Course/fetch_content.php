<?php
include('db_connection.php');

// Check if subheading_id is set in the request
if (isset($_GET['subheading_id'])) {
    $subheadingId = intval($_GET['subheading_id']);
    
    // Query to fetch subheading data
    $stmt = $conn->prepare("SELECT subheading_title, subheading_content, video_blob, image_blob, pdf_blob 
                            FROM Subheadings WHERE subheading_id = ?");
    $stmt->bind_param("i", $subheadingId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        $content = "<h4>" . htmlspecialchars($row['subheading_title']) . "</h4>";
        $content .= "<p>" . nl2br(htmlspecialchars($row['subheading_content'])) . "</p>";
        
        // Display video
        if ($row['video_blob']) {
            $content .= "<h5>Video</h5>";
            $content .= "<video controls width='100%'>
                            <source src='data:video/mp4;base64," . base64_encode($row['video_blob']) . "' type='video/mp4'>
                            Your browser does not support the video tag.
                          </video>";
        }
        
      // Display image
       if ($row['image_blob']) {
           $content .= "<h5>Image</h5>";
           $content .= "<img src='data:image/jpeg;base64," . base64_encode($row['image_blob']) . "' class='img-fluid custom-img' />";
       }


         // Display PDF
        if ($row['pdf_blob']) {
             $content .= "<h5>PDF</h5>";
             $content .= "<div style='padding: 20px; margin: 20px; background-color: #f9f9f9; border: 1px solid #ccc; border-radius: 2px;'>";
             $content .= "<embed src='data:application/pdf;base64," . base64_encode($row['pdf_blob']) . "' width='100%' height='500px' style='border: none;' />";
             $content .= "</div>";
        }


        echo $content;
    } else {
        echo "<p>No content available for this subheading.</p>";
    }
    $stmt->close();
}
?>
