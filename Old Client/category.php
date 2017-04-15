<?php
//displays categories from update that i never really implemented
session_start();
include "header.php";
include "session.php";
$token = $_SESSION["token"];
$url = "http://ws.anomo.com/v210/index.php/webservice/stream/get_list_category/" . $token;
$jsonData = file_get_contents($url);
//print $url;
$phpArray = json_decode($jsonData, true);
$phpArray2 = json_decode($jsonData);
$count = "0";
echo "<table class=\"table\">
				<tbody><tr>";
foreach($phpArray['results'] as $item) {
	$catname = $item['CateName'];
	$photo = $item['Photo'];
	$catid = $item['CateID'];
	$path_parts = pathinfo($photo);
	$photofile =  $path_parts['filename'] . "." . $path_parts['extension']; 
	$photod = "/pics/stream.png?photo=" . $photofile;
	$totaltopic = $itemp['TotalTopic'];
	if ($count == "2"){
		echo "<tr>";
		$count = "0";
	}
	echo "
						<td>
						<center>	<a href=\"topic.php?topic=$catid\"><img height=\"50%\" width=\"50%\" src=\"$photod\" class=\"img-circle\" /><br></a><b>$catname</b></center>
						</td>
					";
	$count++;
}
echo "</tr></tbody>
			</table>";
?>