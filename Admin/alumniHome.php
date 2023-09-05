<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: index.html");
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Alumni Management System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <style>
    /* Style for the background image */
    body {
      background: linear-gradient(rgba(0, 0, 0, 0.30), rgba(0, 0, 0, 0.30)), url(alumniImg2.jpg) no-repeat;
      background-size: cover;
      background-position: center;
      
    }

    #profile{
      background-image: url('profile.png');
      background-size: cover;
      background-position: center;
    }

    #job{
      background-image: url('job.png');
      background-size: cover;
      background-position: center;
    }


    #courses{
      background-image: url('course.png');
      background-size: cover;
      background-position: center;
    }


    
    #event{
      background-image: url('events.png');
      background-size: cover;
      background-position: center;
    }


     
    #forum{
      background-image: url('forum.png');
      background-size: cover;
      background-position: center;
    }


    /* Style for the top bar */
    .top-bar {
      background-color: #333;
      color: #fff;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px;
    }

    .welcome-message {
      font-size: 1.2rem;
      margin-right: 20px;
    }

    .logout-button {
      background-color: #fff;
      color: #333;
      border: none;
      padding: 8px 16px;
      cursor: pointer;
      font-size: 1.1rem;
      border-radius: 5px;
      transition: all 0.3s ease-in-out;
    }

    .logout-button:hover {
      background-color: skyblue;
      color: red;
    }

    /* Media query for smaller screens */
    @media (max-width: 768px) {
      .top-bar {
        flex-direction: column;
        padding: 10px 0;
      }

      .welcome-message {
        margin-right: 0;
        margin-bottom: 10px;
      }
    }

    /* Style for the tiles container */
    .tiles-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
      margin-top: 50px;
    }

    /* Style for the tiles */
    .tile {
      width: 200px;
      height: 200px;
      border-radius: 5px;
      overflow: hidden;
      margin: 20px;
      box-shadow: 9px 13px 13px 3px rgba(0,0,0,0.75);
-webkit-box-shadow: 9px 13px 13px 3px rgba(0,0,0,0.75);
-moz-box-shadow: 9px 13px 13px 3px rgba(0,0,0,0.75);
      background: linear-gradient(to bottom, #00c6fb, #005bea);
    }

    .tile img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .tile:hover {
      transform: scale(1.05);

      box-shadow: 10px 10px 5px 0px rgba(230,5,5,0.75);
-webkit-box-shadow: 10px 10px 5px 0px rgba(230,5,5,0.75);
-moz-box-shadow: 10px 10px 5px 0px rgba(230,5,5,0.75);
    }

    .tile-text {
      margin: 10px 0;
      text-align: center;
      font-size: 1.2rem;
      font-weight: bold;
      color: solid black;
      text-shadow: 1px 1px #000;
    }

    .alumni-connect {
      font-size: 3rem;
      text-align: center;
      margin-top: 30px;
      text-shadow: 2px 2px #000;
      color: Red;
    }
  </style>
</head>

<body>

  <div class="top-bar">
    <span class="welcome-message">Welcome, <?php echo $_SESSION['username']; ?>!</span>
    <form action="logout.php" method="post">
      <button type="submit" class="logout-button">Logout</button>
    </form>
  </div>


  
  <h1 class="alumni-connect">Alumni Connect</h1>
  <div class="tiles-container">
    <div class="tile" id="profile"  onclick="window.location.href='alumniDetails.php'">
      
    </div>
    
    <div class="tile" id="job"  onclick="window.location.href='alumniJob.php'">
    
    </div>
    <div class="tile" id="event"  onclick="window.location.href='alumniEvent.php'">
     
    </div>
    <div class="tile" id="forum"  onclick="window.location.href='alumniForums.php'">
      
    </div>
    <div class="tile" id="courses"   onclick="window.location.href='alumniCourses.php'">
      
    </div>
  </div>


</body>

</html>