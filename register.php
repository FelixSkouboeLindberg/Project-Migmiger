<?php
	session_start();
	unset($_SESSION["postid"]);
    include "connect_mysql.php";
    $userN = $_POST["username"];
    $pass = $_POST["password"];
    $pass2 = $_POST["password2"];

    $sql = "SELECT * FROM brugere WHERE `username`= '$userN'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        echo "The username does already exist";
    } else {
        if($pass == $pass2) 
        {
            $sql = "INSERT INTO brugere (username, password)
            VALUES ('$userN', '$pass')";
            
            if ($conn->query($sql) === TRUE) {
                echo "User is successfully created";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "The 2 passwords dosen't match";
        }
        
    }
    
    mysqli_close($conn);
?>