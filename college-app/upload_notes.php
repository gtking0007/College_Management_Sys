<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    die(json_encode(["error" => "Unauthorized access"]));
}

if ($_FILES['file']['error'] == 0) {
    $file_name = basename($_FILES['file']['name']);
    $file_path = "uploads/" . $file_name;
    
    if (move_uploaded_file($_FILES['file']['tmp_name'], $file_path)) {
        $teacher_id = $_SESSION['user_id'];
        $subject = $_POST['subject'];

        $query = $conn->prepare("INSERT INTO notes (teacher_id, subject, file_path) VALUES (?, ?, ?)");
        $query->bind_param("iss", $teacher_id, $subject, $file_path);
        $query->execute();

        echo json_encode(["message" => "File uploaded"]);
    } else {
        echo json_encode(["error" => "Upload failed"]);
    }
} else {
    echo json_encode(["error" => "No file uploaded"]);
}
?>