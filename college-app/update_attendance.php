<?php
session_start();
include 'config.php';

require 'vendor/autoload.php'; // Load PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\IOFactory;

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "faculty") {
    die("Access Denied!");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["attendance_file"])) {
    $file = $_FILES["attendance_file"]["tmp_name"];

    try {
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray();

        $stmt = $conn->prepare("INSERT INTO attendance (student_id, date, status) VALUES (?, ?, ?) 
                                ON DUPLICATE KEY UPDATE status = VALUES(status)");

        foreach ($data as $row) {
            if (!isset($row[0], $row[1], $row[2])) {
                continue; // Skip empty rows
            }

            $student_id = trim($row[0]); // Column A: Student ID
            $date = trim($row[1]);       // Column B: Date (YYYY-MM-DD)
            $status = trim($row[2]);     // Column C: Present/Absent

            if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
                echo "Invalid date format for student ID $student_id. Skipping row.<br>";
                continue;
            }

            $stmt->bind_param("sss", $student_id, $date, $status);
            $stmt->execute();
        }

        echo "✅ Attendance uploaded successfully!";
    } catch (Exception $e) {
        echo "❌ Error: " . $e->getMessage();
    }
} else {
    echo "❌ Error: No file uploaded.";
}
?>
