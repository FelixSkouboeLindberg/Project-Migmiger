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
			</ul>
		</div>
		
		<div class="content">
			<?php
			$error = false;
			if($stmt = $conn->prepare("SELECT title, billede, votes FROM posts WHERE id=? LIMIT 1"))
			{
				$stmt->bind_param("s", $_POST["id"]);
				$stmt->execute();
				$stmt->bind_result($title, $img, $votes);
				$stmt->fetch();
				$stmt->close();
				
			} else {
				echo "Could not prepare sql statement";
				$error = TRUE;
			}
			
			if($error == false)
			{ 
				$post = '<ul class="posts">';
				$post .= <<<EOT
				<li class="post">
					<form action="showpost.php" method="POST">
					<input type="hidden" name="id" value="{$obj->id}">
					<div class='post_title'><h2>{$obj->title}</h2></div>
					<div class="post_img"><img src="uploads/{$obj->billede}"></div>
					
					<div class="buttom_container">
						<div class="comment_button"><input type="text" value="Comments"></div>
						</form>
						<form action="vote.php" method="POST">
							<div class="VoteContainer">
								<input type="hidden" name="id" value="{$obj->id}">
								<div class="votes_upDown"><input type="submit" name="1" value=""></div>
								<div class="post_votes">{$obj->votes}</div>
								<div class="votes_upDown"><input type="submit" name="0" value=""></div>
							</div>
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