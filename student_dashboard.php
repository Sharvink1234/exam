<?php
session_start();

if (!isset($_SESSION['student'])) {
    header("Location: student_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard - Online Exam System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Student Dashboard - Online Exam System</h1>
        <nav>
            <ul>
                <li><a href="give_exam.php">Give Exam</a></li>
                <li><a href="view_ranks.php">Check Ranks</a></li>
                <li><a href="meeting_details.php">Meeting Details</a></li>
                <li><a href="student_notice.php">Notice Board</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section class="content">
        <h2>Welcome, <?php echo $_SESSION['student']; ?>!</h2>
        <p>Choose an option from the navigation above to proceed.</p>
    </section>

    <footer>
        <p>&copy; 2025 Online Exam System. All Rights Reserved.</p>
    </footer>
</body>
</html>
