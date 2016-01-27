<?php
//lets user update their fb id on the profile to verify which login
session_start();
include "session.php";

include "header.php";
$fb = $_POST['fb'];

//if (isset($pwd)){$md5pwd = md5($pwd);}
//print $md5pwd;
//echo "<br>" .$_SESSION["token"];
if (isset($fb)) {
			
//change pwd
$urls="http://ws.anomo.com/v208/index.php/webservice/user/update/" . $_SESSION["token"];
$chs = curl_init( $urls );
curl_setopt( $chs, CURLOPT_POST, 1);
curl_setopt ($chs, CURLOPT_POSTFIELDS, "FacebookID=$fb");
curl_setopt( $chs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $chs, CURLOPT_HEADER, 0);
curl_setopt( $chs, CURLOPT_RETURNTRANSFER, 1);
//print $pwd;
//Login Response
$responses = curl_exec( $chs );
//print $responses;
$phpArray = json_decode($responses);
//print $responses;
$fbid = $phpArray->FacebookID;
$_SESSION["fbid"] = $fbid;
echo "<div align=\"center\" class=\"alert alert-success alert-dismissable\"><h4>FBID Changed</h4></div>";
}
?>

<div align="center" class="alert alert-success alert-dismissable">
<h4>Current FacebookID: <?php print $_SESSION["fbid"]; ?></h4></div>
	<form role="form" action="fb.php" method="post">
				<div class="form-group">
					 <label for="exampleInputpwd1">Change Your FacebookID To:</label><input type="text" name="fb" class="form-control"/>
				</div>
				</div> <button type="submit" class="btn btn-default btn-block">Submit</button>
			</form><br><br>

			
			<?php include "footer.php"; ?>