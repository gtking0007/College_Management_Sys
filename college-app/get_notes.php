<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    die(json_encode(["error" => "Unauthorized access"]));
}

$query = $conn->prepare("SELECT subject, file_path FROM notes");
$query->execute();
$result = $query->get_result();

$notes = [];
while ($row = $result->fetch_assoc()) {
    $notes[] = $row;
}

echo json_encode($notes);
?>