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
			if($stmt = $conn->prepare("SELECT id, title, billede, votes FROM posts WHERE id=? LIMIT 1"))
			{
				$stmt->bind_param("s", $_POST["id"]);
				$stmt->execute();
				$stmt->bind_result($id, $title, $img, $votes);
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
				<div class='post_title'><h1>{$title}</h1></div>
				<div class="post_img"><img src="uploads/{$img}"></div>
				<div class="buttom_container">
					<div class="comment_button">Comments</div>
				</div>
				<form action="vote.php" method="POST">
						<div class="VoteContainer">
							<input type="hidden" name="id" value="{$id}">
							<div class="votes_upDown"><input type="submit" name="1" value=""></div>
							<div class="post_votes">{$votes}</div>
							<div class="votes_upDown"><input type="submit" name="0" value=""></div>
						</div>
					</form>
				</li>
EOT;
				$post .= '</ul>';
				echo $post;
			}
			?>
		</div>
		<div class="comments">
			<?php 
                if(isset($_SESSION['id'])) {
                    echo "<form action='createcomment.php' method='POST'>
						<input type='hidden' value='{$id}' name='postID'>
                        <input type='text' name='msgtxt' required>
                        <input type='submit' value='Post'>
                    </form>";
                }


                $sql = "SELECT brugere.username, comments.comment, comments.created FROM comments INNER JOIN brugere ON brugere.id=comments.bruger_id ORDER BY comments.id DESC";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo  $row["username"]. " - " . $row["comment"]. " - ". $row["created"]. "<br>";
                    }
                } else {
                    echo "0 results";
                }


            ?>
		</div>
		
	</body>
</html>