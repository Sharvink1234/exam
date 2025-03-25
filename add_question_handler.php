<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "online_exam_system");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject_id = $conn->real_escape_string($_POST['subject_id']);
    $question = $conn->real_escape_string($_POST['question']);
    $option_a = $conn->real_escape_string($_POST['option_a']);
    $option_b = $conn->real_escape_string($_POST['option_b']);
    $option_c = $conn->real_escape_string($_POST['option_c']);
    $option_d = $conn->real_escape_string($_POST['option_d']);
    $correct_answer = $conn->real_escape_string($_POST['correct_answer']);

    $sql = "INSERT INTO questions (subject_id, question, option_a, option_b, option_c, option_d, correct_answer) 
            VALUES ('$subject_id', '$question', '$option_a', '$option_b', '$option_c', '$option_d', '$correct_answer')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Question added successfully!'); window.location.href='admin_dashboard.php';</script>";
    } else {
        echo "<script>alert('Error adding question: " . $conn->error . "'); window.location.href='add_question.php';</script>";
    }
}

$conn->close();
?>
