<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Enrollment Success</title>
  <!-- Add Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Add custom CSS -->
  <style>
    body {
      background-color: #f8f9fa;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      font-family: 'Roboto', sans-serif;
    }
    .enrollment-container {
      text-align: center;
      padding: 30px;
      border-radius: 10px;
      background-color: #ffffff;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }
    h1 {
      color: #28a745;
      font-size: 2.5rem;
    }
    a {
      display: inline-block;
      text-decoration: none;
      color: #ffffff;
      background-color: #007bff;
      padding: 10px 20px;
      border-radius: 5px;
      font-size: 1.125rem;
      font-weight: 500;
      transition: background-color 0.2s ease-in-out;
    }
    a:hover {
      background-color: red;
    }
  </style>
</head>
<body>



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
} 
else 
{
    $user = $_SESSION['username'];
    $courseID = $_POST['course_id'];

    $query = "SELECT * FROM `course_enroll` WHERE alumni_username = '".$user."' and course_id =".$courseID;

    $result = $conn->query($query);
    if( $result->num_rows === 1)
    {
        header("Location: alreadyCourseRegistered.html");
    }

    
    $query = "INSERT INTO `course_enroll` (`alumni_username`, `course_id`) VALUES ('".$user."','".$courseID."')";
    $result = $conn->query($query);
    echo "
    <div class='enrollment-container'>
      <h1>Enrolled Successfully</h1>
      <a href='alumniCourses.php'>Back to the Courses</a>
    </div>";


}

?>


</body>
</html>