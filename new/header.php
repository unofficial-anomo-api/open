<?php
date_default_timezone_set('America/Edmonton');
session_start();
$username = $_SESSION["username"];
$userid = $_SESSION["userid"];
$token = $_SESSION["token"];
$avatar = $_SESSION["avatar"];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Unofficial Anomo Avatar Changer</title>


    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
<!--Start of Tawk.to Script-->

<!--End of Tawk.to Script-->
  </head>
  <body>
      <div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-4">
				</div>
				<div class="col-md-4">