<?php
//left over from paypal script for intended premium service. should have been deleted, too lazy

	require_once('shopconfig.php');
	require_once('expressCheckoutAPI.php');

	$returnURL = RETURN_URL;
   	$cancelURL = CANCEL_URL; 

	$resArray = setExpressCheckOut ($_SESSION, $returnURL, $cancelURL);
	$ack = strtoupper($resArray["ACK"]);
	if($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING")  //if SetExpressCheckout API call is successful
	{
		RedirectToPayPal ( $resArray["TOKEN"] );
	} 
	else  
	{
		//handle errors here	
		//Display error msg
		$ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
		$ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
		$ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
		$ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);
		
		echo "</br>Call to SetExpressCheckout API fail";
		echo "</br>Detailed Error Message: " . $ErrorLongMsg;
		echo "</br>Short Error Message: " . $ErrorShortMsg;
		echo "</br>Error Code: " . $ErrorCode;
		echo "</br>Error Severity Code: " . $ErrorSeverityCode;	
	}
?>