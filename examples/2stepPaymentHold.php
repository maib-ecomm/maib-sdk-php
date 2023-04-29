<?php
require __DIR__  . '/config.php';

// Get Access Token with Project ID and Project Secret
$auth = MaibAuthFactory::create()->generateToken(PROJECT_ID, PROJECT_SECRET);
$token = $auth->accessToken;

// Set up the payment data
$data = array(
    'amount' => 10.25,
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
        ),
        array(
            'id' => '11',
            'name' => 'Product 2',
            'price' => 4,
            'quantity' => 1
        )
    ),
    'callbackUrl' => 'https://example.com/callback',
    'okUrl' => 'https://example.com/ok',
    'failUrl' => 'https://examplecom/fail'
);

// Initiate Payment Authorization
$hold = MaibApiFactory::create()->hold($data, $token);

// Save payId in your system
$payUrl = $hold->payUrl;
$payId = $hold->payId;
$orderId = $hold->orderId;

// Redirect Client to maib checkout page
header("Location: " . $payUrl);
die;

// Payment status and data you will receive on the Callback URL