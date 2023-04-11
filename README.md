# maib-sdk-php
PHP SDK for maib Ecommerce API

API docs: https://docs.maibmerchants.md

It is necessary to be registered on [maibmerchants](https://maibmerchants.md).

## Requirements
PHP >= 5.6

The following PHP extensions are required:

 * curl
 * json
## Install
### Composer
Install via Composer:
```
composer require maib-ecomm/maib-sdk-php
```
To use the package, use Composer's autoload:
```
require "vendor/autoload.php";
```
### Manual
Download the latest release and include the config.php file in your project.
```
require_once('/path/to/examples/config.php');
```
## Getting started
Add SDK class:
```
<?php 
require_once 'vendor/autoload.php';
use MaibEcomm\MaibSdkPhp;
```
Add configurations:
```
define('PROJECT_ID', 'YOUR_PROJECT_ID');
define('PROJECT_SECRET', 'YOUR_PROJECT_SECRET');
define('SIGNATURE_KEY', 'YOUR_SIGNATURE_SECRET');
```
Project Secret and Signature Key are available after Project activation.

The Signature Key is required to validate the notification signature on the Callback URL (/examples/callbackUrl.php).
## SDK usage examples and sample code
### Get Access Token with Project ID and Project Secret:
```
$auth = MaibAuth::getInstance()->generateToken(PROJECT_ID, PROJECT_SECRET);
// Save received data in your DB
$token = $auth->accessToken;
$tokenExpiresAt = time() + $auth->expiresIn;
$refreshToken = $auth->refreshToken;
$refreshExpiresAt = time() + $auth->refreshExpiresIn;
```
### Get Access Token with Refresh Token:
```
$auth = MaibAuth::getInstance()->generateToken($refreshToken);
// Save received data in your DB
$token = $auth->accessToken;
$tokenExpiresAt = time() + $auth->expiresIn;
$refreshToken = $auth->refreshToken;
$refreshExpiresAt = time() + $auth->refreshExpiresIn;
```
### Direct Payment:
```
// Set up payment required data
$data = array(
    'amount' => 10.25,
    'currency' => 'EUR',
    'clientIp' => '135.250.245.121'
);

// Initiate Direct Payment
$pay = MaibApi::getInstance()->pay($data, $token);

// Save payment ID in your DB
$payUrl = $pay->payUrl;
$payId = $pay->payId;

// Redirect Client to maib checkout page
header("Location: " . $payUrl);
die;
```
Payment status and data you will receive on the Callback URL.

### Two-Step Payment. Payment authorization (hold):
```
// Set up payment required data
$data = array(
    'amount' => 10.25,
    'currency' => 'EUR',
    'clientIp' => '135.250.245.121'
);

// Initiate payment authorization
$pay = MaibApi::getInstance()->pay($data, $token);

// Save payment ID in your DB
$payUrl = $pay->payUrl;
$payId = $pay->payId;

// Redirect Client to maib checkout page
header("Location: " . $payUrl);
die;
```
Payment status and data you will receive on the Callback URL.

### Two-Step Payment. Payment capture (complete):
```
// Set up Payment ID
$data = array(
   'payId' => 'f16a9006-128a-46bc-8e2a-77a6ee99df75'
);

// Complete 2-Step Payment
$complete = MaibApi::getInstance()->complete($data, $token);

// Update Payment status in your DB
$payId = $complete->payId;
$orderId = $complete->orderId;
$status = $complete->status;
$statusMessage= $complete->statusMessage;
$confirmAmount = $complete->confirmAmount;
```

### Refund Payment:
```
// Set up Payment ID
$data = array(
   'payId' => 'f16a9006-128a-46bc-8e2a-77a6ee99df75'
);

// Initiate Refund Payment
$pay = MaibApi::getInstance()->refund($data, $token);

// Update Payment status in your DB
$payId = $pay->payId;
$status = $pay->status;
$statusMessage= $pay->statusMessage;
$refundAmount = $pay->refundAmount;
```
### Payment Information:
```
// Set up Payment ID
$id = "f16a9006-128a-46bc-8e2a-77a6ee99df75";

// Initiate Payment Info
$payInfo = MaibApi::getInstance()->payInfo($id, $token);

// Receive Payment status and data 
$payId = $payInfo->payId;
$status = $payInfo->status;
$statusMessage= $payInfo->statusMessage;
$amount = $payInfo->amount;
$currency = $payInfo->currency;
```

