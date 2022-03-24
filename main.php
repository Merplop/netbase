<body>

<h1>Netbase Home</h1>

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
                echo "id: " . $row["id"]. " - Name: " . $row["userId"]. " " . $row["postContent"]. " " . $row["createdDate"]. "<br>";
        }
} else {
        echo "0 results";
}
$conn->close();
?>

</body>
</html>

