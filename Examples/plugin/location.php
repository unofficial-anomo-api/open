<?php
//updates user location to whatever you pass to it.
session_start();
include "session.php";

include "header.php";

$location = $_POST['location'];

if(isset($location)){	
//change email
$urls="http://ws.anomo.com/v210/index.php/webservice/user/update_user_location/" . $_SESSION["token"] . "/0/0";
//print $_SESSION['token'] . "<br>";
$chs = curl_init( $urls );
curl_setopt( $chs, CURLOPT_POST, 1);
curl_setopt ($chs, CURLOPT_POSTFIELDS, "Country=$location");
curl_setopt( $chs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $chs, CURLOPT_HEADER, 0);
curl_setopt( $chs, CURLOPT_RETURNTRANSFER, 1);
//print $email;
//Login Response
$responses = curl_exec( $chs );
//print $responses;
$phpArray = json_decode($responses);
$newlocation = $phpArray->NeighborhoodName;
//print_r($phpArray);
}
?>
<div align="center" class="alert alert-success alert-dismissable">
<h4>Current location: <?php print $newlocation; ?></h4><p>Because I've had a lot of questions about this here's some informaiton:<br>
<ul><li>This will work for anyone that can see their username at the top.</li>
<li>The iPhone app resets your location so if you have an iPhone it'll have your location changed until you log back into the app.</li>
<li>It only works if you have GPS/Location settings turned off for your phone settings.</li>
<li>After logging back into the app go to your profile first to set it there too</li>
<li>Avoid the Nearby or Find People screens. That'll reset it back to earth. You can search with the drop down in the feed but DON'T click the "view all users with" option, its basically Find People screen. They both force a location update since it orders users by proximity.</li>
<li>I haven't set a character limit yet but I know there is one.</li>
<li>It won't accept special characters including quotations.</li></ul></p></div>
	<form role="form" action="location.php" method="post">
				<div class="form-group">
					 <label for="exampleInputEmail1">Change location To:</label><input type="text" name="location" class="form-control" id="exampleInputEmail1" />
				</div>
				</div> <button type="submit" class="btn btn-default btn-block">Submit</button>
			</form><br><br>

			
			<?php include "footer.php"; ?>