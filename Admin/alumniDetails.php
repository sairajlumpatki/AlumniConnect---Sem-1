<!DOCTYPE html>
<html>

<head>
  <link rel='stylesheet' href='navbar.css'>
  <link rel='stylesheet' href='alumniDetails.css'>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
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
  $sql_courses = "SELECT * FROM course_enroll WHERE alumni_username = '" . $alumni_id . "'";
  $result_courses = mysqli_query($conn, $sql_courses);


  echo "
            
            <div class='navigation'>
              <button onclick='location.href=\"logout.php\"' class='logout-btn'>Logout</button>
              <button onclick='location.href = \"alumniHome.php\"' class='homepage-btn'>Home</button>
            </div>";

  if (mysqli_num_rows($result_courses) > 0) {
    echo '<h2>Enrolled Courses</h2>';
    echo '<ul>';
    while ($row_course = mysqli_fetch_assoc($result_courses)) {
      $qry = "select * from courses where id=" . $row_course['course_id'];
      $result =  mysqli_query($conn, $qry);
      $row =  mysqli_fetch_assoc($result);


      echo '<li id=course-'.$row_course["course_id"].'  onclick="displayCourse(' . $row_course['course_id'] . ')">'. $row["course_name"] . ' <button onclick="removeCourse(' . $row_course['course_id'] . ',event)">Remove</button></li>';
    }
    echo '</ul>';
  } else {
    echo "<h1>No courses enrolled</h1><br>";
  }

  $sql_events = "SELECT * FROM event_register WHERE alumni_username = '" . $alumni_id . "'";
  $result_events = mysqli_query($conn, $sql_events);

  if (mysqli_num_rows($result_events) > 0) {
    echo '<h2>Attended Events</h2>';
    echo '<ul>';
    while ($row_event = mysqli_fetch_assoc($result_events)) {
      $qry = "select * from events where event_id=" . $row_event['event_id'];
      $result =  mysqli_query($conn, $qry);
      $row =  mysqli_fetch_assoc($result);
     
      echo '<li id=event-'.$row_event["event_id"].'  onclick="displayEvent(' . $row_event['event_id'] . ')">'. $row["name"] . ' <button onclick="removeEvents(' . $row_event['event_id'] . ',event)">Remove</button></li>';
    }
    echo '</ul>';
  } else {
    echo "<h1>No events attended</h1><br>";
  }

  $sql_jobs = "SELECT * FROM apply_job WHERE alumni_username = '" . $alumni_id . "'";
  $result_jobs = mysqli_query($conn, $sql_jobs);

  if (mysqli_num_rows($result_jobs) > 0) {
    echo '<h2>Applied Jobs</h2>';
    echo '<ul>';
    while ($row_job = mysqli_fetch_assoc($result_jobs)) {
      $qry = "select * from jobpost where job_id=" . $row_job['job_id'];
      $result =  mysqli_query($conn, $qry);
      $row =  mysqli_fetch_assoc($result);
      echo '<li id=job-'.$row_job["job_id"].'  onclick="displayJob(' . $row_job['job_id'] . ')">'. $row["jobtitle"] . ' <button onclick="removeJob(' . $row_job['job_id'] . ',event)">Remove</button></li>';
    }
    echo '</ul>';
  } else {
    echo "<h1>No jobs applied</h1><br>";
  }

  mysqli_close($conn);
  ?>


<script>



function removeCourse(id,event) {
  event.stopPropagation();

  $.ajax({
      type: 'POST',
      url: 'deleteCourse.php',  
      data: { id: id },
      success: function(response){
        if (response.includes("success")) {
          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: ' Deleted Successfully.',
          })
          const element = document.getElementById("course-"+id);
          element.remove();
          
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Something went wrong.',
          });
        }
      },
    });
  }


  function removeEvents(id,event) {
  event.stopPropagation();

  $.ajax({
      type: 'POST',
      url: 'deleteEvent.php',  
      data: { id: id },
      success: function(response){
        if (response.includes("success")) {
          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Event Registration Deleted Successfully.',
          })
          const element = document.getElementById("event-"+id);
          element.remove();
          
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Something went wrong.',
          });
        }
      },
    });
  }




  function removeJob(id , event) {
    event.stopPropagation();
  $.ajax({
    
      type: 'POST',
      url: 'deleteJob.php',
      data: { id: id },
      success: function(response){
        if (response.includes("success")) {
          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Job Application Removed',
          })
         const element = document.getElementById("job-"+id);
        element.remove();
          
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Something went wrong.',
          });
        }
      },
    });
  }



  function displayJob(id)
  {
    $.ajax({
    type: 'GET',
    url: 'displayJob.php',
    data: { id: id },
    success: function(response){
      // Display course details in SweetAlert dialog
      Swal.fire({
        title: 'Job Details',
        html: response,
        icon: 'info'
      });
    },
    error: function(xhr, status, error) {
      console.log(error);
    }
  });
  }


  function displayEvent(id)
  {
    $.ajax({
    type: 'GET',
    url: 'displayEvent.php',
    data: { id: id },
    success: function(response){
      // Display course details in SweetAlert dialog
      Swal.fire({
        title: 'Event Details',
        html: response,
        icon: 'info'
      });
    },
    error: function(xhr, status, error) {
      console.log(error);
    }
  });
  }



  function displayCourse(id)
  {
    $.ajax({
    type: 'GET',
    url: 'displayCourse.php',
    data: { id: id },
    success: function(response){
      // Display course details in SweetAlert dialog
      Swal.fire({
        title: 'Course Details',
        html: response,
        icon: 'info'
      });
    },
    error: function(xhr, status, error) {
      console.log(error);
    }
  });
  }
</script>