<?php
define('VIEWER_USERNAME','viewer');
define('VIEWER_PASSWORD','viewer');
define('USE_VIEWER', false); // Need viewers to log in? 
define('UPLOAD_LOCATION', "uploads/");

define('ADMIN_USERNAME','admin');
define('ADMIN_PASSWORD','admin123');

define('DISQUS_SHORTNAME','YOUR DISQUS_SHORTNAME');
define('DISQUS_INITIAL_IDENTIFIER','homepg');

define('MYSQL_HOST', "localhost");
define('MYSQL_USERNAME', "DATABASE USRNAME");
define('MYSQL_PASSWORD', "DATABASE PASSWORD");
define('MYSQL_DATABASE', "DATABASE to store in");
define('MYSQL_TABLE', "microblog");

define('MBLOG_TITLE', "BLOG TITLE");
define('MBLOG_SUBTITLE', '
	Source on <a href="https://github.com/ambrosechua/picobloggingsys">github</a>
	');
define('MBLOG_DESC', '
	<p>
		BLOG DESCRIPTION
	</p>');


define('MBLOG_PULLEY_TEXT', "What's this?");
define('MBLOG_TOOLTIPS_TEXT', "Tap post to comment and like. :)");
?>
