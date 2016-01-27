<?php
//tools menu list
session_start();
include "session.php";
include "header.php";

?>
<center>
<div align="center" class="alert alert-success alert-dismissable">
<h4>Hello, <?php print $_SESSION["username"]; ?></h4>This section is for changing user preferences and settings.</div>
<a href="email.php"><button type="button" class="btn btn-default btn-block">Change Email</button> <br><br></a>
<a href="invite.php"><button type="button" class="btn btn-default btn-block">Get Fan Page</button> <br><br></a>
<a href="bday.php"><button type="button" class="btn btn-default btn-block">Change Birthday</button> <br><br></a>
<a href="pwd.php"><button type="button" class="btn btn-default btn-block">Change Password</button> <br><br></a>
<a href="gender.php"><button type="button" class="btn btn-default btn-block">Change Gender</button> <br><br></a>
<a href="fb.php"><button type="button" class="btn btn-default btn-block">Change FacebookID</button> <br><br></a>
<a href="location.php"><button type="button" class="btn btn-default btn-block">Change Location</button> <br><br></a>
<a href="locationfind.php"><button type="button" class="btn btn-default btn-block">Search Users By Location</button> <br><br></a>
<a href="lego.php"><button type="button" class="btn btn-default btn-block">Change Avatar</button> <br><br></a>
</center>
<?php include "footer.php"; ?>
