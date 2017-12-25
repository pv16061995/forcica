<?php

class Config {
	public static $BASE_URL="https://uat.trupay.in/TruPay/";
	public static $AUTHORISATION="b9fe552d-af25-49ff-b5f8-7db54f66321a";
	public static $SALT="f06e5da4";
	public static $RET_URL_SUCC="http://10.0.0.66/forcica/Trupay-WebSDK-PHP_v1.0.4/trupay/example/success.php";
	public static $RET_URL_FAIL="http://10.0.0.66/forcica/Trupay-WebSDK-PHP_v1.0.4/trupay/example/failed.php";


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
