<?php

namespace Firstclasspostcodes;

class Client extends Events implements Operations
{
  use cURL;

  use Operations\getPostcode;
  use Operations\getLookup;

  public $config;

  public $userAgent;

  function __construct($configOverrides = array()) {
    parent::__construct();
    $this->userAgent = sprintf('Firstclasspostcodes/php@%s', Firstclasspostcodes::VERSION);
    $config = $this->config = new Configuration($configOverrides);
    $log = function($data) use (&$config) {
      if ($config->logger) $config->logger->debug('Received: %o', $data);
    };
    $this->on('request', $log);
    $this->on('response', $log);
  }

  public function request($method, $path, $queryParams = []) {
    return $this->callRequest($method, $this->getRequestUrl($path), $queryParams);
  }
  
  private function callRequest($method, $url, $queryParams) {
    $requestParams = $this->config->getRequestParams();
    $response = $this->cURL($method, $url, $queryParams, $requestParams);
    if ($response['status'] >= 200 && $response['status'] <= 299) {
      return json_decode($response['body'], true);
    }
    try {
      throw new ResponseError(json_decode($response['body'], true));
    } catch (\Exception $e) {
      throw new ResponseError($response['body'], 'network-error');
    }
  }

  public function getRequestUrl($path) {
    return sprintf('%s/%s', $this->config->getBaseUrl(), ltrim($path, '/'));
  }
}