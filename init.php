<?php

function checkExtentions() {
    $extensions = array('curl', 'json');
    foreach ($extensions AS $e) {
        if (!extension_loaded($e)) {
            throw new Exception('Firstclasspostcodes requires the ' . $e . ' extension.');
        }
    }
}

checkExtentions();

// Firstclasspostcodes singleton
require(dirname(__FILE__) . '/lib/firstclasspostcodes.php');
require(dirname(__FILE__) . '/lib/firstclasspostcodes/curl.php');
require(dirname(__FILE__) . '/lib/firstclasspostcodes/events.php');
require(dirname(__FILE__) . '/lib/firstclasspostcodes/errors.php');
require(dirname(__FILE__) . '/lib/firstclasspostcodes/configuration.php');

require(dirname(__FILE__) . '/lib/firstclasspostcodes/operations.php');
require(dirname(__FILE__) . '/lib/firstclasspostcodes/operations/getPostcode.php');
require(dirname(__FILE__) . '/lib/firstclasspostcodes/operations/getLookup.php');

require(dirname(__FILE__) . '/lib/firstclasspostcodes/client.php');

