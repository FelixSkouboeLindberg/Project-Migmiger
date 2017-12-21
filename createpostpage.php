<?php
session_start();

if(!isset($_SESSION["id"]))
{
	header("Location: loginpage.php");
}
?>
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
					echo "Welcome " .$username. "";
				}
				?>
			</div>
		</div>
		
		<div class="divider"></div>
		
		<div class="navbar">
			<ul>
				<li><a href="index.php">Frontpage</a></li>
				<li><a class="active" href="createpostpage.php">Create post</a></li>
				<?php
				if(isset($_SESSION['username']))
				{
					$username = $_SESSION['username'];
					echo "<li><a href='profile.php'>Profile</a></li>";
					echo "<li><a href='logout.php'>Logout</a></li>";
				} else {
					echo "<li><a href='loginpage.php'>Login</a></li>";
				}
				?>
			</ul>
		</div>
		
		<div class="content">
			<div class="postform">
				<form action='createpost.php' method='POST' enctype="multipart/form-data">
					<input type='text' name='title' required>
					<input type="file" name="billede" id="billede">
					<input type='submit' value='Post'>
				</form>
			</div>
		</div>
	</body>
</html>