<?php
session_start();
include("connect_mysql.php");


if(isset($_SESSION['username']))
{
	$postid = $_POST["id"];
	sql = "SELECT vote FROM votes WHERE post_id = 
	
	if(isset($_POST["1"]))
	{	
		
		
		if($stmt = $conn->prepare("SELECT votes FROM posts WHERE id=?"))
		{
			$stmt->bind_param("i", $postid);
			$stmt->execute();
			$stmt->bind_result($votes);
			$stmt->fetch();
			$stmt->close();
			
			$votes = $votes + 1;
			
			if($stmt = $conn->prepare("UPDATE posts SET votes=? WHERE id=?"))
			{
				$stmt->bind_param("ii", $votes, $postid);
				$stmt->execute();
				$stmt->close();
				
				header("Location: index.php");
			} else {
				echo "Could not prepare sql statement 2";
			}
			
		} else {
			echo "Could not prepare sql statement 1";
		}
	}
	elseif(isset($_POST["0"]))
	{
		$id = $_POST["id"];
		if($stmt = $conn->prepare("SELECT votes FROM posts WHERE id=?"))
		{
			$stmt->bind_param("i", $id);
			$stmt->execute();
			$stmt->bind_result($votes);
			$stmt->fetch();
			$stmt->close();
			
			$votes = $votes - 1;
			
			if($stmt = $conn->prepare("UPDATE posts SET votes=? WHERE id=?"))
			{
				$stmt->bind_param("ii", $votes, $id);
				$stmt->execute();
				$stmt->close();
				
				header("Location: index.php");
				
			} else {
				echo "Could not prepare sql statement 4";
			}
			
		} else {
			echo "Could not prepare sql statement 3";
		}
	}
}
?>


$sql = "SELECT * FROM users WHERE `userName`= '$userN'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            if($row["userName"] == $userN && $row["password"] == $pass) 