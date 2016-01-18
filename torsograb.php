<?php 
session_start();
$db = new SQLite3('db.db');
$ids = $_GET['id'];
if (!isset($_SESSION["torsoid"])){
	$_SESSION["torsoid"] = 1;
}
switch ($ids) {
			case "next":
				$id = $_SESSION["torsoid"]++;
				$_SESSION["torsoided"] = $id;
				break;
			case "prev":
				$id = $_SESSION["torsoid"]--;
				$_SESSION["torsoided"] = $id;
				break;
			case "reset":
				$id = 1;
				$_SESSION["torsoided"] = 1;
				break;
			default:
			$id = $_SESSION["torsoided"];
}
$bodies = $db->query("SELECT * FROM bodies where id = $id");
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