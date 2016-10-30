<?php
require_once 'config.php';
include 'checklogin.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
<title><?php echo MBLOG_TITLE; ?></title>
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
<meta name="apple-mobile-web-app-title" content="ambc's microblog" />
<link rel="icon" type="image/png" href="http://ambc.net16.net/images/icon.png" />
<link rel="apple-touch-icon-precomposed" href="http://ambc.net16.net/images/iconH.png" />
<link rel="stylesheet" href="plugins/add2home.css" />
<!-- 
<link rel="apple-touch-startup-image" href="css/startupPhone320.png" media="screen and (max-device-width: 320px)" />
<link rel="apple-touch-startup-image" href="css/startupPhone640.png" media="(max-device-width: 480px) and (-webkit-min-device-pixel-ratio: 2)" />
-->
<link rel="stylesheet" href="css/styles.css" />
</head>
<body>
<div id="floating">
<div class="statusbarpadd">&nbsp;</div>
<div id="mbinfo">
<h1><?php echo MBLOG_TITLE; ?></h1>
<h2><?php echo MBLOG_SUBTITLE; ?></h2>
<div id="bio">
<?php echo MBLOG_DESC; ?>
</div>
</div>
<div id="pulley"><?php echo MBLOG_PULLEY_TEXT; ?></div>
</div>

<div id="scrollable" class="scrollable">
	<div id="content">
		<div class="statusbarpadd">&nbsp;</div>
		<div id="spacing">&nbsp;</div>
		<div id="topbar"><div class="toptips"><?php echo MBLOG_TOOLTIPS_TEXT; ?></div></div>
		<div id="list" class="posts">
		<?php
		include "connect.php";
		$mysql_table = MYSQL_TABLE;
		$qry="SELECT * FROM `$mysql_table` ORDER BY `$mysql_table`.`id` DESC LIMIT 0, 30 ";
		$result=mysqli_query($qry);
		$iffirst=0;
		$newlastid="null";
		while ($row = mysqli_fetch_array($result)) {
			$postlinked = stripslashes($row["txt"]);
			echo '<span class="post postid'.$row["id"].'"><div class="t"><span class="loadingh"></span>'.$postlinked.'</div><div class="i">'.$row["tim"].'</div></span>';
			if ($iffirst==0) {
				$newlastid=$row["id"]+1;
				$iffirst=1;
			}
		}
		mysqli_close($link);
		?>
		</div><!-- 
		<br /><br /> -->
		<div id="det" class="posts">
		<div class="post detail">
			<div id="detailp">

			</div>
			<div id="disqus_thread"></div>
    		<script type="text/javascript">
        	/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        	var disqus_shortname = '<?php echo DISQUS_SHORTNAME; ?>'; // required: replace example with your forum shortname
        	var disqus_identifier = "<?php echo DISQUS_INITIAL_IDENTIFIER; ?>";
        	var disqus_url = window.location.href.replace("index.php", "");
        	/* * * DON'T EDIT BELOW THIS LINE * * */
        	(function() {
            	var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            	dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
            	(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        	})();
    		</script>
    		<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    		<a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
    
		</div>
		</div>
		<div id="spacing">&nbsp;</div>
	</div>
</div>

<audio id="audioalert" preload="auto">
  <source src="sounds/alert.ogg" type="audio/ogg" />
  <source src="sounds/alert.mp3" type="audio/mpeg" />
  <source src="sounds/alert.wav" type="audio/x-wav" />
 </audio>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
	var lastid=<?php echo $newlastid; ?>;
	var barvisible=true;
	if (window.navigator.standalone == true) {
		$(".statusbarpadd").css("display", "block");
	}
	$(window).on("hashchange", function() {
		if (window.location.hash.indexOf("#!") > -1) {
			godet(window.location.hash.replace("#!", ""));
		}
	});
	if (window.location.hash.indexOf("#!") > -1) {
		godet(window.location.hash.replace("#!", ""));
	}
	document.getElementById("audioalert").load();
	$("#pulley").click(function() {
		if ($("#pulley").html()=="Tap to close") {
			$("#mbinfo").css("height", "1px");
			$("#pulley").html("<?php echo MBLOG_PULLEY_TEXT; ?>");
		} else {
			$("#mbinfo").css("height", "210px");
			$("#pulley").html("Tap to close");
		}
	});
	setInterval(function() {
		if ($("#scrollable").scrollTop()>=75) {
			newbarvisible=false;
		}
		else {
			newbarvisible=true;
		}
		if (barvisible != newbarvisible) {
			barvisible=newbarvisible;
			if (barvisible==false) {
				$("#floating").fadeOut("slow");
			}
			else {
				$("#floating").fadeIn("slow");
			}
		}
	}, 1000);
	$("#list").on("click", ".post", function() {
		postid=$(this).attr("class");
		postid=postid.replace("post postid", "");
		window.location.hash="#!"+postid;
		// alert("tapped"+postid);
	});
	function gobac() {
		// $("#det").css("display", "none");
		$("#list").css("display", "block");
		$("#topbar").html('<div class="toptips"><?php echo MBLOG_TOOLTIPS_TEXT; ?></div>');
		$("#detailp").html("");
		$("#scrollable").scrollTop(lastscroll);
		window.location.hash="";
		DISQUS.reset({
			reload: true,
			config: function () {  
			this.page.identifier = "<?php echo DISQUS_INITIAL_IDENTIFIER; ?>";
			this.page.url = window.location.href.replace("index.php", "");
		}
		});
	}
	function godet(id) {
		$("#list .postid"+id+" .loadingh").html("<div class='loading'>&nbsp;</div>");
		try {
			DISQUS.reset({
				reload: true,
				config: function () {  
					this.page.identifier = id;
					this.page.url = window.location.href.replace("index.php", "") + "#!"+id;
				}
			});
			lastscroll=$("#scrollable").scrollTop();
			$.ajax({
				type: 'GET',
				url: 'detail.php?id='+id,
				success: exceptiong
			});
			function exceptiong(data, status){
				$("#topbar").html('<a href="javascript: gobac();"><div class="toptips backbutton"><img src="css/back.png" height="30" /></div></a>');
				$("#list").css("display", "none");
				$("#detailp").html(data);
				$("#det").css("display", "block");
				$(".loading").remove();
			}
		}
		catch (e) {
			setTimeout(function() {
				godet(id);
			}, 500);
		}
	}
	if (window.screen.height==568) { // iPhone 4"
		document.querySelector("meta[name=viewport]").content="width=320.1, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0";
	}
	if (window.location.hash.indexOf("#!") > -1) {
		godet(window.location.hash.replace("#!", ""));
	}
	setInterval(function() {
		$.ajax({
			type: 'GET',
			url: 'get.php?lastid='+lastid,
			dataType: "json",
			success: exception
		});
		function exception(data, status){
			lastid=data.lastid;
			var nplay=false;
			$(data.posts).each(function(index, domele) {
				str='<span class="post postid'+this.id+'"><div class="t"><span class="loadingh"></span>'+this.txt+'</div><div class="i">'+this.tim+'</div></span>';
				$("#list").prepend(str);
				nplay=true;
			});
			if (nplay==true) {
				document.getElementById("audioalert").play();
			}
			nplay=false;
		}
	}, 5000);
</script>
<script type="text/javascript">
var addToHomeConfig = {
message: 'Install this as a app: tap %icon and then <strong>Add to Home Screen</strong>. ',
expire: 720,
touchIcon: true,
animationOut: 'bubble',
animationIn: 'bubble'
};
</script>
<script type="text/javascript" src="plugins/add2home.js" charset="utf-8"></script>
</body>
</html>
