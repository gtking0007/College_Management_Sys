<?php
session_start();
$_SESSION = array(); // Clear session variables
session_destroy(); // Destroy session
header("Location: login.php");
exit();
?>
