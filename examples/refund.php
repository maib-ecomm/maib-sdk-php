<?php
require __DIR__  . '/config.php';

// Get Access Token with Project ID and Project Secret
$auth = MaibAuthRequest::create()->generateToken(PROJECT_ID, PROJECT_SECRET);
$token = $auth->accessToken;

// Set up Refund parameters
$data = array(
   'payId' => '530d6df6-bfee-47a5-af9a-dd8b3d3a94e4',
   'refundAmount' => 10.25
);

// Initiate Payment Refund 
$refund = MaibApiRequest::create()->refund($data, $token);

// Display request response
$jsonData = json_encode($refund);
echo $jsonData;

// Receive Refund status and data
$payId = $refund->payId;
$status = $refund->status;
$statusMessage= $refund->statusMessage;
