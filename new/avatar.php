<?php
//uploads avatar pictures to user reveal pictures and updates the profile with images
include "header.php";
include "session.php";
include "menu.php";
//print $_SESSION["fullphoto"] . "<br>" . $_SESSION["avatar"];
if (isset($_SESSION['body'])){
	$fullphoto = $_SESSION['body'];
	$headphoto = $_SESSION['head'];
	$urls = "https://ws.anomo.com/v208/index.php/webservice/user/update/" . $token; 
$chs = curl_init( $urls );
curl_setopt( $chs, CURLOPT_POST, 1);
 curl_setopt ($chs, CURLOPT_POSTFIELDS, "Photo=$headphoto&FullPhoto=$fullphoto");
curl_setopt( $chs, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $chs, CURLOPT_HEADER, 0);
curl_setopt( $chs, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec( $chs );
$phpArray = json_decode($response);
$avatar = $phpArray->Avatar;
$apath_parts = pathinfo($avatar);
$avatarfilea =  $apath_parts['filename'] . "." . $apath_parts['extension'];
$_SESSION['avatarfilea'] = $avatarfilea;
$_SESSION["avatar"] = "/pics/avatar.png?avatar=" . $avatarfilea;

$fullphoto = $phpArray->FullPhoto;
$path_parts = pathinfo($fullphoto);
$avatarfile =  $path_parts['filename'] . "." . $path_parts['extension']; 
$_SESSION['avatarfile'] = $avatarfile;
$_SESSION["fullphoto"] = "/pics/avatar.png?avatar=" . $avatarfile;
unset($_SESSION['body']); 
unset($_SESSION['head']);
}
?>


<center>
<h2>Current Avatar</h2>
<?php
echo "<img src=\"" . $_SESSION['fullphoto'] . "\"  id=\"ChangeHead\" /><br>" . $_SESSION['fullphoto'] . "<br><img src=\"" . $_SESSION['avatar'] . "\"  id=\"ChangeHead\" /><br>" . $_SESSION['avatar'];
?> </center><br>
This is your current head shot and full body avatar. If you'd like to save them you can right-click and save them to your system to upload later. Otherwise, they'll be lost forever if they're already custom avatars. Or you can save the file names at the end of the text from each file and use that at a later time.

<center><h2>Upload New Avatar</h2><br></center>
<p> So you want to upload your own? Here's the details you need to know:
<ol>
<li>Headshot: 150x150px transparent PNG</li>
<li>BodyShot: 150x330px transparent PNG</li>
</ol>
First you upload the headshot and then the body shot. Once you upload the body shot it will automatically update your avatar and display your new one.<br><br>
</p><center>
		<form action="upload.php" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<?php 
				if(isset($username)){

				if (!isset($_SESSION['head'])){
					echo "
					<label for=\"exampleInputFile\">
					Headshot
					</label>
					<input type=\"file\" name=\"myFile\">
					<input type=\"hidden\" name=\"headshot\" value=\"1\">
									<button type=\"submit\" class=\"btn btn-default\">
					Submit
				</button>";
				}
				else
				{echo "
					<label for=\"exampleInputFile\">
					Full Body
					</label>
					<input type=\"file\" name=\"myFile\">
				<input type=\"hidden\" name=\"fullbody\" value=\"1\">
								<button type=\"submit\" class=\"btn btn-default\">
					Submit
				</button>";}
			}else{
			echo "<div class=\"alert alert-dismissable alert-danger\">
				 <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
				<h4>
					Alert!
				</h4> <strong>Warning!</strong> Unfortunately due to a bug in the way Facebook login works with Anomo for Anomo.xyz you will not be able to change your avatar. <br><br>
				I'm very sorry,<br>Nason.
				<br><br>
			</div>";
			}

					?>
				</form>
			</div>
		

<?php
include "footer.php";
?>