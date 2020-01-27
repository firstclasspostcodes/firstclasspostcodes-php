<?php

namespace Firstclasspostcodes;

class Events {
  public $events;

  function __construct() {
    $this->events = [];
  }

  public function on($eventName, $handler) {
    if (!array_key_exists($eventName, $this->events)) {
      $this->events[$eventName] = [];
    }
    return $this->events[$eventName][] = $handler;
  }

  public function emit($eventName, ...$args) {
    if (!array_key_exists($eventName, $this->events)) {
      return;
    }
    foreach ($this->events[$eventName] as $handler) {
      return call_user_func_array($handler, $args);
    }
  }

  public function off($eventName, $handler) {
    if (!array_key_exists($eventName, $this->events)) {
      return;
    }
    foreach (array_keys($this->events[$eventName], $handler) as $key) {
      unset($this->events[$eventName][$key]);
    }
    return True;
  }
}
