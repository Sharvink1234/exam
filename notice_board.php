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

// Add notice logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $notice_title = $_POST['notice_title'];
    $notice_details = $_POST['notice_details'];

    $sql = "INSERT INTO notices (title, details) VALUES ('$notice_title', '$notice_details')";

    if ($conn->query($sql) === TRUE) {
        $message = "Notice added successfully.";
    } else {
        $error = "Error: " . $conn->error;
    }
}

// Fetch notices
$notices = $conn->query("SELECT * FROM notices ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Notice Board - Online Exam System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Notice Board - Online Exam System</h1>
        <nav>
            <ul>
                <li><a href="admin_dashboard.php">Dashboard</a></li>
                <li><a href="add_subject.php">Add Subject</a></li>
                <li><a href="add_question.php">Add Question Bank</a></li>
                <li><a href="view_results.php">View Results</a></li>
                <li><a href="meeting_schedule.php">Manage Meetings</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section class="content">
        <h2>Add Notice</h2>
        <form method="POST" action="">
            <label for="notice_title">Title:</label>
            <input type="text" id="notice_title" name="notice_title" required>

            <label for="notice_details">Details:</label>
            <textarea id="notice_details" name="notice_details" required></textarea>

            <button type="submit">Add Notice</button>
        </form>

        <?php 
        if (!empty($message)) { echo "<p style='color: green;'>$message</p>"; } 
        if (!empty($error)) { echo "<p style='color: red;'>$error</p>"; } 
        ?>

        <h2>Notices</h2>
        <table border="1">
            <tr>
                <th>Title</th>
                <th>Details</th>
                <th>Date</th>
            </tr>
            <?php while ($row = $notices->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['details']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
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
