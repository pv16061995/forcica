<?php

/* require_once realpath(dirname(__FILE__).'/../../Settings/Config.php');
require_once realpath(dirname(__FILE__).'/../Libs/BasicFunctions.php'); */
require_once ('Config.php');
require_once ('BasicFunctions.php');

class WebRequest{
	
	 public function getJsonFrame($request) {

	 	if($request->getSALT() == null) $request->setSALT(Config::$SALT);
        if($request->getAUTHORISATION() == null) $request->setAUTHORISATION(Config::$AUTHORISATION);
	    $secureHash = hash('sha512', $request->getMERCH_ORDER_ID()."|".$request->getTXN_AMOUNT()."|".$request->getSALT());
	    $header = BasicFunctions::getHeader($secureHash, $request->getAUTHORISATION());
	   	$orderDetails = BasicFunctions::getJson($request);
	    $datareturn =  BasicFunctions::curlRequest(Config::$WEB_SESSION_URL, $header, $orderDetails);
        if (isset($datareturn) and $datareturn->RESP_STATUS == true) {
            $returnArray = BasicFunctions::formJsonArray($datareturn,$request);
        }
        else {
            return json_encode($datareturn);
        }
        return json_encode($returnArray);
	   
    }

}
