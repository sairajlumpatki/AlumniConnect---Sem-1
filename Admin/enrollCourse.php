<?php
session_start();
if (!isset($_SESSION['username'])) {  
  header("Location: index.html");
}

$hostName = "localhost";
$userName = "root";
$password = "";
$databaseName = "alumniconnect";
$conn = new mysqli($hostName, $userName, $password, $databaseName);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} else {
  $user = $_SESSION['username'];
  $courseID = $_POST['course_id'];

  $query = "SELECT * FROM `course_enroll` WHERE alumni_username = '".$user."' and course_id =".$courseID;

  $result = $conn->query($query);
  if ($result->num_rows == 1) {
    $response = "error";
  } else {
    $query = "INSERT INTO `course_enroll` (`alumni_username`, `course_id`) VALUES ('".$user."','".$courseID."')";
    $result = $conn->query($query);
    if ($result) {
      $response = "success";
    } else {
      $response = "error";
    }
  }
  echo $response; // Send the response back to the AJAX code
}
?>