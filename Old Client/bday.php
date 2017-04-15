<?php
//lets you update birthday on profile
session_start();
include "session.php";

include "header.php";
$olddob = $_POST["dob"];
$dob = $_POST['dob'];
$date_regex = '/^(19|20)\d\d[\-\/.](0[1-9]|1[012])[\-\/.](0[1-9]|[12][0-9]|3[01])$/';
if (preg_match($date_regex, $dob)) {
			
//change dob
$urls="http://ws.anomo.com/v210/index.php/webservice/user/update/" . $_SESSION["token"];
$chs = curl_init( $urls );
curl_setopt( $chs, CURLOPT_POST, 1);
curl_setopt ($chs, CURLOPT_POSTFIELDS, "BirthDate=$olddob");
curl_setopt( $chs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $chs, CURLOPT_HEADER, 0);
curl_setopt( $chs, CURLOPT_RETURNTRANSFER, 1);
//print $email;
//Login Response
$responses = curl_exec( $chs );
//print $responses;
$phpArray = json_decode($responses);
$newdob = $phpArray->BirthDate;
$_SESSION["birthday"] = $newdob;
}
?>
<div align="center" class="alert alert-success alert-dismissable">
<h4>Current Date of Birth: <?php print $_SESSION["birthday"]; ?></h4></div>
	<form role="form" action="bday.php" method="post">
				<div class="form-group">
					 <label for="exampleInputEmail1">Change Birthday To:</label><br>
					 <div class="demo">

<p><input name="dob" type="text" id="datepicker"></p>

</div>
					 
				</div>
				
				</div> <button type="submit" class="btn btn-default btn-block">Submit</button>
			</form><br><br>
<script>
$(function() {
        $( "#datepicker" ).datepicker({
            dateFormat : 'yy-mm-dd',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+nn',
            maxDate: '-1d'
        });
    });
</script>	

<?php include "footer.php"; ?>