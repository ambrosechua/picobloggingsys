<?php
$link = mysqli_connect(MYSQL_HOST, MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);
if(!$db) {
	die("Unable to select database. ");
}
?>
