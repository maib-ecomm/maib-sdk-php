<?php
require __DIR__  . '/config.php';

// Get Access Token with Project ID and Project Secret
$auth = MaibAuthRequest::create()->generateToken(PROJECT_ID, PROJECT_SECRET);
$token = $auth->accessToken;

// Set up the request data
$data = array(
    'billerId' => 't78i8006-458a-46bc-9e0a-89a6ee11df68',
    'amount' => 6.25,
    'currency' => 'EUR',
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

// Initiate execute Recurring Payment
$executeRecurring = MaibApiRequest::create()->executeRecurring($data, $token);

// Display Recurring Payment status and data 
$jsonData = json_encode($executeRecurring);
echo $jsonData;

// Receive Recurring Payment status and data 
$billerId = $executeRecurring->billerId;
$payId = $executeRecurring->payId;
$orderId = $executeRecurring->orderId;
$status = $executeRecurring->status;
$statusMessage= $executeRecurring->statusMessage;
$amount = $executeRecurring->amount;
$currency = $executeRecurring->currency;
