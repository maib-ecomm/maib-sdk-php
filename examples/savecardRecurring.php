<?php
require dirname(__FILE__) . '/config.php';

// Get Access Token with Project ID and Project Secret
$auth = MaibAuth::getInstance()->generateToken(PROJECT_ID, PROJECT_SECRET);
$token = $auth->accessToken;

// Set up the request data
$data = array(
    'billerExpiry' => '1230',
    'amount' => 6.25,
    'currency' => 'EUR',
    'clientIp' => '135.250.245.121',
    'language' => 'en',
    'description' => 'Description',
    'clientName' => 'Customer Name',
    'email' => 'customer@gmail.com',
    'phone' => '069123456',
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

// Initiate Direct Payment
$saveRecurring = MaibApi::getInstance()->saveRecurring($data, $token);

// Save payId in your system
$payUrl = $saveRecurring->payUrl;
$payId = $saveRecurring->payId;
$orderId = $saveRecurring->orderId;

// Redirect Client to maib checkout page
header("Location: " . $payUrl);
die;

// Payment status and data you will receive on the Callback URL