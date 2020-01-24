<?php

namespace Firstclasspostcodes;

class Configuration {
  public $apiKey;

  public $host = "api.firstclasspostcodes.com";

  public $content = "json";

  public $protocol = "https";

  public $basePath = "/data";

  public $sslVerify = true;

  public $timeout = 30;

  public $logger;

  function __construct($parameters = array()) {
    foreach($parameters as $key => $value) {
      $this->$key = $value;
    }
  }

  function getBaseUrl() {
    $stripTrailingSlash = function (&$component) {
      $component = trim($component, '/');
    };
    $domain = sprintf('%s://%s', $this->protocol, $this->host);
    $parts = array($domain, $this->basePath);
    array_walk_recursive($parts, $stripTrailingSlash); 
    return implode('/', array_filter($parts));
  }

  function getRequestParams() {
    return [
      CURLOPT_TIMEOUT => $this->timeout,
      CURLOPT_SSL_VERIFYPEER => $this->sslVerify,
      CURLOPT_HTTPHEADER => [
        sprintf('Accept: application/%s', $this->content),
        sprintf('X-Api-Key: %s', $this->apiKey),
      ],
    ];
  }
}