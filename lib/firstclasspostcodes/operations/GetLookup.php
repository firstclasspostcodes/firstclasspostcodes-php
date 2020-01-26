<?php

namespace Firstclasspostcodes\Operations;

trait getLookup {
  public function getLookup($latitude, $longitude, $radius = 0.1) {
    $latitude = $this->getLookupParseFloat($latitude);
    $longitude = $this->getLookupParseFloat($longitude);
    $radius = $this->getLookupParseFloat($radius);

    $queryParams = [
      'latitude' => $latitude,
      'longitude' => $longitude,
      'radius' => $radius,
    ];

    $isValidCoordinate = $this->getLookupWithinBounds($latitude, $longitude);

    if (!$latitude || !$longitude || !$isValidCoordinate) {
      $errorObject = [
        'message' => sprintf('Parameter is invalid: %s', json_encode(query_params, JSON_PRETTY_PRINT)),
        'docUrl' => 'https://docs.firstclasspostcodes.com/operation/getLookup'
      ];
    }

    $method = 'get';
    $path = '/lookup';

    $requestParams = [
      'method' => $method,
      'path' => $path,
      'queryParams' => $queryParams,
    ];

    if ($this->config->logger) {
      $json = json_encode($requestParams, JSON_PRETTY_PRINT);
      $message = sprintf('Executing operation getLookup: %s', $json);
      $this->config->logger->debug($message);
    }

    $this->emit('operation:getLookup', $requestParams);

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

  private function getLookupParseFloat($val) {
    if (!is_numeric($val)) {
      return false;
    }
    return floatval($val);
  }

  private function getLookupWithinBounds($latitude, $longitude) {
    return (-90 <= $latitude && $latitude <= 90) && (-180 <= $longitude && $longitude <= 180);
  }
}