 <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
	  	 <?php
						   $url = $baseurl."push_notification/get_notification_history/" . $token . "/1/1";
						   //print $url;
						   $sessionjson = file_get_contents($url);
						   $sessionArray = json_decode($sessionjson);
						   $location = $_SESSION["location"];
						   //print_r($sessionArray);
						   $sessionReply = $sessionArray->code;
						   $newNotification = $sessionArray->NewNotificationsNumber;
						   ?>
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="profile.php?id=<?php echo $_SESSION["userid"]; ?>"><img src="<?php echo $_SESSION["avatar"]; ?>" class="img-circle" width="60"></p>
              	  <h5 class="centered"><?php echo $_SESSION["username"] . "</h5></a><center>" . $_SESSION["birthday"] . " | " . $location; ?> 
              	   
				   <li class="mt">
                      <a href="notifications.php">
                          <i class="fa fa-bell"></i>
                          <span><?php echo $newNotification; ?></span>
                      </a>
                  </li>	
                  <li class="mt">
                      <a class="active" href="dashboard.php">
                          <i class="fa fa-tasks"></i>
                          <span>Feed</span>
                      </a>
                  </li>
				  <li class="mt">
                      <a href="groups.php">
                          <i class="fa fa-users"></i>
                          <span>Groups</span>
                      </a>
                  </li>
				   <li class="mt">
                      <a href="find.php">
                          <i class="fa fa-compas"></i>
                          <span>Find Users</span>
                      </a>
                  </li>
				   <li class="mt">
                      <a  href="settings.php">
                          <i class="fa fa-cog"></i>
                          <span>Settings</span>
                      </a>
                  </li>
				   <li class="mt">
                      <a  href="tools.php">
                          <i class="fa fa-wrench"></i>
                          <span>Tools</span>
                      </a>
                  </li>

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      <section id="main-content">
          <section class="wrapper">

						<!-- Button trigger modal -->
						
				
              <div class="row">
                  <div class="col-lg-12 main-chart">
        
                   