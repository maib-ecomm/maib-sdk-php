<?php

namespace MaibEcomm\MaibSdk;

use RuntimeException;

class TokenException extends RuntimeException {}

// This is the factory class, responsible for creating new instances of the MaibAuth class.
class MaibAuthRequest
{
    /**
     * Creates an instance of the MaibAuth class.
     *
     * @return MaibAuth The created instance.
     */
    public static function create()
    {
        // The factory creates a new instance of the MaibSdk class, which is passed to the MaibAuth constructor.
        $httpClient = new MaibSdk();
        return new MaibAuth($httpClient);
    }
}

class MaibAuth
{
    private $httpClient;

    public function __construct(MaibSdk $httpClient)
    {
        $this->httpClient = $httpClient;
    }
    
    /**
     * Generates a new access token using the given project ID and secret or refresh token.
     *
     * @param string|null $ProjectIdOrRefresh The project ID or refresh token to use for generating the token.
     * @param string|null $projectSecret The project secret to use for generating the token.
     * @return array The response body as an associative array.
     * @throws RuntimeException If the API returns an error response.
     */
    public function generateToken($ProjectIdOrRefresh = null, $projectSecret = null)
    {
    if ($ProjectIdOrRefresh === null && $projectSecret === null) {
        throw new TokenException("Either Project ID and Project Secret or Refresh Token must be provided!");
    }
    
    $postData = array();
    
    if ($ProjectIdOrRefresh !== null && $projectSecret !== null) {
        if (!is_string($ProjectIdOrRefresh) || !is_string($projectSecret)) {
            throw new TokenException("Project ID and Project Secret must be strings!");
        }
        
        $postData['projectId'] = $ProjectIdOrRefresh;
        $postData['projectSecret'] = $projectSecret;
    } elseif ($ProjectIdOrRefresh !== null && $projectSecret === null) {
        if (!is_string($ProjectIdOrRefresh)) {
            throw new TokenException("Refresh Token must be a string!");
        }
        
        $postData['refreshToken'] = $ProjectIdOrRefresh;
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
