<?php
require dirname(__FILE__) . '/config.php';

// Get Access Token with Project ID and Project Secret
$auth = MaibAuth::getInstance()->generateToken(PROJECT_ID, PROJECT_SECRET);
$token = $auth->accessToken;

//Example format ID
$id = "f16a9006-128a-46bc-8e2a-77a6ee99df75";

// Initiate Payment Info
$delete = MaibApi::getInstance()->deleteCard($id, $token);

// Receive Payment status and data 
$billerId = $delete->billerId;
$status = $delete->status;
