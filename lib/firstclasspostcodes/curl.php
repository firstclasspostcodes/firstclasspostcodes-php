<?php

namespace Firstclasspostcodes;

trait cURL {
  private function cURL($method, $url, $params, $opts=array()) {
    $curl = curl_init();
    $opts[CURLOPT_RETURNTRANSFER] = true;
    $opts[CURLOPT_FAILONERROR] = true;

    if ($method == 'get') {
      $opts[CURLOPT_HTTPGET] = 1;
      if (count($params) > 0) {
        $encoded = http_build_query($params, null, '&');
        $url = "$url?$encoded";
      }
    } else {
      throw new \Exception(sprintf('Invalid http method: %s', $meth));
    }
    
    $opts[CURLOPT_URL] = utf8_encode($url);

    curl_setopt_array($curl, $opts);

    $response = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if (curl_errno($curl)) {
      $response = curl_error($curl);
    }
    
    curl_close($curl);

    return array('body' => $response, 'status' => $status);
  }
}