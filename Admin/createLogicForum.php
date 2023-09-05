<?php
session_start();
  if (!isset($_SESSION['username'])) {  
    header("Location: index.html");
 }
 ?>

<?php

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
    $ftitle = $_POST['forumTitle'];
    $fdesc = $_POST['forumDescription'];
    $author = $_SESSION['username'];

    $query = "INSERT INTO `forums` (`forum_ID`, `forum_title`, `date_of_creation`, `forum_description`, `author`) VALUES (NULL, '".$ftitle."', current_timestamp(), '".$fdesc."','".$author."')";

    $result = $conn->query($query);
    if( $result)
    {
        header("Location: alumniForums.php");
    }
   
}
?>