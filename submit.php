<?php
session_start();
$hid = $_SESSION["headided"];
$tid = $_SESSION["torsoided"];
$lid = $_SESSION["legided"];
$token = $_SESSION["token"];
$userid = $_SESSION["userid"];
$username = $_SESSION["username"];
$db = new SQLite3('db.db');
$rows = $db->query("SELECT count(userid) as count FROM avatar where userid like $userid");
$row = $rows->fetchArray();
$avatard = $row['count'];
if ($avatard == "0"){
$x = 150;
$y = 320;


$final_img = imagecreatetruecolor($x, $y);
imagesavealpha($final_img, true);
$trans_colour = imagecolorallocatealpha($final_img, 0, 0, 0, 127);
imagefill($final_img, 0, 0, $trans_colour);
$bodies = $db->query("SELECT * FROM bodies where id = $tid");
while ($row = $bodies->fetchArray()) {	
$bod = $row['file'];
}

$legs = $db->query("SELECT * FROM legs where id = $lid");
while ($row = $legs->fetchArray()) {	
$leg = $row['file'];
}
$heads = $db->query("SELECT * FROM heads where id = $hid");
while ($row = $heads->fetchArray()) {	
$head = $row['file'];
}
$images = array($leg, $bod, $head);
foreach ($images as $image) {
    $image_layer = imagecreatefrompng($image);
    imagecopy($final_img, $image_layer, 0, 0, 0, 0, $x, $y);
}
imagesavealpha($final_img, true);
imagealphablending($final_img, true);
//header('Content-Type: image/png');
imagepng($final_img, "/var/www/anmct/avatars/FullPhoto.$username.png");
imagedestroy($final_img);
$x = 150;
$y = 110;
$final_img = imagecreatetruecolor($x, $y);
imagesavealpha($final_img, true);
$trans_colour = imagecolorallocatealpha($final_img, 0, 0, 0, 127);
imagefill($final_img, 0, 0, $trans_colour);
$bodies = $db->query("SELECT * FROM bodyshot where id = $tid");
while ($row = $bodies->fetchArray()) {	
$bod = $row['file'];
}

$heads = $db->query("SELECT * FROM headshot where id = $hid");
while ($row = $heads->fetchArray()) {	
$head = $row['file'];
}
$images = array($bod, $head);
foreach ($images as $image) {
    $image_layer = imagecreatefrompng($image);
    imagecopy($final_img, $image_layer, 0, 0, 0, 0, $x, $y);
}
imagesavealpha($final_img, true);
imagealphablending($final_img, true);
//header('Content-Type: image/png');
imagepng($final_img, "/var/www/anmct/avatars/Photo.$username.png");
imagedestroy($final_img);

$urls="http://ws.anomo.com/v209/index.php/webservice/user/update_secret_picture/$token";
$post = array("SecretPicture"=>"@/var/www/anmct/avatars/FullPhoto." . $username . ".png");
$chs = curl_init( $urls );
curl_setopt( $chs, CURLOPT_POST, 1);
 curl_setopt ($chs, CURLOPT_POSTFIELDS, $post);
curl_setopt( $chs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $chs, CURLOPT_HEADER, 0);
curl_setopt( $chs, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec( $chs );
$phpArray = json_decode($response);
$FullPhoto = $phpArray->PictureUrl;
$fpath_parts = pathinfo($FullPhoto);
$FullPhotod =  $fpath_parts['filename'] . "." . $fpath_parts['extension']; 
//echo $response . "<br>$FullPhotod<br>";

$urls="http://ws.anomo.com/v209/index.php/webservice/user/update_secret_picture/$token";
$post = array("SecretPicture"=>"@/var/www/anmct/avatars/Photo." . $username . ".png");
$chs = curl_init( $urls );
curl_setopt( $chs, CURLOPT_POST, 1);
 curl_setopt ($chs, CURLOPT_POSTFIELDS, $post);
curl_setopt( $chs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $chs, CURLOPT_HEADER, 0);
curl_setopt( $chs, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec( $chs );
$phpArray = json_decode($response);
$Photo = $phpArray->PictureUrl;
$ppath_parts = pathinfo($Photo);
$Photod =  $ppath_parts['filename'] . "." . $ppath_parts['extension']; 
//echo $response . "<br>$Photod<br>";
$urls = "http://ws.anomo.com/v208/index.php/webservice/user/update/" . $token; 
$chs = curl_init( $urls );
curl_setopt( $chs, CURLOPT_POST, 1);
 curl_setopt ($chs, CURLOPT_POSTFIELDS, "Photo=$Photod&FullPhoto=$FullPhotod");
curl_setopt( $chs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $chs, CURLOPT_HEADER, 0);
curl_setopt( $chs, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec( $chs );
$phpArray = json_decode($response);
//print $response . "<br>Upload";
$db->exec("INSERT INTO avatar (userid, invited) VALUES (\"$userid\", \"1\")");
header("Location: profile.php?id=$userid");
}
else{
	header("Location: lego.php?already=1");
}
?>
