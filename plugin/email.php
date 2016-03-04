<?php
//allows user to update email on profile
session_start();
include "session.php";

include "header.php";
$oldemail = $_POST["email"];
$email = $_POST['email'];
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			
//change email
$urls="http://ws.anomo.com/v210/index.php/webservice/user/update/" . $_SESSION["token"];
//print $_SESSION['token'] . "<br>";
$chs = curl_init( $urls );
curl_setopt( $chs, CURLOPT_POST, 1);
curl_setopt ($chs, CURLOPT_POSTFIELDS, "Email=$oldemail");
curl_setopt( $chs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $chs, CURLOPT_HEADER, 0);
curl_setopt( $chs, CURLOPT_RETURNTRANSFER, 1);
//print $email;
//Login Response
$responses = curl_exec( $chs );
//print $responses;
$phpArray = json_decode($responses);
$newemail = $phpArray->Email;
$_SESSION["email"] = $newemail;
}
?>
<div align="center" class="alert alert-success alert-dismissable">
<h4>Current Email: <?php print $_SESSION["email"]; ?></h4></div>
	<form role="form" action="email.php" method="post">
				<div class="form-group">
					 <label for="exampleInputEmail1">Change Email To:</label><input type="email" name="email" class="form-control" id="exampleInputEmail1" />
				</div>
				</div> <button type="submit" class="btn btn-default btn-block">Submit</button>
			</form><br><br>

			
			<?php include "footer.php"; ?>