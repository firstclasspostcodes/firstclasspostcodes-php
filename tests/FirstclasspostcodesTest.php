<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class FirstclasspostcodesTest extends TestCase {
  public function testVersionIsCorrect(): void {
    $match = preg_match('/^[0-9]+.[0-9]+.[0-9]+$/', \Firstclasspostcodes\Firstclasspostcodes::VERSION);
    $this->assertEquals($match, true);
  }
}