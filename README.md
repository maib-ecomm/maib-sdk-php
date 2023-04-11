# maib-sdk-php
PHP SDK for maib Ecommerce API

API docs: https://docs.maibmerchants.md

It is necessary to be registered on [maibmerchants](https://maibmerchants.md).

## Requirements
PHP >= 5.6

The following extensions are required in order to work properly:

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

$token = $auth->accessToken;
$tokenExpiresAt = time() + $auth->expiresIn;
$refreshToken = $auth->refreshToken;
$refreshExpiresAt = time() + $auth->refreshExpiresIn;
```
### Get Access Token with Refresh Token:
```
$auth = MaibAuth::getInstance()->generateToken($refreshToken);

$token = $auth->accessToken;
$tokenExpiresAt = time() + $auth->expiresIn;
$refreshToken = $auth->refreshToken;
$refreshExpiresAt = time() + $auth->refreshExpiresIn;
```









