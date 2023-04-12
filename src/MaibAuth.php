<?php

namespace MaibEcomm\MaibSdk;

use RuntimeException;

class TokenException extends RuntimeException {}

class MaibAuth
{
   // private static $instance;
    private $httpClient;

    private function __construct()
    {
        $this->httpClient = new MaibSdk();
    }
    
    /**
     * Returns a singleton instance of the Auth class.
     *
     * @return Auth An instance of the Auth class.
     */
    public static function getInstance()
    {
        static $instance;
        if (!isset($instance)) {
            $instance = new MaibAuth();
        }
        return $instance;
    }
    
    /**
     * Generates a new access token using the given project ID and secret.
     *
     * @param string|null $projectId The project ID to use for generating the token.
     * @param string|null $projectSecret The project secret to use for generating the token.
     * @param string|null $refreshToken The refresh token to use for generating the token.
     * @return array The response body as an associative array.
     * @throws RuntimeException If the API returns an error response.
     */
    public function generateToken($projectId = null, $projectSecret = null, $refreshToken = null)
    {
        $postData = array();
    
        if ($projectId !== null && $projectSecret !== null) {
            $postData['projectId'] = $projectId;
            $postData['projectSecret'] = $projectSecret;
        } else if ($refreshToken === null) {
            throw new TokenException("Project ID and Project Secret or Refresh Token must be provided!");
        }
    
        if ($refreshToken !== null) {
            $postData['refreshToken'] = $refreshToken;
        }
    
        try {
            $response = $this->httpClient->post(MaibSdk::GET_TOKEN, $postData);
        } catch (HttpException $e) {
            throw new TokenException("HTTP error while sending POST request to endpoint generate-token: {$e->getMessage()}");
        }
    
        if (!$response->ok) {
            $this->handleError($response->errors);
        }
    
        $result = $response->result;
        return $result;
    }
  
    /**
     * Handles errors returned by the API.
     *
     * @param array $errors The error messages returned by the API.
     * @throws RuntimeException If the API returns an error response.
     */
    private function handleError($errors)
    {
        if (!empty($errors)) {
            $error = $errors[0];
            throw new TokenException("Error {$error->errorCode}: {$error->errorMessage}");
        } else {
            throw new TokenException("Unknown error occurred");
        }
    }
}