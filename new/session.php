<?php
//handles session and logs user out 
//print $_SESSION['token'];
$sessionsurl="https://ws.anomo.com/v208/index.php/webservice/user/update/" . $_SESSION['token'];
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