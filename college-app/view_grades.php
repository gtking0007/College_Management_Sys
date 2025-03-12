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

$sql = "SELECT file_name, file_url FROM grades";
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
            <th>File Name</th>
            <th>Download Link</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["file_name"] . "</td><td><a href='" . $row["file_url"] . "' target='_blank'>Open File</a></td></tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No files found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
