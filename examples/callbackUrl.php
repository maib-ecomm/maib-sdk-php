<?php
require __DIR__ . '/config.php';

$json = file_get_contents('php://input');
$data = json_decode($json, true);

// Check if the signature is present
if (isset($data['signature'])) {
    $data_result = $data['result']; // Extract data from the "result" object

    $sortedDataByKeys = sortByKeyRecursive($data_result); // Sort the data array by keys recursively
    $sortedDataByKeys[] = SIGNATURE_KEY; // Add the Signature Key to the end of the data array
    $signString = implodeRecursive(':', $sortedDataByKeys); // Implode the sorted array recursively
    $sign = generateSignature($signString); // Generate the signature

    // Compare the generated signature with the received signature on the Callback URL
    if ($sign === $data['signature']) {
        // Signature is valid, process the data
        // ...
    } else {
        // Signature is invalid, reject the request
        // ...
    }
}

/**
 * Sorts an array by keys recursively.
 *
 * @param array $array The array to be sorted.
 * @return array The sorted array.
 */
function sortByKeyRecursive(array $array)
{
    ksort($array, SORT_STRING);
    foreach ($array as $key => &$value) {
        if (is_array($value)) {
            $value = sortByKeyRecursive($value);
        }
    }
    unset($value); // Unset the reference variable to avoid potential issues
    return $array;
}

/**
 * Implode an array recursively with a separator.
 *
 * @param string $separator The separator string.
 * @param array $array The array to be imploded.
 * @return string The imploded string.
 */
function implodeRecursive($separator, $array)
{
    $result = '';
    foreach ($array as $item) {
        $result .= (is_array($item) ? implodeRecursive($separator, $item) : (string)$item) . $separator;
    }
    return substr($result, 0, -1);
}

/**
 * Generate the signature for the given string.
 *
 * @param string $string The string to generate the signature from.
 * @return string The generated signature.
 */
function generateSignature($string)
{
    return base64_encode(hash('sha256', $string, true));
}
