<?php
require __DIR__  . '/config.php';

// Get Access Token with Project ID and Project Secret
$auth = MaibAuthFactory::create()->generateToken(PROJECT_ID, PROJECT_SECRET);
$token = $auth->accessToken;

// Set up Refund parameters
$data = array(
   'payId' => 'f16a9006-128a-46bc-8e2a-77a6ee99df75',
   'refundAmount' => 10.25
);

// Initiate Payment Refund 
$refund = MaibApiFactory::create()->refund($data, $token);

// Update Payment status in your DB
$payId = $refund->payId;
$status = $refund->status;
$statusMessage= $refund->statusMessage;
$refundAmount = $refund->refundAmount;