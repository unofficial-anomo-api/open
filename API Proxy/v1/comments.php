<?php
include "config.php";
$token = $_POST['Token'];
$userid = $_POST['UserID']; 
$type = $_POST['Type'];
$url = $version . "/activity/comment/" . $token . "/" . $prefid . "/" . $ptype;