<?php

require_once '../libs/Core/Requests/WebRequest.php';
require_once '../libs/Core/Requests/ApiCalls.php';
require_once '../libs/Core/Model/Request.php';

//GET data using post request

	$webRequest = new WebRequest();
	$apiRequest = new ApiCalls();

	header('Content-Type: application/json');

	$amt=$_POST['amt'];
	$order=$_POST['order'];


	 $request = new Request();
	$request->setTXN_AMOUNT($amt);
	$request->setMERCH_ORDER_ID($order);
	$request->setMERCH_CUST_EMAIL("sanchitsaxena9450@gmail.com");
	$request->setMERCH_CUST_NUMBER("918285861993");
	$request->setCOLLECTOR_ID("522");
	echo $webRequest->getJsonFrame($request);  

