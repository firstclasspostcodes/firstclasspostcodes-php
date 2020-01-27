<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class FirstclasspostcodesClientTest extends TestCase {
  public function testUserAgentIsCorrect(): void {
    $client = new \Firstclasspostcodes\Client();
    $version = sprintf('Firstclasspostcodes/php@%s', \Firstclasspostcodes\Firstclasspostcodes::VERSION);
    $this->assertEquals($client->userAgent, $version);
  }

  public function testConfigurationOverridesAreSetCorrectly(): void {
    $client = new \Firstclasspostcodes\Client(['apiKey' => 'some-api-key']);
    $this->assertThat($client->config, $this->isInstanceOf('Firstclasspostcodes\Configuration'));
    $this->assertEquals($client->config->apiKey, 'some-api-key');
  }

  public function testBuildRequestUrlReturnsCorrectly(): void {
    $config = ['protocol' => 'https', 'host' => 'example.com', 'basePath' => '/test'];
    $client = new \Firstclasspostcodes\Client($config);
    $this->assertEquals($client->getRequestUrl('/lookup'), 'https://example.com/test/lookup');
  }
}