<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: login.php");
    exit();
}

$name = $_SESSION['name']; // Retrieve student's name
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($name); ?>!</h2>

    <ul>
        <li><a href="upload_assignment.php">Submit Assignment</a></li>
        <li><a href="view_task.php">View Task</a></li>
        <li><a href="view_grades.php">View Grades</a></li>
        <li><a href="view_attendance.php">View Attendance</a></li>
        <li><a href="notice_board.html">Notice Board</li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</body>
</html>