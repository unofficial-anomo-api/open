<?php
include "config.php";

$content = $_POST['Comment'];
$anon = $_POST['Anonymous'];
if (is_null($anon)){
$anon = 0;
}
$refid = $_POST['RefID'];
$type = $_POST['Type'];
$token = $_POST['Token'];

$post = array(
	'Content' => "$content",
	'IsAnonymous' => "$anon"
);
$urls= $version . "/activity/comment/" . $token . "/" . $refid . "/" . $type;
//print $urls . "<br>";
//print $content . "<br>";
$headers = array("Content-Type:multipart/form-data"); 
$chs = curl_init( $urls );
curl_setopt( $chs, CURLOPT_POST, 1);
curl_setopt ($chs, CURLOPT_POSTFIELDS, $post);
curl_setopt( $chs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($chs, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $chs, CURLOPT_HEADER, 0);
curl_setopt( $chs, CURLOPT_RETURNTRANSFER, 1);
//print $pwd;
//Login Response
$responses = curl_exec( $chs );
//print $responses;
$phpArray = json_decode($responses);
//print $responses;

print "{\"Status\":\"Ok\",\"Comment\":{";
print "\"ID\":\"$phpArray->Comment->{'ID'}\"";
print "\"UserID\":\"$phpArray->Comment->{'UserID'}\"";
print "\"UserName\":\"$phpArray->Comment->{'Content'}\"";
print "\"Created\":\"$phpArray->Comment->{'CreatedDate'}\"";
print "\"NeighbourhoodName\":\"$phpArray->Comment->{'NeighbourhoodName'}\"";
print "\"IsAnonymous\":\"$phpArray->Comment->{'IsAnonymous'}\"";
print "} }";
?>