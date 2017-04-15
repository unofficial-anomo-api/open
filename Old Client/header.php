<?php
//header file for client. 
date_default_timezone_set('America/Edmonton');
session_start();
$username = $_SESSION["username"];
$userid = $_SESSION["userid"];
$token = $_SESSION["token"];
$avatar = $_SESSION["avatar"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Anomo client</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '<-analytics_code->', 'auto');
  ga('send', 'pageview');

</script>

	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--script src="js/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
  <![endif]-->

  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="img/favicon.png">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
	<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
		<style>
	#shutter {
	background:url(./shutter.png) no-repeat;
    cursor:pointer;
    border:none;
    width:100px;
    height:100px;
}
#picsubmit {
    background-color: #cdfcdf;
    padding: 12px;
    float: left;
    font-weight: bold;
    color: black;
}
#picimage:hover {
    background-color: #999;
    color: white;
    cursor: pointer;
}
	#yourimage {
		width:30%;
		height:30%;
		border:none;
		color: white;
	}
	
	</style>


</head>

<body>
<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
		
			<div class="row clearfix">
				<div class="col-md-4 column">
				</div>
				<div class="col-md-4 column">
<?php


if(isset($token)){
	
$host = $_SERVER['HTTP_HOST'];
//$host = substr($host, 0, -4);

echo "<nav class=\"navbar navbar-default\" role=\"navigation\">
				<div class=\"navbar-header\">
					 <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\"> <span class=\"sr-only\">Toggle navigation</span><span class=\"icon-bar\"></span><span class=\"icon-bar\"></span><span class=\"icon-bar\"></span></button> <a class=\"navbar-brand\" href=\"feed.php\">$host Welcome $username</a> <a  class=\"navbar-brand\" href=\"profile.php?id=$userid\">Profile</a>
				</div>
				
				<div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
					<ul class=\"nav navbar-nav\">
					
						<li>
							<a href=\"feed.php\">Feed</a>
						</li>
						<li>
							<a href=\"notification.php\">Notif</a>
						</li>
						<li>
							<a href=\"user.php\">Tools</a>
						</li>
						<li>
							<a href=\"find.php\">Find</a>
						</li>
						<li class=\"dropdown\">
							 <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">|||<strong class=\"caret\"></strong></a>
							<ul class=\"dropdown-menu\">
								<a href=\"logout.php\">Logout</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
				
			</nav>";
			}
?>