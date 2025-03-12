<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "clg_mgt"; // Change to your database name

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
