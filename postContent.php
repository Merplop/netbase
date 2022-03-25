<html>
<body>

<?php 
	$title = $_POST["title"];
	$content = $_POST["content"];

	include_once ("logIn.php");

	$sql = "INSERT INTO Posts (id, userID, title, postContent, createdDate) VALUES (0, 0, '" . $title . "', '" . $content . "', '2022-03-03 00:00:00')";
	$result = logIn($sql);

?>
</body>
</html>
