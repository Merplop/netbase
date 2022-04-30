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

if($_REQUEST['cpost']) {
	$postContent = $_REQUEST['cpost'];
	$ip = $_SERVER['REMOTE_ADDR'];
	$uid = getUID();
	$date = Date("Y-m-d H:i:s");
	logIn("insert into posts (uid, post, date) values($uid, '$postContent', '$date')");
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
print "<table border=1>";
while ($row = mysqli_fetch_assoc($result)) {
	$uid = $row['uid'];
	$postContent = htmlspecialchars($row['post']);
	$date = $row['date'];

	$follow = <<<EOF
	<a href=index.php?follow=$uid>Follow</a>
	EOF;
	print <<<EOF

	<tr><td>$uid</td><td>$postContent</td><td>$date</td><td>$follow</td></tr>
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

