<?php
$id = $_GET['refid'];
						$type = $_GET['type'];
include "session.php";
include "header.php";
include "leftmenu.php";
?>
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
 <div class="row mt">

                      <!-- SERVER STATUS PANELS -->
                      	<!-- WEATHER-2 PANEL -->
						<?php 
						
						if (!isset($refid)){
							$url = $baseurl."activity/detail/$token/$id/$type";
$jsonData = file_get_contents($url);
print $url . "<br>";
$phpArray = json_decode($jsonData, true);
//$phpArray = array_reverse($phpArray['Activity']['ListComment'],true);
//print_r($phpArray['Activity']['ListComment']);
$phpArray2 = json_decode($jsonData);
//print_r($phpArray2);

$comment = $phpArray2->Activity->{'Comment'};
$comment--;
$commented = '0';
//print_r($phpArray);
while ($comment >= $commented) {
$user = $phpArray2->Activity->ListComment[$comment]->{'UserName'};
$userid = $phpArray2->Activity->ListComment[$comment]->{'UserID'};
$id = $phpArray2->Activity->ListComment[$comment]->{'ID'};
$dob = $phpArray2->Activity->ListComment[$comment]->{'BirthDate'};
	$birthday = date_diff(date_create("$dob"), date_create('today'))->y;
	$location = $phpArray2->Activity->ListComment[$comment]->{'NeighborhoodName'};
$buttonuser = $user;
$buttonid = $userid;
$content = $phpArray2->Activity->ListComment[$comment]->{'Content'};
$messagemoji = preg_replace("/\\\\u([0-9A-F]{2,5})/i", "&#x$1;", $content);
//$type = $item['Type'];
$NumberOfLike = $phpArray2->Activity->ListComment[$comment]->{'NumberOfLike'};
$avatar = $phpArray2->Activity->ListComment[$comment]->{'Avatar'};

	$comment--;
								
						echo "<div class=\"col-lg-4 col-md-4 col-sm-4 mb\">
							<div class=\"weather-2 pn\">
								<div class=\"weather-2-header\">
									<div class=\"row\">
										<div class=\"col-sm-6 col-xs-6\">
											<p><a href=\"profile.php?uerid=$userid\"><img src=\"$avatar\" class=\"img\" width=\"30\" heigh=\"30\">$user</a>
											</br>$birthday | $location</p>
										</div>
										<div class=\"col-sm-6 col-xs-6 goright\">
											<p class=\"small\">
											</p>
										</div>
									</div>
								</div><!-- /weather-2 header -->
								<div class=\"row centered\">
								</div>
								<div class=\"row data\">
								$messagemoji
									</div>
								</div>
							</div>";
							$count++;
							}
							}
							$_SESSION["lastpost"] = $phpArray2->Activities[$count]->ActivityID;
							$lastpost = $_SESSION["lastpost"];
							
							?>

							
						
					</div><!-- col-l
					</div><!-- /row -->
					
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->

<?
include "rightmenu.php";
//include "footer.php";
?>
     <!--main content end-->
      <!--footer start-->
            <footer class="site-footer">
              
              <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
		
<script src="assets/js/jquery.js"></script>
    <script src="assets/js/jjquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>
    


    <!--script for this page-->
  
	 

	



  </body>
</html>