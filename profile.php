<?php
session_start();
unset($_SESSION["postid"]);
require('connect_mysql.php');
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
				<li><a href="createpostpage.php">Create post</a></li>
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
			<?php
			$error = false;
			if($stmt = $conn->prepare("SELECT username, profilepic FROM brugere WHERE id=? LIMIT 1"))
			{
				$stmt->bind_param("s", $_SESSION['id']);
				$stmt->execute();
				$stmt->bind_result($username, $billede);
				$stmt->fetch();
				$stmt->close();
				
			} else {
				echo "Could not prepare sql statement";
				$error = TRUE;
			}
			
			if($error == false)
			{ 
				$post = '<ul class="profiles">';
				$post .= <<<EOT
				<div class="profile">
					<li class="profileContainer">
					<div class='username'><h1>{$username}</h1></div>
					<div class="profilepic"><img src="ProfilePics/{$billede}"></div>
					<form action='updatepic.php' method='POST' enctype="multipart/form-data">
						<input type="file" name="billede" id="billede">
						<input type='submit' value='Update'>
					</form>
				</div>
				</li>
EOT;
				$post .= '</ul>';
				echo $post;
			}
			?>
		</div>
		
	</body>
</html>