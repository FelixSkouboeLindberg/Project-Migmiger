<html>
	<head>
		<title>LoginPage</title>
	</head>
	<body>
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
	</body>
</html>