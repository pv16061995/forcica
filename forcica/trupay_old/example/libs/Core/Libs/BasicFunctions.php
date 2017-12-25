<?php

require_once  realpath(dirname(__FILE__).'/../../Settings/Config.php');

class BasicFunctions{

	public static function curlRequest($url, $header, $data){

        $post = curl_init();

        curl_setopt($post, CURLOPT_URL, Config::$BASE_URL.$url);
        curl_setopt($post, CURLOPT_POST, 1);
        curl_setopt($post, CURLOPT_HTTPHEADER, $header);
        curl_setopt($post, CURLOPT_POSTFIELDS, $data);
        curl_setopt($post, CURLOPT_USERAGENT, 'Mozilla/5.0');
        curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);
	      curl_setopt($post, CURLOPT_SSL_VERIFYPEER , 0); 

        $datareturn = curl_exec($post);

        curl_close($post);

        return json_decode($datareturn);
  	}

  	public static function prepareData($data){
  		$dataReturn = null;
  		if (!empty($data)) {
  			$dataReturn = $data;
  		}else{
  			if (is_numeric($data)) {
  				$dataReturn=0;
  			}
  			if ($data==null) {
          $datareturn = null;
        }
  			else	$dataReturn ="";
  		}
  		return $dataReturn;
  	}

  	public static function getAmountFormat($amount){
	    $amount+=0;
	    if (strpos($amount, ".") == false) {
	        $amount = (string) number_format((float) $amount, 2,'.','');
	     }
	    return $amount;
  	}


  	public static function getHeader($secureHash,$authorization){
	    $header = [
	            'Content-Type: application/json',
	            "Authorization: Bearer $authorization",
	            'SecureHash:' . $secureHash,
	    ];

	    return $header;
  	}

  	public static function checkStatus($request){

        $url = Config::$MERCHANT_REQUEST_STATUS;

        $secureHash = hash('sha512', $request->getMERCH_ORDER_ID()."|".$request->getTXN_ID()."|".$request->getSALT());

        $header = self::getHeader($secureHash, $request->getAUTHORISATION());
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

       return  self::curlRequest($url,$header,$data);

    }


  public static function getJson($request){
  	$RET_URL_SUCC = null;
    $RET_URL_FAIL = null;
    
    if($request->getRET_URL_SUCC() == null) $RET_URL_SUCC = Config::$RET_URL_SUCC;
    else $RET_URL_SUCC = $request->getRET_URL_SUCC();
    if($request->getRET_URL_FAIL() == null) $RET_URL_FAIL = Config::$RET_URL_FAIL;
    else $RET_URL_FAIL = $request->getRET_URL_FAIL();
    
    return json_encode(
	        array(
	            "MERCH_ORDER_ID" => $request->getMERCH_ORDER_ID(),
              "CUST_EMAIL" => $request->getCUST_EMAIL(),
              "BANK_ACCOUNT_ID" => $request->getBANK_ACCOUNT_ID(),
	            "TXN_AMOUNT" => $request->getTXN_AMOUNT(),
	            "TXN_REMARKS" => $request->getTXN_AMOUNT(),
	            "CUST_NUMBER" => $request->getCUST_NUMBER(),
	            "CUST_VPA" => $request->getCUST_VPA(),
              "MERCH_CUST_NUMBER" => $request->getMERCH_CUST_NUMBER(),
              "MERCH_CUST_EMAIL" => $request->getMERCH_CUST_EMAIL(),
	            "DEVICE_ID" => $request->getDEVICE_ID(),
              "COLLECTOR_ID" => $request->getCOLLECTOR_ID(),
              "SELLER_NAME" => $request->getSELLER_NAME(),
              "REDIRECT_ON_CANCEL" => $request->getREDIRECT_ON_CANCEL(),
              "RET_URL_SUCC" => $RET_URL_SUCC,
              "RET_URL_FAIL" => $RET_URL_FAIL,
	            "PARAM1"=>$request->getPARAM1(),
	            "PARAM2"=>$request->getPARAM2(),
	            "PARAM3"=>$request->getPARAM3(),
	            "PARAM4"=>$request->getPARAM4(),
	            "PARAM5"=>$request->getPARAM5()
	            )
	        );
  }

  	public static function formJsonArray($data,$request){
  		$returnArray = array();
  		$returnArray['TXN_AMOUNT'] = self::getAmountFormat(self::prepareData($data->TXN_AMOUNT));
  		$returnArray['MERCH_ORDER_ID'] = self::prepareData($data->MERCH_ORDER_ID);
  		$returnArray['API_KEY'] = self::prepareData($data->API_KEY);
  		$returnArray['RESP_MSG'] = self::prepareData($data->RESP_MSG);
  		$returnArray['CUST_NUMBER'] = self::prepareData($data->CUST_NUMBER);
  		$returnArray['CUST_VPA'] = self::prepareData($data->CUST_VPA);
  		$returnArray['SELLER_NAME'] = self::prepareData($data->SELLER_NAME);
  		$returnArray['CSRF_TOKEN'] = self::prepareData($data->CSRF_TOKEN);
      $returnArray['MERCH_CUST_NUMBER'] = self::prepareData($data->MERCH_CUST_NUMBER);
      $returnArray['MERCH_CUST_EMAIL'] = self::prepareData($data->MERCH_CUST_EMAIL);
  		$returnArray['PAY_METHODS'] = self::prepareData($data->PAY_METHODS);
  		$returnArray['RET_URL_SUCC'] = self::prepareData($data->RET_URL_SUCC);
  		$returnArray['RET_URL_FAIL'] = self::prepareData($data->RET_URL_FAIL);

  		$returnArray['API_URL'] = self::prepareData($data->API_URL);
  		
  		$returnArray['PARAM1'] = self::prepareData($data->PARAM1);
  		$returnArray['PARAM2'] = self::prepareData($data->PARAM2);
  		$returnArray['PARAM3'] = self::prepareData($data->PARAM3);
  		$returnArray['PARAM4'] = self::prepareData($data->PARAM4);
  		$returnArray['PARAM5'] = self::prepareData($data->PARAM5);
        
        $secureHash = self::prepareData($data->SECURE_HASH);    
        $dataHash = $returnArray['MERCH_ORDER_ID'].'|'.$returnArray['TXN_AMOUNT']."|".$returnArray['CSRF_TOKEN']."|".$returnArray['API_KEY']."|".$request->getSALT();
        $hashKeyNew = hash('sha512', $dataHash);

        if($secureHash != $hashKeyNew){
            $returnArray = array();
            $returnArray['ERROR_MSG'] = "Hash Mismatch";
            return $returnArray;
        }
        return $returnArray;
  	} 
}
