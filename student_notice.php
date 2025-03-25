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

// Fetch notices
$sql = "SELECT * FROM notices ORDER BY posted_date DESC";
$result = $conn->query($sql);
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
                <li><a href="student_dashboard.php">Dashboard</a></li>
                <li><a href="give_exam.php">Give Exam</a></li>
                <li><a href="view_ranks.php">Check Ranks</a></li>
                <li><a href="meeting_details.php">Meeting Details</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section class="content">
        <h2>Latest Notices</h2>
        <?php if ($result->num_rows > 0) { ?>
            <ul>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <li>
                        <strong><?php echo $row['title']; ?></strong> - 
                        <?php echo $row['posted_date']; ?><br>
                        <?php echo $row['description']; ?>
                    </li>
                <?php } ?>
            </ul>
        <?php } else { ?>
            <p>No notices available.</p>
        <?php } ?>
    </section>

    <footer>
        <p>&copy; 2025 Online Exam System. All Rights Reserved.</p>
    </footer>
</body>
</html>

<?php $conn->close(); ?>
