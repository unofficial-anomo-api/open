<?php
  session_start();
  include "session.php";
  $token = $_SESSION["token"];
define("UPLOAD_DIR", "upload");
$head = $_POST["headshot"];
$body = $_POST["fullbody"];
if (!empty($_FILES["myFile"])) {
    $myFile = $_FILES["myFile"];
 
    if ($myFile["error"] !== UPLOAD_ERR_OK) {
        echo "<p>An error occurred.</p>";
        exit;
    }
 
    // ensure a safe filename
    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);
 
    // don't overwrite an existing file
    $i = 0;
    $parts = pathinfo($name);
    while (file_exists(UPLOAD_DIR . $name)) {
        $i++;
        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
    }
 
    // preserve file from temporary directory
    $success = move_uploaded_file($myFile["tmp_name"],
        UPLOAD_DIR . $name);
    if (!$success) { 
        echo "<p>Unable to save file.</p>";
        exit;
    }
 
    // set proper permissions on the new file
    chmod(UPLOAD_DIR . $name, 0644);
	$uploaded = UPLOAD_DIR . $name;

$urls="https://ws.anomo.com/v209/index.php/webservice/user/update_secret_picture/$token";
$post = array("SecretPicture"=>"@$uploaded");
$chs = curl_init( $urls );
curl_setopt( $chs, CURLOPT_POST, 1);
 curl_setopt ($chs, CURLOPT_POSTFIELDS, $post);
curl_setopt( $chs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $chs, CURLOPT_HEADER, 0);
curl_setopt( $chs, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec( $chs );
//print $response;
$phpArray = json_decode($response);
$Photo = $phpArray->PictureUrl;
$ppath_parts = pathinfo($Photo);
$Photod =  $ppath_parts['filename'] . "." . $ppath_parts['extension']; 
if (is_null($_SESSION['head'])){
$_SESSION['head'] = $Photod;
header("Location: avatar.php");
//echo "head is " . $_SESSION['head'];
}else{
	$_SESSION['body'] = $Photod;
	//echo "body is " . $_SESSION['body'];
	header("Location: avatar.php");
}

//header("Location: feed.php");
}
?>