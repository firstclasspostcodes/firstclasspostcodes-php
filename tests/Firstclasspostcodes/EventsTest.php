<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class FirstclasspostcodesEventsTest extends TestCase {
  public function testAnEventCanBeAdded(): void {
    $handle = function() {
      return null;
    };
    $events = new \Firstclasspostcodes\Events();
    $events->on('test', $handle);
    $this->assertContains('test', array_keys($events->events));
    $this->assertContains($handle, $events->events['test']);
  }

  public function testASecondEventCanBeAdded(): void {
    $firstHandle = function() {};
    $secondHandle = function() {};
    $events = new \Firstclasspostcodes\Events();
    $events->on('test', $firstHandle);
    $events->on('test', $secondHandle);
    $this->assertContains($firstHandle, $events->events['test']);
    $this->assertContains($secondHandle, $events->events['test']);
  }

  public function testAnEventCanBeRemoved(): void {
    $handle = function() {
      return null;
    };
    $events = new \Firstclasspostcodes\Events();
    $events->on('test', $handle);
    $this->assertContains($handle, $events->events['test']);
    $events->off('test', $handle);
    $this->assertNotContains($handle, $events->events['test']);
  }

  public function testAnEventIsCalled(): void {
    $num = 0;
    $handle = function($n) use (&$num) {
      return $num = $n;
    };
    $events = new \Firstclasspostcodes\Events();
    $events->on('test', $handle);
    $events->emit('test', 50);
    $this->assertEquals($num, 50);
  }
}