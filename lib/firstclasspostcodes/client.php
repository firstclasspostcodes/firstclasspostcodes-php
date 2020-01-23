<?php

namespace Firstclasspostcodes;

class Client implements Operations
{
  use cURL;

  use Operations\getPostcode;

  public $config;

  public $userAgent;

  public $events;

  function __construct($configOverrides = array()) {
    $this->userAgent = sprintf('Firstclasspostcodes/php@%s', Firstclasspostcodes::VERSION);
    $config = $this->config = new Configuration($configOverrides);
    $log = function($data) use (&$config) {
      if ($config->logger) $config->logger->debug('Received: %o', $data);
    };
    $this->events = new Events;
    $this->events->on('request', $log);
    $this->events->on('response', $log);
  }

  public function request($method, $path, $queryParams) {
    $url = $this->getRequestUrl($path);
    return $this->callRequest($method, $url, $queryParams);
  }
  
  private function callRequest($method, $url, $queryParams) {
    $requestParams = $this->config->getRequestParams();
    $response = $this->cURL($method, $url, $queryParams, $requestParams);
    if ($response['status'] >= 200 && $response['status'] <= 299) {
      return json_decode($response['body'], true);
    }
    try {
      throw new ResponseError(json_decode($response['body'], true));
    } catch (Exception $e) {
      throw new ResponseError($response['body'], 'network-error');
    }
  }

  public function getRequestUrl($path) {
    return sprintf('%s/%s', $this->config->getBaseUrl(), ltrim($path, '/'));
  }
}