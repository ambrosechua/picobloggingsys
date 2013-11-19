<?php
$obj = json_decode(stripslashes(($_COOKIE["adminlogin"])), true);
$shaedpass = sha1(ADMIN_PASSWORD);
if ($obj["username"] == ADMIN_USERNAME && $obj["password"] == $shaedpass) {
	
}
else {
	header("Location: login.php");
	exit();
}
?>