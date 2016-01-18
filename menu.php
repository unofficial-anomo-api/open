<?php
session_start();
include "session.php";
include "header.php";

?>
<center>
<div align="center" class="alert alert-success alert-dismissable">
<h4>Hello, <?php print $_SESSION["username"]; ?></h4></div>
<a href="user.php"><button type="button" class="btn btn-default btn-block">User Preferences and Settings</button> <br><br></a>
<a href="activity.php"><button type="button" class="btn btn-default btn-block">Status Updates and Fan Page Tasks</button> <br><br></a><br><br>
<a href="logout.php"><button type="button" class="btn btn-default btn-block">Logout</button> <br><br></a>
</center>
<?php include "footer.php"; ?>
