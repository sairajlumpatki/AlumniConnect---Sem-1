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
    $eID = $_POST['event_id'];

    $query = "SELECT * FROM `event_register` WHERE alumni_username = '".$user."' and event_id =".$eID;

    $result = $conn->query($query);
    if( $result->num_rows === 1)
    {
        header("Location: alreadyEventRegistered.html");
    }

    
    $query = "INSERT INTO `event_register` (`alumni_username`, `event_id`) VALUES ('".$user."','".$eID."')";
    $result = $conn->query($query);
    echo"<h1>Registered successfully</h1>";
    echo"<a href='alumniEvent.php'><h2>BACK TO Event</h2></a>";

}

?>
