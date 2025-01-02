<?php
// create_quiz.php
$conn = new mysqli("localhost", "root", "", "confluent_database");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course_name = $_POST['title'];
    $time_limit = $_POST['time_limit'];
    $question_text = $_POST['question_text'];
    $option_a = $_POST['option_a'];
    $option_b = $_POST['option_b'];
    $option_c = $_POST['option_c'];
    $option_d = $_POST['option_d'];
    $correct_answer = $_POST['correct_answer'];

    // Insert quiz
    $conn->query("INSERT INTO quizzes (course_name, time_limit) VALUES ('$course_name', $time_limit)");
    $quiz_id = $conn->insert_id;

    // Insert questions
    for ($i = 0; $i < count($question_text); $i++) {
        $conn->query("INSERT INTO questions (quiz_id, question_text, option_a, option_b, option_c, option_d, correct_answer) 
                      VALUES ($quiz_id, '{$question_text[$i]}', '{$option_a[$i]}', '{$option_b[$i]}', '{$option_c[$i]}', '{$option_d[$i]}', '{$correct_answer[$i]}')");
    }

    echo "Quiz created successfully!";
}
?>
