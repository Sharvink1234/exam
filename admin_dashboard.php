<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Welcome to the Admin Dashboard</h1>
    <ul>
        <li><a href="add_subject.php">Add Subject</a></li>
        <li><a href="add_question.php">Add Question Bank</a></li>
        <li><a href="view_results.php">View Results & Ranking</a></li>
        <li><a href="manage_meetings.php">Manage Meeting Schedule</a></li>
        <li><a href="add_notice.php">Add Notice Board</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</body>
</html>