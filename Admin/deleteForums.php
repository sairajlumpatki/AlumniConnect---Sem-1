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
$sql = " SELECT * FROM forums ORDER BY forum_ID ASC";
$result = mysqli_query($con,$sql);

?>
<!-- HTML code to display data in tabular format -->
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Manage Forums</title>
	<link rel="stylesheet" href="view.css">
</head>

<body>
	<section>
		<button class="button" onclick=location.href="adminHome.html">Home</button>
		<h1>MANAGE FORUMS</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
			<tr>
				<th>Forum Title</th>
				<th>Date of Creation</th>
				<th>Forum Description</th>
                <th>Forum Author</th>
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
				<!--<td><?php echo $rows['forum_name'];?></td>-->
				<td><?php echo $rows['forum_title'];?></td>
				<td><?php echo $rows['date_of_creation'];?></td>
				<td><?php echo $rows['forum_description'];?></td>
				<td><?php echo $rows['author'];?></td>
				<td><?php echo "<form action='deleteLogicForum.php' method='post'>";
            echo "<input type='hidden' name='forum_ID' value='".$rows['forum_ID']."' >";
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
