# maib-sdk-php
PHP SDK for maib Ecommerce API

API docs: https://docs.maibmerchants.md

It is necessary to be registered on [maibmerchants](https://maibmerchants.md)

## Requirements
PHP >= 5.6

The following extensions are required in order to work properly:

 * curl
 * json
## Install
### Composer
You can install the SDK via Composer:
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
Add class:
```
<?php 
require_once 'vendor/autoload.php';
use MaibEcomm\MaibSdkPhp;
```
Setting Configuration:
```
define('PROJECT_ID', 'YOUR_PROJECT_ID');
define('PROJECT_SECRET', 'YOUR_PROJECT_SECRET');
define('SIGNATURE_KEY', 'YOUR_SIGNATURE_SECRET');
```

### 









