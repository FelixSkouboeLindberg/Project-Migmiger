<?php 
    session_start();
    include 'connect_mysql.php';
	if(isset($_SESSION["username"] )){	
		$title = $_POST['title'];
		$target_dir = "uploads/";
		$target_file = basename($_FILES["billede"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["billede"]["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}
		}
		// Check if file already exists
		if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}
		// Check file size
		if ($_FILES["billede"]["size"] > 500000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}

		$temp = explode(".", $_FILES["billede"]["name"]);

		$newfilename = round(microtime(true)) . '.' . end($temp);

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["billede"]["tmp_name"], "uploads/" . $newfilename)) {
				echo "The file ". basename( $_FILES["billede"]["name"]). " has been uploaded.";
				$UN = $_SESSION["username"];
				$sql = "SELECT * FROM `users` WHERE `id` = '$UN'";
	 
				$result2 = mysqli_query($conn, $sql) or die(mysqli_error($conn));
				$count2 = mysqli_num_rows($result2);
				//3.1.2 If the posted values are equal to the database values, then session will be created for the user.
				if ($count2 == 1){
					$_SESSION["id"] = $
				}
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}
	}
?>