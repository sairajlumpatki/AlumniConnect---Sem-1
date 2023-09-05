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
    $eID = $_POST['job_id'];

    $query = "SELECT * FROM `apply_job` WHERE alumni_username = '".$user."' and job_id =".$eID;
    $result = $conn->query($query);
    if ($result->num_rows == 1) {
      $response = "error";
    }
    else
     {
        $query = "INSERT INTO `apply_job` (`alumni_username`, `job_id`) VALUES ('".$user."','".$eID."')";
        $result = $conn->query($query);
        if ($result==1) {
         $response = "success";
        } 
        else 
        {
            $response = "error";
         }
    }
  echo $response; // Send the response back to the AJAX code

}

?>
