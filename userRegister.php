<?php 
	include_once 'header.php';
?>


<section class="signup-form">
	<h3>Register</h3>
	<form action="includes/signUp.inc.php" method="post"><br>
		<input type="text" name="name" placeholder="Full Name:"><br>
		<input type="text" name="email" placeholder="Email:"><br>
		<input type="text" name="uid" placeholder="Username:"><br>
		<input type="password" name="pwd" placeholder="Password:"><br>
		<input type="password" name="pwdConf" placeholder="Confirm Password:"><br>
		<button type="submit" name="submit">Register</button>
	</form>
	<?php

if (isset($_GET["error"])) {
	if ($_GET["error"] == "emptyinput") {
		echo "<p>Field empty</p>";
	} else if ($_GET["error"] == "invaliduid") {
		echo "<p>Invalid username</p>";
	} else if ($_GET["error"] == "invalidemail") {
		echo "<p>Invalid email</p>";
	} else if ($_GET["error"] == "pwdnotmatch") {
		echo "<p>Passwords don't match</p>";
	} else if ($_GET["error"] == "uidexists") {
		echo "<p>Username already taken</p>";
	} else if ($_GET["error"] == "none") {
		echo "<p>Sign up successful</p>";
	}
}

?>
</section>

</body>
</html>
