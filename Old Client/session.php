<?php
//checks to see if server still has a valid session for the browser client and if not logs user out. Apache2 default duration is 23 minutes.
//print $_SESSION['token'];
$sessionsurl="http://ws.anomo.com/v210/index.php/webservice/user/update/" . $_SESSION['token'];
$sessionjson = file_get_contents($sessionsurl);
$sessionArray = json_decode($sessionjson);
$sessionReply = $sessionArray->code;
//print $sessionReply;

if(($sessionReply == "INVALID_TOKEN") || ($sessionReply == "FAIL")){
session_unset($_SESSION);
session_destroy();
header("Location: index.php?login=fail");

exit();
}

?>