<?php
session_start();

$hostName = "localhost";
$userName = "root";
$password = "";
$databaseName = "alumniconnect";
$conn = new mysqli($hostName, $userName, $password, $databaseName);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $name = $_POST["alumniName"];
    $pass = $_POST["alumniPass"];
    $query = "select * from alumni where alumni_username = '".$name."' and alumni_password = '".$pass."' and isApproved = 1";
    $result = $conn->query($query);
    

    if( $result->num_rows === 1)
    {
        $_SESSION["username"] = $name;
        $_SESSION["isHomePageVisited"]=false ; 
        echo 'success';
    }

    $query = "select * from alumni where alumni_username = '".$name."' and alumni_password = '".$pass."' and isApproved = 0";
    $result = $conn->query($query);
    if( $result->num_rows === 1)
    {
        echo 'incomplete';
    }

    else 
    {
        // Display error message
     
    }
}
?>