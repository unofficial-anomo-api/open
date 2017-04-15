      <div class="black-bg navbar-fixed-top">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="dashboard.php" class="logo"><b>Anomo Online </b></a>
            <!--logo end-->
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                
                <li><button class="logout" data-toggle="modal" data-target="#myModal"> Post</button></li>
                    <li><a class="logout" href="logout.php">Logout</a></li>
                
            	</ul>
            </div>
</div>
<?php
 $filename = basename($_SERVER['REQUEST_URI'], '?'.$_SERVER['QUERY_STRING']);
                $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
switch ($withoutExt){

  case 'dashboard':
    include "poster.php";
    break;
  case 'comments':
	include "commenter.php";
	break;
  default:
      include "poster.php"; 
}
?>