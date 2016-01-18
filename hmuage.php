<?php
//include "token.php";
$token = "blank";
//$response = "d";
/*function costumeChange(){
$urls = "https://ws.anomo.com/v208/index.php/webservice/user/update/" . $token; 
$chs = curl_init( $urls );
curl_setopt( $chs, CURLOPT_POST, 1);
 curl_setopt ($chs, CURLOPT_POSTFIELDS, "Photo=$photo&FullPhoto=$fullphoto");
curl_setopt( $chs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $chs, CURLOPT_HEADER, 0);
curl_setopt( $chs, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec( $chs );
$phpArray = json_decode($response);
return $response;
}*/
$costume = rand(1, 2);
switch ($costume) {
    case "1":
        $birthday_body = "df8c450806e5b7e0bb3c2ab10457d331.png";
		$fullphoto = $birthday_body;
		$birthday_head = "a3f417433c53ac477384a2e66c2daede.png";
		$photo = $birthday_head;
		//costumeChange($photo,$fullphoto);
		$urls = "https://ws.anomo.com/v208/index.php/webservice/user/update/" . $token; 
$chs = curl_init( $urls );
curl_setopt( $chs, CURLOPT_POST, 1);
 curl_setopt ($chs, CURLOPT_POSTFIELDS, "Photo=$photo&FullPhoto=$fullphoto");
curl_setopt( $chs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $chs, CURLOPT_HEADER, 0);
curl_setopt( $chs, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec( $chs );
$phpArray = json_decode($response);
		echo "birthday <br> " . $response;
        break;
    case "2":
        $eating_body = "32089483744c69e074ea36ed2ec83adb.png";
		$fullphoto = $eating_body;
		$eating_head = "fc426cdd6e939ef75548a81676028d3c.png";
		$photo = $eating_head;
		//costumeChange($photo,$fullphoto);
		$urls = "https://ws.anomo.com/v208/index.php/webservice/user/update/" . $token; 
$chs = curl_init( $urls );
curl_setopt( $chs, CURLOPT_POST, 1);
 curl_setopt ($chs, CURLOPT_POSTFIELDS, "Photo=$photo&FullPhoto=$fullphoto");
curl_setopt( $chs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $chs, CURLOPT_HEADER, 0);
curl_setopt( $chs, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec( $chs );
$phpArray = json_decode($response);
        echo "eating<br> " . $response;
		break;
}




?>