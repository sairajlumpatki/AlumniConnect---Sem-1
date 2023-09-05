<?php 
  session_start();
  if (!isset($_SESSION['username'])) {  
    header("Location: index.html");
 }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Alumni Connect</title>
	<style>
		body {
			font-family: Arial, Helvetica, sans-serif;
			background: linear-gradient(to bottom, blue, skyblue);
			margin: 0;
			padding: 0;
		}
		h1 {
			margin-top: 30px;
			margin-bottom: 10px;
			color: #483D8B;
		}
		h3 {
			margin-top: 0;
			margin-bottom: 5px;
			color: #8B008B;
		}
		p {
			margin-top: 0;
			margin-bottom: 20px;
			color: #483D8B;
		}
		.forum {
			margin: 20px;
			padding: 20px;
			background-color: #FFFFFF;
			border-radius: 10px;
			box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.3);
		}
		.comments {
			margin-top: 20px;
			margin-bottom: 0;
			padding-left: 20px;
			color: #696969;
            list-style: none;
		}
		.comment {
			margin-top: 10px;
			margin-bottom: 10px;
			padding: 10px;
			background-color: #F5F5F5;
			border-radius: 5px;
			box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.3);
		}
		.comment p {
			margin-top: 5px;
			margin-bottom: 0;
			color: #696969;
		}
		.comment h4 {
			margin-top: 0;
			margin-bottom: 5px;
			color: #8B008B;
		}
		.comment h5 {
			margin-top: 0;
			margin-bottom: 5px;
			color: #483D8B;
		}
		form {
			margin-top: 20px;
		}
		textarea {
			display: block;
			width: 100%;
			padding: 10px;
			margin-bottom: 10px;
			border-radius: 5px;
			border: none;
			box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.3);
			resize: vertical;
			min-height: 100px;
		}
		button {
			display: block;
			background-color: #8B008B;
			color: #FFFFFF;
			padding: 10px;
			border-radius: 5px;
			border: none;
			cursor: pointer;
			box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.3);
		}
		button:hover {
			background-color: #483D8B;
		}

        button.logout{
			display: inline-block;
			padding: 10px 20px;
			background-color:  #8B008B;;
			color: #fff;
			border-radius: 5px;
			border: none;
			cursor: pointer;
			transition: all 0.3s ease;
			float: right;
			margin-left: 20px;
		}

		button.logout:hover {
			background-color: #696969;
		}

		button.home{
			display: inline-block;
			padding: 10px 20px;
			background-color:  #8B008B;;
            color: #fff;
			border-radius: 5px;
			border: none;
			cursor: pointer;
			transition: all 0.3s ease;
			float: right;
			margin-left: 20px;
		}

		button.home:hover {
			background-color: #696969;
		}

        button.addForum{
			display: inline-block;
			padding: 10px 20px;
			background-color:  #8B008B;;
            color: #fff;
			border-radius: 5px;
			border: none;
			cursor: pointer;
			transition: all 0.3s ease;
			float: right;
			margin-left: 20px;
		}

		button.addForum:hover {
			background-color: #696969;
		}

        .commentBox{
            border: 2px solid black;
            border-radius: 3px;
            margin: 3px;
        }
	</style>
</head>
<body>


<?php
// Connect to database
$hostName = 'localhost';
$userName = 'root';
$password = '';
$db = 'alumniconnect';

$conn = new mysqli($hostName, $userName, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Fetch all forums from "forums" table
$sql = "SELECT * FROM forums";
$result = mysqli_query($conn, $sql);



if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo '<div class="forum">';
        echo '<h1>' . $row["forum_title"] . '</h1>';
        echo '<h3>Author: ' . $row["author"] . '</h3>';
        echo '<h3>Created On: ' . $row["date_of_creation"] . '</h3>';
        echo '<p><h4>' . $row["forum_description"] . '</h4></p>';

        // Fetch all comments for this forum
        $forum_id = $row["forum_ID"];
        $sql_comments = "SELECT * FROM `forum_comments` WHERE `forum_ID` = '".$forum_id."'";
        $result_comments = mysqli_query($conn, $sql_comments);
        
        if (mysqli_num_rows($result_comments) > 0) {
            echo '<ul class="comments">';
            while($row_comment = mysqli_fetch_assoc($result_comments)) {
                
                echo '<div class="commentBox"><li>' . $row_comment["comment_text"] . '</li>';
                echo '<li>By: ' . $row_comment["author"] . ' on ' . $row_comment["comment_date"] . '</li></div>';
            }
            echo '</ul>';
        }

        // Add comment form for alumni to add comments
        echo '<form method="post" action="addComment.php">';
        echo '<input type="hidden" name="forum_id" value="' . $row["forum_ID"] . '">';
        echo '<textarea name="comment" placeholder="Add your comment" required></textarea>';
        echo '<button type="submit">Add Comment</button>';
        echo '</form>';
        echo '</div>';
    }
} else {
    echo "No forums found";
}


// Close database connection
mysqli_close($conn);
?>

<div class="footer">
<button onclick=location.href="logout.php" class="logout">Logout</button>
<button onclick=location.href="alumniHome.php" class="home">Home</button>
<button onclick=location.href="createForum.php" class="home">Create Forum</button>
</div>
