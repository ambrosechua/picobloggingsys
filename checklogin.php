<?php
$obj = json_decode(stripslashes(($_COOKIE["viewerlogin"])), true);
$shaedpass = sha1(VIEWER_PASSWORD);
if (
	($obj["username"] == VIEWER_USERNAME && $obj["password"] == $shaedpass)
	 || !USE_VIEWER
	) {
	
}
else {
	header("Location: login.php");
	exit();
}
?>