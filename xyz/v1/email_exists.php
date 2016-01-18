<?php
include "config.php";
$email = $_POST['email'];
$useranme = $_POST['UserName'];

$url = $version . "/user/check_username_or_email_is_existed";
$response = file_get_contents($url);
echo $response;
?>