<?php 
session_start();
include 'connect_mysql.php';
if(isset($_SESSION["username"] ))
{
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
			if (move_uploaded_file($_FILES["billede"]["tmp_name"], "ProfilePics/" . $newfilename)) {
				echo "The file ". basename( $_FILES["billede"]["name"]). " has been uploaded.";
				$UN = $_SESSION["username"];
				if ($stmt = $conn->prepare("SELECT id FROM brugere WHERE (username=?)"))
				{
					$stmt->bind_param("s", $UN);
					$stmt->execute();
					$stmt->bind_result($_SESSION['id']);
					$stmt->fetch();
					$stmt->close();
					
					$id = $_SESSION['id'];
					
					$sql = "UPDATE brugere SET profilepic='$newfilename' WHERE id='$id'";
					if ($conn->query($sql) === TRUE) {
						echo "Succses";
					} else {
						echo "Error: " . $sql . "<br>" . $conn->error;
					}
					//header("Location: profile.php");
				}
				else{
					echo "Could not prepare sql statement";
				}
				
				
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}
	}
?>
}