<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clg_mgt";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, title, description, uploaded_at, deadline_time FROM tasks ORDER BY deadline_time ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Task List</title>
     <link rel="stylesheet"  href="styles.css">
</head>
<body>
    <h2>Task List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Uploaded At</th>
            <th>Deadline</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . htmlspecialchars($row["title"]) . "</td>
                        <td>" . htmlspecialchars($row["description"]) . "</td>
                        <td>" . $row["uploaded_at"] . "</td>
                        <td>" . $row["deadline_time"] . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No tasks found.</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
