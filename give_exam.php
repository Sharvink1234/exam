<?php
session_start();

if (!isset($_SESSION['student'])) {
    header("Location: student_login.php");
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "online_exam_system");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch subjects
$sql = "SELECT * FROM subjects";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Give Exam - Online Exam System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Give Exam - Online Exam System</h1>
        <nav>
            <ul>
                <li><a href="student_dashboard.php">Dashboard</a></li>
                <li><a href="view_ranks.php">Check Ranks</a></li>
                <li><a href="meeting_details.php">Meeting Details</a></li>
                <li><a href="student_notice.php">Notice Board</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section class="content">
        <h2>Select a Subject to Start Exam</h2>
        <form action="exam_page.php" method="POST">
            <label for="subject">Select Subject:</label>
            <select id="subject" name="subject_id" required>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <option value="<?php echo $row['id']; ?>">
                        <?php echo $row['subject_name']; ?>
                    </option>
                <?php } ?>
            </select>

            <button type="submit">Start Exam</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2025 Online Exam System. All Rights Reserved.</p>
    </footer>
</body>
</html>

<?php $conn->close(); ?>