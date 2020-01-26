<?php

namespace Firstclasspostcodes\Operations;

trait getPostcode {
  public function getPostcode($postcode) {
    if (gettype($postcode) != 'string' || strlen($postcode) == 0) {
      $errorObject = [
        'message' => sprintf('Unexpected postcode parameter: %s', $postcode),
        'docUrl' => 'https://docs.firstclasspostcodes.com/operation/getPostcode',
      ];
    }

    $method = 'get';
    $path = '/postcode';
    $queryParams = ['search' => $postcode];

    $requestParams = [
      'method' => $method,
      'path' => $path,
      'queryParams' => $queryParams,
    ];

    if ($this->config->logger) {
      $json = json_encode($requestParams, JSON_PRETTY_PRINT);
      $message = sprintf('Executing operation getPostcode: %s', $json);
      $this->config->logger->debug($message);
    }

    $this->emit('operation:getPostcode', $requestParams);

    if (isset($errorObject)) {
      $error = new \Firstclasspostcodes\ParameterValidationError($errorObject);
      if ($this->config->logger) {
        $this->config->logger->error($error);
      }
      $this->emit('error', $error);
      throw $error;
    }

    return $this->request($method, $path, $queryParams);
  }
}