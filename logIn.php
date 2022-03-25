<?php 
	function logIn($sql) {
		$servername = "localhost";
		$username = 'netuser';
		$password = 'darthgamer';
		$dbname = 'netbase';

		$conn = new mysqli($servername, $username, $password, $dbname);

		if ($conn->connect_error) {
			echo "Connection refused";
			die("Connection refused" . $conn->connect_error);
		}
		$result = $conn->query($sql);
		return $result;
	}
?>
