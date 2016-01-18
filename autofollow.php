<?php
$token = "blank";
$userid = "blank";




$url = "https://ws.anomo.com/v208/index.php/webservice/user/get_list_follower/$token/$userid/1";
$jsonData = file_get_contents($url);
$phpArray2 = json_decode($jsonData);
$pages = $phpArray2->TotalPage;
$page = $phpArray2->CurrentPage;
while ($page <= $pages){
$furl = "https://ws.anomo.com/v208/index.php/webservice/user/get_list_follower/$token/$userid/$page";
$followData = file_get_contents($furl);
$phpArray = json_decode($followData, true);
foreach($phpArray['ListFollower'] as $item) {
$fuserid = $item['UserID'];
$db = new SQLite3('db.db');
$rows = $db->query("SELECT count(followid) as count FROM follows where followid like $fuserid");
$row = $rows->fetchArray();
$numRows = $row['count'];
if ($numRows == "0"){
$fourl = "https://ws.anomo.com/v208/index.php/webservice/user/follow/$token/$fuserid";
$followData = file_get_contents($fourl);

$db->exec("INSERT INTO follows (userid, followid) VALUES (\"$userid\",\"$fuserid\")");
echo "followed<br>";
}
echo "not followed<br>";
}
$page++;
}

?>
