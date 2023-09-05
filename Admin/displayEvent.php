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
  $id = $_GET['id'];
  $sql = "SELECT * FROM events WHERE event_id = " . $id;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $html = '<div>';
        $html .= '<p><h1><strong>'. $row['name'] . '</strong> </h1></p>'; 
        $html .= '<p><h2><strong>'. $row['edesc'] . '</strong></h2></p>';
        $html .= '<p><h3><strong>Date: '. $row['doe'] . '</strong></h3></p>';
        $html .= '<p><h3><strong>Location: '. $row['location'] . '</strong></h3></p>';
        $html .= '</div>';
        echo $html;
    } 

        mysqli_close($conn);
?>