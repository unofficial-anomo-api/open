<?php
$token = "";
$userid = "";

$url = "http://ws.anomo.com/v101/index.php/webservice/user/search_advance/$token/$userid/0/0/1/0/13/100";

//print $url;
$jsonData = file_get_contents($url);
$phpArray = json_decode($jsonData, true);
$phpArray2 = json_decode($jsonData);
$pages = $phpArray2->TotalPage;
$page = $phpArray2->CurrentPage;
echo "<h1><center>Last 10 Users To Use Anomo</h1>";
//print_r($phpArray);
foreach($phpArray['results']['ListUser'] as $item) {
$userid = $item['UserID'];
$username = $item['UserName'];
$gender= $item['Gender'];
$avatar = $item['Avatar'];
echo "<center><h3>$username</h3><br>";
echo "<img src=\"$avatar\" height=\"200\" width=\"200\"><br><br></center>";
}
?>