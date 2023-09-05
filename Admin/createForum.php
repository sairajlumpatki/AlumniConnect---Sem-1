<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: index.html");
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Job Portal Form</title>
  <style>
    /* Style the form container */
    body {
      background: #db3df0;

      /* Chrome 10-25, Safari 5.1-6 */
      background: -webkit-linear-gradient(to right, rgba(219, 61, 240, 0.5), rgba(84, 2, 90, 0.5));

      /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
      background: linear-gradient(to right, rgba(219, 61, 240, 0.5), rgba(84, 2, 90, 0.5))
    }

    .form-container {
      background-color: skyblue;
      max-width: 500px;
      margin: auto;
      padding: 20px;
      border: 1px solid black;
      border-radius: 5px \;
    }

    /* Style the form labels */
    label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
    }

    /* Style the form input fields */
    input[type=text],
    input[type=number],
    textarea {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      margin-bottom: 20px;
    }

    /* Style the form submit button */
    input[type=submit] {
      background-color: #4CAF50;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    /* Style the form submit button on hover */
    input[type=submit]:hover {
      background-color: #45a049;
    }
  </style>
</head>

<body>
  <div class="form-container">
    <h2>ADD FORUM</h2>
    <form action="createLogicForum.php" method="post">
      <label for="forumTitle">Forum Title:</label>
      <input type="text" id="forumTitle" name="forumTitle" required>

      <label for="forumDescription">Forum Description:</label>
      <textarea id="forumDescription" name="forumDescription" rows="5" required></textarea>

      <input type="submit" value="Submit">
      <a href="alumniForums.php">Back TO FORUMS</a>
    </form>
  </div>

</body>

</html>