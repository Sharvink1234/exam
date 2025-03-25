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

// Fetch meeting details
$sql = "SELECT * FROM meetings ORDER BY meeting_date ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Meeting Details - Online Exam System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Meeting Details - Online Exam System</h1>
        <nav>
            <ul>
                <li><a href="student_dashboard.php">Dashboard</a></li>
                <li><a href="give_exam.php">Give Exam</a></li>
                <li><a href="view_ranks.php">Check Ranks</a></li>
                <li><a href="student_notice.php">Notice Board</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section class="content">
        <h2>Upcoming Meetings</h2>
        <?php if ($result->num_rows > 0) { ?>
            <ul>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <li>
                        <strong><?php echo $row['title']; ?></strong> - 
                        <?php echo $row['meeting_date']; ?> at 
                        <?php echo $row['meeting_time']; ?>
                    </li>
                <?php } ?>
            </ul>
        <?php } else { ?>
            <p>No upcoming meetings scheduled.</p>
        <?php } ?>
    </section>

    <footer>
        <p>&copy; 2025 Online Exam System. All Rights Reserved.</p>
    </footer>
</body>
</html>

<?php $conn->close(); ?>