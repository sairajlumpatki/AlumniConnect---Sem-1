<?php
$courseName = $_POST['course_name'];
$courseDescription = $_POST['course_description'];
$startDate = $_POST['course_start'];
$duration = $_POST['course_duration'];


$servername = "localhost";
$username = "root";
$password = "";
$database = "alumniconnect";
$con = new mysqli($servername, $username, $password, $database);
if($con->connect_error){
    die("Connection Failed: ".$con->connect_error);
}
else{
    $query= "INSERT INTO `courses` ( `course_name`, `course_description`, `course_start`, `course_duration`) VALUES ('".$courseName."','".$courseDescription."','". $startDate."','".$duration."')";
   
    $result = $con->query($query);

    if ($result){
        echo "Record inserted Successfully";
    }
    else{
        echo"Unable to insert Record";
}
}

?>