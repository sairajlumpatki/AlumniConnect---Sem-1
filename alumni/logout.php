<!DOCTYPE html>
<html>
<head>
	<title>Logout</title>
	<style>
		body {
			background-color: #f0f0f0;
			font-family: Arial, sans-serif;
			text-align: center;
			padding: 50px;
		}
		h1 {
			color: #444;
			margin-bottom: 20px;
		}
		h2 {
			color: #777;
			margin-top: 0;
		}
		a {
			color: #333;
			text-decoration: none;
		}
		a:hover {
			text-decoration: underline;
		}
	</style>
</head>
<body>
	<?php
		session_start();
  		session_destroy();
	?>
	<h1>YOU HAVE BEEN LOGGED OUT</h1>
	<h2><a href="http://localhost/alumniconnect/">Back to login</a></h2>
</body>
</html>
