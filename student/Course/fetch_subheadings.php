<?php
include('db_connection.php');

if (isset($_GET['lesson_id'])) {
    $lessonId = intval($_GET['lesson_id']);
    $sql = "SELECT subheading_id, subheading_title FROM Subheadings WHERE lesson_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $lessonId);
    $stmt->execute();
    $result = $stmt->get_result();

    $subheadings = [];
    while ($row = $result->fetch_assoc()) {
        $subheadings[] = $row;
    }

    echo json_encode(['subheadings' => $subheadings]);
    $stmt->close();
}
?>
