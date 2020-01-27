<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class FirstclasspostcodesConfigurationTest extends TestCase {
  public function testBaseUrlWorksCorrectly(): void {
    $config = new \Firstclasspostcodes\Configuration([
      'protocol' => 'http',
      'host' => 'example.com',
      'basePath' => '/test'
    ]);
    $this->assertEquals($config->getBaseUrl(), 'http://example.com/test');
  }

  public function testRequestParamsWorksCorrectly(): void {
    $config = new \Firstclasspostcodes\Configuration([
      'apiKey' => 'some-key',
      'timeout' => 180,
      'sslVerify' => false,
      'content' => 'geo+json',
    ]);
    $params = $config->getRequestParams();
    $this->assertEquals($params[CURLOPT_TIMEOUT], 180);
    $this->assertEquals($params[CURLOPT_SSL_VERIFYPEER], false);
    $this->assertContains('Accept: application/geo+json', $params[CURLOPT_HTTPHEADER]);
    $this->assertContains('X-Api-Key: some-key', $params[CURLOPT_HTTPHEADER]);
  }

  public function testItSetsKeysCorrectly(): void {
    $config = new \Firstclasspostcodes\Configuration([
      'apiKey' => 'some-api-key',
    ]);
    $this->assertEquals($config->apiKey, 'some-api-key');
  }

  public function testItSetsHostCorrectly(): void {
    $config = new \Firstclasspostcodes\Configuration();
    $this->assertNotNull($config->host);
  }

  public function testItSetsContentCorrectly(): void {
    $config = new \Firstclasspostcodes\Configuration();
    $this->assertNotNull($config->content);
  }

  public function testItSetsProtocolCorrectly(): void {
    $config = new \Firstclasspostcodes\Configuration();
    $this->assertNotNull($config->protocol);
  }

  public function testItSetsBasePathCorrectly(): void {
    $config = new \Firstclasspostcodes\Configuration();
    $this->assertNotNull($config->basePath);
  }
}