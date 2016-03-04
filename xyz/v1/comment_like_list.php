<?php
include "config.php";
$refid = $_POST['RefID'];
$type = $_POST['Type'];
$token = $_POST['Token'];
$url = "https://ws.anomo.com/v210/index.php/webservice/comment/likelist/IUJI4VDZIPSSKZFKRXET/1101125/1";
$profileData = file_get_contents($url);
echo $profileData;