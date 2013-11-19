<?php
require_once 'config.php';
include 'checklogin.php';

include "connect.php";

$mysql_table = MYSQL_TABLE;
$qry="SELECT * FROM `$mysql_table` ORDER BY  `$mysql_table`.`id` ASC LIMIT ".mysql_escape_string($_GET["lastid"])." , 1000";
$result=mysql_query($qry);
$newlastid=$_GET["lastid"];
$jspo=array();
while ($row = mysql_fetch_array($result)) {
$newlastid=$newlastid+1;
array_push($jspo, array("txt"=>stripslashes($row["txt"]), "tim"=>$row["tim"], "id"=>$row["id"]));
}
echo json_encode(array("posts"=>$jspo, "lastid"=>$newlastid));

mysql_close($link);
?>