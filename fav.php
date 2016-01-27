<?php
//a fav script to store comment value in a database for user to refer later, can't remember if i finished this
session_start();
include "session.php";
include "header.php";
$token = $_SESSION["token"];
$userid = $_SESSION["userid"];
$db = new SQLite3('db.db');
//min
$min = $_GET['min'];
if (!isset($min)){
$min = "0";
}
//max
$max = $_GET['max'];
if (!isset($max)){
$max = "9";
}
echo "<div class=\"panel panel-default\">
<center><h2>Posts You've Favorited</h2></center>
</div>";
echo "<div class=\"panel panel-default\">
<center><ul class=\"pagination\">
				<li>
					<a href=\"fav.php?min=0&max=9\">1</a>
				</li>
				<li>
					<a href=\"fav.php?min=10&max=19\">2</a>
				</li>
				<li>
					<a href=\"fav.php?min=20&max=29\">3</a>
				</li>
				<li>
					<a href=\"fav.php?min=30&max=39\">4</a>
				</li>
				<li>
					<a href=\"fav.php?min=40&max=49\">5</a>
				</li>
				<li>
					<a href=\"fav.php?min=50&max=59\">6</a>
				</li>
				<li>
					<a href=\"fav.php?min=60&max=69\">7</a>
				</li>
				<li>
					<a href=\"fav.php?min=70&max=79\">8</a>
				</li>
				<li>
					<a href=\"fav.php?min=80&max=89\">9</a>
				</li>
				<li>
					<a href=\"fav.php?min=90&max=99\">10</a>
				</li>
			</ul></center>
			</div>";
$results = $db->query("SELECT * FROM favs where userid like $userid order by refid desc limit $min, $max");
while ($row = $results->fetchArray()) {
    $refid = $row['refid'];
	 $type = $row['type'];


	$url = "http://ws.anomo.com/v208/index.php/webservice/activity/detail/$token/$refid/$type";
$jsonData = file_get_contents($url);
//print $url . "<br>";
$phpArray = json_decode($jsonData);
//print $jsonData;
//print "<br><br>";


$code = $phpArray->{'code'};
if ($code == "OK"){
	$message = $phpArray->Activity->{'Message'};
	$phpArray3 = json_decode($message);
	$messaged = $phpArray3->{'message'};
	
	$refid = $phpArray->Activity->{'RefID'};
	$activity = $phpArray->Activity->{'ActivityID'};
	$comment = $phpArray->Activity->{'Comment'};
	$like = $phpArray->Activity->{'Like'};
	
	$favatar = $phpArray->Activity->{'Avatar'};
	$fpath_parts = pathinfo($favatar);
	$favatarfile =  $fpath_parts['filename'] . "." . $fpath_parts['extension']; 
	$favatard = "/pics/avatar.png?avatar=" . $favatarfile;
	
	$fromuser = $phpArray->Activity->{'FromUserName'};
	
	$image = $phpArray->Activity->{'Image'};
	$encoded = urlencode($image);
	$photopath_parts = pathinfo($image);
	$photofile =  $photopath_parts['filename'] . "." . $photopath_parts['extension']; 
	$pic = "/pics/pic.jpg?pic=" . $photofile;
	
	echo "<div class=\"panel panel-default\">
<div class=\"panel-heading\">
<div class=\"media\">
<a href=\"profile.php?id=$fromid\" class=\"pull-left\"><img src=\"" . $favatard . "\" height=40 width=40 class=\"media-object\" alt='' /></a><p align=\"right\"><a id=\"modal-$refid\" href=\"#modal-container-$refid\" role=\"button\" class=\"btn\" data-toggle=\"modal\">|||</a></p>
<div class=\"media-body\">
<h4 class=\"media-heading\">
$fromuser
</h4>$messaged <br>";
if ($type == "27"){
echo "<a href=\"http://images.google.com/searchbyimage?image_url=$encoded\"><img src=\"" . $pic . "\" height=\"90%\" width=\"90%\" class=\"media-object\" alt='' /></a>";
}elseif($type == "31"){
echo "<embed  width=\"100%\" height=\"100%\" src=\"http://www.youtube.com/embed/$video\">";
}
echo "</div></div>";
if ($ptype !== "29"){
echo "<ul class=\"nav nav-pills\">
				<li><a href=\"likelist.php?refid=$refid&type=$type\"><span class=\"badge pull-right\">Likes</span>$like</a></li>
				<li style=\"float: right;\"><span class=\"badge pull-left\">Comments</span> $comment</li>";
}
echo "</div></div>";
}
}
$min = $min - 10;
$max = $max - 10;
echo "<div class=\"panel panel-default\">
<center><ul class=\"pagination\">
				<li>
					<a href=\"fav.php?min=0&max=9\">1</a>
				</li>
				<li>
					<a href=\"fav.php?min=10&max=19\">2</a>
				</li>
				<li>
					<a href=\"fav.php?min=20&max=29\">3</a>
				</li>
				<li>
					<a href=\"fav.php?min=30&max=39\">4</a>
				</li>
				<li>
					<a href=\"fav.php?min=40&max=49\">5</a>
				</li>
				<li>
					<a href=\"fav.php?min=50&max=59\">6</a>
				</li>
				<li>
					<a href=\"fav.php?min=60&max=69\">7</a>
				</li>
				<li>
					<a href=\"fav.php?min=70&max=79\">8</a>
				</li>
				<li>
					<a href=\"fav.php?min=80&max=89\">9</a>
				</li>
				<li>
					<a href=\"fav.php?min=90&max=99\">10</a>
				</li>
			</ul></center>
			</div>";
?>