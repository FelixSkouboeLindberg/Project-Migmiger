<?php
session_start();
require('connect_mysql.php');
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="stylesheet.css">
	</head>
	<body>
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
				echo "<a href='login.php'>Login</a>";
			}
			?>
		</div>
	</body>
</html>