<?php
//Retrieving data
$myvars = 'FacebookID=' . $fbid . '&FbAccessToken=' . $fbtoken . '&Email=' . $fbemail;
$rpost = array(
	'FacebookID' => "$fbtoken",
	'FbAccessToken' => "$fbid",
	'Email' => "$fbemail"
);
$urls="http://site.com/v1/fblogin.php";
$headers = array("Content-Type:multipart/form-data");
$rchs = curl_init( $urls );
curl_setopt( $rchs, CURLOPT_POST, 1);
curl_setopt ($rchs, CURLOPT_POSTFIELDS, $rpost);
curl_setopt($rchs, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $rchs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $rchs, CURLOPT_HEADER, 0);
curl_setopt( $rchs, CURLOPT_RETURNTRANSFER, 1);
$responses = curl_exec( $rchs );
$phpArray = json_decode($responses);

//Parsing results
$userid = $phpArray->UserID;
$username = $phpArray->UserName;
$gender = $phpArray->Gender
$birthday = $phpArray->BirthDate;
$aboutme = $phpArray->AboutMe;
$neighbourhoodname = $phpArray->NeighbourhoodName;
$avatar = $phpArray->Avatar;
$fullavatar = $phpArray->FullAvatar;
$coverphoto = $phpArray->CoverPhoto;
$allowrevealnotice = $phpArray->AllowRevealNotice;
$allowchatnotice = $phpArray->AllowChatNotice;
$allowanomotionnotice = $phpArray->AllowAnomotionNotice;
$allowcommentactivitynotice = $phpArray->AllowCommentActivityNotice;
$allowLikeactivitynotice = $phpArray->AllowLikeActivityNotice;
$allowfollownotice = $phpArray->AllowFollowNotice;
$onlyshowcountry = $phpArray->OnlyShowCountry;
$token = $phpArray->Token;
$status = $phpArray->Status;


?>