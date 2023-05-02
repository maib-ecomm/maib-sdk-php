<?php
require __DIR__  . '/config.php';

// Get Access Token with Project ID and Project Secret
$auth = MaibAuthRequest::create()->generateToken(PROJECT_ID, PROJECT_SECRET);
$token = $auth->accessToken;

// Set up the payment data
$data = array(
   'payId' => 'f16a9006-128a-46bc-8e2a-77a6ee99df75',
   'confirmAmount' => 10.25
);

// Initiate Payment Capture
$complete = MaibApiRequest::create()->complete($data, $token);

// Receive Payment status and data 
$payId = $complete->payId;
$orderId = $complete->orderId;
$status = $complete->status;
$statusMessage= $complete->statusMessage;
$confirmAmount = $complete->confirmAmount;