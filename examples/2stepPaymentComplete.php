<?php
require __DIR__  . '/config.php';

// Get Access Token with Project ID and Project Secret
$auth = MaibAuthRequest::create()->generateToken(PROJECT_ID, PROJECT_SECRET);
$token = $auth->accessToken;

// Set up the payment data
$data = array(
   'payId' => '6ca6f3b5-cd10-4d92-9933-bc5808fdcdbd',
   'confirmAmount' => 10.25
);

// Initiate 2-Step Payment Capture
$complete = MaibApiRequest::create()->complete($data, $token);

// Display request response
$jsonData = json_encode($complete);
echo $jsonData;

// Receive Payment status and data 
$payId = $complete->payId;
$orderId = $complete->orderId;
$cardNumber = $complete->cardNumber;
$status = $complete->status;
$statusMessage= $complete->statusMessage;
$confirmAmount = $complete->confirmAmount;
