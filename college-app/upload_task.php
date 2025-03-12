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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $deadline_time = $_POST["deadline_time"]; // Get deadline time from input

    $sql = "INSERT INTO tasks (title, description, deadline_time) VALUES ('$title', '$description', '$deadline_time')";

     if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Task Added! ');
              </script>";
    } else {
        echo "<script>
                alert('Task Not Added: " . $conn->error . "');
                
              </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Task</title>
     <link rel="stylesheet"  href="styles.css">
</head>
<body>
    <form action="" method="post">
        <h2 class="title">Add a New Task</h2>
        Task Title: <input type="text" name="title" required><br><br>
        Description: <textarea name="description" required></textarea><br><br>
        Deadline Time: <input type="datetime-local" name="deadline_time" required><br><br>
        <input type="submit" value="Add Task">
    </form>
</body>


</html>
