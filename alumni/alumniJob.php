<?php 
  session_start();
  if (!isset($_SESSION['username'])) {  
    header("Location: index.html");
 }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Job Listings</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-kg87u2lWVG0mSvS+XpVf0beLnhGX1JnZvF22tPbxoZnOhwWnPOKkAFrT9neY9axcQ2xZxHnzAdz2lsZB58dwgg==" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
	<style>
		body {
			margin: 0;
			padding: 0;
			font-family: 'Montserrat', sans-serif;
			background-color: rgba(255,255,255,0.2);
		}

		h1 {
			text-align: center;
			padding: 50px 0;
			font-size: 48px;
			color: #1b1b1b;
			text-shadow: 2px 2px #e6e6e6;
		}

		.container {
			width: 80%;
			margin: 0 auto;
		}

		.job-listings {
			display: flex;
			flex-wrap: wrap;
			justify-content: center;
			align-items: center;
		}

		.job-listing {
			width: 300px;
			margin: 20px;
			padding: 20px;
			background-color: #fff;
			border-radius: 10px;
			box-shadow: 0px 0px 10px rgba(255, 0, 0, 0.5);
			transition: all 0.3s ease;
		}

		.job-listing:hover {
			box-shadow: 0px 0px 20px blue;
			transform: translateY(-5px);
		}

		.job-listing h2 {
			font-size: 24px;
			color: #1b1b1b;
			margin: 0;
			margin-bottom: 10px;
		}

		.job-listing h3 {
			font-size: 18px;
			color: #1b1b1b;
			margin: 0;
			margin-bottom: 20px;
		}

		.job-listing p {
			font-size: 16px;
			color: #777;
			margin: 0;
			margin-bottom: 20px;
		}

		.job-listing .salary {
			font-size: 20px;
			color: #1b1b1b;
			margin: 0;
			margin-bottom: 10px;
		}

		.job-listing .location {
			font-size: 16px;
			color: #777;
			margin: 0;
		}

		button {
			display: inline-block;
			background-color: #4CAF50;
			color: #fff;
			padding: 10px 20px;
			border-radius: 5px;
			font-size: 16px;
			cursor: pointer;
			transition: all 0.3s ease;
		}

		button:hover {
			background-color: #3e8e41;
		}

    button {
  background-color: #333;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  cursor: pointer;
}

button:hover {
  background-color: #555;
}

button:active {
  background-color: #777;
}

button:focus {
  outline: none;
  box-shadow: 0 0 0 3px rgba(255,255,255,0.2);
}


button.logout{
			display: inline-block;
			padding: 10px 20px;
			background-color:  #8B008B;;
			color: #fff;
			border-radius: 5px;
			border: none;
			cursor: pointer;
			transition: all 0.3s ease;
			float: right;
			margin-left: 20px;
		}

		button.logout:hover {
			background-color: #696969;
		}

		button.home{
			display: inline-block;
			padding: 10px 20px;
			background-color:  #8B008B;;
            color: #fff;
			border-radius: 5px;
			border: none;
			cursor: pointer;
			transition: all 0.3s ease;
			float: right;
			margin-left: 20px;
		}

		button.home:hover {
			background-color: #696969;
		}

		
	</style>
</head>
<body>
<button onclick=location.href="logout.php" class="logout">Logout</button>
<button onclick=location.href="alumniHome.php" class="home">Home</button>
	<h1>Job Listings</h1>
	<div class="container">
		<div class="job-listings">
			<?php
				$servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "alumniconnect";
        
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        
        
        $sql = "SELECT * FROM jobpost";
        
        
        $result = $conn->query($sql);

				// loop through the results and display each job listing
				while ($row = mysqli_fetch_assoc($result)) {
					echo '<div class="job-listing">';
					echo '<div class="job-type ' . strtolower($row["eType"]) . '">' . $row["eType"] . '</div>';
					echo '<h2>' . $row["jobtitle"] . '</h2>';
					echo '<h3>' . $row["company"] . '</h3>';
					echo '<p>' . $row["jobdesc"] . '</p>';
					echo '<p class="salary">' . $row["salary"] . '</p>';
          echo "<form action='applyJob.php' method='post'>";
          echo "<input type='hidden' name='job_id' value='".$row['job_id']."' >";
          echo "<button type='submit'>Apply Now</button>";
          echo "</form>";
					echo '</div>';
				}

				// close database connection
				mysqli_close($conn);
			?>
        
		</div>
	</div>

</body>
</html>

