<!DOCTYPE html>
<html>
	<head>
		<style>

body {
  font-family: Arial, sans-serif;
  background-color: #242424;
  color: #fff;
}

.container {
  width: 80%;
  margin: 0 auto;
  padding: 20px;
  background-color: #333;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  border-radius: 10px;
  text-align: center;
}

h1, h2 {
  color: #4CAF50;
  text-align: center;
}

ul {
  list-style: none;
  padding: 0;
  margin: 0;
  text-align: left;
}

li {
  margin: 10px 0;
  padding: 10px;
  background-color: #444;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
  border-radius: 5px;
  transition: all 0.3s ease;
}

li:hover {
  background-color: #4CAF50;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
  transform: scale(1.05);
}

.logout, .home {
  background-color: #4CAF50;
  color: #fff;
  padding: 10px 20px;
  border: none;
  cursor: pointer;
  margin: 5px;
  border-radius: 5px;
  text-align: center;
  display: inline-block;
  transition: all 0.3s ease;
}

.logout:hover, .home:hover {
  background-color: #3e8e41;
  transform: scale(1.05);
}

/* Footer styles */
.footer {
  position: fixed;
  bottom: 0;
  width: 100%;
  background-color: #333;
  padding: 10px;
  text-align: center;
}

.footer button {
  transition: all 0.3s ease;
}

.footer button:hover {
  transform: scale(1.05);
}

		</style>

	</head>

<?php
session_start();
if (!isset($_SESSION['username'])) {  
  header("Location: index.html");
}
// Connect to database
$hostName = 'localhost';
$userName = 'root';
$password = '';
$db = 'alumniconnect';

$conn = new mysqli($hostName, $userName, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Fetch all courses enrolled by the alumni
$alumni_id = $_SESSION['username']; 
$sql_courses = "SELECT * FROM course_enroll WHERE alumni_username = '".$alumni_id."'";
$result_courses = mysqli_query($conn, $sql_courses);

if (mysqli_num_rows($result_courses) > 0) {
    echo '<h2>Enrolled Courses</h2>';
    echo '<ul>';
    while($row_course = mysqli_fetch_assoc($result_courses)) {
        $qry = "select * from courses where id=".$row_course['course_id'];
        $result =  mysqli_query($conn, $qry);
        $row =  mysqli_fetch_assoc($result);
        echo '<li>' . $row["course_name"] . '</li>';
    }
    echo '</ul>';
} else {
    echo "<h1>No courses enrolled</h1><br>";
}

$sql_events = "SELECT * FROM event_register WHERE alumni_username = '".$alumni_id."'";
$result_events = mysqli_query($conn, $sql_events);

if (mysqli_num_rows($result_events) > 0) {
    echo '<h2>Attended Events</h2>';
    echo '<ul>';
    while($row_event = mysqli_fetch_assoc($result_events)) {
        $qry = "select * from events where event_id=".$row_event['event_id'];
        $result =  mysqli_query($conn, $qry);
        $row =  mysqli_fetch_assoc($result);
        echo '<li>' . $row["name"] . '</li>';    }
    echo '</ul>';
} else {
    echo "<h1>No events attended</h1><br>";
}

$sql_jobs = "SELECT * FROM apply_job WHERE alumni_username = '".$alumni_id."'";
$result_jobs = mysqli_query($conn, $sql_jobs);

if (mysqli_num_rows($result_jobs) > 0) {
    echo '<h2>Applied Jobs</h2>';
    echo '<ul>';
    while($row_job = mysqli_fetch_assoc($result_jobs)) {
        $qry = "select * from jobpost where job_id=".$row_job['job_id'];
        $result =  mysqli_query($conn, $qry);
        $row =  mysqli_fetch_assoc($result);
        echo '<li>' . $row["jobtitle"] . '</li>';
    }
    echo '</ul>';
} else {
    echo "<h1>No jobs applied</h1><br>";
}

mysqli_close($conn);
?>


<div class="footer">
<button onclick=location.href="logout.php" class="logout">Logout</button>
<button onclick=location.href="alumniHome.php" class="home">Home</button>
</div>