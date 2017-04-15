<?php
  session_start();
  include "session.php";
  $token = $_SESSION["token"];
define("UPLOAD_DIR", "<directory to temp folder>");
$status = $_POST["status"];
//echo $status;
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
//	echo $uploaded;
	$url = $baseurl."user/post_picture_activity/$token";
echo $url . "<br>";
	$ch = curl_init();
$data = array(
'PictureCaption' => "{\"message\":\"$status\",\"message_tags\":[]}", 
'Photo' => "@" . $uploaded
);
print_r($data);

curl_setopt($ch, CURLOPT_URL, "$url");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_NOPROGRESS, false);
curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, 'CURL_callback');
curl_setopt($ch, CURLOPT_BUFFERSIZE, 128);
curl_setopt($ch, CURLOPT_INFILESIZE, filesize($uploaded));

$response = curl_exec( $ch );
print_r($response);
//header("Location: dashboard.php");
}
?>