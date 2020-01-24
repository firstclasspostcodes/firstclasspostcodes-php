<?php

namespace Firstclasspostcodes;

class ResponseError extends \Exception {
  const DOC_URL = "https://docs.firstclasspostcodes.com/php/errors";

  public $docUrl;

  public $type;

  public function __construct($error, $type = '', $docUrl = '') {
    if (is_array($error)) {
      parent::__construct($error['message']);
      $this->docUrl = $error['docUrl'];
      $this->type = $error['type'];
      return;
    }
    parent::__construct($error);
    $this->docUrl = sprintf('%s/%s', self::DOC_URL, $type);
    $this->type = $type;
  }

  public function __toString() {
    return sprintf('%s: [%s] %s (%s)', __CLASS__, $this->type, $this->message, $this->docUrl);
  }
}

class ParameterValidationError extends ResponseError {};