<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class FirstclasspostcodesErrorsTest extends TestCase {
  public function testApiErrorInstantiation(): void {
    $response = array('docUrl' => 'example.com', 'type' => 'some-type', 'message' => 'message');
    $error = new \Firstclasspostcodes\ResponseError($response);
    $this->assertEquals($error->getMessage(), 'message');
    $this->assertEquals($error->type, 'some-type');
    $this->assertEquals($error->docUrl, 'example.com'); 
  }

  public function testClientErrorInstantiation(): void {
    $error = new \Firstclasspostcodes\ResponseError('message', 'client-error');
    $this->assertEquals($error->getMessage(), 'message');
    $this->assertEquals($error->type, 'client-error');
    $this->assertNotEquals($error->docUrl, null); 
  }
}