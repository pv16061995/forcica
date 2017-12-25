<?php

require_once 'libs/trupay_lib/Core/Requests/ApiCalls.php';
require_once 'libs/trupay_lib/Core/Model/Request.php';


//checking for the backed request for completion of order
$request = new Request();
$request->setMERCH_ORDER_ID($_SESSION['orderId']);  //get from the session

$apiCalls = new ApiCalls();
$response =  $apiCalls->getRequestStatus($apiCalls);  

if ($response!=null) {
	echo $response->TXN_ID;
        
	if ($response->TXN_STATUS=="success") {
		unset($_SESSION['orderId']);
		//redirect to your success page where the you store database information
	}
	else{
		//redirect to error page
		echo "Error! Payment Failed";
	}
}else{
	echo "something is not right";
}
