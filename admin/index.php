<?php
require_once '../config.php';
include 'checkadminlogin.php';
include '../plugins/parsedown/Parsedown.php';

$allok = 2;

$txt=$_POST["txt"];
$tim=$_POST["tim"];

$txt = preg_replace("#((http|https|ftp)://(\S*?\.\S*?))(\s|\;|\)|\]|\[|\{|\}|,|\"|'|:|\<|$|\.\s)#ie", "'<a href=\"$1\" target=\"_blank\">http://$3</a>$4'", $txt);

$txt = Parsedown::instance()->parse($txt);

if (isset($_FILES["file"])) {
$allok = 0;

$uploadLocation = "../" . UPLOAD_LOCATION . "";
$config['max_size'] = "100000000";

$target_path = $uploadLocation;
$extrl = " ";
$seperator = "-";
// $rndno=rand();
$rndno = substr(md5_file($_FILES['file']['tmp_name']), 0, 7);
if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path.$rndno.$seperator.$_FILES["file"]["name"])) { //.$_FILES["file"]["name"]
$fileurl = UPLOAD_LOCATION.$rndno.$seperator.$_FILES['file']['name'];
$filephp = "image.php?url=".$rndno.$seperator.$_FILES['file']['name'];
$extrl = '<br /><br /><a href="'.$fileurl.'" target="_blank"><img class="pim" src="'.$filephp.'" /></a>';
}
else{
die("File upload error");
}

}

if (isset($_POST["txt"]) && isset($_POST["tim"])) {

include "../connect.php";

$mysql_table = MYSQL_TABLE;
$qry = "INSERT INTO `$mysql_table` (`id`, `txt`, `tim`) VALUES (NULL, '".mysqli_real_escape_string(nl2br($txt.$extrl))."', '".mysqli_real_escape_string($tim)."')";
$result = mysqli_query($db, $qry);

if (!$result) {
    die("Error! ".mysqli_error($db));
} else {
	$allok = 1;
}
mysqli_close($db);

}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
	<title>Create post</title>
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
<link rel="icon" type="image/png" href="http://ambc.net16.net/images/icon.png" />
<link rel="apple-touch-icon-precomposed" href="http://ambc.net16.net/images/iconH.png" />
	<link rel="stylesheet" href="../css/tinystyles.css" />
</head>
<body>
<div class="statusbarpadd">&nbsp;</div>
<h1>Create post<?php
if ($allok == 2) {
echo '';
}
else if ($allok == 1) {
echo ' <span class="red">Sent</span>';
}
else {
echo ' <span class="red">Error</span>';
}
?></h1>
<form id="pform" method="post" enctype="multipart/form-data" action="index.php" onSubmit="clearInterval(inter); ">
<input type="file" value="Attach Photo" name="file" id="file" />
<textarea name="txt" placeholder="Post"></textarea><br />
<input type="text" name="tim" placeholder="12:12:12 PM - 12/12/12" value="12:12:12 PM - 12/12/12" id="time" />
<input type="submit" value="Post! " />
</form>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
inter=setInterval(function() {
h=new Date().getHours();
m=new Date().getMinutes();
s=new Date().getSeconds();
da=new Date().getDate();
mo=new Date().getMonth()+1;
ye=new Date().getFullYear();
if (mo==1) {
	mon="January";
}
else if (mo==2) {
	mon="Febuary";
}
else if (mo==3) {
	mon="March";
}
else if (mo==4) {
	mon="April";
}
else if (mo==5) {
	mon="May";
}
else if (mo==6) {
	mon="June";
}
else if (mo==7) {
	mon="July";
}
else if (mo==8) {
	mon="August";
}
else if (mo==9) {
	mon="September";
}
else if (mo==10) {
	mon="October";
}
else if (mo==11) {
	mon="November";
}
else if (mo==12) {
	mon="December";
}
pa="AM";
hn=h;
if (h>12) {
pa="PM";
hn=h-12;
}
document.getElementById("time").value=hn+":"+m+":"+s+" "+pa+" - "+da+" "+mon+" "+ye;
}, 100);
$("#pform").submit(function() {
	$("#pform").append("<div class='loading'>&nbsp;</div>");
});
	if (window.navigator.standalone == true) {
		$(".statusbarpadd").css("display", "block");
	}
	if (window.screen.height==568) { // iPhone 4"
		document.querySelector("meta[name=viewport]").content="width=320.1, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0";
	}
</script>
</body>
</html>
