<?php

include "session.php";
include "header.php";
include "leftmenu.php";
?>
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-12 main-chart">
        
                    <div class="row mt">
                      <!-- SERVER STATUS PANELS -->
                      	<!-- WEATHER-2 PANEL -->
						<?php 
						$url = $baseurl."group/get_list_my_group/$token";
//print $url;
$jsonData = file_get_contents($url);
$phpArray = json_decode($jsonData, true);
$phpArray2 = json_decode($jsonData);
$pages = $phpArray2->TotalPage;
$page = $phpArray2->CurrentPage;
echo "<h1><center>These are your groups</h1>";
//print_r($phpArray);
foreach($phpArray['results'] as $item) {
$groupid = $item['GroupID'];
$groupname = $item['GroupName'];
$userid = $item['UserID'];
$newposts = $item['NumberOfNewPost'];
$totalmember = $item['TotalMember'];
$photo = $item['Photo'];
								
						echo "<div class=\"col-md-4 col-sm-4 mb\">
							<div class=\"weather pn\">
								<img src=\"$photo\" class=\"img-circle\" width=\"120\" heigh=\"120\">
								<h2><a href=\"group.php?id=$groupid\">$groupname</a></h2>
								<h4>$newposts New Posts | $totalmember Members</h4>
							</div>
						</div><!-- /col-md-4-->";
}
							?>

							
						
					</div><!-- col-l
					</div><!-- /row -->
					
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->

<?php
include "rightmenu.php";
include "footer.php";
?>