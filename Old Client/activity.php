<?php
//some old menu
session_start();
include "session.php";
include "header.php";

?>
<center>
<div align="center" class="alert alert-success alert-dismissable">
<h4>Hello, <?php print $_SESSION["username"]; ?></h4>This section is for posting tasks.</div>
<a href="find.php"><button type="button" class="btn btn-default btn-block">User Search</button> <br><br></a>
<a href="login.php"><button type="button" class="btn btn-default btn-block">Back</button></a>	<br><br>
<a href="logout.php"><button type="button" class="btn btn-default btn-block">Logout</button> <br><br></a>
</center>
<?php include "footer.php"; ?>
