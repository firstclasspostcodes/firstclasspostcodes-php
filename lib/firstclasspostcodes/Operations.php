<?php

namespace Firstclasspostcodes;

interface Operations {
  public function getPostcode($postcode);
  
  public function getlookup($latitude, $longitude, $radius);
}