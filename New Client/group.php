<?php

include "session.php";
include "header.php";
include "leftmenu.php";
$id = $_GET['id'];
?>
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->

                    <div class="row mt">
                      <!-- SERVER STATUS PANELS -->
                      	<!-- WEATHER-2 PANEL -->
						<?php 
						if (!isset($id)){
							$url = $baseurl."group/get_list_post/" . $token . "/$groupid/$id";
							}elseif(isset($lastpost)){
							$url = $baseurl."group/get_list_post/" . $token . "/$groupid/$lastpost";
						}else{
							$url = $baseurl."group/get_list_post/" . $token . "/$groupid/$id";
							}
							$jsonData = file_get_contents($url);
							//print $url;
											$count = 0;
							echo $lastpost;
							$phpArray = json_decode($jsonData, true);
							$phpArray2 = json_decode($jsonData);
							$next = 0;
							foreach($phpArray['Activities'] as $item) {
								$message = $item['Message'];
								$phpArray3 = json_decode($message);
								$messaged = $phpArray3->{'message'};
								$messagemoji = preg_replace("/\\\\u([0-9A-F]{2,5})/i", "&#x$1;", $messaged);
								
								$location = $item['NeighborhoodName'];								
								$dob = $item['BirthDate'];
								$birthday = date_diff(date_create("$dob"), date_create('today'))->y;
								$fromuuser = $item['FromUserName'];
								$user = substr($fromuuser, 0, 25) ;
								$userid = $item['FromUserID'];
								
								$liked = $item['IsLike'];
								if(isset($liked)){
									$likes = "important";
								}
								else {
									$likes = "inverse";
								}
								$commented = $item['IsComment'];
								if(isset($commented)){
									$comments = "important";
								}
								else {
									$comments = "inverse";
								}
								$video = $item['VideoID'];
								$image = $item['Image'];
								$encoded = urlencode($image);
								$anon = $item['IsAnonymous'];
								$avatar = $item['Avatar'];
								$like = $item['Like'];
								$posttype = $item['Type'];
								$comment = $item['Comment'];
								$activity = $item['ActivityID'];
								$refid = $item['RefID'];
								$groupid = $item['GroupID'];
								$groupname = $item['GroupName'];
								
						echo "<div class=\"col-lg-4 col-md-4 col-sm-4 mb\">
							<div class=\"weather-2 pn\">
								<div class=\"weather-2-header\">
									<div class=\"row\">
										<div class=\"col-sm-6 col-xs-6\">
											<p><a href=\"profile.php?uerid=$userid\"><img src=\"$avatar\" class=\"img\" width=\"30\" heigh=\"30\">$user</a>
											</br>$birthday | $location</p>
										</div><div class=\"col-sm-6 col-xs-6 goright\">
											<p class=\"small\"><a href=\"likes.php?refid=$refid&type=$posttype\"><span class=\"badge bg-$likes\">$like Likes</span></a> | <a href=\"comments.php?refid=$refid&type=$posttype\"><span class=\"badge bg-$comments\">$comment Comments</span></a>
											</p>
										</div></div>
								</div><!-- /weather-2 header -->";
								if ($posttype == "27"){
								echo "<div class=\"row centered\">
									<a href=\"http://images.google.com/searchbyimage?image_url=$encoded\"><img src=\"$image\" class=\"img\" width=\"80\" heigh=\"80\"></a>
								</div>";
								}
								elseif($posttype == "31"){
									echo "<center><embed  width=\"30%\" height=\"30%\" src=\"http://www.youtube.com/embed/$video\"></center>";
								}elseif($posttype == "33")
								{
									//$poll = $phpAarray2->Activities->Poll->Content;
										echo "<div class=\"row centered\">This is a poll. Still working out the code for it.</div>";
								}
								

							echo "<div class=\"row data\">$messagemoji
									</div>
								</div>
							</div>";
							$count++;
							}
							$_SESSION["lastpost"] = $phpArray2->Activities[$count]->ActivityID;
							$lastpost = $_SESSION["lastpost"];
							?>

							
						
					</div><!-- col-l
					</div><!-- /row -->
					
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->

<?
include "rightmenu.php";
include "footer.php";
?>

                  
                  
 

 