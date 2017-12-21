<html>
	<head>
		<title>GemmeGag</title>
		<link rel="stylesheet" type="text/css" href="stylesheet.css">
	</head>
	<body>
		<div class="header">
			<div class="logo">
				<p>GemmeGag</p>
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
		</div>
		
		<div class="divider"></div>
		
		<div class="navbar">
			<ul>
				<li><a href="index.php">Frontpage</a></li>
				<li><a href="createpostpage.php">Create post</a></li>
			</ul>
		</div>
		
		<div class="loginform">
			<form action="login.php" method="POST">
				Username: 
				<br>
				<input type="text" name="username" required>
				<input type="password" name="password" required>
				<input type="submit" value="Login">
				<?php 
				if(isset($_SESSION["trylogin"])) 
				{
					echo "wrong login";
				}
				?>
			</form>
		</div>
	</body>
</html>