<?php
require __DIR__  . '/config.php';

// Get Access Token with Project ID and Project Secret
$auth = MaibAuthFactory::create()->generateToken(PROJECT_ID, PROJECT_SECRET);
$token = $auth->accessToken;

// Payment ID example
$id = 'f16a9006-128a-46bc-8e2a-77a6ee99df75';

// Initiate Payment Info
$payInfo = MaibApiFactory::create()->payInfo($id, $token);

// Receive Payment status and data 
$payId = $payInfo->payId;
$orderId = $payInfo->orderId;
$status = $payInfo->status;
$statusMessage= $payInfo->statusMessage;
$amount = $payInfo->amount;
$currency = $payInfo->currency;