<?php
require_once 'config.php';

$sttype=0;
if (isset($_POST["un"]) && isset($_POST["ps"])) {
	$sttype=1;
	if ($_POST["un"] == VIEWER_USERNAME && $_POST["ps"] == VIEWER_PASSWORD) {
		$sttype=2;
	}
} else {
	$sttype=3;
}
if ($sttype!=2) {
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
	<title>Please login</title>
	<link rel="stylesheet" href="css/tinystyles.css" />
</head>
<body>
<div class="statusbarpadd">&nbsp;</div>
<h1>Please login<sup class="red"><?php  if ($sttype == 1) {echo "Incorrect";} ?></sup></h1>
<form method="post" action="login.php" class="login">
<input type="text" name="un" placeholder="Username" /><br />
<input type="password" name="ps" placeholder="Password" /><input type="submit" value="Login" />
</form>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
	if (window.navigator.standalone == true) {
		$(".statusbarpadd").css("display", "block");
	}
</script>
</body>
</html>
<?php
} else if ($sttype==2) {
	$shaedpass = sha1($_POST["ps"]);
	$arr = array('username' => $_POST["un"], 'password' => $shaedpass);
	setcookie("viewerlogin", json_encode($arr), time()+86400);
	header("Location: index.php");
}
?>