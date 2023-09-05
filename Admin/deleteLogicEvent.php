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
    $id = $_POST['event_id'];
    $query = "DELETE FROM events WHERE event_id =". $id;
   
    $result = $con->query($query);

    if ($result){
header("location: deleteEvents.php")  ;  }
    else{
        echo"Unable to delete Record";
    }
}

?>