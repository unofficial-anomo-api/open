<?php
//displays anon posts from database of post ids stored...doesn't actually store the anon post it self
session_start();
include "session.php";
include "header.php";
$token = $_SESSION["token"];
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
<center><h2>Last 100 Anon Posts</h2></center>
</div>";
echo "<div class=\"panel panel-default\">
<center><ul class=\"pagination\">
				<li>
					<a href=\"anon.php?min=0&max=9\">1</a>
				</li>
				<li>
					<a href=\"anon.php?min=10&max=19\">2</a>
				</li>
				<li>
					<a href=\"anon.php?min=20&max=29\">3</a>
				</li>
				<li>
					<a href=\"anon.php?min=30&max=39\">4</a>
				</li>
				<li>
					<a href=\"anon.php?min=40&max=49\">5</a>
				</li>
				<li>
					<a href=\"anon.php?min=50&max=59\">6</a>
				</li>
				<li>
					<a href=\"anon.php?min=60&max=69\">7</a>
				</li>
				<li>
					<a href=\"anon.php?min=70&max=79\">8</a>
				</li>
				<li>
					<a href=\"anon.php?min=80&max=89\">9</a>
				</li>
				<li>
					<a href=\"anon.php?min=90&max=99\">10</a>
				</li>
			</ul></center>
			</div>";
$results = $db->query("SELECT * FROM anon2 ORDER BY timestamp DESC limit $min, $max ");
while ($row = $results->fetchArray()) {
    $refid = $row['refid'];


	$url = "http://ws.anomo.com/v208/index.php/webservice/activity/detail/$token/$refid/1";
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
	echo "<div class=\"panel panel-default\">
	<div class=\"media\">
<div class=\"media-body\">
<h4 class=\"media-heading\">
Anonymous
</h4>$messaged
<br>
<ul class=\"nav nav-pills\">
				<li><a href=\"likelist.php?refid=$refid&type=1\"><span class=\"badge pull-right\">Likes</span>$like</a></li>
				<li><a href=\"feed.php?id=$activity\"><span class=\"badge pull-center\">Feed From Post</a></span></li>
				<li style=\"float: right;\"><a href=\"comment.php?refid=$refid&type=1\"><span class=\"badge pull-left\">Comments</span> $comment</a></li></ul>
				</div></div></div>";
}else{
echo "<div class=\"panel panel-default\">
<h2><center>Anon Post Deleted</center></h2></div>";
}
}
$min = $min - 10;
$max = $max - 10;
echo "<div class=\"panel panel-default\">
<center><ul class=\"pagination\">
				<li>
					<a href=\"anon.php?min=0&max=9\">1</a>
				</li>
				<li>
					<a href=\"anon.php?min=10&max=19\">2</a>
				</li>
				<li>
					<a href=\"anon.php?min=20&max=29\">3</a>
				</li>
				<li>
					<a href=\"anon.php?min=30&max=39\">4</a>
				</li>
				<li>
					<a href=\"anon.php?min=40&max=49\">5</a>
				</li>
				<li>
					<a href=\"anon.php?min=50&max=59\">6</a>
				</li>
				<li>
					<a href=\"anon.php?min=60&max=69\">7</a>
				</li>
				<li>
					<a href=\"anon.php?min=70&max=79\">8</a>
				</li>
				<li>
					<a href=\"anon.php?min=80&max=89\">9</a>
				</li>
				<li>
					<a href=\"anon.php?min=90&max=99\">10</a>
				</li>
			</ul></center>
			</div>";
?>