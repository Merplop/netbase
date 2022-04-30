<?php

if (isset($_POST["submit"])) {
	
	$name = $_POST["name"];
	$email = $_POST["email"];
	$uid = $_POST["uid"];
	$pwd = $_POST["pwd"];
	$pwdConf = $_POST["pwdConf"]

	require_once 'dbHandler.inc.php';
	require_once 'functions.inc.php';

	if (emptyInputSignup($name, $email, $uid, $pwd, $pwdConf) !== false) {
		header("location: ../userRegister.php?error=emptyinput");
		exit();
	}
	if (invalidUid($uid) !== false) {
		header("location: ../userRegister.php?error=invaliduid");
		exit();
	}
	if (invalidEmail($email) !== false) {
		header("location: ../userRegister.php?error=invalidemail");
		exit();
	}
	if (pwdNotMatch($pwd, $pwdConf) !== false) {
		header("location: ../userRegister.php?error=pwdnotmatch");
		exit();
	}
	if(uidExists($conn, $username) !== false) {
		header("location: ../userRegister.php?error=uidexists");
		exit();
	}

	createUser($conn, $name, $email, $uid, $pwd);

} else {
	header("location: ../userRegister.php");
	exit();
}
