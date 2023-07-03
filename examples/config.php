<?php
require __DIR__ . '/../src/MaibAuthRequest.php';
require __DIR__ . '/../src/MaibApiRequest.php';
require __DIR__ . '/../src/MaibSdk.php';
class_alias("MaibEcomm\MaibSdk\MaibAuthRequest", "MaibAuthRequest");
class_alias("MaibEcomm\MaibSdk\MaibApiRequest", "MaibApiRequest");

// Project settings from maibmerchants.md
// Project Secret and Signature Key are available after Project activation
define('PROJECT_ID', 'YOUR_PROJECT_ID');
define('PROJECT_SECRET', 'YOUR_PROJECT_SECRET');
define('SIGNATURE_KEY', 'YOUR_SIGNATURE_SECRET');
