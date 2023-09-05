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
    $name = $_POST["adminName"];
    $pass = $_POST["adminPass"];
    $query = "select * from admin where admin_username = '".$name."' and admin_passw = '".$pass."'";
    $result = $conn->query($query);
    

    if( $result->num_rows === 1)
    {
        header("Location: adminHome.html");
    }
    else {
        // Login failed
        echo "Invalid username or password";
    }
}
?>