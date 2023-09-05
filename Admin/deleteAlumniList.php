<?php

$hostName = "localhost";
$userName = "root";
$password = "";
$databaseName = "alumniconnect";
$conn = new mysqli($hostName, $userName, $password, $databaseName);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    

    $query = "SELECT * FROM alumni WHERE isApproved = 1; ";
    $result = $conn->query($query);
    
    echo'<!DOCTYPE html>
    <html>
    <head>
      <title>Table Style</title>
      <link rel="stylesheet" href="alumniRegList.css">
    </head>
    <body>
';    
    if ($result->num_rows > 0) 
    {
        
        echo" <table border='1px solid black'>
        <tr>
            <td>Name</td>
            <td>Email</td>
            <td>Contact</td>
            <td>Graduation Year</td>
            <td>Gender</td>
            <td>Department</td>
            <td>Employment</td>
            <td>Delete</td>     
        </tr>";

        while($row = $result->fetch_assoc())
        {
           echo"<tr>
           <td>".$row['alumni_name']."</td>
           <td>".$row['alumni_email']."</td>
           <td>".$row['alumni_contact']."</td>
           <td>".$row['batchyear']."</td>
           <td>".$row['alumni_gender']."</td>
           <td>".$row['branch']."</td>";

           if($row['isEmployed']==1)
           {
            echo"<td>Yes</td>";
           }
           else
           {
            echo"<td>No</td>";
           }

          echo'<td><form action="deleteAlumni.php" method="post">

           <input type="hidden" name="username" value='.$row['alumni_username'].' >
           <input type="submit" value="Delete">
          </form></td></tr>';

        
        }
        echo"</table>";
        
    } 
    else {
        echo "<h1>0 results</h1>";
    }
  
   $conn->close();

   echo"<h2><a href='adminHome.html'>Back to admin dashbord</a></h2></body>";
}

?>