<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class FirstclasspostcodesClientIntegrationTest extends TestCase {
  public function setUp(): void {
    $this->client = new \Firstclasspostcodes\Client([
      'apiKey' => getenv('API_KEY'),
      'protocol' => 'http',
      'host' => getenv('API_HOST'),
      'basePath' => '/',
    ]);
    $this->fixtures = $this->client->request('get', '/data/.postcodes');
  }

  public function testGetPostcodeWorksCorrectly(): void {
    $fixture = $this->fixtures[array_rand($this->fixtures)];
    $response = $this->client->getPostcode($fixture['postcode']);
    $this->assertEquals($response['postcode'], $fixture['postcode']);
  }

  public function testGetLookupWorksCorrectly(): void {
    $fixture = $this->fixtures[array_rand($this->fixtures)];
    $response = $this->client->getLookup($fixture['latitude'], $fixture['longitude']);
    $this->assertNotEmpty($response);
    $this->assertEquals($response[0]['postcode'], $fixture['postcode']);
  }
}