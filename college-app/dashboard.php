<?php
session_start();
include 'config.php'; // Ensure database connection is included

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch user role from session
$role = $_SESSION['role']; // Assuming you store role in session after login

// Redirect based on role
if ($role == 'student') {
    header("Location: student.php");
    exit();
} elseif ($role == 'faculty') {
    header("Location: faculty.php");
    exit();
} else {
    echo "Invalid role! Please contact admin.";
    exit();
}
?>