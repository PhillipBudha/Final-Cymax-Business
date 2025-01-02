<?php
// submit_quiz.php
$conn = new mysqli("localhost", "root", "", "confluent_database");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quiz_id = $_POST['quiz_id'];
    $student_name = $_POST['student_name'];
    $answers = $_POST['answers'];

    $score = 0;
    $total = count($answers);

    foreach ($answers as $question_id => $answer) {
        $result = $conn->query("SELECT correct_answer FROM questions WHERE id = $question_id AND quiz_id = $quiz_id");

        if ($result && $row = $result->fetch_assoc()) {
            if ($row['correct_answer'] === $answer) {
                $score++;
            }
        }
    }

    // Store student's result
    $conn->query("INSERT INTO quiz_results (quiz_id, student_name, score, total) VALUES ($quiz_id, '$student_name', $score, $total)");

    $response = [
        'message' => 'Quiz submitted successfully!',
        'student_name' => $student_name,
        'quiz_id' => $quiz_id,
        'score' => $score,
        'total' => $total
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Quiz Result</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="container mt-5 d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card" style="width: 50%;">
        <div class="card-body text-center">
            <h2 class="card-title alert alert-success">Quiz Submitted Successfully!</h2>
            <table class="table table-bordered mt-4">
                <tbody>
                    <tr>
                        <th>Student Name</th>
                        <td><?= $response['student_name'] ?></td>
                    </tr>
                    <tr>
                        <th>Quiz ID</th>
                        <td><?= $response['quiz_id'] ?></td>
                    </tr>
                    <tr>
                        <th>Score</th>
                        <td><?= $response['score'] ?></td>
                    </tr>
                    <tr>
                        <th>Total Questions</th>
                        <td><?= $response['total'] ?></td>
                    </tr>
                </tbody>
            </table>
            <a href="student_view.php" class="btn btn-primary mt-3">Take Another Quiz</a>
        </div>
    </div>
</body>
</html>
