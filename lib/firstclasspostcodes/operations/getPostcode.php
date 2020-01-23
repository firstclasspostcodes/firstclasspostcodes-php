<?php

namespace Firstclasspostcodes\Operations;

trait getPostcode {
  public function getPostcode() {
    return $this->config->host;
  }
}