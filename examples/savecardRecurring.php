<?php
require __DIR__  . '/config.php';

// Get Access Token with Project ID and Project Secret
$auth = MaibAuthRequest::create()->generateToken(PROJECT_ID, PROJECT_SECRET);
$token = $auth->accessToken;

// Set up the request data
$data = array(
    'billerExpiry' => '1230',
    'amount' => 6.25,
    'currency' => 'USD',
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
    'failUrl' => 'https://example.com/fail'
);

// Initiate Recurring Payment (Card Registration)
$saveRecurring = MaibApiRequest::create()->saveRecurring($data, $token);

// Save payId in your system
$payUrl = $saveRecurring->payUrl;
$payId = $saveRecurring->payId;
$orderId = $saveRecurring->orderId;

// Redirect Client to maib checkout page
header("Location: " . $payUrl);
die;

// Payment status and data will be sent to the Callback URL
