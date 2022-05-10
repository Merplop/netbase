<?php 
	session_start();
?>

<html>
<head>
	
<link rel="stylesheet" href="style.css">

<ul>
	<li><a class="active" href="index.php">Home</a></li>
	<?php 
		if (isset($_SESSION["uid"])) {
			echo "<li><a href='myProfile.php'>My Profile</a></li>";
			echo "<li><a href='logout.php'>Log Out</a></li>";
		} else {
			echo "<li><a href='userLogIn.php'>Log In</a></li>";
			echo "<li><a href='userRegister.php'>Register</a></li>";
		}
	?>
</ul>

<h1>Netbase</h1>

<?php 
	if (isset($_SESSION["uid"])) {
		echo "You are signed in as: " . $_SESSION["username"];
	}
?>
</head>

<body>

<div class="wrapper">
