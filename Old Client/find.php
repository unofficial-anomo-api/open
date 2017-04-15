<?php
//searches for given username. results may be sorted from server by activity rather than spelling order
session_start();
include "header.php";
include "session.php";
$userid = $_SESSION["userid"];
$token = $_SESSION["token"];
$next = $_GET['next'];
$user = $_POST['user'];
if(isset($user)){
if (isset($next)){
$urls = "http://ws.anomo.com/v210/index.php/webservice/user/search_user/" . $token . "/" . $userid . "/null/null/" . $next . "/0/18/100";
}else{
$urls = "http://ws.anomo.com/v210/index.php/webservice/user/search_user/" . $token . "/" . $userid . "/null/null/1/0/18/100";
}
$chs = curl_init( $urls );
curl_setopt( $chs, CURLOPT_POST, 1);
 curl_setopt ($chs, CURLOPT_POSTFIELDS, "Keyword=$user");
curl_setopt( $chs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $chs, CURLOPT_HEADER, 0);
curl_setopt( $chs, CURLOPT_RETURNTRANSFER, 1);

//Login Response
$response = curl_exec( $chs );
$phpArray = json_decode($response, true);
$phpArray2 = json_decode($response);
//$print_r($response);
//print_r($phpArray);

foreach($phpArray['results']['ListUser'] as $item) {
	$user = $item['UserName'];
	$avatar = $item['Avatar'];
	$path_parts = pathinfo($avatar);
	$avatarfile =  $path_parts['filename'] . "." . $path_parts['extension']; 
	$avatard = "/pics/avatar.png?avatar=" . $avatarfile;
	$profileid = $item['UserID'];
	$dob = $item['BirthDate'];
	$birthday = date_diff(date_create("$dob"), date_create('today'))->y;
	$location = $item['PlaceName'];
	print "<center><h5>$user </h5><p>$birthday | $location</p>";
	print "<a href=\"profile.php?id=$profileid\"><img src=\"" . $avatard . "\" width=\"50\" height=\"50\"></a><br>";
	print "</center>";
	print "_________________________________________________________";
}
$page = $phpArray2->results->TotalPage;
//print $page . "<br>";
$count = "2";
print "<b><a href=\"find.php?next=1\"><button type=\"button\" class=\"btn btn-default\">First</button></a>";
while ($count < $page){
print "<a href=\"find.php?next=$count\"><button type=\"button\" class=\"btn btn-default\">$count</button></a>";
$count++;
}
print "<a href=\"find.php?next=$page\"><button type=\"button\" class=\"btn btn-default\">Last</button></a>";
}
?>
<form role="form" action="find.php" method="post">
				<div class="form-group">
					 <label for="exampleInputEmail1">Search User:</label><input type="text" name="user" class="form-control" id="exampleInputEmail1" />
				</div><button type="submit" class="btn btn-default">Submit</button>
				</div> 
			</form><br><br>
			
			
<?php include "footer.php"; ?>