<?php 
session_start();
$db = new SQLite3('db.db');
$ids = $_GET['id'];
if (!isset($_SESSION["legid"])){
	$_SESSION["legid"] = 1;
}
switch ($ids) {
			case "next":
				$id = $_SESSION["legid"]++;
				$_SESSION["legided"] = $id;
				break;
			case "prev":
				$id = $_SESSION["legid"]--;
				$_SESSION["legided"] = $id;
				break;
			case "reset":
				$id = 1;
				$_SESSION["legided"] = 1;
				break;
			default:
			$id = $_SESSION["legided"];
}
$bodies = $db->query("SELECT * FROM legs where id = $id");
while ($row = $bodies->fetchArray()) {	
$bod = $row['file'];
}
//echo $bod;
$img = imagecreatefrompng("$bod"); 
header('Content-Type: image/png');
imagealphablending($img, true); // setting alpha blending on
imagesavealpha($img, true); 
imagepng($img);
imagedestroy($img);
?> 