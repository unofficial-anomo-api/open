<?php
// Required if your environment does not handle autoloading
require __DIR__ . '/Twilio/autoload.php';

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$sid = '<twilio sid>';
$token = '<twilio token';
$client = new Client($sid, $token);
$number=$_GET['number'];
if (isset($number)){
$number = $client->lookups
    ->phoneNumbers("+$number")
    ->fetch(
        array("type" => "carrier")
);}
//echo $number->carrier["type"] . "\r\n";
?>

<html>
<body>
<center><h4>Phone Type: <?php echo $number->carrier["type"] . "\r\n"; ?></h4></div>
	<form role="form" action="index.php" method="get">
				<div class="form-group">
					 <label for="exampleInputEmail1">Verify What Number?<br></label><input type="text" placeholder="555-555-5555" name="number" class="form-control" />
				</div>
				</div> <button type="submit">Submit</button>
			</form></center>