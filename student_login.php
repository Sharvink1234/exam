<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "online_exam_system");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Student Login Logic
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM students WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['student'] = $username;
        header("Location: student_dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}

// Student Registration Logic
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];

    $check_sql = "SELECT * FROM students WHERE username='$new_username'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows == 0) {
        $register_sql = "INSERT INTO students (username, password) VALUES ('$new_username', '$new_password')";
        if ($conn->query($register_sql) === TRUE) {
            $success = "Registration successful. Please login.";
        } else {
            $error = "Error registering user.";
        }
    } else {
        $error = "Username already exists.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Login - Online Exam System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Online Exam System - Student Module</h1>
    </header>

    <section class="content">
        <h2>Student Login</h2>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" name="login">Login</button>
        </form>

        <?php if (!empty($error)) { echo "<p style='color: red;'>$error</p>"; } ?>

        <h2>Student Registration</h2>
        <form method="POST" action="">
            <label for="new_username">New Username:</label>
            <input type="text" id="new_username" name="new_username" required>

            <label for="new_password">New Password:</labe