<!DOCTYPE html>
<html>
  <head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel='stylesheet' href='navbar.css'>
    <link rel='stylesheet' href='alumniCourses.css'>

    <script>
      $(document).ready(function(){
  $('.course-form').submit(function(event){
    event.preventDefault();
    $.ajax({
      type: 'POST',
      url: 'enrollCourse.php',
      data: $(this).serialize(),
      success: function(response){
        if (response.includes("error")) {
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'You have already enrolled in this course.',
          })
        } else if (response.includes("success")) {
          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Course enrolled successfully.',
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
        }).then((result) => {
          window.location = 'enrollCourse.php';
        });
      }
    });
  });
});
    </script>
  </head>
  <body>
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

      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      } else {
        $query = "SELECT * FROM courses;";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
          echo "
            <link rel='stylesheet' href='navbar.css'>
            <div class='navigation'>
              <button onclick='location.href=\"logout.php\"' class='logout-btn'>Logout</button>
              <button onclick='location.href = \"alumniHome.php\"' class='homepage-btn'>Home</button>
            </div>
            <div style='text-align:center; margin: 50px 0;'>
              <h1 style='color: #fff;'>Courses</h1>
            </div>
            <div class='card-container'>
          ";
          while ($row = $result->fetch_assoc()) {
            echo "<div class='card'>";
            echo "<h3 class='card-title'>" . $row['course_name'] . "</h3>";
            echo "<p>" . $row['course_description'] . "</p>";
            echo "<p>Start Date: " . $row['course_start'] . "</p>";
            echo "<p>Duration: " . $row['course_duration'] . " months</p>";
            echo "<form action='enrollCourse.php' method='post' class='course-form'>";
            echo "<input type='hidden' name='course_id' value='" . $row['id'] . "' >";
            echo "<button class='apply-button' type='submit'>Enroll</button>";
            echo "</form>";
            echo "</div>";
          }
          echo "</div>";
        } else {
          echo "<h1>0 results</h1>";
        }
        $conn->close();
      }
    ?>
  </body>
</html>