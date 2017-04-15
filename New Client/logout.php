<?php
session_start();
include "config.php";
//print $_SESSION['token'];

$url = $baseurl."user/logout/" . $_SESSION['token'];
$refData = file_get_contents($rurl);
$refArray = json_decode($refData);
session_unset($_SESSION["token"]); 
session_destroy(); 
header("Location: index.php");
//print $_SESSION["token"];
?>