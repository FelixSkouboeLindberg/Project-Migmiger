<?php  //Start the Session
session_start();
require('connect_mysql.php');

if (isset($_POST['username']) and isset($_POST['password'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	//3.1.2 Checking the values are existing in the database or not
	$query = "SELECT * FROM `brugere` WHERE username='$username' and password='$password'";
	 
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
	$count = mysqli_num_rows($result);
	//3.1.2 If the posted values are equal to the database values, then session will be created for the user.
	if ($count == 1){
	$_SESSION['username'] = $username;
	$_SESSION['id'] = $result['id'];
	}else{
	//3.1.3 If the login credentials doesn't match, he will be shown with an error message.
	$fmsg = "Invalid Login Credentials.";
	}
}
//3.1.4 if the user is logged in Greets the user with message
header('Location: index.php');
?>