<?php
$db = mysqli_connect(MYSQL_HOST, MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);
if(!$db) {
	die("Unable to connect to database. ");
}
?>
