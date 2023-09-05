<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: index.html");
}
?>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "alumniconnect";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Query to fetch data from events table
$currentDate = date('Y-m-d');
$sql = "SELECT * FROM events where doe > '$currentDate'";

// Execute query and store results
$result = $conn->query($sql);



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alumni Connect - Events</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel='stylesheet' href='navbar.css'>
  <link rel='stylesheet' href='alumniEvent.css'>

  <script>
    $(document).ready(function() {
      $('.event-form').submit(function(event) {
        event.preventDefault();
        $.ajax({
          type: 'POST',
          url: 'registerEvent.php',
          data: $(this).serialize(),
          success: function(response) {
            if (response.includes("error")) {
              Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Your Registration is Already DONE !!!!',
              })
            } else if (response.includes("success")) {
              Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Registration successfull.',
              })
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Something went wrong.',
              });
            }
          },
          error: function() {
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
    <button onclick="location.href='logout.php'" class="logout-btn">Logout</button>
    <h2>EVENTS</h2>
    <button onclick="location.href='alumniHome.php'" class="homepage-btn">Home</button>
  </div>
  <div class="container-fluid">
  <h1>UPCOMING EVENT</h1><br>;
    <div class="row">
      <?php

      // Loop through each row of results and display as a card
      if ($result->num_rows > 0) {
        
        while ($row = $result->fetch_assoc()) {
          echo '<div class="col-lg-4 col-md-6 col-sm-12 mb-3">';
          echo '<div class="card event-card">';
          echo '<div class="card-body">';
          echo '<h3 class="card-title">' . $row['name'] . '</h3>';
          echo '<p class="card-text">' . $row['edesc'] . '</p>';
          echo '<p class="card-text"><strong>Date:</strong> ' . $row['doe'] . '</p>';
          echo '<p class="card-text"><strong>Time:</strong> ' . $row['etime'] . '</p>';
          echo '<p class="card-text"><strong>Location:</strong> ' . $row['location'] . '</p>';
          echo "<form action='registerEvent.php' method='post' class='event-form'>";
          echo "<input type='hidden' name='event_id' value='" . $row['event_id'] . "' >";
          echo "<button type='submit' class='btn btn-primary'>Register</button>";
          echo "</form>";
          echo '</div>';
          echo '</div>';
          echo '</div>';
        }
      } else {
        echo "<h2>NO UPCOMING EVENT SCHEDULE</h2><br>";
      }



      $currentDate = date('Y-m-d');
      $sql = "SELECT * FROM events where doe < '$currentDate'";

      // Execute query and store results
      $result = $conn->query($sql);
      

      ?>









      <div class="container-fluid">
      <br><h1>Our Past Events</h1><br>
        <div class="row">
          <?php
          if ($result->num_rows > 0) {
         
            while ($row = $result->fetch_assoc()) {
              echo '<div class="col-lg-4 col-md-6 col-sm-12 mb-3">';
              echo '<div class="card event-card">';
              echo '<div class="card-body">';
              echo '<h3 class="card-title">' . $row['name'] . '</h3>';
              echo '<p class="card-text">' . $row['edesc'] . '</p>';
              echo '<p class="card-text"><strong>Date:</strong> ' . $row['doe'] . '</p>';
              echo '<p class="card-text"><strong>Time:</strong> ' . $row['etime'] . '</p>';
              echo '<p class="card-text"><strong>Location:</strong> ' . $row['location'] . '</p>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
            }
          } else {
            echo "<h2>NO RECENT EVENT </h2>";
          }

          ?>