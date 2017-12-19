<?php
session_start();

echo $_SESSION["username"];
?>
<form action='createpost.php' method='POST' enctype="multipart/form-data">
	<input type='text' name='title' required>
	<input type="file" name="billede" id="billede">
	<input type='submit' value='Post'>
</form>