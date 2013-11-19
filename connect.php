<?php
$link = mysql_connect(MYSQL_HOST, MYSQL_USERNAME, MYSQL_PASSWORD);
if(!$link) {
	die("Failed to connect to mysql server. ");
}
$db = mysql_select_db(MYSQL_DATABASE);
if(!$db) {
	die("Unable to select database. ");
}
?>