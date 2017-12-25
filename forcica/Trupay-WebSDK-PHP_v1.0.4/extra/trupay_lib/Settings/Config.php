<?php

class Config {
	public static $BASE_URL="https://uat.trupay.in/TruPay/";
	public static $AUTHORISATION="";
	public static $SALT="";
	public static $RET_URL_SUCC="";
	public static $RET_URL_FAIL="";


	public static function startSession(){
		if (session_status() == PHP_SESSION_NONE) {
    		session_start();
		}
	}

	public static $WEB_SESSION_URL="v1/api/getOneTimeWebSessionKey";
	public static $MERCHANT_REQUEST_STATUS= "v1/api/merchantRequestStatus";

	public static $REQUEST_MONEY = "v1/api/merchantRequestMoney";
	public static $CANCEL_REQUEST= "v1/api/cancelRequest";
}
