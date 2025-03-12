<?php
session_start();
include 'config.php';

if (!isset($_SESSION["user_id"])) {
    die("Access Denied!");
}

$user_id = $_SESSION["user_id"];
$role = $_SESSION["role"];

echo "<h1>Attendance Records</h1>";

if ($role == "faculty") {
    echo "<a href='upload_attendance.php'>Upload Attendance Sheet</a><br><br>";
}

if ($role == "student") {
    // Student can only see their own attendance
    $sql = "SELECT date, status FROM attendance WHERE student_id = ? ORDER BY date DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_id);
} else {
    // Faculty can see all students' attendance
    $sql = "SELECT id, student_id, date, status FROM attendance ORDER BY date DESC";
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();

echo "<table border='1'>
        <tr>
            <th>Student ID</th>
            <th>Date</th>
            <th>Status</th>";

if ($role == "faculty") {
    echo "<th>Action</th>";  // Add action column for teachers
}

echo "</tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    
    if ($role == "faculty") {
        echo "<td>{$row['student_id']}</td>";  // Show Student ID only for faculty
    }
    
    echo "<td>{$row['date']}</td>
          <td>{$row['status']}</td>";

    if ($role == "faculty") {
        echo "<td>
                <form method='POST' action='update_attendance.php'>
                    <input type='hidden' name='attendance_id' value='{$row['id']}'>
                    <select name='status'>
                        <option value='Present' " . ($row['status'] == 'Present' ? 'selected' : '') . ">Present</option>
                        <option value='Absent' " . ($row['status'] == 'Absent' ? 'selected' : '') . ">Absent</option>
                    </select>
                    <button type='submit'>Update</button>
                </form>
              </td>";
    }

    echo "</tr>";
}

echo "</table>";

if ($role == "faculty") {
    echo "<br><a href='export_attendance.php'>Download Attendance (Excel)</a>";
}

?>
