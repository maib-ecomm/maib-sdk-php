<?php
require __DIR__  . '/config.php';

$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (isset($data['signature'])) {
$data_result = $data['result']; // Data from "result" object

function sortByKeyRecursive(array $array) {
    ksort($array, SORT_STRING);
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $array[$key] = sortByKeyRecursive($value);
        }
    }
    return $array;
}

function implodeRecursive($separator, $array) {
    $result = '';
    foreach ($array as $item) {
        $result .= (is_array($item) ? implodeRecursive($separator, $item) : (string)$item) . $separator;
    }

    return substr($result, 0, -1);
}

$sortedDataByKeys = sortByKeyRecursive($data_result); //Sort an array by key recursively
$sortedDataByKeys[] = SIGNATURE_KEY; //Add Signature Key to the end of data array
$signString = implodeRecursive(':', $sortedDataByKeys); // Implode array recursively
$sign = base64_encode(hash('sha256', $signString, true)); // Generate signature 

if ($sign === $data['signature']) // Compare the generated signature with the received signature on Callback URL
{
  echo "Signature is valid!"; 
  // Signature is valid, process the data from $data['result']

} else {
  echo "Signature is invalid!"; 
  // Signature is invalid, reject the request
}
}