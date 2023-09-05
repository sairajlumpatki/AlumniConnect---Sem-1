<?php
  session_start();
  if (!isset($_SESSION['username'])) {
    header("Location: index.html");
  }
  // Connect to database
  $hostName = 'localhost';
  $userName = 'root';
  $password = '';
  $db = 'alumniconnect';

  $conn = new mysqli($hostName, $userName, $password, $db);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $alumni_id = $_SESSION['username'];
  $id = $_POST['id'];
$sql = "DELETE FROM apply_job WHERE job_id = ".$id." and  alumni_username= '".$alumni_id."'";
if (mysqli_query($conn, $sql)) {
    $response="success";
} else {
   $response="error";
}

echo $response;

mysqli_close($conn);
?>