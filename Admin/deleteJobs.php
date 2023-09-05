<?php

// Username is root
$user = 'root';
$password = '';
$database = 'alumniconnect';
$servername='localhost';
$con = new mysqli($servername, $user,
				$password, $database);

// Checking for connections
if(!$con) {
	die('Connect Error (' );
	
}

// SQL query to select data from database
$sql = " SELECT * FROM jobpost ORDER BY job_id ASC";
$result = mysqli_query($con,$sql);

?>
<!-- HTML code to display data in tabular format -->
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Manage Jobs</title>
	<link rel="stylesheet" href="view.css">
</head>

<body>
	<section>
		<button class="button" onclick=location.href="adminHome.html">Home</button>
		<h1>MANAGE JOBS</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
			<tr>
			
				<th>Job Role</th>
				<th>Company Name</th>
				<th>Min Experience (Yrs)</th>
                <th>Salary (CTC)</th>
                <th>Employement Type</th>
				<th>Action</th>
			</tr>
			<!-- PHP CODE TO FETCH DATA FROM ROWS -->
			<?php
				// LOOP TILL END OF DATA
				while($rows=$result->fetch_assoc())
				{
			?>
			<tr>
				<!-- FETCHING DATA FROM EACH
					ROW OF EVERY COLUMN -->
				<!--<td><?php echo $rows['job_id'];?></td>-->
				<td><?php echo $rows['jobtitle'];?></td>
				<td><?php echo $rows['company'];?></td>
				<td><?php echo $rows['minexp'];?></td>
				<td><?php echo $rows['salary'];?></td>
                <td><?php echo $rows['eType'];?></td>
				<td><?php echo "<form action='deleteLogicJob.php' method='post'>";
            echo "<input type='hidden' name='job_id' value='".$rows['job_id']."' >";
            echo "<button type='submit'>Delete</button>";
            echo "</form>";?></td>
				 

			</tr>
			<?php
				}
			?>
		</table>
	</section>
</body>

</html>
