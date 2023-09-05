<?php
// Connect to database
session_start();
$hostName = 'localhost';
$userName = 'root';
$password = '';
$db = 'alumniconnect';

$conn = new mysqli($hostName, $userName, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Get values from comment form
$forum_id = $_POST['forum_id'];
$comment_text = $_POST['comment'];
$author = $_SESSION['username'];
// Insert new comment into database
$sql = "INSERT INTO forum_comments (forum_id, author, comment_text) VALUES ('$forum_id', '$author', '$comment_text')";
if ($conn->query($sql) === TRUE) {
    header("Location: alumniForums.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close database connection
mysqli_close($conn);
?>





