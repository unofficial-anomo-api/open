<?php
//Retrieving data
$urls = "http://site.com/v1/login.php";
$myvars = 'UserName=' . $username . '&Password=' . $encpassword;
$chs = curl_init( $urls );
curl_setopt( $chs, CURLOPT_POST, 1);
 curl_setopt ($chs, CURLOPT_POSTFIELDS, "UserName=$username&Password=$encpassword");
curl_setopt( $chs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $chs, CURLOPT_HEADER, 0);
curl_setopt( $chs, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec( $chs );
$phpArray = json_decode($response);

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