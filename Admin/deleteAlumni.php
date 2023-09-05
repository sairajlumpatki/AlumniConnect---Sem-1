<?php
$alumni_username = $_POST["username"];
$hostName = "localhost";
$userName = "root";
$password = "";
$databaseName = "alumniconnect";
$conn = new mysqli($hostName, $userName, $password, $databaseName);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {

    $query = "DELETE FROM ALUMNI  where alumni_username = '" . $alumni_username . "'";

    $result = $conn->query($query);

    if ($result) {
        header("Location: deleteAlumniList.php");
    }
    $conn->close();
}
?>