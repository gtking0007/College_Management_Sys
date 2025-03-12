<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'faculty') {
    header("Location: login.php");
    exit();
}

$name = $_SESSION['name']; // Retrieve faculty name from session
?>

<!DOCTYPE html>
<html>
<head>
    <title>Faculty Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($name); ?>!</h2> 
    <br> </br>
    <h3>You are Faculty</h3>
    <ul>
        <li><a href="upload_task.php">Upload Task</a></li>
        <li><a href="view_submissions.php"> View Assignments</a></li>
        <li><a href="upload_attendance.php">Upload Attendance</a></li>
        <li><a href="upload_grades.php">Upload Grades</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</body>
</html>