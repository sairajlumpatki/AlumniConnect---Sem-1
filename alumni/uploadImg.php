<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="uploadImg.php" method = "post" enctype="multipart/form-data">
        UPLOAD FILE : <input type="file" name = "myImg"><br>
        <input type="submit" name = "submit">

    </form>
</body>
</html>



<?php

if(isset($_POST['myImg']) && isset($_POST['myImg']))

?>