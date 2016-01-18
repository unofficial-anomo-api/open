<?php
session_start();
//Check if we have received a connection_token

$token = $_POST['connection_token'];
$host = $_SERVER['HTTP_HOST'];
$host = substr($host, 0, -4);
 //print $token . "<br>";
  //Your Site Settings

  $site_subdomain = '<-oneall_site->';
  $site_public_key = '<-oneall_pub_key->';
  $site_private_key = '<-oneall_priv_key->';
 
  //API Access domain
  $site_domain = $site_subdomain.'.api.oneall.com';
 
  //Connection Resource
  //http://docs.oneall.com/api/resources/connections/read-connection-details/
  $resource_uri = 'https://'.$site_domain.'/connections/'.$token .'.json';
 //print $resource_uri . "<br>";
  //Setup connection
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $resource_uri);
  curl_setopt($curl, CURLOPT_HEADER, 0);
  curl_setopt($curl, CURLOPT_USERPWD, $site_public_key . ":" . $site_private_key);
  curl_setopt($curl, CURLOPT_TIMEOUT, 15);
  curl_setopt($curl, CURLOPT_VERBOSE, 0);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
  curl_setopt($curl, CURLOPT_FAILONERROR, 0);

  //Send request
  $result_json = curl_exec($curl);
  
$phpArray2 = json_decode($result_json);
//$db->exec("INSERT INTO login (data) VALUES ($result_json)");
//print_r($phpArray);
$fbid = $phpArray2->response->result->data->user->identity->source->access_token->{'key'};
$fbtoken = $phpArray2->response->result->data->user->identity->accounts[0]->{'userid'};
$fbemail = $phpArray2->response->result->data->user->identity->emails[0]->{'value'};
//print $fbid . "<br>" . $fbtoken . "<br>" . $fbemail;

$myvars = 'FacebookID=' . $fbtoken . '&FbAccessToken=' . $fbid . '&Email=' . $fbemail;
$rpost = array(
	'FacebookID' => "$fbtoken",
	'FbAccessToken' => "$fbid",
	'Email' => "$fbemail"
);
$urls="http://ws.anomo.com/v208/index.php/webservice/user/login_with_fb/";
//print $urls . "<br>" . $myvars;
//print_r($rpost);
$headers = array("Content-Type:multipart/form-data");
$rchs = curl_init( $urls );
curl_setopt( $rchs, CURLOPT_POST, 1);
curl_setopt ($rchs, CURLOPT_POSTFIELDS, $rpost);
curl_setopt($rchs, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $rchs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $rchs, CURLOPT_HEADER, 0);
curl_setopt( $rchs, CURLOPT_RETURNTRANSFER, 1);
$responses = curl_exec( $rchs );
//print $responses;
$phpArray = json_decode($responses);

if (!isset($_SESSION['token'])){
//print $response . "<br>";
//Account Values
$_SESSION["token"] = $phpArray->token;
$debugtoken = $phpArray->token;;
$_SESSION["userid"] = $phpArray->UserID;
$debuguserid = $phpArray->UserID;
$_SESSION["username"] = $phpArray->UserName;
$_SESSION["avatar"] = $phpArray->Avatar;
$_SESSION["fullavatar"] = $phpArray->FullPhoto;
$_SESSION["birthday"] = $phpArray->BirthDate;
$_SESSION["email"] = $phpArray->Email;
$_SESSION["fbid"] = $phpArray->FacebookID;
$_SESSION["gender"] = $phpArray->Gender;
$insertuser = $_SESSION["username"];
$insertuserid = $_SESSION['userid'];
$headers = apache_request_headers();
if (array_key_exists('X-Forwarded-For', $headers)){
  $hostname=$headers['X-Forwarded-For'] . ' via ' . $_SERVER["REMOTE_ADDR"];
} else {
  $hostname=$_SERVER["REMOTE_ADDR"];
}

}
//print "token " . $_SESSION["token"] . "<br>";
//print $_SESSION['token'];
$sessionsurl="http://ws.anomo.com/v208/index.php/webservice/user/update/" . $_SESSION['token'];
$sessionjson = file_get_contents($sessionsurl);
$sessionArray = json_decode($sessionjson);
$sessionReply = $sessionArray->code;
print $sessionReply;
if(($sessionReply == "INVALID_TOKEN") || ($sessionReply == "FAIL")){
session_unset($_SESSION);
session_destroy();
header("Location: index.php?login=fail");

exit();
}
else{
header("Location: feed.php");
}








?>