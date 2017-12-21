<?php 
    session_start();
    include 'connect_mysql.php';
    $msg = $_POST['msgtxt'];
	$postid = $_POST['postID'];
	

    $ID = $_SESSION['id']; 
    

    $sql = "SELECT * FROM `brugere` WHERE `id` = '$ID'";
    $result=mysqli_query($conn,$sql);
    
    if($result) {
        $sql = "INSERT INTO comments (comment, post_id, bruger_id) VALUES ('$msg', '$postid', '$ID')";
        if ($conn->query($sql) === TRUE) {
            echo "Post was successfully created";
            header( "Location: showpost.php" );
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo $mysqli_error;
    }

?>