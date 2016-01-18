<?php
//usertoken
include "token.php";
//avatars
$hmu_body = "df8c450806e5b7e0bb3c2ab10457d331.png";
$hmu_head = "a3f417433c53ac477384a2e66c2daede.png";
$hmu_body2 = "32089483744c69e074ea36ed2ec83adb.png";
$hmu_head2 = "fc426cdd6e939ef75548a81676028d3c.png";

$surl = "http://ws.anomo.com/v208/index.php/webservice/activity/get_activities/$token/1/3/-1/0/0/0/0/0";
$url="http://ws.anomo.com/v208/index.php/webservice/activity/get_activities/" . $hmu;
$jsonData = file_get_contents($url);
$phpArray = json_decode($jsonData, true);
foreach($phpArray['Activities'] as $item) {
	$type = $item['Type'];
	$message = $item['Message'];
	$phpArray = json_decode($message);
	$messaged = $phpArray->{'message'};
	$user = $item['FromUserName'];
	$refid = $item['RefID'];
	$str = strtolower($messaged);
	if(preg_match('/hmu\*?/im', $str)) {
	$url = "http://ws.anomo.com/v208/index.php/webservice/activity/like/" . $hmu . "/" . $refid. "/" . $type;
	$jsonData = file_get_contents($url);
	$phpArray = json_decode($jsonData);
	$url2 = "http://ws.anomo.com/v208/index.php/webservice/activity/comment/" . $hmu . "/" . $refid. "/" . $type;
	$chs = curl_init( $url2 );
	curl_setopt( $chs, CURLOPT_POST, 1);
	curl_setopt ($chs, CURLOPT_POSTFIELDS, "Content=HMUUUUUUU \n\n Will you ring my bell?");
	curl_setopt( $chs, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt( $chs, CURLOPT_HEADER, 0);
	curl_setopt( $chs, CURLOPT_RETURNTRANSFER, 1);
	$response = curl_exec( $chs );
	$phpArray = json_decode($response);
	echo $response . "<br>" . $refid . "<br>";
	echo "here kitty kitty<br>";
	}/*elseif (preg_match('/pusheen\*?/im', $str)){
		$url = "http://ws.anomo.com/v206/index.php/webservice/activity/like/" . $techsupport . "/" . $refid. "/" . $type;
	$jsonData = file_get_contents($url);
	$phpArray = json_decode($jsonData);
	$url2 = "http://ws.anomo.com/v206/index.php/webservice/activity/comment/" . $techsupport . "/" . $refid. "/" . $type;
	$chs = curl_init( $url2 );
	curl_setopt( $chs, CURLOPT_POST, 1);
	curl_setopt ($chs, CURLOPT_POSTFIELDS, "Content=Hein, you should go to http://anmct.com");
	curl_setopt( $chs, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt( $chs, CURLOPT_HEADER, 0);
	curl_setopt( $chs, CURLOPT_RETURNTRANSFER, 1);
	$response = curl_exec( $chs );
	$phpArray = json_decode($response);
	echo $response . "<br>" . $refid . "<br>";
	echo "maow maow<br>";
	}*/
	else {

	echo "suffering sucatash<br>$refid<br>";
	
	}
}
?>