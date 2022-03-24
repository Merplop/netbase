<html>
<body>

<?php 

	$servername = "localhost";
	$username = 'netuser';
	$password = 'darthgamer';
	$dbname = 'netbase';

	$title = $_POST["title"];
	$content = $_POST["content"];

	echo $title;
	echo $content;

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		echo "Connection refused";
		die("Connection refused" . $conn->connect_error);
	}

	$sql = "INSERT INTO Posts (id, userID, title, postContent, createdDate) VALUES (0, 0, '" . $title . "', '" . $content . "', '2022-03-03 00:00:00')";
	echo $sql;
	$result = $conn->query($sql);
?>
</body>
</html>
