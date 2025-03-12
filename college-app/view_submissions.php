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

$sql = "SELECT student_name, file_name, file_url FROM assignment";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Uploaded Files</title>
     <link rel="stylesheet"  href="styles.css">
</head>
<body>
    <h2>Uploaded Files</h2>
    <table border="1">
        <tr>
            <th>Student Name</th>
            <th>File Name</th>
            <th>Download Link</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row["student_name"]) . "</td>
                        <td>" . htmlspecialchars($row["file_name"]) . "</td>
                        <td><a href='" . htmlspecialchars($row["file_url"]) . "' target='_blank'>Open File</a></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No files uploaded yet.</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
