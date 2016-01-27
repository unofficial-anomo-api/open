<?php
//modified version of the Pusheen bot as a birthday gift for @whysoserious. grabbed the feed whenever cron job (every 10 in this case) ran the script. the script only processes that set of data, usually 23 posts worth, and checks for specific words then posts acordingly.
$token = "blank";

$surl = "https://ws.anomo.com/v208/index.php/webservice/activity/get_activities/$token/1/3/-1/0/0/0/0/0";
$url="https://ws.anomo.com/v208/index.php/webservice/activity/get_activities/" . $token . "/1/3/";
$jsonData = file_get_contents($url);
$phpArray = json_decode($jsonData, true);
$db = new SQLite3('/var/www/anmct/pusheen.db');
//print_r($phpArray);
foreach($phpArray['Activities'] as $item) {
	$type = $item['Type'];
	$message = $item['Message'];
	$userid = $item['UserID'];
	$phpArray3 = json_decode($message);
	$messaged = $phpArray3->{'message'};
	
	$user = $item['FromUserName'];
	$refid = $item['RefID'];
	print $messaged . "<br>" . $user . "<br><br>";
	$someValue = "My brain melts at the thought.";
	$str = strtolower($messaged);
	$arr = array("cat", "meow", "kitty", "kitten");
	if(preg_match('/cat|kitten|meow|kitty|purr|pussy|maow|catnip|tuna|fish\*?/im', $str)) {
	$rows = $db->query("SELECT count(refid) as count FROM comments where refid like $refid");
	$row = $rows->fetchArray();
	$numRows = $row['count'];
	if ($numRows == "0"){
	if ($userid == "128335"){
	$url = "https://ws.anomo.com/v208/index.php/webservice/activity/like/" . $token . "/" . $refid. "/" . $type;
	$jsonData = file_get_contents($url);
	$phpArray = json_decode($jsonData);
	$url2 = "https://ws.anomo.com/v208/index.php/webservice/activity/comment/" . $token . "/" . $refid. "/" . $type;
	$chs = curl_init( $url2 );
	curl_setopt( $chs, CURLOPT_POST, 1);
	curl_setopt ($chs, CURLOPT_POSTFIELDS, "Content=Meow \n\n  Pusheen loooooves Ryssa");
	curl_setopt( $chs, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt( $chs, CURLOPT_HEADER, 0);
	curl_setopt( $chs, CURLOPT_RETURNTRANSFER, 1);
	$response = curl_exec( $chs );
	$db->exec("INSERT INTO comments (refid) VALUES ($refid)");
	$phpArray = json_decode($response);
	echo $response . "<br>" . $refid . "<br>";
	echo "here kitty kitty<br>";
	}else{
	$url = "https://ws.anomo.com/v208/index.php/webservice/activity/like/" . $token . "/" . $refid. "/" . $type;
	$jsonData = file_get_contents($url);
	$phpArray = json_decode($jsonData);
	$url2 = "https://ws.anomo.com/v208/index.php/webservice/activity/comment/" . $token . "/" . $refid. "/" . $type;
	$chs = curl_init( $url2 );
	curl_setopt( $chs, CURLOPT_POST, 1);
	curl_setopt ($chs, CURLOPT_POSTFIELDS, "Content=Maow");
	curl_setopt( $chs, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt( $chs, CURLOPT_HEADER, 0);
	curl_setopt( $chs, CURLOPT_RETURNTRANSFER, 1);
	$response = curl_exec( $chs );
	$db->exec("INSERT INTO comments (refid) VALUES ($refid)");
	$phpArray = json_decode($response);
	echo $response . "<br>" . $refid . "<br>";
	echo "here kitty kitty<br>";}
	}elseif (preg_match('/pusheen\*?/im', $str)){
		$url = "https://ws.anomo.com/v208/index.php/webservice/activity/like/" . $token . "/" . $refid. "/" . $type;
	$jsonData = file_get_contents($url);
	$phpArray = json_decode($jsonData);
	$url2 = "https://ws.anomo.com/v208/index.php/webservice/activity/comment/" . $token . "/" . $refid. "/" . $type;
	$chs = curl_init( $url2 );
	curl_setopt( $chs, CURLOPT_POST, 1);
	curl_setopt ($chs, CURLOPT_POSTFIELDS, "Content=Maow Maow, $user? =^-^=");
	curl_setopt( $chs, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt( $chs, CURLOPT_HEADER, 0);
	curl_setopt( $chs, CURLOPT_RETURNTRANSFER, 1);
	$response = curl_exec( $chs );
	$db->exec("INSERT INTO comments (refid) VALUES ($refid)");
	$phpArray = json_decode($response);
	echo $response . "<br>" . $refid . "<br>";
	echo "maow maow<br>";
	}
	else {

	echo "suffering sucatash<br>$refid<br>";
	
	}
	}
}
?>