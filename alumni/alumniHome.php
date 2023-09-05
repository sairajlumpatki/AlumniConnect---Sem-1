<?php 
  session_start();
  if (!isset($_SESSION['username'])) {  
    header("Location: http://localhost/alumniconnect/index.html");
 }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Alumni Management System</title>
    <style>

      .tile-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-evenly;
      }


      .tile {
        width: 200px;
        height: 200px;
        margin: 10px;
        background-color: #f2f2f2;
        border-radius: 10px;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        cursor: pointer;
        transition: transform 0.2s;
      }

 
      .tile a {
        color: black;
        text-decoration: none;
        font-size: 24px;
        font-weight: bold;
      }


      .tile:hover {
        transform: scale(1.05);
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5), 0 0 20px rgba(255, 255, 255, 0.5), 0 0 30px rgba(255, 255, 255, 0.5), 0 0 40px rgba(255, 255, 255, 0.5), 0 0 70px rgba(255, 255, 255, 0.5);
      }

      body {
        background-color: #1f2d3d;
        font-family: sans-serif;
        color: #fff;
      }

      h1 {
        text-align: center;
        margin-top: 50px;
        font-size: 36px;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 30px;
      }

   
      .logout-button {
  background-color: #4CAF50;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
  position: absolute;
  top: 20px;
  right: 20px;
}

      .logout-button:hover {
        background-color: #3e8e41;
      }
    </style>
  </head>
  <body>

  <?php
echo"<h2>Welcome ".$_SESSION['username']."  !!!!!";

?>
    <h1>Home page</h1>
    
    <button class="logout-button" onclick="location.href='logout.php';">Logout</button>
    
    <div class="tile-container">
      <div class="tile" onclick="location.href='#';">
        <a href="alumniDetails.php">PROFILE</a>
      </div>
      <div class="tile" onclick="location.href='#';">
        <a href="alumniEvent.php">EVENTS</a>
      </div>
      <div class="tile" onclick="location.href='#';">
        <a href="alumniJob.php">JOB BOARD</a>
      </div>
      <div class="tile" onclick="location.href='#';">
        <a href="alumniCourses.php">COURSES</a>
      </div>
      <div class="tile" onclick="location.href='#';">
        <a href="alumniForums.php">Forums</a>
      </div>
    </div>
    
  

    <script>
      
      const tiles = document.querySelectorAll('.tile');
      tiles.forEach(tile => {
        tile.addEventListener('click', () => {
          const link = tile.querySelector('a').href;
          location.href = link;
        });
      });
    </script>
  </body>
</html>
