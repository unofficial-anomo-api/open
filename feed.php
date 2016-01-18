<?php
session_start();
include "header.php";
include "session.php";
$token = $_SESSION["token"];
$nurl="http://ws.anomo.com/v208/index.php/webservice/user/get_user_info/" . $token . "/63977";
$njsonData = file_get_contents($nurl);
//print $url . "<br>";
$nphpArray = json_decode($njsonData);
$nusername = $nphpArray->results->{'UserName'};
if (!isset($nusername)){
header("Location: logout.php");
}
$delid = $_SESSION["userid"];
$delete = $_POST['delete'];
$id = $_GET['id'];
$system = $_GET['system'];
if (isset($system)){
$sysurl = "http://ws.anomo.com/v208/index.php/webservice/activity/close_announcement/$token/$system";
$sysData = file_get_contents($sysurl);
$sysArray = json_decode($sysData);
}
if(isset($delete)){
$furl = "http://ws.anomo.com/v208/index.php/webservice/user/delete_activity/$token/$delete";
$followData = file_get_contents($furl);
//print $furl;
//print "<br>";
//print $followData;
$followArray = json_decode($followData);
}
$follow = $_POST['follow'];
if(isset($follow)){
$furl = "http://ws.anomo.com/v208/index.php/webservice/user/follow/$token/$follow";
$followData = file_get_contents($furl);
//print $url;
$followArray = json_decode($followData);
}
$block = $_POST['block'];

if(isset($block)){
$burl = "http://ws.anomo.com/v208/index.php/webservice/user/block_user/$token/$block";
$blockData = file_get_contents($burl);
//print $url;
$blockArray = json_decode($blockData);
//print_r($blockArray);

}
$report = $_POST['report'];
$reporting = $_POST['reporting'];
$typing = $_POST['typing'];
if(isset($report)){
$headers = array("Content-Type:multipart/form-data"); 
$rpost = array(
	'Content' => "$reporting"
);
$rurls="http://ws.anomo.com/v208/index.php/webservice/flag/content/$token/$report/$typing/0";
$rchs = curl_init( $rurls );
curl_setopt( $chs, CURLOPT_POST, 1);
curl_setopt ($rchs, CURLOPT_POSTFIELDS, $rpost);
curl_setopt($rch, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $rchs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $rchs, CURLOPT_HEADER, 0);
curl_setopt( $rchs, CURLOPT_RETURNTRANSFER, 1);
$rresponses = curl_exec( $rchs );
}

//max
$max = $_POST['maxage'];
if (!isset($max)){
$_SESSION["maxage"] = 100;
$max = $_SESSION["maxage"];
}
else{
$_SESSION["maxage"] = $max;
}
//min
$min = $_POST['minage'];
if (!isset($min)){
$_SESSION["minage"] = 18;
$min = $_SESSION["minage"];
}
else{
$_SESSION["minage"] = $min;
}
//type
$type = $_POST['type'];
if (!isset($type)){
$_SESSION["type"] = 1;
$type = $_SESSION["type"];
}
else{
$_SESSION["type"] = $type;
}
//gender
//type
$gender = $_POST['gender'];
if (!isset($gender)){
$_SESSION["gender"] = -1;
$gender = $_SESSION["gender"];
}
else{
$_SESSION["gender"] = $gender;
}
//tab
//max
$tab = $_GET['tab'];
if (!isset($tab)){
$_SESSION["tab"] = 0;
$tab = $_SESSION["tab"];
}
else{
$_SESSION["tab"] = $tab;
}
$comment = $_POST['post'];
$messaged = $_POST['messaged'];
$anon = $_POST['anon'];
if(!isset($anon)){
$anon = 0;
}
if (isset($messaged)) {	
//change pwd
$headers = array("Content-Type:multipart/form-data"); 
$post = array(
	'ProfileStatus' => "{\"message\":\"$comment\",\"message_tags\":[]}",
    'IsAnonymous' => "$anon"
);
$urls="http://ws.anomo.com/v208/index.php/webservice/user/update/" . $_SESSION["token"];
$chs = curl_init( $urls );
curl_setopt( $chs, CURLOPT_POST, 1);
curl_setopt ($chs, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $chs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $chs, CURLOPT_HEADER, 0);
curl_setopt( $chs, CURLOPT_RETURNTRANSFER, 1);
$responses = curl_exec( $chs );
//print $responses;
$phpArray = json_decode($responses);

echo "<div align=\"center\" class=\"alert alert-success alert-dismissable\"><h4>Status Posted</h4></div>";
}
/*echo "<div class=\"panel panel-default\"><div class=\"alert alert-dismissable alert-alert\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
<center><strong>Avatar Contest</strong><br>
Here for the Avatar Contest? </center>
</div><center><a href=\"vacant.php\"><button class=\"btn btn-default\" type=\"button\">Vacant</button></a> </center></div>";*/
echo "<div class=\"panel panel-default\">
<div class=\"panel-heading\">
						 <a class=\"panel-title collapsed\" data-toggle=\"collapse\" data-parent=\"#panel-1817d58\" href=\"#panel-elemdent-$refid\"><center>Search Status'</center></a>
					</div>
					<div id=\"panel-elemdent-$refid\" class=\"panel-collapse collapse\">
						<div class=\"panel-body\">
							<form role=\"form\" action=\"feedfind.php\" method=\"post\">
					<div class=\"form-group\">
					<label for=\"exampleInputpwd1\">Search Text</label><input type=\"text\" name=\"search\" class=\"form-control\"/>
					 
				</div>
			 <button type=\"submit\" class=\"btn btn-default btn-block\">Submit</button>
			</form>
						</div>
					</div></div>";
//Preferences
echo "
<div class=\"panel panel-default\">
<div class=\"panel-heading\">
						 <a class=\"panel-title collapsed\" data-toggle=\"collapse\" data-parent=\"#panel-181758\" href=\"#panel-element-1\"><center>Feed Preferences</a></center>
					</div>
					<div id=\"panel-element-1\" class=\"panel-collapse collapse\">
						<div class=\"panel-body\">
							<form class=\"form-horizontal\" action=\"feed.php\" method=\"post\">
<fieldset>

<!-- Form Name -->
<legend>Filtering</legend>
<div class=\"tabbable\" id=\"tabs-74997\">
				<ul class=\"nav nav-tabs\">
					<li class=\"active\">
						<a href=\"#panel-7893\" data-toggle=\"tab\">Gender</a>
					</li>
					<li>
						<a href=\"#panel-255589\" data-toggle=\"tab\">Age Filter</a>
					</li>
					<li>
						<a href=\"#panel-255587\" >Post Type</a>
					</li>
				</ul>
				<div class=\"tab-content\">
<!-- Multiple Radios (inline) -->
<div class=\"tab-pane active\" id=\"panel-7893\">
						<p>
<div class=\"form-group\">
  <label class=\"col-md-4 control-label\" for=\"Gender\">Gender</label>
  <div class=\"col-md-4\">
  <div class=\"radio\">
    <label for=\"Gender-0\">
      <input type=\"radio\" name=\"gender\" id=\"Gender-0\" value=\"0\" checked=\"checked\">
      Both
    </label>
	</div>
  <div class=\"radio\">
    <label for=\"Gender-1\">
      <input type=\"radio\" name=\"gender\" id=\"Gender-1\" value=\"2\">
      Female
    </label>
	</div>
  <div class=\"radio\">
    <label for=\"Gender-2\">
      <input type=\"radio\" name=\"gender\" id=\"Gender-2\" value=\"1\">
      Male
    </label>
	</div>
  </div>
</div>
</p>
					</div>
<!-- Select Basic -->
<div class=\"tab-pane\" id=\"panel-255589\">
						<p>
<div class=\"form-group\">
  <label class=\"col-md-4 control-label\" for=\"MinAge\">Min Age</label>
  <div class=\"col-md-2\">
    <select id=\"MinAge\" name=\"minage\" class=\"form-control\"><option name=\"$min\" selected=\"selected\" value=\"$min\">$min</option>";

$minage = 18;
$maxage = 100;
while ($minage <= $maxage){
 echo "<option value=\"$minage\" name=\"$minage\">$minage</option>";
 $minage++;
 }
 echo    "</select>
  </div>
</div>

<!-- Select Basic -->
<div class=\"form-group\">
  <label class=\"col-md-4 control-label\" for=\"MaxAge\">MaxAge</label>
  <div class=\"col-md-2\">
    <select id=\"MaxAge\" name=\"maxage\" class=\"form-control\"><option name=\"$max\"selected=\"selected\" value=\"$max\">$max</option>";

$minage = 18;
$maxage = 100;
while ($minage <= $maxage){
 echo "<option value=\"$minage\" name=\"$minage\">$minage</option>";
 $minage++;
 }
 
 echo "</select>
  </div>
</div>
</p>
					</div>
<div class=\"tab-pane\" id=\"panel-255587\">
						<p>
<div class=\"form-group\">
  <label class=\"col-md-4 control-label\" for=\"Type\">Types</label>
  <div class=\"col-md-4\">
  <div class=\"radio\">
    <label for=\"Type-0\">
      <input type=\"radio\" name=\"type\" id=\"Type-0\" value=\"0\">
      All
    </label>
	</div>
  <div class=\"radio\">
    <label for=\"Type-1\">
      <input type=\"radio\" name=\"type\" id=\"Type-1\" value=\"1\">
      Status'
    </label>
	</div>
  <div class=\"radio\">
    <label for=\"Type-2\">
      <input type=\"radio\" name=\"type\" id=\"Type-2\" value=\"27\">
      Pictures
    </label>
	</div>
  </div>
</div>
</p>
					</div><button type=\"submit\" class=\"btn btn-default btn-block\">Submit</button>
</fieldset></form>

						</div>
					</div></div>";
print "<center><div class=\"btn-group\">
	<a href=\"feed.php?tab=2\"><button class=\"btn btn-default\" type=\"button\">Hot</button></a> 
	<a href=\"feed.php?tab=0\"><button class=\"btn btn-default\" type=\"button\">Now</button></a>
	<a href=\"feed.php?tab=1\"><button class=\"btn btn-default\" type=\"button\">Near</button></a> 
	<a href=\"feed.php?tab=3\"><button class=\"btn btn-default\" type=\"button\">Follow</button></a>
	<a href=\"anon.php\"><button class=\"btn btn-default\" type=\"button\">Anon</button></a>
	<a href=\"fav.php\"><button class=\"btn btn-default\" type=\"button\">Fav</button></a>
	
			</div></center><br>";

			echo "<div class=\"panel panel-default\">
<div class=\"panel-heading\">
						 <a class=\"panel-title collapsed\" data-toggle=\"collapse\" data-parent=\"#panel-181758\" href=\"#panel-element-$refid\"><center>Post Status</center></a>
					</div>
					<div id=\"panel-element-$refid\" class=\"panel-collapse collapse\">
						<div class=\"panel-body\">
							<form role=\"form\" action=\"feed.php\" method=\"post\">
					<div class=\"form-group\">
					<label for=\"exampleInputpwd1\">Post</label>
					<textarea name=\"post\" class=\"form-control counted\" placeholder=\"Type in your message\" rows=\"5\" style=\"margin-bottom:10px;\"/></textarea>
					<h6 class=\"pull-right\" id=\"counter\">90000 characters remaining</h6>
					<label><input type=\"checkbox\" name=\"anon\" value=\"1\"/>Make Anonymous</label>
					<label><input type=\"checkbox\" name=\"alwaysanon\" value=\"1\"/>Always Anonymous</label>
					 <input type=\"hidden\" name=\"messaged\" value=\"1\">
					 
				</div>
			 <button type=\"submit\" class=\"btn btn-info\">Submit</button>
			</form><script type=\"text/javascript\">
	/**
 *
 * jquery.charcounter.js version 1.2
 * requires jQuery version 1.2 or higher
 * Copyright (c) 2007 Tom Deater (http://www.tomdeater.com)
 * Licensed under the MIT License:
 * http://www.opensource.org/licenses/mit-license.php
 * 
 */
 
(function($) {
    /**
	 * attaches a character counter to each textarea element in the jQuery object
	 * usage: $(\"#myTextArea\").charCounter(max, settings);
	 */
	
	$.fn.charCounter = function (max, settings) {
		max = max || 100;
		settings = $.extend({
			container: \"<span></span>\",
			classname: \"charcounter\",
			format: \"(%1 characters remaining)\",
			pulse: true,
			delay: 0
		}, settings);
		var p, timeout;
		
		function count(el, container) {
			el = $(el);
			if (el.val().length > max) {
			    el.val(el.val().substring(0, max));
			    if (settings.pulse && !p) {
			    	pulse(container, true);
			    };
			};
			if (settings.delay > 0) {
				if (timeout) {
					window.clearTimeout(timeout);
				}
				timeout = window.setTimeout(function () {
					container.html(settings.format.replace(/%1/, (max - el.val().length)));
				}, settings.delay);
			} else {
				container.html(settings.format.replace(/%1/, (max - el.val().length)));
			}
		};
		
		function pulse(el, again) {
			if (p) {
				window.clearTimeout(p);
				p = null;
			};
			el.animate({ opacity: 0.1 }, 100, function () {
				$(this).animate({ opacity: 1.0 }, 100);
			});
			if (again) {
				p = window.setTimeout(function () { pulse(el) }, 200);
			};
		};
		
		return this.each(function () {
			var container;
			if (!settings.container.match(/^<.+>$/)) {
				// use existing element to hold counter message
				container = $(settings.container);
			} else {
				// append element to hold counter message (clean up old element first)
				$(this).next(\".\" + settings.classname).remove();
				container = $(settings.container)
								.insertAfter(this)
								.addClass(settings.classname);
			}
			$(this)
				.unbind(\".charCounter\")
				.bind(\"keydown.charCounter\", function () { count(this, container); })
				.bind(\"keypress.charCounter\", function () { count(this, container); })
				.bind(\"keyup.charCounter\", function () { count(this, container); })
				.bind(\"focus.charCounter\", function () { count(this, container); })
				.bind(\"mouseover.charCounter\", function () { count(this, container); })
				.bind(\"mouseout.charCounter\", function () { count(this, container); })
				.bind(\"paste.charCounter\", function () { 
					var me = this;
					setTimeout(function () { count(me, container); }, 10);
				});
			if (this.addEventListener) {
				this.addEventListener('input', function () { count(this, container); }, false);
			};
			count(this, container);
		});
	};

})(jQuery);

$(function() {
    $(\".counted\").charCounter(90000,{container: \"#counter\"});
});

	</script>
						</div>
					</div></div>";
echo "<div class=\"panel panel-default\">
<div class=\"panel-heading\">
						 <a class=\"panel-title collapsed\" data-toggle=\"collapse\" data-parent=\"#paneld-181758\" href=\"#panel-delement-$refid\"><center>Post Pic</center></a>
					</div>
					<div id=\"panel-delement-$refid\" class=\"panel-collapse collapse\">
						<div class=\"panel-body\">
							<form action=\"upload.php\" method=\"post\" enctype=\"multipart/form-data\">
		<center><label for=\"takePictureField\">
    <div id=\"shutter\"></div>
</label>
  <br><input type=\"text\" id=\"inputName\" name=\"status\" placeholder=\"Your Status\"><br>
<input id=\"takePictureField\" type=\"file\" name=\"myFile\" capture=\"camera\" style=\"display:none\" accept=\"image/*\" >
        
		
		<label for=\"submitPic\">
		<div id=\"picsubmit\">Submit Picture</div>
		</label>
		<input type=\"submit\" value=\"Upload\" id=\"submitPic\" style=\"display:none\" multiple>
		<br><br><br>
		<img id=\"yourimage\" align=left><br></center>
 </form>
		
    <script>
	var desiredWidth;
 
    $(document).ready(function() {
        console.log('onReady');
		$(\"#takePictureField\").on(\"change\",gotPic);
		$(\"#yourimage\").load(getSwatches);
		desiredWidth = window.innerWidth;
        
        if(!(\"url\" in window) && (\"webkitURL\" in window)) {
            window.URL = window.webkitURL;   
        }
		
	});
 
	
    //Credit: http://www.youtube.com/watch?v=EPYnGFEcis4&feature=youtube_gdata_player
	function gotPic(event) {
        if(event.target.files.length == 1 && 
           event.target.files[0].type.indexOf(\"image/\") == 0) {
            $(\"#yourimage\").attr(\"src\",URL.createObjectURL(event.target.files[0]));
        }
	}
	
	
        
    </script>
						</div>
					</div></div>";

if (!isset($id)){
$url = "http://ws.anomo.com/v208/index.php/webservice/activity/get_activities/" . $token . "/" . $type . "/" . $tab . "/0/" . $gender . "/" . $min . "/" . $max . "/0/0";
}else{
$url = "http://ws.anomo.com/v208/index.php/webservice/activity/get_activities/" . $token . "/" . $type . "/" . $tab . "/0/" . $gender . "/" . $min . "/" . $max . "/$id/0";
}
$jsonData = file_get_contents($url);
//print $url;
$phpArray = json_decode($jsonData, true);
$phpArray2 = json_decode($jsonData);
$next = 0;
foreach($phpArray['Activities'] as $item) {
	$posttype = $item['Type'];
	$comment = $item['Comment'];
	$like = $item['Like'];
	$dob = $item['BirthDate'];
	$birthday = date_diff(date_create("$dob"), date_create('today'))->y;
	$location = $item['NeighborhoodName'];
	
	$message = $item['Message'];
	$phpArray3 = json_decode($message);
	$messaged = $phpArray3->{'message'};
	
	$activity = $item['ActivityID'];
	$fanpage = $item['FanPage'];
	$aboutuser = $item['AboutName'];
	
	$tag = $phpArray3->{'message_tags'};
	$phpArray4 = json_decode($tag);
	$tagID = $phpArray4->{'id'};
	$tagName = $phpArray4->{'name'};
	
	$userid = $item['FromUserID'];
	$anon = $item['IsAnonymous'];
	$content = $item['Content'];
	
	$next++;
	$avatar = $item['Avatar'];
	$path_parts = pathinfo($avatar);
	$avatarfile =  $path_parts['filename'] . "." . $path_parts['extension']; 
	$avatard = "/pics/avatar.png?avatar=" . $avatarfile;
	
	$user = $item['FromUserName'];
	$video = $item['VideoID'];
	$buttonuser = $user;
	$buttonid = $userid;
	
	$image = $item['Image'];
	// $encoded = urlencode($image);
	$photopath_parts = pathinfo($image);
	$photofile =  $photopath_parts['filename'] . "." . $photopath_parts['extension']; 
	$pic = "/pics/pic.jpg?pic=" . $photofile;
	$token = $_POST['connection_token'];
	$host = $_SERVER['HTTP_HOST'];
	$host = substr($host, 0, -4);

	$epic = "http://app.anomo.xyz/" . $pic;
	$encoded = urlencode($epic);
	$refid = $item['RefID'];
print "<div class=\"panel panel-default\">";
if ($anon == "1"){
echo "<div class=\"media\">
<div class=\"media-body\">
<h4 class=\"media-heading\">
Anonymous
</h4>";
echo nl2br($messaged, false);
echo " <br>";
}elseif($posttype == "29"){
echo "<div class=\"media\"><p align=\"right\"><a href=\"feed.php?system=$activity\" role=\"button\" class=\"btn\">X</a></p>
<div class=\"media-body\">
<h4 class=\"media-heading\">
System Message
</h4>";
echo nl2br($message, false);
echo " <br>";
}else{
echo "<div class=\"media\">
<a href=\"profile.php?id=$userid\" class=\"pull-left\"><img src=\"" . $avatard . "\" height=40 width=40 class=\"media-object\" alt='' /></a><p align=\"right\"><a id=\"modal-$userid\" href=\"#modal-container-$userid\" role=\"button\" class=\"btn\" data-toggle=\"modal\">|||</a></p>
<div class=\"media-body\">";
if (isset($fanpage)){
$fanurl="http://ws.anomo.com/v208/index.php/webservice/user/get_user_info/" . $token . "/" . $fanpage;
$fanData = file_get_contents($fanurl);
//print $fanurl . "<br>";
$fanArray = json_decode($fanData);
$fanvatar = $fanArray->results->{'Avatar'};
$fuser = $fanArray->results->{'UserName'};
//print $fanvatar;
$fan_parts = pathinfo($fanvatar);
$fanfile =  $fan_parts['filename'] . "." . $fan_parts['extension']; 
$avatarf = "/pics/avatar.png?avatar=" . $fanfile;
echo "<a href=\"profile.php?id=$fanpage\"><img  src=\"$avatarf\" height=30 width=30 align=\"right\" class=\"media-object\" alt='$fuser' /></a>";
}
echo "<h4 class=\"media-heading\">
$user
</h4>
<p>$birthday | $location</p>
<div class=\"modal fade\" id=\"modal-container-$userid\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
				<div class=\"modal-dialog\">
					<div class=\"modal-content\">";
if($buttonid == $delid){
echo "<form class=\"form-horizontal\" action=\"feed.php\" method=\"post\"> 
<input type=\"hidden\" name=\"delete\" value=\"$activity\"><center><button type=\"submit\" class=\"btn btn-default btn-block\">Delete $username</button></center></form>";
}
					
echo			"<form class=\"form-horizontal\" action=\"feed.php\" method=\"post\"> <input type=\"hidden\" name=\"follow\" value=\"$buttonid\"><center><button type=\"submit\" class=\"btn btn-default btn-block\">Follow $buttonuser</button></center></form>
					
					<form class=\"form-horizontal\" action=\"feed.php\" method=\"post\"> <input type=\"hidden\" name=\"block\" value=\"$buttonid\"><center><button type=\"submit\" class=\"btn btn-default btn-block\">Block $buttonuser</button></center></form>
					
					<a class=\"panel-title collapsed\" data-toggle=\"collapse\" data-parent=\"#panel-$buttonid\" href=\"#panel-element-$buttonid\"><center>Report $buttonuser</center></a>
					<div id=\"panel-element-$buttonid\" class=\"panel-collapse collapse\">
						<div class=\"panel-body\">
							<form role=\"form\" action=\"feed.php\" method=\"post\">
					<div class=\"form-group\">
					<label for=\"exampleInputpwd1\">Reason</label><input type=\"text\" name=\"reporting\" class=\"form-control\"/>
					 <input type=\"hidden\" name=\"report\" value=\"$buttonid\">
					 <input type=\"hidden\" name=\"reporting\" value=\"$posttype\">
					 </div>
					 </div>
					 
			 <button type=\"submit\" class=\"btn btn-default btn-block\">Submit</button>
			</form>
						</div>
					
					
						<div class=\"modal-footer\">
							 <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>
						</div>
					</div>
					
				</div>
			</div><a href=\"comment.php?refid=$refid&type=$posttype\"><font color=\"black\">";
			echo nl2br($messaged, false);
			echo "</font></a> <br>";
}
if ($posttype == "27"){
echo "<a href=\"http://images.google.com/searchbyimage?image_url=$encoded\"><img src=\"" . $pic . "\" height=\"90%\" width=\"90%\" class=\"media-object\" alt='' /></a>";
}
elseif($posttype == "31"){
echo "<embed  width=\"100%\" height=\"100%\" src=\"http://www.youtube.com/embed/$video\">";
}  
echo "</div>";
if ($posttype !== "29"){
echo "<ul class=\"nav nav-pills\">
				<li><a href=\"likelist.php?refid=$refid&type=$posttype\"><span class=\"badge pull-right\">Likes</span>$like</a></li>
				<li style=\"float: right;\"><a href=\"comment.php?refid=$refid&type=$posttype\"><span class=\"badge pull-left\">Comments</span> $comment</a></li>";
}
echo "</div></div>";
/*echo "</div>
</div>
<p align=\"right\"> $like Likes
				<div class=\"panel-heading\">
						 <a class=\"panel-title collapsed\" data-toggle=\"collapse\" data-parent=\"#panel-181758\" href=\"#panel-element-$refid\">$comment Comments</a>
					</div>
					<div id=\"panel-element-$refid\" class=\"panel-collapse collapse\">
						<div class=\"panel-body\">
							Anim pariatur cliche...
						</div>
					</div>
</div><br>";*/

}
$next--;
$nextest = $phpArray2->Activities[$next]->ActivityID;
//print $nextest;
echo "<form class=\"form-horizontal\" action=\"feed.php\" method=\"get\"> <input type=\"hidden\" name=\"id\" value=\"$nextest\"><center><button type=\"submit\" class=\"btn btn-default btn-block\">Next</button></center></form>";
print $token . " token";
?>






















<?php include "footer.php"; ?>