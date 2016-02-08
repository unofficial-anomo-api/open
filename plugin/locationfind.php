<?php
//searches location passed to script using google location api to convert to lat and long and returns users within proximity to givne location. that is to say, users who aren't set to earth within that proximity.
session_start();
include "header.php";
include "session.php";
$userid = $_SESSION["userid"];
$token = $_SESSION["token"];
$next = $_GET['next'];


function lookup($string){
 
   $string = str_replace (" ", "+", urlencode($string));
   $details_url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$string."&sensor=false";
 
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $details_url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   $response = json_decode(curl_exec($ch), true);
 
   // If Status Code is ZERO_RESULTS, OVER_QUERY_LIMIT, REQUEST_DENIED or INVALID_REQUEST
   if ($response['status'] != 'OK') {
    return null;
   }
 
  // print_r($response);
   $geometry = $response['results'][0]['geometry'];
 
    $longitude = $geometry['location']['lat'];
    $latitude = $geometry['location']['lng'];
 
    $array = array(
        'latitude' => $geometry['location']['lat'],
        'longitude' => $geometry['location']['lng'],
        'location_type' => $geometry['location_type'],
    );
 
    return $array;
 
}
$city = $_POST['city'];
 
$array = lookup($city);
$lats = $array['latitude'];
$lons = $array['longitude'];
//echo $lats . "/" . $lons;
if(isset($city)){
if (isset($next)){
$urls = "http://ws.anomo.com/v208/index.php/webservice/user/search_user/" . $token . "/" . $userid . "/" . $lats . "/" . $lons . "/" . $next . "/0/18/100";
}else{
$urls = "http://ws.anomo.com/v208/index.php/webservice/user/search_user/" . $token . "/" . $userid . "/" . $lats . "/" . $lons . "/1/0/18/100";
}
//echo $urls;
$chs = curl_init( $urls );
curl_setopt( $chs, CURLOPT_POST, 1);
// curl_setopt ($chs, CURLOPT_POSTFIELDS, "Keyword=$user");
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
print "<b><a href=\"locationfind.php?next=1\"><button type=\"button\" class=\"btn btn-default\">First</button></a>";
while ($count < $page){
print "<a href=\"locationfind.php?next=$count\"><button type=\"button\" class=\"btn btn-default\">$count</button></a>";
$count++;
}
print "<a href=\"locationfind.php?next=$page\"><button type=\"button\" class=\"btn btn-default\">Last</button></a>";
}
?>

<form role="form" action="locationfind.php" method="post">
				<div class="form-group">
					 <label for="exampleInputEmail1">Search City, State/Province, Country:</label><input type="text" name="city" class="form-control" id="exampleInputEmail1" />
				</div><button type="submit" class="btn btn-default">Submit</button>
				</div> 
			</form><br><br>
			
			
<?php include "footer.php"; ?>