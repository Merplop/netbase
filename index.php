<body>

<h1>Netbase Home</h1>

<form action="postContent.php" method="post">
	<label for="title">Title</label><br>
	<input type="text" id="title" name="title"><br>
	<label for="content">Post content:</label><br>
	<input type="text" id="content" name="content"><br>
	<input type="submit">
</form>

<?php
$servername = "localhost";
$username = 'netuser';
$password = 'darthgamer';
$dbname = 'netbase';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	echo "Connection refused";
	die("Connection refused" . $conn->connect_error);
}

$sql = "SELECT id, userId, title, postContent, createdDate FROM Posts;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
                echo "Title: " . $row["title"]. " - Name: " . $row["userId"]. " " . $row["postContent"]. " " . $row["createdDate"]. "<br>";
        }
} else {
        echo "0 results";
}
$conn->close();
?>

</body>
</html>

