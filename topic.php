<?php
//This retrieves stream topic names. Never implemented the streams in the client much more than this.

session_start();
include "header.php";
include "session.php";
$token = $_SESSION["token"];
$topic = $_GET['topic'];
$page = $_GET['page'];
if (isset($page)){
$url = "https://ws.anomo.com/v209/index.php/webservice/stream/get_list_topic/" . $token . "/$topic/$page";
} else{
$url = "https://ws.anomo.com/v209/index.php/webservice/stream/get_list_topic/" . $token . "/$topic";
}
$jsonData = file_get_contents($url);
//print $url;
$phpArray = json_decode($jsonData, true);
$phpArray2 = json_decode($jsonData);
$count = "0";
echo "<a id=\"modal-354315\" href=\"#modal-container-354315\" role=\"button\" class=\"btn\" data-toggle=\"modal\"><button type=\"submit\" class=\"btn btn-default\">Launch demo modal</button</a>
			
			
			
			
			<div class=\"modal fade\" id=\"modal-container-354315\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
				<div class=\"modal-dialog\">
					<div class=\"modal-content\">
			
			<form role=\"form\">
				<div class=\"form-group\">
					 <label for=\"exampleInputEmail1\">Email address</label><input type=\"email\" class=\"form-control\" id=\"exampleInputEmail1\" />
				</div>
				<div class=\"form-group\">
					 <label for=\"exampleInputPassword1\">Password</label><input type=\"password\" class=\"form-control\" id=\"exampleInputPassword1\" />
				</div>
				<div class=\"form-group\">
					 <label for=\"exampleInputFile\">File input</label><input type=\"file\" id=\"exampleInputFile\" />
					<p class=\"help-block\">
						Example block-level help text here.
					</p>
				</div>
				<button type=\"submit\" class=\"btn btn-default\">Submit</button>
			</form>
			
			
			
					</div>
				</div>
				</div><table class=\"table\">
				<tbody><tr>";
foreach($phpArray['results'] as $item) {
	$topicname = $item['TopicName'];
	$topicid = $item['TopicID'];
	$photo = $item['Photo'];
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
	$isfav = $item['IsFavorite'];
	if ($count == "3"){
		echo "<tr>";
		$count = "0";
	}
	echo "
						<td>
						<center>	<img height=\"70%\" width=\"70%\" src=\"$photod\" class=\"img-circle\" /><br><b>$topicname</b><br>Posts: $totalposts</center>
						</td>
					";
	$count++;
}
echo "</tr></tbody>
			</table>";
?>