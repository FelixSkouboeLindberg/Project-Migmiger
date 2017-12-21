<?php  //Start the Session
session_start();
unset($_SESSION["postid"]);
require('connect_mysql.php');

if (isset($_POST['username']) and isset($_POST['password'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	//3.1.2 Checking the values are existing in the database or not
	if ($stmt = $conn->prepare("SELECT id, username FROM brugere WHERE username=? AND password=?"))
	{
		$stmt->bind_param("ss", $username, $password);
		$stmt->execute();
		$stmt->bind_result($_SESSION['id'], $_SESSION['username']);
		$stmt->fetch();
		$stmt->close();
	} else {
		echo "Could not prepare sql statement";
	}
}
//3.1.4 if the user is logged in Greets the user with message
header('Location: index.php');
?>