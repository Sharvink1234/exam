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

// Add meeting logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $meeting_title = $_POST['meeting_title'];
    $meeting_date = $_POST['meeting_date'];
    $meeting_time = $_POST['meeting_time'];

    $sql = "INSERT INTO meetings (title, date, time) VALUES ('$meeting_title', '$meeting_date', '$meeting_time')";

    if ($conn->query($sql) === TRUE) {
        $message = "Meeting scheduled successfully.";
    } else {
        $error = "Error: " . $conn->error;
    }
}

// Fetch scheduled meetings
$meetings = $conn->query("SELECT * FROM meetings ORDER BY date ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Meetings - Online Exam System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Manage Meetings - Online Exam System</h1>
        <nav>
            <ul>
                <li><a href="admin_dashboard.php">Dashboard</a></li>
                <li><a href="add_subject.php">Add Subject</a></li>
                <li><a href="add_question.php">Add Question Bank</a></li>
                <li><a href="view_results.php">View Results</a></li>
                <li><a href="notice_board.php">Notice Board</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section class="content">
        <h2>Schedule a Meeting</h2>
        <form method="POST" action="">
            <label for="meeting_title">Meeting Title:</label>
            <input type="text" id="meeting_title" name="meeting_title" required>

            <label for="meeting_date">Date:</label>
            <input type="date" id="meeting_date" name="meeting_date" required>

            <label for="meeting_time">Time:</label>
            <input type="time" id="meeting_time" name="meeting_time" required>

            <button type="submit">Add Meeting</button>
        </form>

        <?php 
        if (!empty($message)) { echo "<p style='color: green;'>$message</p>"; } 
        if (!empty($error)) { echo "<p style='color: red;'>$error</p>"; } 
        ?>

        <h2>Upcoming Meetings</h2>
        <table border="1">
            <tr>
                <th>Title</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
            <?php while ($row = $meetings->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['time']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </section>

    <footer>
        <p>&copy; 2025 Online Exam System. All Rights Reserved.</p>
    </footer>
</body>
</html>

<?php $conn->close(); ?>