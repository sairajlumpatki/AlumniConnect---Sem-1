<?php

// Username is root
$user = 'root';
$password = '';

// Database name is geeksforgeeks
$database = 'alumniconnect';
$servername='localhost';
$mysqli = new mysqli($servername, $user,
				$password, $database);

// Checking for connections
if ($mysqli->connect_error) {
	die('Connect Error (' .
	$mysqli->connect_errno . ') '.
	$mysqli->connect_error);
}

// SQL query to select data from database
$sql = " SELECT * FROM courses ORDER BY id ASC";
$result = $mysqli->query($sql);
$mysqli->close();
?>
<!-- HTML code to display data in tabular format -->
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Manage Courses</title>
	<link rel="stylesheet" href="view.css">
</head>

<body>
	<section>
		<button class="button" onclick=location.href="adminHome.html">Home</button>
		<h1>MANAGE COURSES</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
			<tr>
				<th>Course Name</th>
				<th>Course Description</th>
				<th>Start Date</th>
                <th>Course Duration (Months)</th>
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
				<!--<td><?php echo $rows['id'];?></td>-->
				<td><?php echo $rows['course_name'];?></td>
				<td><?php echo $rows['course_description'];?></td>
				<td><?php echo $rows['course_start'];?></td>
				<td><?php echo $rows['course_duration'];?></td>
				<td><?php echo "<form action='deleteLogicCourse.php' method='post'>";
            echo "<input type='hidden' name='id' value='".$rows['id']."' >";
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
