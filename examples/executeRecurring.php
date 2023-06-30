<?php
require __DIR__  . '/config.php';

// Get Access Token with Project ID and Project Secret
$auth = MaibAuthRequest::create()->generateToken(PROJECT_ID, PROJECT_SECRET);
$token = $auth->accessToken;

// Set up the request data
$data = array(
    'billerId' => '8a90269f-cebd-4b23-1f85-08db7982298c',
    'amount' => 6.25,
    'currency' => 'USD',
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
    )
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
