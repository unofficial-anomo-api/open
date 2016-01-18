<?php
session_start();
include "session.php";

include "header.php";
$pwd = $_POST['pwd'];

if (isset($pwd)){$md5pwd = md5($pwd);}
//print $md5pwd;
//echo "<br>" .$_SESSION["token"];
if (isset($pwd)) {
			
//change pwd
$urls="http://ws.anomo.com/v208/index.php/webservice/user/update/" . $_SESSION["token"];
$chs = curl_init( $urls );
curl_setopt( $chs, CURLOPT_POST, 1);
curl_setopt ($chs, CURLOPT_POSTFIELDS, "Password=$md5pwd");
curl_setopt( $chs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $chs, CURLOPT_HEADER, 0);
curl_setopt( $chs, CURLOPT_RETURNTRANSFER, 1);
//print $pwd;
//Login Response
$responses = curl_exec( $chs );
//print $responses;
$phpArray = json_decode($responses);
//print $responses;
echo "<div align=\"center\" class=\"alert alert-success alert-dismissable\"><h4>Password Changed</h4></div>";
}
?>
	<form role="form" action="pwd.php" method="post">
				<div class="form-group">
					 <label for="exampleInputpwd1">Change Your Password To:</label><input type="password" name="pwd" class="form-control"/>
				</div>
				</div> <button type="submit" class="btn btn-default btn-block">Submit</button>
			</form><br><br>

			
			<?php include "footer.php"; ?>