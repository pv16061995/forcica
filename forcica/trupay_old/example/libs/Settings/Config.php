<?php

class Config {
	public static $BASE_URL="https://uat.trupay.in/TruPay/";
	public static $AUTHORISATION="69bbb9be-32a0-49df-b7e5-b6583392fce8";
	public static $SALT="7989f1af";
	public static $RET_URL_SUCC="http://10.0.0.66/forcica/success.php";
	public static $RET_URL_FAIL="http://10.0.0.66/forcica/failed.php";


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
