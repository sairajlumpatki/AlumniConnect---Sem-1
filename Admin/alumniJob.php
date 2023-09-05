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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel='stylesheet' href='navbar.css'>
    <link rel='stylesheet' href='alumniJob.css'>

    <script>
      $(document).ready(function(){
  $('.job-form').submit(function(event){
    event.preventDefault();
    $.ajax({
      type: 'POST',
      url: 'applyJob.php',
      data: $(this).serialize(),
      success: function(response){
        if (response.includes("error")) {
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'You have already to this Job',
          })
        } else if (response.includes("success")) {
          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Applied to the Job successfully.',
          })
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Something went wrong.',
          });
        }
      },
      error: function(){
        Swal.fire({
          icon: 'error',
          title: 'Error!',
          text: 'Something went wrong.',
        });
      }
    });
  });
});
    </script>
</head>
<body>
	<div class="navigation">
<button onclick=location.href="logout.php" class="logout-btn">Logout</button>
<button onclick=location.href="alumniHome.php" class="homepage-btn">Home</button>
</div>
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
          echo "<form action='applyJob.php' method='post' class='job-form'>";
          echo "<input type='hidden' name='job_id' value='".$row['job_id']."' >";
          echo "<button type='submit' class='button pulse-button'>Apply Now</button>";
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

