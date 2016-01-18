<?php
session_start();
$userid = $_SESSION["userid"];
$yes = $_GET['yes'];
$token = $_SESSION["token"];
$db = new SQLite3("db.db");

if(isset($yes)){
$rows = $db->query("SELECT * FROM spammer where userid = $userid");

while ($row = $rows->fetchArray()) {

$activityid = $row['activityid'];


$likeurl = "https://ws.anomo.com/v208/index.php/webservice/user/delete_activity/$token/$activityid";
//print $likeurl . "<br><br>";
$profileData2 = file_get_contents($likeurl);
$phpArray3 = json_decode($profileData2);
//print_r($phpArray3);
//echo "<br><br>";
}
echo "completed";
}
echo "<h4><a href=\"deleteall.php?yes=1\">delete all my posts</a></h4>";
?>