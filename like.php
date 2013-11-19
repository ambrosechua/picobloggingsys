<?php
require_once 'config.php';
include 'checklogin.php';

include "connect.php";

$stars=0;
$starred="";

$mysql_table = MYSQL_TABLE;
$qrya="SELECT * FROM `$mysql_table` WHERE `id`='".mysql_escape_string($_GET["id"])."'";
$resulta=mysql_query($qrya);
if($resulta) {
    if(mysql_num_rows($resulta) == 1) {
	    $rowa = mysql_fetch_array($resulta);
	    $stars=$rowa["pluses"];
	}
}

$stars=$stars+1;

if (isset($_GET["plusone"])) {
	$qryb="UPDATE `$mysql_table` SET `pluses`='".($stars)."' WHERE `id`='".mysql_escape_string($_GET["id"])."'";
	$resultb=mysql_query($qryb);
	if($resultb) {
		$starred="Thanks for a ★! ";
	} else {
		$starred="Error! ";
		$stars=$stars-1;
	}
} else {
	$stars=$stars-1;
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Like</title>
<link rel="stylesheet" href="css/likebtnstyles.css" />
</head>
<body>

<form action="like.php" method="get">
<input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>" />
<?php echo $starred; ?><input type="submit" name="plusone" class="btn" value="+1 ★" /><span class="btnm"><?php echo $stars; ?></span>
</form>
</body>
</html>