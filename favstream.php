<?php
//lists the users fav streams...not really implemented in the client
session_start();
include "header.php";
include "session.php";
$token = $_SESSION["token"];
$url = "https://ws.anomo.com/v210/index.php/webservice/stream/get_list_favorite/" . $token;
$jsonData = file_get_contents($url);
//print $url;
$phpArray = json_decode($jsonData, true);
$phpArray2 = json_decode($jsonData);
$count = "0";
echo "<table class=\"table\">
				<tbody><tr>";
foreach($phpArray['results'] as $item) {
	$topicname = $item['TopicName'];
	$topicid = $item['TopicID'];
	$photo = $item['Photo100'];
	$path_parts = pathinfo($photo);
	$photofile =  $path_parts['filename'] . "." . $path_parts['extension'];
	if ($path_parts['extension'] == 'png'){
	$photod = "/pics/stream.png?photo=" . $photofile;
	} else {
	$photod = "/pics/stream.jpg?photo=" . $photofile;
	}
	$totalpage = $item['TotalPage'];
	$desc = $item['Desc'];
	$totalposts = $item['TotalPost'];
	if ($count == "3"){
		echo "<tr>";
		
	}
	echo "
						<td>
						<center>	<a href=\"topic.php?topic=$topicid\"><img height=\"50%\" width=\"50%\" src=\"$photod\" class=\"img-circle\" /></a><br><b>$topicname</b><br>Posts: $totalposts</center>
						</td>
					";
		
	$count++;
}
echo "</tr></tbody>
			</table>";
?>