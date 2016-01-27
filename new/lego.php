<?php
//lego avatar stuff
session_start();
include "header.php";
include "session.php";
$db = new SQLite3('db.db');
$db2 = new SQLite3('db.db');
$token = $_SESSION["token"];
$userid = $_SESSION["userid"];
$username = $_SESSION["username"];
$Avatar =  $_SESSION["avatar"]; 
$FullPhoto = $_SESSION["fullavatar"];
$entered = $_GET['enter'];
$rows = $db->query("SELECT * FROM contest");
//$row = $rows->fetchArray();
$already = $_GET['already'];
$rows = $db2->query("SELECT count(userid) as count FROM avatar where userid like $userid");
$row = $rows->fetchArray();
$avatard = $row['count'];
/*if ($avatard == "1"){
echo "<div class=\"alert alert-dismissable alert-danger\">
				 <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
				<h4>
					Alert!
				</h4> <strong>Warning!</strong> You've already set your avatar once. Until further work is done users will only get one. You can always play with the builder until then, though.
			</div>";
}*/
if (!isset($userid)){
echo "<div class=\"alert alert-dismissable alert-danger\">
				 <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
				<h4>
					Alert!
				</h4> <strong>Warning!</strong> Unfortunately there's a bug with the way Anomo handles Facebook logins for some users. As a result you are unable to change your avatar. I'm really sorry. It is something that I've tried to resolve but the glitch is from the Anomo side.
			</div>";	
}
if ($avatard == "0"){
echo "<div class=\"alert alert-dismissable alert-danger\">
				 <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
				<h4>
					Alert!
				</h4> <strong>Warning!</strong> This will remove your existing avatar. If you have a custom avatar that isn't through Nuiikit/Anomocity then it will be lost forever. I'm working on a backup system to be able to back up all your avatars as you change them but it's not quite ready. If you want to wait it might be wise. <br> Also, you can only change it once for now until I have a better model in place. If you want to have other options down the road, might want to save this for that. No hurry.
			</div>";
}			
?>
<div class="panel panel-default">



<img alt="" src="headgrab.php?id=1" style="z-index: 3; position: absolute"  id="ChangeHead" />

<img alt="" src="leggrab.php?id=1" style="z-index: 1; position: absolute" id="ChangeLeg" />
<img alt="" src="torsograb.php?id=1" style="z-index: 2; position: absolute" id="ChangeTorso" />
</div>
<!--<center><div style="position: relative; right: 1; top: 0;">
<img alt="" src="savegrab.php?id=1" style="z-index: 3; position: absolute"  id="ChangeOriginal" />
</div></center>-->
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<input id="hPrev" type="button" value="Previous" />Head
<input id="hNext" type="button" value="Next"  /><!--<input id="oPrev" type="button" value="Previous" />Original<input id="oNext" type="button" value="Next"  />-->
<br>

<input id="tPrev" type="button" value="Previous" />Torso
<input id="tNext" type="button" value="Next"  /><br>

<input id="lPrev" type="button" value="Previous" />Legs
<input id="lNext" type="button" value="Next"  />
<br>
<form action="submit.php" method="GET">
<input type="submit" value="Submit">
</form>
<input id="hReset" type="button" value="Reset"  />

    <script type="text/javascript">
        $(document).ready(function () {
            $("#hPrev").click(function () {
                $('#ChangeHead').attr('src', 'headgrab.php?id=prev');
            });
            $("#hNext").click(function () {
                $('#ChangeHead').attr('src', 'headgrab.php?id=next');
            });
			
			 $("#tPrev").click(function () {
                $('#ChangeTorso').attr('src', 'torsograb.php?id=prev');
            });
            $("#tNext").click(function () {
                $('#ChangeTorso').attr('src', 'torsograb.php?id=next');
            });
			
			 $("#oPrev").click(function () {
                $('#ChangeOriginal').attr('src', 'savegrab.php?id=next');
            });
            $("#oNext").click(function () {
                $('#ChangeOriginal').attr('src', 'savegrab.php?id=prev]');
            });
			
			 $("#lPrev").click(function () {
                $('#ChangeLeg').attr('src', 'leggrab.php?id=prev');
            });
            $("#lNext").click(function () {
                $('#ChangeLeg').attr('src', 'leggrab.php?id=next');
            });
			$("#Reset").click(function () {
                $('#ChangeHead').attr('src', 'headgrab.php?id=rest');
				 $('#ChangeTorso').attr('src', 'torsograb.php?id=rest');
				  $('#ChangeLeg').attr('src', 'leggrab.php?id=rest');
            });
        });
    </script>
					
					
					
					</div>


			
			
<?php		
include "footer.php";
?>
