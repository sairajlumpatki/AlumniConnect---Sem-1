
<!DOCTYPE html>
<html>
<head>
	<title>Registered successfully</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<!-- Custom CSS -->
	<style>
		body {
			background-color: #f5f5f5;
			font-family: Arial, sans-serif;
			font-size: 16px;
			line-height: 1.5;
			padding-top: 50px;
			padding-bottom: 50px;
		}
		h1, h2 {
			font-weight: bold;
			margin-top: 0;
		}
		h1 {
			font-size: 36px;
			margin-bottom: 30px;
			text-align: center;
			text-transform: uppercase;
		}
		h2 {
			font-size: 24px;
			margin-bottom: 20px;
			text-align: center;
		}
		a {
			color: #007bff;
			text-decoration: none;
		}
		a:hover {
			color: #0056b3;
			text-decoration: underline;
		}
	</style>
</head>

<?php
session_start();
  if (!isset($_SESSION['username'])) {  
    header("Location: index.html");
 }

$hostName = "localhost";
$userName = "root";
$password = "";
$databaseName = "alumniconnect";
$conn = new mysqli($hostName, $userName, $password, $databaseName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
else 
{
    $user = $_SESSION['username'];
    $eID = $_POST['job_id'];

    $query = "SELECT * FROM `apply_job` WHERE alumni_username = '".$user."' and job_id =".$eID;

    $result = $conn->query($query);
    if( $result->num_rows === 1)
    {
        header("Location: alreadyJobApplied.html");
    }
 
    $query = "INSERT INTO `apply_job` (`alumni_username`, `job_id`) VALUES ('".$user."','".$eID."')";
    $result = $conn->query($query);

}

?>


<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Registered successfully</h1>
				<h2><a href="alumniJob.php">Back to job portal</a></h2>
			</div>
		</div>
	</div>
	
	<!-- Bootstrap JS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>