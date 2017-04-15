     <!-- settings start -->
	 <?php
						   $url = $baseurl."push_notification/get_notification_history/1/1" . $token;
						   //print $url;
						   $sessionjson = file_get_contents($url);
						   $sessionArray = json_decode($sessionjson);
						   $sessionArray2 = json_decode($sessionjson, true);
						   //print_r($sessionArray);
						   $sessionReply = $sessionArray->code;
						   $newNotification = $sessionArray->NewNotificationNumber;
						   ?>
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                            <i class="fa fa-tasks"></i>
                            <span class="badge bg-theme"><?php echo $newNotification; ?></span>
                        </a>
                        <ul class="dropdown-menu extended inbox">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">You have <?php echo $newNotification; ?> pending notifications</p>
                            </li>
                            
                           <?php
						   foreach($sessionArray2['NotificationHistory'] as $item) {
							$userid = $item['SendUserID'];
							$unview = $item['UnView'];
							$refid = $item['RefID'];
							$type = $item['Type'];
							$username = $item['UserName'];
							$avatar = $item['Avatar'];
							$postownername = $item['PostOwnerName'];
							
							switch($type){
								case '17':
								$posttype = "liked " . $postownername . "'s post";
								break;
								case '14':
								$postype = "commented on " . $postownername . "'s post";
								break;
								
							}
							echo "<li>
								<a href=\"post.php?ref=$refid\">
                                    <span class=\"photo\"><img alt=\"avatar\" src=\"$avatar\" width=\"10%\" height=\"10%\"></span>
                                    <span class=\"subject\">
                                    <span class=\"from\">$Username</span>
                                    </span>
                                    <span class=\"message\">
                                        $posttype
                                    </span>
                                </a></li>";
						   }
						   ?>
                            <li class="external">
                                <a href="#">See All Notifications</a>
                            </li>
                        </ul>
                    </li>