<?php

if (isset($_POST["submit"])) {
	$username = $_POST["uid"];
	$pwd = $_POST["pwd"];

	$serverName = "localhost";
	$dbUsername = "netuser";
	$dbPassword = "darthgamer";
	$dbName = "netbase";

	$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

	require_once 'dbHandler.inc.php';
	require_once 'functions.inc.php';

	if (emptyInputLogin($username, $pwd) !== false) {
		header("location: ../userLogIn.php?error=emptyInputLogin");
		exit();
	}

	loginUser($conn, $username, $pwd);

} else {
	header("location: ../userLogIn.php");
	exit();
}
