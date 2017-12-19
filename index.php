<?php
session_start();
require('connect_mysql.php');
?>
<html>
	<head>
		<title>GemmeGag</title>
		<link rel="stylesheet" type="text/css" href="stylesheet.css">
	</head>
	<body>
		<div class="header">
			<p>GemmeGag</p>
		</div>
		<div class="navbar">
			<ul>
				<li><a class="active" href="index.php">Frontpage</a></li>
			</ul>
		</div>
		<div class="loginspot">
			<?php
			if(isset($_SESSION['username']))
			{
				$username = $_SESSION['username'];
				echo "Welcome " .$username. "<br> <a href='logout.php'>Logout?</a>";
			} else {
				echo "<a href='loginpage.php'>Login</a><br>Dont have an account? <a href='registerpage.php'>Signup</a>";
			}
			?>
		</div>
	</body>
</html>