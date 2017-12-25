<?php
/**
 * Created by PhpStorm.
 * User: shashwat
 * Date: 23/2/17
 * Time: 7:36 PM
 */
require_once '../libs/trupay_lib/Core/Requests/WebRequest.php';
require_once '../libs/trupay_lib/Core/Requests/ApiCalls.php';
require_once '../libs/trupay_lib/Core/Model/Request.php';


$request = new Request();
$request->setTXN_AMOUNT("1.00");
$request->setMERCH_ORDER_ID("ORDER".rand(9999,99999999));
$request->setCUST_NUMBER("919716809959");
$request->setCUST_VPA("sanchitsaxena@upi");

$apiCalls = new ApiCalls();

header('Content-Type: application/json');
echo json_encode($apiCalls->getRequestMoney($request));


/*header('Content-Type: application/json');
$request->setTXN_AMOUNT("ORDER2190601"); //replace with the requested amount
$request->setTXN_ID("578898");   //replace it with the requested transaction id
echo json_encode($apiCalls->getRequestStatus($request));*/

/*header('Content-Type: application/json');
$request->setTXN_AMOUNT("ORDER2190601");    //replace with the requested order id
$request->setTXN_ID("578898");     //replace with the requested transaction id
echo json_encode($apiCalls->getRequestCancel($request));*/
