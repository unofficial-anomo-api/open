<?php 
include "config.php";
$token = $_GET['Token'];
$block = $_GET['UserID'];

$burl = $version . "/user/block_user/$token/$block";
$blockData = file_get_contents($burl);
echo $blockData;
?>