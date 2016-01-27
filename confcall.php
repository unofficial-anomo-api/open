<?php
//checks how many users are in the freeconference.com conference call and updates a user About Me with details
$cookie_jar = tempnam('/tmp','cookie');
$c = curl_init('https://hello.freeconference.com/conf/fetch/$accesscode?access_code=$accesscode');
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($c, CURLOPT_COOKIEJAR, $cookie_jar);
$page = curl_exec($c);
$partArray = json_decode($page);
$masterid = $partArray->master_id;
$masterid;
curl_close($c);

$c = curl_init("https://hello.freeconference.com/participant/fetch/?conference_call_id=$masterid");
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($c, CURLOPT_COOKIEFILE, $cookie_jar);
$pages = curl_exec($c);
$partsArray = json_decode($pages, true);
curl_close($c);
$count = 0;
foreach($partsArray as $item) {
	$comment = $item['on_call_status'];
	if ($comment == "on_call"){
		$count++;
	}
}
 
$about = "Currently $count callers on the line. \n\n Access Code $accesscode \n\n
 US          605-475-4120 \n
 UK         0844  410 0400 \n
 UK         8545508 \n
 Australia  (08)  9520 3110 \n";
		$headers = array("Content-Type:multipart/form-data"); 
$rpost = array(
	'AboutMe' => "$about"
);
$rurls="https://ws.anomo.com/v209/index.php/webservice/user/update/$token"; 
$rchs = curl_init( $rurls );
curl_setopt( $chs, CURLOPT_POST, 1);
curl_setopt ($rchs, CURLOPT_POSTFIELDS, $rpost);
curl_setopt($rch, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $rchs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $rchs, CURLOPT_HEADER, 0);
curl_setopt( $rchs, CURLOPT_RETURNTRANSFER, 1);
$rresponses = curl_exec( $rchs );
echo $rresponses;


?>
