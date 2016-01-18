<?php
$remoteaddr=$_SERVER["REMOTE_ADDR"];
$xforward= $_SERVER["HTTP_X_FORWARDED_FOR"];
if (empty($xforward)) {
//user is NOT using proxy
echo "You are not using proxy, your real IP address is: $remoteaddr ";
}
else {
echo "You are using a proxy, your proxy server IP is $remoteaddr while your real IP address is $xforward";
}

foreach (getallheaders() as $name => $value) {
    echo "$name: $value <br>";
}

$headers = apache_request_headers();
if (array_key_exists('X-Forwarded-For', $headers)){
  $hostname=$headers['X-Forwarded-For'] . ' via ' . $_SERVER["REMOTE_ADDR"];
} else {
  $hostname=$_SERVER["REMOTE_ADDR"];
}
echo "<br>$hostname";
?>