<?php 
//left over from paypal configuration for intended premium service. should have deleted it actually.
	require_once("config.php");
	require_once("expressCheckoutAPI.php");
?>

<!DOCTYPE html>
<html lang="en">
<html>
<head>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<title>ExpressCheckOut</title>

</head>
</html>

<?php
	$token = $_SESSION["TOKEN"];
	if ( $token != "" )
	{
		/*
		* Calls the GetExpressCheckoutDetails API call
		*/
		$resArray = GetExpressCheckoutDetails( $token );
		$ackGetExpressCheckout = strtoupper($resArray["ACK"]);	 
		if( $ackGetExpressCheckout == "SUCCESS" || $ackGetExpressCheckout == "SUCESSWITHWARNING") 
		{
			//person info
			$email 				= $resArray["EMAIL"]; 
			$payerId 			= $resArray["PAYERID"]; 
			$firstName			= $resArray["FIRSTNAME"]; 
			$lastName			= $resArray["LASTNAME"]; 
			
			//shipping info
			$cntryCode			= $resArray["COUNTRYCODE"]; 
			$shipToName			= $resArray["PAYMENTREQUEST_0_SHIPTONAME"]; 
			$shipToStreet		= $resArray["PAYMENTREQUEST_0_SHIPTOSTREET"]; 
			$shipToCity			= $resArray["PAYMENTREQUEST_0_SHIPTOCITY"]; 
			$shipToState		= $resArray["PAYMENTREQUEST_0_SHIPTOSTATE"]; 
			$shipToCntryCode	= $resArray["PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE"]; 
			$shipToZip			= $resArray["PAYMENTREQUEST_0_SHIPTOZIP"]; 
			
			//payment info
			$totalAmt   		= $resArray["PAYMENTREQUEST_0_AMT"];
			$itemAmt 			= $resArray["PAYMENTREQUEST_0_ITEMAMT"];
			$tax 				= $resArray["PAYMENTREQUEST_0_TAXAMT"];
			$currencyCode       = $resArray["CURRENCYCODE"]; 
			$shippingAmt        = $resArray["PAYMENTREQUEST_0_SHIPPINGAMT"]; 
?>
<html>
<body>
	<div class="container title"><h1>Review &amp; Submit Order</h1></div>
	<div class="container well"><h4><strong>You're almost done!</strong></h4><p>Review your information before you place your order.</p></div>
	<div class="container paymentDetails">
		<div class="container outerWrapper div1 col-sm-4"><div class="container"><h3>Shipping Address</h3><?php echo "</br>".$shipToName."</br>".$shipToStreet."</br>".$shipToCity."</br>".$shipToState."</br>".$shipToCntryCode."</br>".$shipToZip;	?></div></div>
		<div class="container outerWrapper div2 col-sm-4"><div class="container"><h3>Shipping Method</h3><p>Standard<br>Delivery in 3-5 business days following shipment</p></div></div>
		<div class="container outerWrapper div3 col-sm-4"><div class="container"><h3>Selected Payment</h3><p>PayPal Account</br><?php echo $email ?></p></div></div>
	</div>
	</br>
	</br>
	<div class="container orderSummary col-sm-3">
		<div class = "row"><dl class="dl-horizontal">
			<dt> Subtotal:</dt><dd><?php echo $itemAmt."  ".$currencyCode; ?></dd>
			<dt class="info"> Shipping:</dt><dd><?php echo $shippingAmt."  ".$currencyCode; ?></dd>
			<dt class="info"> Estimated Tax</dt><dd><?php echo $tax."  ".$currencyCode?></dd></dl>
		</div>
		<div class = "row"><dl class="dl-horizontal orderTotal"><dt> Order Total</dt><dd><?php echo $totalAmt."  ".$currencyCode; ?></dd></dl></div>
		<div class = "row confirmButton">
			<form action="return.php" method="POST"><input type="Submit" value="Confirm Order" class = "btn btn-success"></form>
		</div>
	</div>

</body>
</html>

<?php
		} 
		else  
		{
			//Display error
			$ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
			$ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
			$ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
			$ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);

			echo "</br>GetExpressCheckoutDetails API call failed. ";
			echo "</br>Detailed Error Message: " . $ErrorLongMsg;
			echo "</br>Short Error Message: " . $ErrorShortMsg;
			echo "</br>Error Code: " . $ErrorCode;
			echo "</br>Error Severity Code: " . $ErrorSeverityCode;
		}
	}
?>

