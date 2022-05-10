<?php
	include_once 'header.php'; 
?>

<form>
<textarea name="cpost"></textarea>
<input type=submit value="Post">
</form>

<?php

include_once ("includes/dbHandler.inc.php");

function getUID() {
	$ip = $_SERVER['REMOTE_ADDR'];
	$uid = getSingle("select uid from users where ip = '".$ip."'");
		if(!$uid) {
			logIn("insert into users(ip) values ('$ip')");
	}
	return $uid;
}

function getUsername($uid) {
	$username = getSingle("select username from users where uid = '".$uid."'");
	return $username;
}

if($_REQUEST['cpost']) {
	if (!isset($_SESSION["uid"])) {
		echo "<p>Please log in to post</p>";
	} else {
		$postContent = $_REQUEST['cpost'];
		$uid = $_SESSION["uid"];
		$date = Date("Y-m-d H:i:s");
		logIn("insert into posts (uid, post, date) values($uid, '$postContent', '$date')");
		header("location: index.php");
	} 
}

function getSingle($query) {
	$result = logIn($query);
	$row = mysqli_fetch_row($result);
	return $row[0];
}

if($_REQUEST['follow']) {
	$follow = $_REQUEST['follow'];
	$uid = getUID();
	logIn("insert ignore into follows(uid, follower) values ($uid, $follow)");
}

?> 
<h2>Recent Posts</h2>
<?php

$result = logIn("select * from posts order by date desc");
print "<table border=0>";
while ($row = mysqli_fetch_assoc($result)) {
	$uid = $row['uid'];
	$username = getUsername($uid);
	$postContent = htmlspecialchars($row['post']);
	$date = $row['date'];

	$follow = <<<EOF
	<a href=index.php?follow=$uid>Follow</a>
	EOF;
	print <<<EOF
	<tr><td><b>$username</td></b>
	<td>$postContent</td><td>$date</td><td>$follow</td></tr>
	EOF;

}
print "</table>";

if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
                print_r($row);
        }
} else {
        echo "0 results";
}
//$conn->close();
?>

</body>
</html>

