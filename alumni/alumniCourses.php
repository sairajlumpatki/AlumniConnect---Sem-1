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
    
    if ($result->num_rows > 0) 
    {
        echo "<html>
                <head>
                <style>
                
                
                body{

                    background-color: #2C3E50;
                }

                .card-container {
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: space-around;
                    margin: 50px auto;
                    max-width: 1000px;
                    background-color: #2C3E50;
                    background-image: linear-gradient(to bottom, #2C3E50, #34495E);
                  }
                  
                  .card {
                    background-color: #34495E;
                    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
                    padding: 20px;
                    margin: 20px;
                    max-width: 300px;
                    width: 100%;
                    transition: all 0.3s ease;
                    cursor: pointer;
                  }
                  
                  .card:hover {
                    transform: translateY(-10px);
                    box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.5);
                  }
                  
                  .card-title {
                    font-size: 24px;
                    margin: 0;
                    color: #fff;
                  }
                  
                  .card p {
                    font-size: 16px;
                    margin: 10px 0;
                    color: #eee;
                  }
                  
                  .apply-button {
                    display: inline-block;
                    background-color: #3498DB;
                    color: #fff;
                    padding: 10px 20px;
                    border-radius: 5px;
                    font-size: 16px;
                    cursor: pointer;
                    transition: all 0.3s ease;
                  }
                  
                  .apply-button:hover {
                    background-color: #2980B9;
                  }
                  
                  .navigation {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    background-color: #34495E;
                    background-image: linear-gradient(to right, #34495E, #2C3E50);
                    padding: 10px;
                    transition: all 0.3s ease;
                  }
                  
                  .navigation button {
                    padding: 10px 20px;
                    font-size: 16px;
                    border-radius: 5px;
                    border: none;
                    cursor: pointer;
                    transition: all 0.3s ease;
                  }
                  
                  .navigation button:hover {
                    opacity: 0.8;
                  }
                  
                  .logout-btn {
                    background-color: #E74C3C;
                    color: white;
                    margin-right: 10px;
                    transition: all 0.3s ease;
                  }
                  
                  .logout-btn:hover {
                    transform: scale(1.2);
                  }
                  
                  .homepage-btn {
                    background-color: #3498DB;
                    color: white;
                    transition: all 0.3s ease;
                  }
                  
                  .homepage-btn:hover {
                    transform: scale(1.2);
                  }
                  
                  
  
  
                
                
                </style>
                </head><body>";
        echo '<div class="navigation">';
        echo '<button onclick="location.href=\'logout.php\'" class="logout-btn">Logout</button>';
        echo '<button onclick="location.href = \'alumniHome.php\'" class="homepage-btn">Home</button>';
        echo '</div>';
        
        echo "<div style='text-align:center; margin: 50px 0;'>
        <h1 style='color: #fff;'>Courses</h1>
      </div><div class='card-container'>";
        while($row = $result->fetch_assoc())
        {
            echo "<div class='card'>";
            echo "<h3 class='card-title'>".$row['course_name']."</h3>";
            echo "<p>".$row['course_description']."</p>";
            echo "<p>Start Date: ".$row['course_start']."</p>";
            echo "<p>Duration: ".$row['course_duration']." months</p>";
            echo "<form action='enrollCourse.php' method='post'>";
            echo "<input type='hidden' name='course_id' value='".$row['id']."' >";
            echo "<button class='apply-button' type='submit'>Enroll</button>";
            echo "</form>";
            echo "</div>";
        }
        
        echo "</div><body></html>";
    } 
    else {
        echo "<h1>0 results</h1>";
    }
  
    $conn->close();
}
?>
