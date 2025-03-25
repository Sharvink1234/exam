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
    $subject_name = $conn->real_escape_string($_POST['subject_name']);
    $subject_code = $conn->real_escape_string($_POST['subject_code']);

    $sql = "INSERT INTO subjects (subject_name, subject_code) VALUES ('$subject_name', '$subject_code')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Subject added successfully!'); window.location.href='admin_dashboard.php';</script>";
    } else {
        echo "<script>alert('Error adding subject: " . $conn->error . "'); window.location.href='add_subject.php';</script>";
    }
}

$conn->close();
?>
