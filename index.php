<?php
	include_once 'header.php'; 
?>

<form>
<textarea name="cpost"></textarea>
<input type=submit value="Post">
</form>

<?php

include_once ("includes/dbHandler.inc.php");

function getUsername($uid) {
	$username = getSingle("select username from users where uid = '".$uid."'");
	return $username;
}

if(isset($_REQUEST['cpost']) and $_REQUEST['cpost']) {
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

if(isset($_REQUEST['follow']) and $_REQUEST['follow']) {
	if (isset($_SESSION["uid"])) {
		$follow = $_REQUEST['follow'];
		$uid = $_SESSION["uid"];
		logIn("insert ignore into follows(uid, follower) values ($uid, $follow)");
	} else {
		echo "<p>Please log in to follow</p>";
	}
}

?> 
<h2>Recent Posts</h2>
<?php

$result = logIn("select * from posts order by date desc");
while ($row = mysqli_fetch_assoc($result)) {
	$uid = $row['uid'];
	$username = getUsername($uid);
	$postContent = htmlspecialchars($row['post']);
	$date = $row['date'];

	if (isset($_SESSION["uid"])) {
		$currentUID = $_SESSION["uid"];
		if (getSingle("select follower from follows where uid=$uid and follower=$currentUID")) {
			$follow = <<<EOF
			<a href=index.php?follow=$uid>Follow</a>
			EOF;
		} else {
			$follow = "Followed.";
		}
	} else {
		$follow = "";
	}

	print <<<EOF
	<h4>$username</h4>
	<p>$postContent</p><br><p>$follow</td></tr><p><i><font size="-2">$date</font></i></p><br>
	EOF;

}

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

