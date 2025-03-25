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

// Fetch student ranks
$sql = "SELECT username, score FROM students ORDER BY score DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Ranks - Online Exam System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>View Ranks - Online Exam System</h1>
        <nav>
            <ul>
                <li><a href="student_dashboard.php">Dashboard</a></li>
                <li><a href="give_exam.php">Give Exam</a></li>
                <li><a href="meeting_details.php">Meeting Details</a></li>
                <li><a href="student_notice.php">Notice Board</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section class="content">
        <h2>Student Ranking</h2>
        <table border="1">
            <tr>
                <th>Rank</th>
                <th>Student Name</th>
                <th>Score</th>
            </tr>
            <?php $rank = 1; ?>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $rank++; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['score']; ?></td>
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
