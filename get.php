<?php
require_once 'config.php';
include 'checklogin.php';

include "connect.php";

$mysql_table = MYSQL_TABLE;
$qry="SELECT * FROM `$mysql_table` WHERE `id`>".mysqli_real_escape_string($db, $_GET["lastid"])." ORDER BY `$mysql_table`.`id`";
$result=mysqli_query($db, $qry);
$newlastid=$_GET["lastid"];
$jspo=array();
while ($row = mysqli_fetch_array($result)) {
$newlastid=$newlastid+1;
array_push($jspo, array("txt"=>stripslashes($row["txt"]), "tim"=>$row["tim"], "id"=>$row["id"]));
}
echo json_encode(array("posts"=>$jspo, "lastid"=>$newlastid));

mysqli_close($db);
?>
