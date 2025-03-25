<?php
session_start();
include 'db_connection.php'; // Database connection file

$email = $_POST['email'];
$password = $_POST['password'];

// Admin Login Check
$sql_admin = "SELECT * FROM admin WHERE username='$email' AND password='$password'";
$result_admin = $conn->query($sql_admin);

if ($result_admin->num_rows > 0) {
    $_SESSION['role'] = 'admin';
    header("Location: admin_dashboard.php");
    exit();
}

// Student Login Check
$sql_student = "SELECT * FROM students WHERE email='$email' AND password='$password'";
$result_student = $conn->query($sql_student);

if ($result_student->num_rows > 0) {
    $_SESSION['role'] = 'student';
    header("Location: student_dashboard.php");
    exit();
} else {
    echo "Invalid email or password!";
}
?>
