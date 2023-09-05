<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "alumniconnect";
$con = new mysqli($servername, $username, $password, $database);
if($con->connect_error){
    die("Connection Failed: ".$con->connect_error);
}
else{
    $id = $_POST['job_id'];
    $query = "DELETE FROM jobpost WHERE job_id =". $id;
   
    $result = $con->query($query);

    if ($result){
header("location: deleteJobs.php")  ;  }
    else{
        echo"Unable to delete Record";
    }
}

?>