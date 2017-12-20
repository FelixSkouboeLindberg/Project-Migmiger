<?php
if(isset($_POST["1"]))
{	
	$id = $_POST["id"];
	if($stmt = $conn->prepare("SELECT votes FROM posts WHERE id=?"))
	{
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$stmt->bind_result($votes);
		$stmt->fetch();
		$stmt->close();
		
		$votes = $votes + 1;
		
		if($stmt = $conn->prepare("UPDATE posts SET votes=? WHERE id=?"))
		{
			$stmt->bind_param("i", $id);
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
?>