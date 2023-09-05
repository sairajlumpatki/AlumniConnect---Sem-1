
<?php

$Ename = $_POST["ename"];
$Description = $_POST["edesc"];
$Dateofevent = $_POST["doe"];
$ETime = $_POST["etime"];
$Duration = $_POST["duration"]; 
$ELocation = $_POST["location"];

$hostName = "localhost";
$userName = "root";
$password = "";
$databaseName = "alumniconnect";
$conn = new mysqli($hostName, $userName, $password, $databaseName);
// Check connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    

    $query = "INSERT INTO `events`  VALUES (null,'".$Ename."','".$Description."','".$Dateofevent."','".$ETime."','".$Duration."','".$ELocation."')";
    $result = $conn->query($query);
    
    
    if($result)
    {
        header("Location: success.html");
    }
}

?>