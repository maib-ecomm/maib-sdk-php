<?php
// require_once 'vendor/autoload.php';
use MaibEcomm\MaibSdk;
// use MaibEcomm\MaibSdk\MaibApi;
// use MaibEcomm\MaibSdk\MaibSdk;

// Uncoment for use whitout Composer

require dirname(__FILE__) . '/../src/MaibAuth.php';
require dirname(__FILE__) . '/../src/MaibApi.php';
require dirname(__FILE__) . '/../src/MaibSdk.php';

// Project settings from maibmerchants.md
// Project Secret and Signature Key are available after Project activation
define('PROJECT_ID', 'YOUR_PROJECT_ID');
define('PROJECT_SECRET', 'YOUR_PROJECT_SECRET');
define('SIGNATURE_KEY', 'YOUR_SIGNATURE_SECRET');