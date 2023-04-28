<?php

namespace MaibEcomm\MaibSdk;

use RuntimeException;

class PaymentException extends RuntimeException {}

class MaibApi
{
    private $httpClient;

    private function __construct()
    {
        $this->httpClient = new MaibSdk();
    }

    public static function getInstance()
    {
        static $instance;
        if (!isset($instance)) {
            $instance = new MaibApi();
        }
        return $instance;
    }
    
    /**
     * Sends a request to the pay endpoint.
     *
     * @param array $data The parameters for the request.
     * @param string $token The authentication token.
     * @throws PaymentException if the request fails.
     */
    public function pay($data, $token)
    {
    $requiredParams = ['amount', 'currency', 'clientIp'];
        try {
        $this->validatePayParams($data, $requiredParams);
        return $this->sendRequestPost(MaibSdk::DIRECT_PAY, $data, $token);
        } catch (PaymentException $e) {
        error_log('Invalid request: ' . $e->getMessage());
        throw new PaymentException('Invalid request: ' . $e->getMessage());
        }
    }

    /**
     * Sends a request to the hold endpoint.
     *
     * @param array $data The parameters for the request.
     * @param string $token The authentication token.
     * @throws PaymentException if the request fails.
     */
    public function hold($data, $token)
    {
    $requiredParams = ['amount', 'currency', 'clientIp'];
        try {
        $this->validatePayParams($data, $requiredParams);
        return $this->sendRequestPost(MaibSdk::HOLD, $data, $token);
        } catch (PaymentException $e) {
        error_log('Invalid request: ' . $e->getMessage());
        throw new PaymentException('Invalid request: ' . $e->getMessage());
        }
    }   
 
    /**
     * Sends a request to the complete endpoint.
     *
     * @param array $data The parameters for the request.
     * @param string $token The authentication token.
     * @throws PaymentException if the request fails.
     */ 
    public function complete($data, $token)
    {
    $requiredParams = ['payId'];
        try {
        $this->validatePayParams($data, $requiredParams);
        return $this->sendRequestPost(MaibSdk::COMPLETE, $data, $token);
        } catch (PaymentException $e) {
        error_log('Invalid request: ' . $e->getMessage());
        throw new PaymentException('Invalid request: ' . $e->getMessage());
        }
    }   
 
     /**
     * Sends a request to the refund endpoint.
     *
     * @param array $data The parameters for the request.
     * @param string $token The authentication token.
     * @throws PaymentException if the request fails.
     */ 
    public function refund($data, $token)
    {
    $requiredParams = ['payId'];
        try {
        $this->validatePayParams($data, $requiredParams);
        return $this->sendRequestPost(MaibSdk::REFUND, $data, $token);
        } catch (PaymentException $e) {
        error_log('Invalid request: ' . $e->getMessage());
        throw new PaymentException('Invalid request: ' . $e->getMessage());
        }
    } 
  
    /**
     * Sends a request to the pay-info endpoint.
     *
     * @param string $id The parameters for the request.
     * @param string $token The authentication token.
     * @throws PaymentException if the request fails.
     */
    public function payInfo($id, $token)
    {
        try {
        $this->validateIdParam($id);
        return $this->sendRequestGet(MaibSdk::PAY_INFO, $id, $token);
        } catch (PaymentException $e) {
        error_log('Invalid request: ' . $e->getMessage());
        throw new PaymentException('Invalid request: ' . $e->getMessage());
        }
    }

    /**
     * Sends a request to the delete-card endpoint.
     *
     * @param string $id The parameters for the request.
     * @param string $token The authentication token.
     * @throws PaymentException if the request fails.
     */
    public function deleteCard($id, $token)
    {
        try {
        $this->validateIdParam($id);
        return $this->sendRequestDelete(MaibSdk::DELETE_CARD, $id, $token);
        } catch (PaymentException $e) {
        error_log('Invalid request: ' . $e->getMessage());
        throw new PaymentException('Invalid request: ' . $e->getMessage());
        }
    }
  
    /**
     * Sends a request to the savecard-recurring endpoint.
     *
     * @param array $data The parameters for the request.
     * @param string $token The authentication token.
     * @throws PaymentException if the request fails.
     */
    public function saveRecurring($data, $token)
    {
    $requiredParams = ['billerExpiry', 'currency', 'clientIp'];
        try {
        $this->validatePayParams($data, $requiredParams);
        return $this->sendRequestPost(MaibSdk::SAVE_REC, $data, $token);
        } catch (PaymentException $e) {
        error_log('Invalid request: ' . $e->getMessage());
        throw new PaymentException('Invalid request: ' . $e->getMessage());
        }
    }
  
     /**
     * Sends a request to the execute-recurring endpoint.
     *
     * @param array $data The parameters for the request.
     * @param string $token The authentication token.
     * @throws PaymentException if the request fails.
     */
    public function executeRecurring($data, $token)
    {
    $requiredParams = ['billerId', 'amount', 'currency'];
        try {
        $this->validatePayParams($data, $requiredParams);
        return $this->sendRequestPost(MaibSdk::EXE_REC, $data, $token);
        } catch (PaymentException $e) {
        error_log('Invalid request: ' . $e->getMessage());
        throw new PaymentException('Invalid request: ' . $e->getMessage());
        }
    }
  
     /**
     * Sends a request to the savecard-oneclick endpoint.
     *
     * @param array $data The parameters for the request.
     * @param string $token The authentication token.
     * @throws PaymentException if the request fails.
     */
    public function saveOneclick($data, $token)
    {
    $requiredParams = ['billerExpiry', 'currency', 'clientIp'];
        try {
        $this->validatePayParams($data, $requiredParams);
        return $this->sendRequestPost(MaibSdk::SAVE_ONECLICK, $data, $token);
        } catch (PaymentException $e) {
        error_log('Invalid request: ' . $e->getMessage());
        throw new PaymentException('Invalid request: ' . $e->getMessage());
        }
    }
  
     /**
     * Sends a request to the execute-oneclick endpoint.
     *
     * @param array $data The parameters for the request.
     * @param string $token The authentication token.
     * @throws PaymentException if the request fails.
     */
    public function executeOneclick($data, $token)
    {
    $requiredParams = ['billerId', 'amount', 'currency', 'clientIp'];
        try {
        $this->validatePayParams($data, $requiredParams);
        return $this->sendRequestPost(MaibSdk::EXE_ONECLICK, $data, $token);
        } catch (PaymentException $e) {
        error_log('Invalid request: ' . $e->getMessage());
        throw new PaymentException('Invalid request: ' . $e->getMessage());
        }
    }
  
     /**
     * Sends a request to the specified endpoint.
     *
     * @param string $endpoint The endpoint to send the request to.
     * @param array $data The parameters for the request.
     * @param string $token The authentication token.
     * @throws PaymentException if the request fails.
     */
    private function sendRequestPost($endpoint, $data, $token)
    {
        try {
            $response = $this->httpClient->post($endpoint, $data, $token);
        } catch (HttpException $e) {
            throw new PaymentException("HTTP error while sending POST request to endpoint $endpoint: {$e->getMessage()}");
        }
        return $this->handleResponse($response, $endpoint);
    }

   private function sendRequestGet($endpoint, $id, $token)
    {
        try {
            $response = $this->httpClient->get($endpoint, $id, $token);
        } catch (HttpException $e) {
            throw new PaymentException("HTTP error while sending GET request to endpoint $endpoint: {$e->getMessage()}");
        }
        return $this->handleResponse($response, $endpoint);
    }

   private function sendRequestDelete($endpoint, $id, $token)
    {
        try {
            $response = $this->httpClient->delete($endpoint, $id, $token);
        } catch (HttpException $e) {
            throw new PaymentException("HTTP error while sending DELETE request to endpoint $endpoint: {$e->getMessage()}");
        }
        return $this->handleResponse($response, $endpoint);
    }
  
    private function handleResponse($response, $endpoint)
    {
    if (isset($response->ok) && $response->ok) {
        if (isset($response->result)) {
            return $response->result;
        } else {
            throw new PaymentException("Invalid response received from server for endpoint $endpoint: missing 'result' field");
        }
    } else {
        if (isset($response->errors)) {
            $error = $response->errors[0];
            throw new PaymentException("Error sending request to endpoint $endpoint: {$error->errorMessage} ({$error->errorCode})");
        } else {
            throw new PaymentException("Invalid response received from server for endpoint $endpoint: missing 'ok' and 'errors' fields");
        }
    }
    }
  
  private function validateIdParam($id)
  {
  if (!isset($id)) {
        throw new PaymentException("Missing ID!");
     }
  if (strlen($id) !== 36) {
        throw new PaymentException("Invalid 'ID' parameter. Should be 36 characters.");
    }
             
  }
  
  private function validatePayParams($data, $requiredParams)
  {
    // Check that all required parameters are present
    foreach ($requiredParams as $param) {
        if (!isset($data[$param])) {
            throw new PaymentException("Missing required parameter: '$param'");
        }
    }
    // Check that parameters have the expected types and formats
    if (isset($data['billerId']) && strlen($data['billerId']) !== 36) {
        throw new PaymentException("Invalid 'billerId' parameter. Should be 36 characters.");
    }
    if (isset($data['billerExpiry']) && strlen($data['billerExpiry']) !== 4) {
        throw new PaymentException("Invalid 'billerExpiry' parameter. Should be 4 characters.");
    }
    if (isset($data['payId']) && strlen($data['payId']) > 36) {
        throw new PaymentException("Invalid 'payId' parameter. Should not exceed 36 characters.");
    }
    if (isset($data['confirmAmount']) && (!is_numeric($data['confirmAmount']) || $data['confirmAmount'] < 0)) {
        throw new PaymentException("Invalid 'confirmAmount' parameter. Should be a numeric value > 0.");
    }
    if (isset($data['amount']) && (!is_numeric($data['amount']) || $data['amount'] < 1)) {
        throw new PaymentException("Invalid 'amount' parameter. Should be a numeric value >= 1.");
    }
    if (isset($data['refundAmount']) && (!is_numeric($data['refundAmount']) || $data['refundAmount'] < 0)) {
        throw new PaymentException("Invalid 'refundAmount' parameter. Should be a numeric value > 0.");
    }
    if (isset($data['currency']) && !in_array($data['currency'], ['MDL', 'EUR', 'USD'])) {
        throw new PaymentException("Invalid 'currency' parameter. Currency should be one of 'MDL', 'EUR', or 'USD'.");
    }
    if (isset($data['clientIp']) && !filter_var($data['clientIp'], FILTER_VALIDATE_IP)) {
        throw new PaymentException("Invalid 'clientIp' parameter. Please provide a valid IP address.");
    }
    if (isset($data['language']) && strlen($data['language']) !== 2) {
        throw new PaymentException("Invalid 'language' parameter. Should be 2 characters.");
    }
    if (isset($data['clientName']) && strlen($data['clientName']) > 128) {
        throw new PaymentException("Invalid 'clientName' parameter. Client name should not exceed 128 characters.");
    }
    if (isset($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        throw new PaymentException("Invalid 'email' parameter. Please provide a valid email address.");
    }
    if (isset($data['phone']) && strlen($data['phone']) > 40) {
        throw new PaymentException("Invalid 'phone' parameter. Phone number should not exceed 40 characters.");
    }
    if (isset($data['orderId']) && strlen($data['orderId']) > 36) {
        throw new PaymentException("Invalid 'orderId' parameter. Order ID should not exceed 36 characters.");
    }
    if (isset($data['delivery']) && (!is_numeric($data['delivery']) || $data['delivery'] <= 0)) {
        throw new PaymentException("Invalid 'delivery' parameter. Delivery fee should be a numeric value greater than >= 0.");
    }
    if (isset($data['items']) && (!is_array($data['items']) || empty($data['items']))) {
        throw new PaymentException("Invalid 'items' parameter. Items should be a non-empty array.");
    }
    if (isset($data['items'])) {		
    foreach ($data['items'] as $item) {
        if (isset($item['id']) && strlen($item['id']) > 36) {
            throw new PaymentException("Invalid 'id' parameter in the 'items' array. Item ID should not exceed 36 characters.");
        }
        if (isset($item['name']) && strlen($item['name']) > 128) {
            throw new PaymentException("Invalid 'name' parameter in the 'items' array. Item name should not exceed 128 characters.");
        }
        if ((isset($item['price'])) && (!is_numeric($item['price']) || $item['price'] <= 0)) {
            throw new PaymentException("Invalid 'price' parameter in the 'items' array. Item price should be a numeric value >= 0.");
        }
        if ((isset($item['quantity'])) && (!is_numeric($item['quantity']) || $item['quantity'] <= 0)) {
      throw new PaymentException("Invalid 'quantity' parameter in the 'items' array. Item quantity should be a numeric value >= 0.");
        }
    }
	}
    if (isset($item['callbackUrl']) && !filter_var($data['callbackUrl'], FILTER_VALIDATE_URL)) {
      throw new PaymentException('Invalid callbackUrl parameter');
    }
    if (isset($item['okUrl']) && !filter_var($data['okUrl'], FILTER_VALIDATE_URL)) {
      throw new PaymentException('Invalid okUrl parameter');
    }
    if (isset($item['failUrl']) && !filter_var($data['failUrl'], FILTER_VALIDATE_URL)) {
      throw new PaymentException('Invalid failUrl parameter');
    }

    return true;
    }


}
