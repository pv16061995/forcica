<?php

class Request{

	private $CUST_NUMBER=null,
       

        $CUST_EMAIL=null,
        $BANK_ACCOUNT_ID=null,
        $TXN_AMOUNT=null,
        $TXN_REMARKS=null,
        $MERCH_ORDER_ID=null,
        $TXN_ID=null,
        $CUST_VPA=null,
        $MERCH_CUST_NUMBER = null,
        $MERCH_CUST_EMAIL = null,
        $RET_URL_SUCC = null,
        $RET_URL_FAIL = null,
        $REDIRECT_ON_CANCEL = null,
        $SELLER_NAME = null,
        $DEVICE_ID=null,
        $COLLECTOR_ID = null,
        $PARAM1=null,
        $PARAM2=null,
        $PARAM3=null,
        $PARAM4=null,
        $PARAM5=null,
        $AUTHORISATION=null,
        $SALT=null;

  
    
    public function setTXN_ID($TXN_ID)
    {
        $this->TXN_ID = $TXN_ID;
    }
	public function setCUST_EMAIL($CUST_EMAIL){
		$this->CUST_EMAIL = $CUST_EMAIL;
	}
	public function setCUST_NUMBER($CUST_NUMBER){
		$this->CUST_NUMBER = $CUST_NUMBER;
	}
	public function setMERCH_CUST_EMAIL($MERCH_CUST_EMAIL){
		$this->MERCH_CUST_EMAIL = $MERCH_CUST_EMAIL;
	}
	public function setMERCH_CUST_NUMBER($MERCH_CUST_NUMBER){
		$this->MERCH_CUST_NUMBER = $MERCH_CUST_NUMBER;
	}
	public function setBANK_ACCOUNT_ID($BANK_ACCOUNT_ID){
			$this->BANK_ACCOUNT_ID = $BANK_ACCOUNT_ID;
	}
	public function setTXN_AMOUNT($TXN_AMOUNT){
		$this->TXN_AMOUNT = $TXN_AMOUNT;
	}
	public function setTXN_REMARKS($TXN_REMARKS){
		$this->TXN_REMARKS = $TXN_REMARKS;
	}
	public function setMERCH_ORDER_ID($MERCH_ORDER_ID){
		$this->MERCH_ORDER_ID = $MERCH_ORDER_ID;
	}
	public function setCUST_VPA($CUST_VPA){
		$this->CUST_VPA = $CUST_VPA;
	}
	public function setDEVICE_ID($DEVICE_ID){
		$this->DEVICE_ID = $DEVICE_ID;
	}
	public function setRET_URL_SUCC($RET_URL_SUCC){
		$this->RET_URL_SUCC = $RET_URL_SUCC;
	}
	public function setRET_URL_FAIL($RET_URL_FAIL){
		$this->RET_URL_FAIL = $RET_URL_FAIL;
	}
	public function setREDIRECT_ON_CANCEL($REDIRECT_ON_CANCEL){
		$this->REDIRECT_ON_CANCEL = $REDIRECT_ON_CANCEL;
	}
	public function setSELLER_NAME($SELLER_NAME){
		$this->SELLER_NAME = $SELLER_NAME;
	}
	public function setCOLLECTOR_ID($COLLECTOR_ID){
		$this->COLLECTOR_ID = $COLLECTOR_ID;
	}
	public function setPARAM1($PARAM1){
		$this->PARAM1 = $PARAM1;
	}
	public function setPARAM2($PARAM2){
		$this->PARAM2 = $PARAM2;
	}
	public function setPARAM3($PARAM3){
		$this->PARAM3 = $PARAM3;
	}
	public function setPARAM4($PARAM4){
		$this->PARAM4 = $PARAM4;
	}
	public function setPARAM5($PARAM5){
		$this->PARAM5 = $PARAM5;
	}
	public function setAUTHORISATION($AUTHORISATION){
		$this->AUTHORISATION = $AUTHORISATION;
	}
	public function setSALT($SALT){
		$this->SALT = $SALT;
	}

	


	public function getTXN_ID()
    {
        return $this->TXN_ID;
    }
	public function getCUST_EMAIL(){
		return $this->CUST_EMAIL;
	}
	public function getCUST_NUMBER(){
		return $this->CUST_NUMBER;
	}
	public function getMERCH_CUST_EMAIL(){
		return $this->MERCH_CUST_EMAIL;
	}
	public function getMERCH_CUST_NUMBER(){
		return $this->MERCH_CUST_NUMBER;
	}
	public function getBANK_ACCOUNT_ID(){
		return $this->BANK_ACCOUNT_ID;
	}
	public function getTXN_AMOUNT(){
		return $this->TXN_AMOUNT;
	}
	public function getTXN_REMARKS(){
		return $this->TXN_REMARKS;
	}
	public function getMERCH_ORDER_ID(){
		return $this->MERCH_ORDER_ID;
	}
	public function getCUST_VPA(){
		return $this->CUST_VPA;
	}
	public function getDEVICE_ID(){
		return $this->DEVICE_ID;
	}
	public function getRET_URL_SUCC(){
		return $this->RET_URL_SUCC;
	}
	public function getRET_URL_FAIL(){
		return $this->RET_URL_FAIL;
	}
	public function getSELLER_NAME(){
		return $this->SELLER_NAME;
	}
	public function getREDIRECT_ON_CANCEL(){
		return $this->REDIRECT_ON_CANCEL;
	}
	public function getCOLLECTOR_ID(){
		return $this->COLLECTOR_ID;
	}
	public function getPARAM1(){
		return $this->PARAM1;
	}
	public function getPARAM2(){
		return $this->PARAM2;
	}
	public function getPARAM3(){
		return $this->PARAM3;
	}
	public function getPARAM4(){
		return $this->PARAM4;
	}
	public function getPARAM5(){
		return $this->PARAM5;
	}
	public function getAUTHORISATION(){
		return $this->AUTHORISATION;
	}
	public function getSALT(){
		return $this->SALT;
	}


}