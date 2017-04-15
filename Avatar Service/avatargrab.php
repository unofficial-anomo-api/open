<?php 
//left over from lego avatar i think
session_start();
$db = new SQLite3('db.db');
$ids = $_GET['id'];
if (!isset($_SESSION["headid"])){
	$_SESSION["headid"] = 1;
}
switch ($ids) {
			case "next":
				$id = $_SESSION["headid"]++;
				$_SESSION["headided"] = $id;
				break;
			case "prev":
				$id = $_SESSION["headid"]--;
				$_SESSION["headided"] = $id;
				break;
			case "reset":
				$id = 1;
				$_SESSION["headided"] = 1;
				break;
			default:
			$id = $_SESSION["headided"];
}
$bodies = $db->query("SELECT * FROM heads where id = $id");
while ($row = $bodies->fetchArray()) {	
$bod = $row['file'];
}
//echo $bod . " " . $_SESSION["headid"];
$img = imagecreatefrompng("$bod"); 
header('Content-Type: image/png');
imagealphablending($img, true); // setting alpha blending on
imagesavealpha($img, true); 
imagepng($img);
imagedestroy($img);
?> 