<?php

$alumniUsername = $_POST["username"];
$alumniEmail = $_POST["email"]; 
$alumniName = $_POST["alumniName"];
$alumniPass = $_POST["password"];
$alumniGender = $_POST["gender"];
$alumniDateOfBirth = $_POST["dateOfBirth"]; 
$alumniDept = $_POST["department"];   
$alumniGradYear = $_POST["batchYear"]; 
$alumniContact = $_POST["mobile"]; 
$alumniAdd = $_POST["address"]; 

if($_POST["isEmp"]=="true")
{
    $isEmp = 1 ; 
}
else
{
    $isEmp = 0 ; 
}

$hostName = "localhost";
$userName = "root";
$password = "";
$databaseName = "alumniconnect";
$conn = new mysqli($hostName, $userName, $password, $databaseName);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    

    $query = "INSERT INTO `alumni` (`alumni_username`, `alumni_password`, `alumni_name`, `alumni_email`, `alumni_contact`, `alumni_gender`, `alumni_address`, `batchyear`, `branch`, `isEmployed`, `isApproved`) VALUES ('".$alumniUsername."','".$alumniPass."','".$alumniName."','".$alumniEmail."','".$alumniContact."','".$alumniGender."','".$alumniAdd."','".$alumniGradYear."','".$alumniDept."','".$isEmp."','0')";
    $result = $conn->query($query);
    
    if($result)
    {
        header("Location: successReg.html");
    }
}

?>