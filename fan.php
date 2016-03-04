<?php
//user fan page. all users have one but only visible if HasFanPage is set to 1 is it visible. this shows it and allows you to post to it. 	
session_start();
include "session.php";

include "header.php";
$fanid = $_GET['fanid'];
if (isset($fanid)){
$_SESSION["fanid"] = $fanid;
}
$comment = $_POST['comment'];
$messaged = $_POST['messaged'];
//if (isset($pwd)){$md5pwd = md5($pwd);}
//print $md5pwd;
//echo "<br>" .$_SESSION["token"];
if (isset($messaged)) {
			
//change pwd
$post = "ProfileStatus={\"message\":" . $comment . ",\"message_tags\":[]}&FanPage=" . $_SESSION["fanid"];
$urls="http://ws.anomo.com/v210/index.php/webservice/user/update/" . $_SESSION["token"];
$chs = curl_init( $urls );
curl_setopt( $chs, CURLOPT_POST, 1);
curl_setopt ($chs, CURLOPT_POSTFIELDS, $post);
curl_setopt( $chs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $chs, CURLOPT_HEADER, 0);
curl_setopt( $chs, CURLOPT_RETURNTRANSFER, 1);
//print $pwd;
//Login Response
$responses = curl_exec( $chs );
//print $responses;
$phpArray = json_decode($responses);
//print $responses;
//$fbid = $phpArray->FacebookID;
//$_SESSION["fbid"] = $fbid;
echo "<div align=\"center\" class=\"alert alert-success alert-dismissable\"><h4>Posted Fan Comment</h4></div>";
}
else{
echo "<div align=\"center\" class=\"alert alert-success alert-dismissable\">
<h4>Fan Page:</h4></div>";
}
//print $_SESSION["fanid"];
//print $_SESSION["fanid"];
//print $post;
?>


	<form role="form" action="fan.php" method="post">
				<div class="form-group">
					 <label for="exampleInputpwd1">Comment</label><input type="text" name="comment" class="form-control"/>
					 <input type="hidden" name="messaged" value="1"/>
				</div>
				</div> <button type="submit" class="btn btn-default btn-block">Submit</button>
			</form><br><br>
			<a href="activity.php"><button type="button" class="btn btn-default btn-block">Back</button></a>
			
			<?php include "footer.php"; ?>