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

// Fetch subjects for dropdown
$subjectsResult = $conn->query("SELECT * FROM subjects");

// Add question logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and trim input data
    $subject_id     = trim($_POST['subject_id']);
    $question       = trim($_POST['question']);
    $option1        = trim($_POST['option1']);
    $option2        = trim($_POST['option2']);
    $option3        = trim($_POST['option3']);
    $option4        = trim($_POST['option4']);
    $correct_answer = trim($_POST['correct_answer']);

    // Prepare an insert statement
    $stmt = $conn->prepare("INSERT INTO questions (subject_id, question, option1, option2, option3, option4, correct_answer) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    if ($stmt) {
        // Bind parameters (assuming subject_id is integer and rest are strings)
        $stmt->bind_param("issssss", $subject_id, $question, $option1, $option2, $option3, $option4, $correct_answer);
        
        // Execute the statement
        if ($stmt->execute()) {
            $message = "Question added successfully.";
        } else {
            $error = "Execution failed: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $error = "Preparation failed: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Question - Online Exam System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Add Question - Online Exam System</h1>
        <nav>
            <ul>
                <li><a href="admin_dashboard.php">Dashboard</a></li>
                <li><a href="add_subject.php">Add Subject</a></li>
                <li><a href="view_results.php">View Results</a></li>
                <li><a href="meeting_schedule.php">Manage Meetings</a></li>
                <li><a href="notice_board.php">Notice Board</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section class="content">
        <h2>Add Question</h2>
        <form method="POST" action="">
            <label for="subject_id">Select Subject:</label>
            <select id="subject_id" name="subject_id" required>
                <?php while ($row = $subjectsResult->fetch_assoc()) { ?>
                    <option value="<?php echo htmlspecialchars($row['id']); ?>">
                        <?php echo htmlspecialchars($row['subject_name']); ?>
                    </option>
                <?php } ?>
            </select>

            <label for="question">Questions:</label>
            <textarea id="question" name="question" required></textarea>

            <label for="option1">Option 1:</label>
            <input type="text" id="option1" name="option1" required>

            <label for="option2">Option 2:</label>
            <input type="text" id="option2" name="option2" required>

            <label for="option3">Option 3:</label>
            <input type="text" id="option3" name="option3" required>

            <label for="option4">Option 4:</label>
            <input type="text" id="option4" name="option4" required>

            <label for="correct_answer">Correct Answer:</label>
            <input type="text" id="correct_answer" name="correct_answer" required>

            <button type="submit">Add Question</button>
        </form>

        <?php 
        if (!empty($message)) { 
            echo "<p style='color: green;'>$message</p>"; 
        } 
        if (!empty($error)) { 
            echo "<p style='color: red;'>$error</p>"; 
        } 
        ?>
    </section>

    <footer>
        <p>&copy; 2025 Online Exam System. All Rights Reserv</p>
    </footer>
</body>
</html>

<?php 
$conn->close(); 
?>
