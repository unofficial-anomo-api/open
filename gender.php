
<?php
session_start();
include "session.php";

include "header.php";
$gender = $_POST['gender'];

//if (isset($pwd)){$md5pwd = md5($pwd);}
//print $md5pwd;
//echo "<br>" .$_SESSION["token"];
if (isset($gender)) {
			
//change pwd
$urls="http://ws.anomo.com/v208/index.php/webservice/user/update/" . $_SESSION["token"];
$chs = curl_init( $urls );
curl_setopt( $chs, CURLOPT_POST, 1);
curl_setopt ($chs, CURLOPT_POSTFIELDS, "Gender=$gender");
curl_setopt( $chs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $chs, CURLOPT_HEADER, 0);
curl_setopt( $chs, CURLOPT_RETURNTRANSFER, 1);
//print $pwd;
//Login Response
$responses = curl_exec( $chs );
//print $responses;
$phpArray = json_decode($responses);
$curgender = $phpArray->Gender;
$_SESSION["gender"] = $curgender;
//print $responses;
echo "<div align=\"center\" class=\"alert alert-success alert-dismissable\"><h4>Gender Changed</h4></div>";
}
?>


<div align="center" class="alert alert-success alert-dismissable">
<h4>Current Gender: 
<?php 
//print $_SESSION["gender"];
if ($_SESSION["gender"] == "2"){
print "Male";
}else{
print "Female";
} ?>
</h4>Note: if you have a custom avatar, changing your gender will make you loose it forever.</div>
	<form role="form" action="gender.php" method="post">
				<div class="form-group">
					 <label><input type="radio" name="gender" value="1" /> Male</label><br>
					  <label><input type="radio" name="gender" value="2" /> Female</label>
				</div>
				</div> <button type="submit" class="btn btn-default btn-block">Submit</button>
			</form><br><br>

			
			<?php include "footer.php"; ?>