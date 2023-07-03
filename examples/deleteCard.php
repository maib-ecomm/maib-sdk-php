<?php
require __DIR__  . '/config.php';

// Get Access Token with Project ID and Project Secret
$auth = MaibAuthRequest::create()->generateToken(PROJECT_ID, PROJECT_SECRET);
$token = $auth->accessToken;

//Example format ID
$id = "f16a9006-128a-46bc-8e2a-77a6ee99df75";

// Initiate Delete Card (onec-click and recurring payments)
$deleteCard = MaibApiRequest::create()->deleteCard($id, $token);

// Display request response
$jsonData = json_encode($deleteCard);
echo $jsonData;

// Receive request data 
$billerId = $deleteCard->billerId;
$status = $deleteCard->status;
