<?php
//downloads images based on stored locations for backing up a users image posts
//include "header.php";
$userid = $_GET['userid'];
$db = new SQLite3('db.db');
$rows = $db->query("SELECT * FROM backup where type like '27' and userid = " . $userid);
while ($row = $rows->fetchArray()) {
$source = $row['image'];
$refid = $row['refid'];

//$source = "https://myapps.gia.edu/ReportCheckPortal/downloadReport.do?reportNo=1152872617&weight=1.35";
$ch = curl_init($source);
$destination = "./saved/" . $username  . "." . $refid . ".jpg";
$file = fopen($destination, "w+");
curl_setopt($ch, CURLOPT_FILE, $file);
curl_setopt($ch, CURLOPT_TIMEOUT, 20);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($Channel, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//curl_setopt($ch, CURLOPT_SSLVERSION,3);
$data = curl_exec ($ch);
$error = curl_error($ch); 
curl_close ($ch);
fclose($File);
print $refid . "<br>";
}
$zipFile = "./" . $userid . ".zip";
$zipArchive = new ZipArchive();

if (!$zipArchive->open($zipFile, ZIPARCHIVE::OVERWRITE))
    die("Failed to create archive\n");

$zipArchive->addGlob("./saved/" . $userid . "*.jpg");
if (!$zipArchive->status == ZIPARCHIVE::ER_OK)
    echo "Failed to write files to zip\n";

$zipArchive->close();
?>
