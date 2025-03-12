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
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    $file_name = basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir . $file_name;
    $uploadOk = 1;
    
    // Check file size (limit: 5MB)
    if ($_FILES["fileToUpload"]["size"] > 20000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    
    // Allow only certain file formats
    $allowed_types = array("jpg", "png", "jpeg", "gif", "pdf", "docx");
    $file_extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (!in_array($file_extension, $allowed_types)) {
        echo "Sorry, only JPG, JPEG, PNG, GIF, PDF, and DOCX files are allowed.";
        $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $file_url = "uploads/" . $file_name;
            
            // Insert file URL into database
            $sql = "INSERT INTO attendance (file_name, file_url) VALUES ('$file_name', '$file_url')";
            if ($conn->query($sql) === TRUE) {
                echo "File uploaded successfully. <a href='$file_url' target='_blank'>$file_url</a>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
    Select file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload File" name="submit">
</form>
</body>
</html>
   