<?php 
	include_once 'header.php';
?>

<h3>Register</h3>

<form>
<label for="username">Username</label><br>
<textarea name="username"></textarea><br>
<label for="password">Password</label><br>
<textarea name="passwordPost"></textarea><br>
<input type=submit value="Register">
</form>

<?php

	if($_REQUEST['username'] and $_REQUEST['passwordPost']) {

		$username = $_REQUEST['username'];
		$password = password_hash($_REQUEST['passwordPost'], PASSWORD_DEFAULT);

		include_once ("logIn.php");

		$ip = $_SERVER['REMOTE_ADDR'];

		$sql = "insert into users (ip, username, passwd) values ($ip, '$username', $password)";

		$result = logIn($sql); 

		header("Location = localhost/index.php");
		exit();
	}

?>

</body>
</html>
