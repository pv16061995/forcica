<?php

require_once '../libs/trupay_lib/Core/Requests/WebRequest.php';
require_once '../libs/trupay_lib/Core/Requests/ApiCalls.php';
require_once '../libs/trupay_lib/Core/Model/Request.php';

//GET data using post request

	$webRequest = new WebRequest();
	$apiRequest = new ApiCalls();

	header('Content-Type: application/json');

	//OrderNumber must be coming from database to track the payment success. You need to have access of orderNumber in the end of transaction during success page, for rechecking whether the transaction is completed or not.
	

	/////////////////////////////////GET WEB SESSION KEY API//////////////////////////////
	$request = new Request();
	$request->setTXN_AMOUNT("1.00");
	$request->setMERCH_ORDER_ID("ORDER".rand(9999,99999999));
	$request->setMERCH_CUST_EMAIL("sanchitsaxena9450@gmail.com");
	$request->setMERCH_CUST_NUMBER("918285861993");
	$request->setCOLLECTOR_ID("522");

	//$request->setAUTHORISATION('c6afa030-8fcd-470a-9104-3c1120587ce8');
	//$request->setSALT('ca023832');

	echo $webRequest->getJsonFrame($request); 



	/////////////////////////////////TESTING REQUEST MONEY API//////////////////////////////
	/*$request = new Request();
	$request->setTXN_AMOUNT("1.00");
	$request->setMERCH_ORDER_ID("ORDER".rand(9999,99999999));
	$request->setCUST_VPA("sanchitsaxena@upi");
	$request->setCOLLECTOR_ID("382");
	$request->setAUTHORISATION('c6afa030-8fcd-470a-9104-3c1120587ce8');
	$request->setSALT('ca023832');
	echo json_encode($apiRequest->getRequestMoney($request));*/



	/////////////////////////////////TESTING CHECK STATUS//////////////////////////////
	/*$request = new Request();
	//$request->setAUTHORISATION('c6afa030-8fcd-470a-9104-3c1120587ce8');
	//$request->setSALT('ca023832');
	$request->setMERCH_ORDER_ID("ORDER26446026");
	echo json_encode($apiRequest->getRequestStatus($request));*/