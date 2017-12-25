<?php 

  $curl = curl_init();
  curl_setopt_array($curl, array(
  CURLOPT_URL => "https://uatm.trupay.in/merchant/api/ver1/txn/status",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\n\n\t\"MERCH_ORDER_ID\": \"68255737\",\n\t\"REQUEST_ID\":\"68255737\"\n\n}",
  CURLOPT_HTTPHEADER => array(
    "accept-encoding: application/json",
    "authorization: Bearer b9fe552d-af25-49ff-b5f8-7db54f66321a",
    "cache-control: no-cache",
    "content-type: application/json",
    "postman-token: b8227a68-cf0d-aeba-2f61-aaeea1de6694",
    "securehash: 54df282d312405e7655180f64d327931f7ac04ced0a1b2055ccae22537d00f2ae81494417a57a88d1ba2df7f9a872f6d5e50546cba25a93f35958d123a73b4cd"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}



/* $arr=array();

$arr[]=array(
				'name'=>'Prateek Verma',
				'email'=>'prateek@intouchgroup.in',
				'MERCH_ORDER_ID'=>'82643337',
			);
			
print_r($arr);
echo "<br><br><br><br>";
echo json_encode($arr); */


/* $request = new HttpRequest();
$request->setUrl('https://uatm.trupay.in/merchant/api/ver1/txn/status');
$request->setMethod(HTTP_METH_POST);

$request->setHeaders(array(
  'postman-token' => '63a6c2f1-6e60-aaf4-383a-0331b2c1c975',
  'cache-control' => 'no-cache',
  'securehash' => '54df282d312405e7655180f64d327931f7ac04ced0a1b2055ccae22537d00f2ae81494417a57a88d1ba2df7f9a872f6d5e50546cba25a93f35958d123a73b4cd',
  'content-type' => 'application/json',
  'authorization' => 'Bearer b9fe552d-af25-49ff-b5f8-7db54f66321a',
  'accept-encoding' => 'application/json'
));
$request->setBody('{
    "MERCH_ORDER_ID": "68255737",
    "REQUEST_ID":"68255737"
}');
try {
  $response = $request->send();

  echo $response->getBody();
} catch (HttpException $ex) {
  echo $ex;
} */ 

/* 
$client = new http\Client;
$request = new http\Client\Request;

$body = new http\Message\Body;
$body->append('{

    "MERCH_ORDER_ID": "68255737",
    "REQUEST_ID":"68255737"

}');

$request->setRequestUrl('https://uatm.trupay.in/merchant/api/ver1/txn/status');
$request->setRequestMethod('POST');
$request->setBody($body);

$request->setHeaders(array(
  'postman-token' => 'eba066bc-821f-3370-4012-df1831ee8aca',
  'cache-control' => 'no-cache',
  'securehash' => '54df282d312405e7655180f64d327931f7ac04ced0a1b2055ccae22537d00f2ae81494417a57a88d1ba2df7f9a872f6d5e50546cba25a93f35958d123a73b4cd',
  'content-type' => 'application/json',
  'authorization' => 'Bearer b9fe552d-af25-49ff-b5f8-7db54f66321a',
  'accept-encoding' => 'application/json'
));

$client->enqueue($request)->send();
$response = $client->getResponse();

echo $response->getBody(); */



?>