<?php
require __DIR__ . '/../src/MaibAuthRequest.php';
require __DIR__ . '/../src/MaibApiRequest.php';
require __DIR__ . '/../src/MaibSdk.php';

use MaibEcomm\MaibSdk\MaibAuthRequest;
use MaibEcomm\MaibSdk\MaibApiRequest;

// Project settings from maibmerchants.md
// Project Secret and Signature Key are available after Project activation
define('PROJECT_ID', 'YOUR_PROJECT_ID');
define('PROJECT_SECRET', 'YOUR_PROJECT_SECRET');
define('SIGNATURE_KEY', 'YOUR_SIGNATURE_SECRET');
