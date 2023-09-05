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
$sql = "SELECT * FROM events";

// Execute query and store results
$result = $conn->query($sql);

// Close database connection
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alumni Connect - Events</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <style>
    .event-card {
      transition: all 0.3s ease-out;
      box-shadow: 0px 0px 10px rgba(255, 0, 0, 0.7);

    }
    .event-card:hover {
      transform: scale(1.05);
      box-shadow: 0px 0px 10px rgba(90, 0, 0, 0.8);
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Alumni Connect</a>
    </div>
    <button onclick=location.href="logout.php" class="btn btn-danger">Logout</button>
    <button onclick=location.href="alumniHome.php" class="btn btn-secondary">Home</button>
  </div> <!-- end of div with class "container-fluid" -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse">
    </div> <!-- end of div with class "collapse navbar-collapse" -->
  </nav>
  <div class="container-fluid">
    <h1>EVENTS</h1><br>
    <div class="row">
      <?php

        // Loop through each row of results and display as a card
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            echo '<div class="col-lg-4 col-md-6 col-sm-12 mb-3">';
            echo '<div class="card event-card">';
            echo '<div class="card-body">';
            echo '<h3 class="card-title">' . $row['name'] . '</h3>';
            echo '<p class="card-text">' . $row['edesc'] . '</p>';
            echo '<p class="card-text"><strong>Date:</strong> ' . $row['doe'] . '</p>';
            echo '<p class="card-text"><strong>Time:</strong> ' . $row['etime'] . '</p>';
            echo '<p class="card-text"><strong>Location:</strong> ' . $row['location'] . '</p>';
            echo "<form action='registerEvent.php' method='post'>";
            echo "<input type='hidden' name='event_id' value='".$row['event_id']."' >";
            echo "<button type='submit' class='btn btn-primary'>Register</button>";
            echo "</form>";
            echo '</div>';
            echo '</div>';
            echo '</div>';
          }
        } else {
          echo "0 results";
        }

      ?>
   
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script>
// Add animation and hover effect to event cards
$(document).ready(function() {
  $(".event-card").hover(
    function() {
      $(this).addClass("shadow-lg").css("cursor", "pointer");
    },
    function() {
      $(this).removeClass("shadow-lg");
    }
  );
});

</script>
