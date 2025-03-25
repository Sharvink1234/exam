<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "online_exam_system");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject_name = $_POST['subject_name'];
    $subject_code = $_POST['subject_code'];

    $sql = "INSERT INTO subjects (subject_name, subject_code) VALUES ('$subject_name', '$subject_code')";

    if ($conn->query($sql) === TRUE) {
        $message = "Subject added successfully.";
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Subject - Online Exam System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Add Subject - Online Exam System</h1>
        <nav>
            <ul>
                <li><a href="admin_dashboard.php">Dashboard</a></li>
                <li><a href="add_question.php">Add Question Bank</a></li>
                <li><a href="view_results.php">View Results</a></li>
                <li><a href="meeting_schedule.php">Manage Meetings</a></li>
                <li><a href="notice_board.php">Notice Board</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section class="content">
        <h2>Add Subject</h2>
        <form method="POST" action="">
            <label for="subject_name">Subject Name:</label>
            <input type="text" id="subject_name" name="subject_name" required>

            <label for="subject_code">Subject Code:</label>
            <input type="text" id="subject_code" name="subject_code" required>

            <button type="submit">Add Subject</button>
        </form>
        <?php 
        if (!empty($message)) { echo "<p style='color: green;'>$message</p>"; } 
        if (!empty($error)) { echo "<p style='color: red;'>$error</p>"; } 
        ?>
    </section>

    <footer>
        <p>&copy; 2025 Online Exam System. All Rights Reserved.</p>
    </footer>
</body>
</html>

<?php $conn->close(); ?>
