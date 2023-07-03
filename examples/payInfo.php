<?php
require __DIR__  . '/config.php';

// Get Access Token with Project ID and Project Secret
$auth = MaibAuthRequest::create()->generateToken(PROJECT_ID, PROJECT_SECRET);
$token = $auth->accessToken;

// Payment ID example
$id = '7c369f7f-140d-469c-b3ef-b7d06f2f8823';

// Initiate Payment Info
$payInfo = MaibApiRequest::create()->payInfo($id, $token);

// Display request response
$jsonData = json_encode($payInfo);
echo $jsonData;

// Receive Payment Info 
$payId = $payInfo->payId;
$status = $payInfo->status;
$statusMessage = $payInfo->statusMessage;
$amount = $payInfo->amount;
$currency = $payInfo->currency;
$cardNumber = $payInfo->cardNumber;
$rrn = $executeRecurring->rrn;
$approval = $executeRecurring->approval;
