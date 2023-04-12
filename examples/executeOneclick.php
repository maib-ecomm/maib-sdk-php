<?php
require dirname(__FILE__) . '/config.php';

// Get Access Token with Project ID and Project Secret
$auth = MaibAuth::getInstance()->generateToken(PROJECT_ID, PROJECT_SECRET);
$token = $auth->accessToken;

// Set up the request data
$data = array(
    'billerId' => 't78i8006-458a-46bc-9e0a-89a6ee11df68',
    'amount' => 6.25,
    'currency' => 'EUR',
    'clientIp' => '135.250.245.121',
    'language' => 'en',
    'description' => 'Description',
    'orderId' => '123',
    'delivery' => 1.25,
    'items' => array(
        array(
            'id' => '10',
            'name' => 'Product 1',
            'price' => 2.50,
            'quantity' => 2
        )
    ),
    'callbackUrl' => 'https://example.com/callback',
    'okUrl' => 'https://example.com/ok',
    'failUrl' => 'https://examplecom/fail'
);

// Initiate Execute One-click Payment
$executeOneclick = MaibApi::getInstance()->executeOneclick($data, $token);

// Save payId in your system
$payUrl = $executeOneclick->payUrl;
$payId = $executeOneclick->payId;
$orderId = $executeOneclick->orderId;

// Redirect Client to maib checkout page
//header("Location: " . $payUrl);
//die;

// Payment status and data you will receive on the Callback URL