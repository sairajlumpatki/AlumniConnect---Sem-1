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
$sql = " SELECT * FROM events ORDER BY event_id ASC";
$result = mysqli_query($con,$sql);

?>
<!-- HTML code to display data in tabular format -->
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Manage Events</title>
	<link rel="stylesheet" href="view.css">
</head>

<body>
	<section>
	<button class="button" onclick=location.href="adminHome.html">Home</button>
		<h1>MANAGE EVENTS</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
			<tr>
				<th>Event Name</th>
				<th>Event Description</th>
				<th>Date of Event</th>
                <th>Event Time</th>
                <th>Location</th>
                <th>Duration (Day)</th>
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
				<!--<td><?php echo $rows['event_id'];?></td>-->
				<td><?php echo $rows['name'];?></td>
				<td><?php echo $rows['edesc'];?></td>
				<td><?php echo $rows['doe'];?></td>
				<td><?php echo $rows['etime'];?></td>
                <td><?php echo $rows['location'];?></td>
                <td><?php echo $rows['duration'];?></td>
				<td><?php echo "<form action='deleteLogicEvent.php' method='post'>";
            echo "<input type='hidden' name='event_id' value='".$rows['event_id']."' >";
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
