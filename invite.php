<?php
//session_start();
include "header.php";
include "session.php";
$token = $_SESSION['token'];//"233XVQQUV8JR8NMSUSXO";
$userid = $_SESSION['userid'];
$areacode = $_GET['areacode'];
$urls="http://ws.anomo.com/v209/index.php/webservice/user/update/" . $token;
//print $urls . "<br>";
$chst = curl_init( $urls );
curl_setopt( $chst, CURLOPT_POST, 1);
curl_setopt ($chst, CURLOPT_POSTFIELDS, $post);
curl_setopt($chst, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $chst, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $chst, CURLOPT_HEADER, 0);
curl_setopt( $chst, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec( $chst );
//print $response;
$phpArray1 = json_decode($response);
//print_r($phpArray1);
$points = $phpArray1->{'Point'};
$pointer = "130000" - $points;
$pointed = ceil($pointer/"25");
//print $points;
if(isset($areacode)){

$db = new SQLite3('db.db');
//$results = $db->query("SELECT invited FROM invite where userid like $userid");
$rows = $db->query("SELECT count(userid) as count FROM invite where userid like $userid");
$row = $rows->fetchArray();
$invited = $row['count'];
//print $invited;
if ($invited == "0"){
$count = 0;
$exchange = substr(number_format(time() * mt_rand(),0,'',''),0,3);
$suffix = substr(number_format(time() * mt_rand(),0,'',''),0,4);
$phone = $areacode . "-" . $exchange . "-" . $suffix;
$phonenum = $phone;
while ($count < $pointed){
$exchange = substr(number_format(time() * mt_rand(),0,'',''),0,3);
$suffix = substr(number_format(time() * mt_rand(),0,'',''),0,4);
$phone = $areacode . "-" . $exchange . "-" . $suffix;
$phonenum = $phonenum . ";" . $phone;
$count++;
}
$rpost = array(
	'PhoneNumbers' => "$phonenum"
);
//$headers = array("Content-Type:multipart/form-data");
$url = "http://ws.anomo.com/v209/index.php/webservice/invite_friend/sms/$token";
//print $url . "<br>" . $phonenum . "<br>";
$chs = curl_init($url);
curl_setopt( $chs, CURLOPT_POST, 1);
curl_setopt ($chs, CURLOPT_POSTFIELDS, $rpost);
//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $chs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $chs, CURLOPT_HEADER, 0);
curl_setopt( $chs, CURLOPT_RETURNTRANSFER, 1);
$responses = curl_exec( $chs );
$phpArray = json_decode($responses);
//print $responses;
$db = new SQLite3('db.db');
$db->exec("INSERT INTO invite (userid, invited) VALUES (\"$userid\", \"1\")");
echo "<div class=\"alert alert-dismissable alert-success\">
				 <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
				<h4>
					Success!
				</h4> <strong>We gave you $pointer points by inviting $pointed \"people\". Congrats on your Fan Page.</strong>
			</div>";
}
else{
echo "<div class=\"alert alert-dismissable alert-danger\">
				 <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
				<h4>
					Alert!
				</h4> <strong>Warning!</strong> You've already made you awesome..
			</div>";
			}
}
print "<div class=\"panel panel-default\">
<h1>You have $points points.</h1></div>
<div class=\"panel panel-default\">
<form role=\"form\" action=\"invite.php\" method=\"get\">
					<div class=\"form-group\">
					<label for=\"exampleInputpwd1\">Your Area Code</label><input type=\"text\" name=\"areacode\" class=\"form-control\"/>
					 </div>
					 </div>
					 
			 <button type=\"submit\" class=\"btn btn-default btn-block\">Submit</button>
			</form>
</div>
";

?>