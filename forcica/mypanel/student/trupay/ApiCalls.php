<?php

/* require_once realpath(dirname(__FILE__).'/Config.php');
require_once realpath(dirname(__FILE__).'/BasicFunctions.php'); */
require_once ('Config.php');
require_once ('BasicFunctions.php');

class ApiCalls
{

	 function getRequestMoney($request) {

        if($request->getSALT() == null) $request->setSALT(Config::$SALT);
        if($request->getAUTHORISATION() == null) $request->setAUTHORISATION(Config::$AUTHORISATION);


	 	$CUST_NUMBER = $request->getCUST_NUMBER();
	 	$TXN_AMOUNT = $request->getTXN_AMOUNT();
	 	$MERCH_ORDER_ID = $request->getMERCH_ORDER_ID();
	 	$CUST_EMAIL = $request->getCUST_EMAIL();
	 	$CUST_VPA = $request->getCUST_VPA();
	 	$TXN_REMARKS = $request->getTXN_REMARKS();
	 	$BANK_ACCOUNT_ID = $request->getBANK_ACCOUNT_ID();
	 	$DEVICE_ID = $request->getDEVICE_ID();
        $PARAM1 = $request->getPARAM1();
        $PARAM2 = $request->getPARAM2();
        $PARAM3 = $request->getPARAM3();
        $PARAM4 = $request->getPARAM4();
        $PARAM5 = $request->getPARAM5();

        //return data array initilize
        $errorReturn = array();
        //check mandatory parameter
        if (empty($CUST_NUMBER) and empty($CUST_VPA)) {
            $errorReturn["ERROR_MSG"] = "Mobile number  OR VPA is required";
        } else if (empty($TXN_AMOUNT)) {
            $errorReturn["ERROR_MSG"] = "Request amount is required";
        } else if (empty($MERCH_ORDER_ID)) {
            $errorReturn["ERROR_MSG"] = "merchantOrderNumber is required";
        }
        if (!empty($errorReturn)) {
            return json_encode($errorReturn);
        }

        $datasendArry = array(
            "MERCH_ORDER_ID" => $request->getMERCH_ORDER_ID(),
            "CUST_EMAIL" => $request->getCUST_EMAIL(),
            "BANK_ACCOUNT_ID" => $request->getBANK_ACCOUNT_ID(),
            "TXN_AMOUNT" => $request->getTXN_AMOUNT(),
            "TXN_REMARKS" => $request->getTXN_REMARKS(),
            "CUST_NUMBER" => $request->getCUST_NUMBER(),
            "CUST_VPA" => $request->getCUST_VPA(),
            "DEVICE_ID" => $request->getDEVICE_ID(),
            //"RET_URL_SUCC" => Config::$RET_URL_SUCC,
            "PARAM1"=>$request->getPARAM1(),
            "PARAM2"=>$request->getPARAM2(),
            "PARAM3"=>$request->getPARAM3(),
            "PARAM4"=>$request->getPARAM4(),
            "PARAM5"=>$request->getPARAM5()
        );

        $datasendArry = json_encode($datasendArry);

        $dataHash = $CUST_NUMBER . "|" . $MERCH_ORDER_ID . "|" . $TXN_AMOUNT . "|" . $CUST_VPA . "|" . $request->getSALT();
        $hashKey = hash('sha512',$dataHash);
        $header = BasicFunctions::getHeader($hashKey, $request->getAUTHORISATION());
        //send data with curl

        $datareturn = BasicFunctions::curlRequest(
                            Config::$REQUEST_MONEY,
                            $header,
                            $datasendArry
        );

        echo json_encode($datareturn);
        die();
        $returnArray = array();

        if ($datareturn->RESP_STATUS==true) {
            $returnArray['TXN_AMOUNT'] = BasicFunctions::getAmountFormat(BasicFunctions::prepareData($datareturn->TXN_AMOUNT));
            $returnArray['MERCH_ORDER_ID'] = BasicFunctions::prepareData($datareturn->MERCH_ORDER_ID);
            $returnArray['TXN_ID'] = BasicFunctions::prepareData($datareturn->TXN_ID);
            $returnArray['CUST_NUMBER'] = BasicFunctions::prepareData($datareturn->CUST_NUMBER);
            $returnArray['RESP_MSG'] = BasicFunctions::prepareData($datareturn->RESP_MSG);
            $returnArray['CUST_VPA'] = BasicFunctions::prepareData($datareturn->CUST_VPA);
            $returnArray['PARAM1'] = BasicFunctions::prepareData($datareturn->PARAM1);
            $returnArray['PARAM2'] = BasicFunctions::prepareData($datareturn->PARAM2);
            $returnArray['PARAM3'] = BasicFunctions::prepareData($datareturn->PARAM3);
            $returnArray['PARAM4'] = BasicFunctions::prepareData($datareturn->PARAM4);
            $returnArray['PARAM5'] = BasicFunctions::prepareData($datareturn->PARAM5);
            $returnArray['TXN_REMARKS'] = BasicFunctions::prepareData($datareturn->TXN_REMARKS);
            $returnArray['RESP_CODE'] = BasicFunctions::prepareData($datareturn->RESP_CODE);
            $returnArray['SECURE_HASH'] = BasicFunctions::prepareData($datareturn->SECURE_HASH);

            //check hash data vailid or not

            $dataHash = $returnArray['MERCH_ORDER_ID'] . "|" . $returnArray['TXN_ID'] . "|".$returnArray['CUST_NUMBER']."|".$returnArray['CUST_VPA']."|".$returnArray['TXN_AMOUNT']."|".$request->getSALT();

            $hashKeyNew = hash('sha512',$dataHash);

            if($returnArray['SECURE_HASH']  != $hashKeyNew){
                $returnArray = array();
                $returnArray['ERROR_MSG'] = "Hash Mismatch";
                return $returnArray;
            }

        }
        else{
            $returnArray['ERROR_MSG'] = BasicFunctions::prepareData($datareturn->RESP_MSG);
        }

        return $returnArray;
    }

    /*
     * @Description check request by marchant
     * any one Mandatory params
     * @params $merchantOrderNumber
     * @param  $merchantOrderNumber
     */


    function getRequestStatus($request) {

        if($request->getSALT() == null) $request->setSALT(Config::$SALT);
        if($request->getAUTHORISATION() == null) $request->setAUTHORISATION(Config::$AUTHORISATION);


      	$datareturn = BasicFunctions::checkStatus($request);

      	$returnArray = array();

        if ($datareturn->RESP_STATUS==true) {
            $returnArray['TXN_AMOUNT'] = BasicFunctions::getAmountFormat(BasicFunctions::prepareData($datareturn->TXN_AMOUNT));
            $returnArray['MERCH_ORDER_ID'] = BasicFunctions::prepareData($datareturn->MERCH_ORDER_ID);
            $returnArray['TXN_ID'] = BasicFunctions::prepareData($datareturn->TXN_ID);
            $returnArray['TXN_TIME'] = BasicFunctions::prepareData($datareturn->TXN_TIME);
            $returnArray['TXN_STATUS'] = BasicFunctions::prepareData($datareturn->TXN_STATUS);
            $returnArray['BANK_REF_NUMBER'] = BasicFunctions::prepareData($datareturn->BANK_REF_NUMBER);
            $returnArray['RESP_MSG'] = BasicFunctions::prepareData($datareturn->RESP_MSG);
            $returnArray['RESP_CODE'] = BasicFunctions::prepareData($datareturn->RESP_CODE);
            $returnArray['CUST_VPA'] = BasicFunctions::prepareData($datareturn->CUST_VPA);
            $returnArray['CUST_NAME'] = BasicFunctions::prepareData($datareturn->CUST_NAME);
            $returnArray['CUST_EMAIL'] = BasicFunctions::prepareData($datareturn->CUST_EMAIL);
            $returnArray['PARAM1'] = BasicFunctions::prepareData($datareturn->PARAM1);
            $returnArray['PARAM2'] = BasicFunctions::prepareData($datareturn->PARAM2);
            $returnArray['PARAM3'] = BasicFunctions::prepareData($datareturn->PARAM3);
            $returnArray['PARAM4'] = BasicFunctions::prepareData($datareturn->PARAM4);
            $returnArray['PARAM5'] = BasicFunctions::prepareData($datareturn->PARAM5);
            $returnArray['SECURE_HASH'] = BasicFunctions::prepareData($datareturn->SECURE_HASH);

            //check hash data vailid or not

            $dataHash = $returnArray['MERCH_ORDER_ID'] . "|" . $returnArray['TXN_ID'] . "|".$returnArray['BANK_REF_NUMBER']."|".$returnArray['TXN_STATUS']."|".$returnArray['TXN_AMOUNT']."|".$returnArray['TXN_TIME']."|".$request->getSALT();


            $hashKeyNew = hash('sha512',$dataHash);

            if($returnArray['SECURE_HASH']  != $hashKeyNew){
                $returnArray = array();
                $returnArray['ERROR_MSG'] = "Hash Mismatch";
                return $returnArray;
            }

        }
        else{
            $returnArray['ERROR_MSG'] = BasicFunctions::prepareData($datareturn->RESP_MSG);
        }

        return $returnArray;
    }

    /*
     * @Description cancel request by merchant
     * any one Mandatory params
     * @params $merchantOrderNumber
     * @param  $merchantOrderNumber
     */

    function getRequestCancel($request) {

        if ($request->getTXN_AMOUNT()=="" && $request->getTXN_ID()=="") {
            $errorReturn = array();
            $errorReturn["RESP_MSG"] = "INVALID ARGS";
            return $errorReturn;
        }

        $url = Config::$CANCEL_REQUEST;

        $secureHash = hash('sha512', $request->getMERCH_ORDER_ID()."|".$request->getTXN_ID()."|".Config::$SALT);
        $header = BasicFunctions::getHeader($secureHash,Config::$AUTHORISATION);

        $data = json_encode(
            array(
                "MERCH_ORDER_ID" => $request->getMERCH_ORDER_ID(),
                "TXN_ID" => $request->getTXN_ID(),
                "PARAM1" => $request->getPARAM1(),
                "PARAM2" => $request->getPARAM2(),
                "PARAM3" => $request->getPARAM3(),
                "PARAM4" => $request->getPARAM4(),
                "PARAM5" => $request->getPARAM5()
            )
        );

        $datareturn =  BasicFunctions::curlRequest($url,$header,$data);

        $returnArray = array();

        if ($datareturn->RESP_STATUS==true) {
            $returnArray['MERCH_ORDER_ID'] = BasicFunctions::prepareData($datareturn->MERCH_ORDER_ID);
            $returnArray['TXN_ID'] = BasicFunctions::prepareData($datareturn->TXN_ID);
            $returnArray['TXN_STATUS'] = BasicFunctions::prepareData($datareturn->TXN_STATUS);
            $returnArray['BANK_REF_NUMBER'] = BasicFunctions::prepareData($datareturn->BANK_REF_NUMBER);
            $returnArray['RESP_MSG'] = BasicFunctions::prepareData($datareturn->RESP_MSG);
            $returnArray['RESP_CODE'] = BasicFunctions::prepareData($datareturn->RESP_CODE);
            $returnArray['PARAM1'] = BasicFunctions::prepareData($datareturn->PARAM1);
            $returnArray['PARAM2'] = BasicFunctions::prepareData($datareturn->PARAM2);
            $returnArray['PARAM3'] = BasicFunctions::prepareData($datareturn->PARAM3);
            $returnArray['PARAM4'] = BasicFunctions::prepareData($datareturn->PARAM4);
            $returnArray['PARAM5'] = BasicFunctions::prepareData($datareturn->PARAM5);
            $returnArray['SECURE_HASH'] = BasicFunctions::prepareData($datareturn->SECURE_HASH);

            //check hash data vailid or not

            $dataHash = $returnArray['MERCH_ORDER_ID'] . "|" . $returnArray['TXN_ID'] . "|".$returnArray['BANK_REF_NUMBER']."|".$returnArray['TXN_STATUS']."|".Config::$SALT;

            $hashKeyNew = hash('sha512',$dataHash);

            if($returnArray['SECURE_HASH']  != $hashKeyNew){
                $returnArray = array();
                $returnArray['ERROR_MSG'] = "Hash Mismatch";
                return $returnArray;
            }

        }
        else{
            $returnArray['ERROR_MSG'] = BasicFunctions::prepareData($datareturn->RESP_MSG);
        }

        return $returnArray;
    }

}
