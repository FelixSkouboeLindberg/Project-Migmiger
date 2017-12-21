<?php
session_start();
unset($_SESSION["postid"]);
unset($_SESSION["username"]);
unset($_SESSION['id']);
header('Location: index.php');
?>