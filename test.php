<?php

require_once('vendor/autoload.php');

$config = [
  'host'=>'localhost:3000', 
  'protocol'=>'http', 
  'apiKey'=>'111111111111', 
  'basePath'=>'/',
];

$client = new \Firstclasspostcodes\Client($config);

echo json_encode($client->getPostcode('ab301fr'), JSON_PRETTY_PRINT);