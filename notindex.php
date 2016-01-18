<?php
session_start();
//include "session.php";
//print $_SESSION['token'];
 $host = $_SERVER['HTTP_HOST'];
$host = substr($host, 0, -4);
if (isset($_SESSION["token"])){
header("Location: feed.php");
}
include "header.php";
$login = $_GET['login'];
if ($login == "fail"){
echo "<div class=\"alert alert-dismissable alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button><strong>Wrong Username/Password</strong></div>";
}
if ($login == "banned"){
echo "<div class=\"alert alert-dismissable alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button><strong>You have been blocked or you blocked @Nason000.</strong></div>";
}
?>
<script type="text/javascript">
 var oa = document.createElement('script');
 oa.type = 'text/javascript'; oa.async = true;
 <?php
  echo "oa.src = '<-oneall_address->' \n";
 ?>
 var s = document.getElementsByTagName('script')[0];
 s.parentNode.insertBefore(oa, s)
</script>

<div class="alert alert-dismissable alert-warning">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<strong>Notice</strong><br>
The site does not store, copy or use your login credentials or associated access for any functions other than those in which you select.<br><br>
Logging into this toolkit will log out of your mobile device. You will be required to log back into your phone/tablet when you are done here.
</div>

			<form class="form-horizontal" role="form" action="login.php" method="post">
				<div class="form-group">
					 <label for="inputEmail3" class="col-sm-2 control-label">Username</label><br>
					<div class="col-sm-10">
						<input type="username" class="form-control" name="username" id="inputEmail3" size="20">
					</div>
				</div>
				<div class="form-group">
					 <label for="inputPassword3" class="col-sm-2 control-label">Password</label><br>
					<div class="col-sm-10">
						<input type="password" class="form-control" name="password" id="inputPassword3" size="20">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						 <button type="submit" class="btn btn-default">Sign in</button>
					</div>
				</div>
			</form><br> <div class="panel panel-default"><center><h4>or click the Facebook logo to Login with FB</h4><div id="oa_social_login_container"></div></center></div>

<script type="text/javascript">
 var _oneall = _oneall || [];
<?php
  echo " _oneall.push(['social_login', 'set_callback_uri', '<-oneall_address->']); \n";
?>
 _oneall.push(['social_login', 'set_providers', ['facebook']]);
 _oneall.push(['social_login', 'do_render_ui', 'oa_social_login_container']);
</script><br><br>
<form class="form-horizontal" role="form" action="login.php" method="post">
				<div class="form-group">
					 <label for="inputEmail3" class="col-sm-7 control-label">I Know My Token</label><br>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="token" id="inputEmail3" size="20">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						 <button type="submit" class="btn btn-default">Sign in</button>
					</div>
				</div>
			</form>
<?php
include "footer.php";
?>