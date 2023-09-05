<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="student.php" method="get">
        enter the name : <input type="text" name="studentName"></input><br>
        enter the address : <input type="text" name="studentAdd"></input><br>
        <input type="submit" value="submit">
    </form>
</body>

</html>


<?php
$hostName = "localhost";
$userName = "root";
$password = "";
$databaseName = "gaurav";
$conn = new mysqli($hostName, $userName, $password, $databaseName);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $name = $_GET["studentName"];
    $add = $_GET["studentAdd"];

    $query = "INSERT INTO `alumni_queue` (`alumni_username`, `alumni_password`, `alumni_name`, `alumni_email`, `alumni_contact`, `alumni_gender`, `alumni_address`, `batchyear`, `branch`, `isEmployed`, `isApproved`) VALUES ('', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)";
    $result = $conn->query($query);
}
?>


<!DOCTYPE html>
<html>
    <head>
        <style>
            body{
                background: linear-gradient(to bottom, #1e5799 0%,#2989d8 50%,#7db9e8 100%);
            }

            .forum {
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0,0,0,.3);
  padding: 20px;
  margin-bottom: 20px;
}

.forum h3 {
  margin: 0;
  font-size: 24px;
  font-weight: 600;
  color: #333;

  background: #fff;
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 20px;
  margin-bottom: 20px;
}

.forum p {
  margin: 10px 0;
  font-size: 16px;
  line-height: 1.5;
  color: #666;
}

.comments {
  list-style: none;
  margin: 0;
  padding: 0;
}

.comments li {
  margin: 10px 0;
  font-size: 14px;
  line-height: 1.5;
  color: #666;
}

.comments li:first-child {
  margin-top: 0;
}

.comments li:last-child {
  margin-bottom: 0;
}

textarea[name="comment"] {
  display: block;
  width: 100%;
  margin: 10px 0;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
  min-height: 100px;
}

button[type="submit"] {
  background-color: #008CBA;
  border: none;
  color: #fff;
  padding: 10px 20px;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
  background-color: #006C9D;
}

        </style>
    </head>
</html>