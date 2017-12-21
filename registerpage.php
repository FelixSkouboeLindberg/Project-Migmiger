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
				<li><a class="active" href="createpostpage.php">Create post</a></li>
			</ul>
		</div>
		
		<div class="content">
			<div class="signupform">
				<form action="register.php" method="POST">
					Username: <input type="text" name="username" required> <br>
					Password: <input type="password" name="password" required> <br>
					Confirm Password: <input type="password" name="password2" required> <br>
					<input type="submit" value="Register">
				</form>
			</div>
		</div>
	</body>
</html>





