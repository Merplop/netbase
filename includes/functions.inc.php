<?php

function emptyInputSignup($name, $email, $uid, $pwd, $pwdConf) {
	$result;
	if (empty($name) || empty($email) || empty($uid) || empty($pwd) || empty($pwdConf)) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

function invalidUid($uid) {
	$result;
	if (!preg_match("/^[a-zA-Z0-9]*$/", $uid)) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

function invalidEmail($email) {
	$result;
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

function pwdNotMatch($pwd, $pwdConf) {
	$result;
	if ($pwd !== $pwdConf) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

function uidExists($conn, $uid, $email) {
	$sql = "select * from users where username = ? or email = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../signup.php?error=stmtfailed");
		exit();
	}
	mysqli_stmt_bind_param($stmt, "ss", $uid, $email);
	mysqli_stmt_execute($stmt);
	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	} else {
		$result = false;
		return $result;
	}

	mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $email, $uid, $pwd) {
	$ip = $_SERVER['REMOTE_ADDR'];
	$sql = "insert into users (username, passwd, email, name) values (?, ?, ?, ?);";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../signup.php?error=stmtfailed");
		exit();
	}

	$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

	mysqli_stmt_bind_param($stmt, "ssss", $uid, $hashedPwd, $email, $name);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	header("location: ../userRegister.php?error=none");
	exit();
}

function emptyInputLogin($username, $pwd) {
	$result;
	if (empty($username) || empty($pwd)) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

function loginUser($conn, $username, $pwd) {
	$uidExists = uidExists($conn, $username, $username);

	if ($uidExists === false) {
		header("location: ../userLogIn.php?error=invalidlogin");
		exit();
	}

	$pwdHash = $uidExists["passwd"];
	$checkPwd = password_verify($pwd, $pwdHash);

	if($checkPwd === false) {
		header("location: ../userLogIn.php?error=invalidlogin");
		exit();
	} else if ($checkPwd === true) {
		session_start();
		$_SESSION["uid"] = $uidExists["uid"];
		$_SESSION["username"] = $uidExists["username"];
		header("location: ../index.php");
		echo "<p>Login successful</p>";
		exit();
	}
}

