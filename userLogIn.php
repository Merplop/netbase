<?php 
	include_once 'header.php';
?>


<section class="login-form">
	<h3>Log In</h3>
	<form action="includes/logIn.inc.php" method="post"><br>
		<input type="text" name="uid" placeholder="Username/Email:"><br>
		<input type="password" name="pwd" placeholder="Password:"><br>
		<button type="submit" name="submit">Log In</button>
	</form>
	<?php

if (isset($_GET["error"])) {
	if ($_GET["error"] == "emptyinput") {
		echo "<p>Field empty</p>";
	}
}

?>

</section>

</body>
</html>
