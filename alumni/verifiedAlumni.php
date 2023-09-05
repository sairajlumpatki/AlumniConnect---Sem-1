<?php

$aluname = $_POST["username"];

$hostName = "localhost";
$userName = "root";
$password = "";
$databaseName = "alumniconnect";
$conn = new mysqli($hostName, $userName, $password, $databaseName);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {

    $query = "UPDATE ALUMNI SET isApproved = 1 where alumni_username = '" . $aluname . "'";
    $result = $conn->query($query);

    if ($result == true) {
        header("Location: alumniRegList.php");
    }
    $conn->close();
}
