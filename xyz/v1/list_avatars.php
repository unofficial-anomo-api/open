<?php
include "config.php";
$gender = $_GET['Gender'];
if (!isset($gender)){
$gender = 1;
}
$url = $version . "user/list_avatar/$gender";
$profileData = file_get_contents($url);
$phpArray = json_decode($profileData, true);
echo "{\"ListAvatar\":[{";
foreach($phpArray['ListAvatar'] as $item) {
	
	$avatar = $phpArray->AvatarName;
	$fullavatar = $phpArray->FullAvatarName;
	echo "{\"Avatar\":\"$avatar\",";
	echo "\"FullAvatar\":\"$fullavatar\"},";
	
}
print "],\"Status\":\"OK\"}";