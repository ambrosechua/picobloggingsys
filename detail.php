<?php
require_once 'config.php';
include 'checklogin.php';

include "connect.php";

$mysql_table = MYSQL_TABLE;
$qry="SELECT * FROM `$mysql_table` WHERE `id`='".mysqli_escape_string($_GET["id"])."'";
$result=mysqli_query($qry);
if($result) {
    if(mysqli_num_rows($result) == 1) {
	    $row = mysqli_fetch_array($result);
?>
			<div class="t tp">
			<?php
			// $postlinked = preg_replace("#((http|https|ftp)://(\S*?\.\S*?))(\s|\;|\)|\]|\[|\{|\}|,|\"|'|:|\<|$|\.\s)#ie", "' <a href=\"$1\" target=\"_blank\">http://$3</a>$4'", stripslashes($row["txt"]));
			// echo $postlinked;
			echo stripslashes($row["txt"]);
			?>
			</div>
			<div class="i ip">
			at <?php
			echo $row["tim"];
			?>
			</div>
			<hr class="bfo" />
			<div class="iframeh"><iframe src="like.php?id=<?php echo $_GET["id"]; ?>" class="like"></iframe></div>
			<hr class="aft" />
<?php
	}
}
mysqli_close($link);
?>
