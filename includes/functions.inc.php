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
	if (preg_match("/^[a-zA-Z0-9]*$/")) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

function invalidEmail($email) {
	$result;
	if (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

function pwdMatch($pwd, $pwdConf) {
	$result;
	if ($pwd !== $pwdRepeat) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

function uidExists($uid) {
	$sql = "select * from users where username = ? or email = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../signup.php?error=stmtfailed");
		exit();
	}
	mysqli_stmt_bind_param($stmt, "ss");
	mysqli_stmt_execute($stmt);
	$resultData = mysqli_stmt_get_result();

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	} else {
		$result = false;
		return $result;
	}

	mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $email, $uid, $pwd) {
	$sql = "insert into users (uid, ) values ();";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../signup.php?error=stmtfailed");
		exit();
	}
	mysqli_stmt_bind_param($stmt, "ss");
	mysqli_stmt_execute($stmt);
	$resultData = mysqli_stmt_get_result();

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	} else {
		$result = false;
		return $result;
	}

	mysqli_stmt_close($stmt);
}

