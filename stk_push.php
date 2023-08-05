<?php
include 'accessToken.php';
date_default_timezone_set('Africa/Nairobi');
$processrequestUrl='https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
$callbackurl="";
$passkey="bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
$BusinessShortCode='174379';
$Timestamp=date('YmdHis');
$Password=base64_encode($BusinessShortCode.$passkey.$Timestamp);
$phone='254718183781';
$money='1';
$PartyA=$phone;
$PartyB='254708374149';
$AccountReference='27775755';
$TransactionDesc='Loan payment';
$Amount=$money;
$stkpushheader=['Content-Type:application/json','Authorization:Bearer '.$access_token];
$curl=curl_init();
curl_setopt($curl,CURLOPT_URL,$processrequestUrl);
curl_setopt($curl,CURLOPT_HTTPHEADER,$stkpushheader);
$curl_post_data=array(
    'BusinessShortCode'=>$BusinessShortCode,
    'Password'=>$Password,
    'Timestamp'=>$Timestamp,
    'TransactionType'=>'CustomerPayBillOnline',
    'Amount'=>$Amount,
    'PartyA'=>$PartyA,
    'PartyB'=>$BusinessShortCode,
    'PhoneNumber'=>$PartyA,
    'CallBackURL'=>$callbackurl,
    'AccountReference'=>$AccountReference,
    'TransactionDesc'=>$TransactionDesc
);
$data_string=json_encode($curl_post_data);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,TRUE);
curl_setopt($curl,CURLOPT_POST,TRUE);
curl_setopt($curl,CURLOPT_POSTFIELDS,$data_string);
$curl_response=curl_exec($curl);
echo $curl_response;