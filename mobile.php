<?php
//http://trinityblog.in/html5/2014/capture-and-save-image-with-html5-and-php
//https://gist.github.com/miguelmota/6403122
include "header.php";
?>
<!DOCTYPE HTML>
<html>
	<head>
	<meta name="viewport" content="width=320; user-scalable=no" />
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>Picamo</title>
	
	<script type="text/javascript" charset="utf-8" src="http:////cdnjs.cloudflare.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

        
	<style>
	#shutter {
	background:url(./shutter.png) no-repeat;
    cursor:pointer;
    border:none;
    width:100px;
    height:100px;
}
#picsubmit {
    background-color: #cdfcdf;
    padding: 12px;
    float: left;
    font-weight: bold;
    color: black;
}
#picimage:hover {
    background-color: #999;
    color: white;
    cursor: pointer;
}
	#yourimage {
		width:30%;
		height:30%;
		border:none;
		color: white;
	}
	
	</style>
	</head>
 
	<body>
 <form action="upload.php" method="post" enctype="multipart/form-data">
		<label for="takePictureField">
    <div id="shutter"></div>
</label>
 <br><input type="text" id="inputName" name="status" placeholder="Your Status"><br>
<input id="takePictureField" type="file" name="myFile" capture="camera" style="display:none" accept="image/*" >
        
		
		<label for="submitPic">
		<div id="picsubmit">Submit Picture</div>
		</label>
		<input type="submit" value="Upload" id="submitPic" style="display:none" multiple>
		<br><br><br>
		<img id="yourimage" align=left><br>
 </form>
		
    <script>
	var desiredWidth;
 
    $(document).ready(function() {
        console.log('onReady');
		$("#takePictureField").on("change",gotPic);
		$("#yourimage").load(getSwatches);
		desiredWidth = window.innerWidth;
        
        if(!("url" in window) && ("webkitURL" in window)) {
            window.URL = window.webkitURL;   
        }
		
	});
 
	
    //Credit: https://www.youtube.com/watch?v=EPYnGFEcis4&feature=youtube_gdata_player
	function gotPic(event) {
        if(event.target.files.length == 1 && 
           event.target.files[0].type.indexOf("image/") == 0) {
            $("#yourimage").attr("src",URL.createObjectURL(event.target.files[0]));
        }
	}
	
	
        
    </script>    
	</body>
 
</html>