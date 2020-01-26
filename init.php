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
require(dirname(__FILE__) . '/lib/Firstclasspostcodes.php');
require(dirname(__FILE__) . '/lib/firstclasspostcodes/Curl.php');
require(dirname(__FILE__) . '/lib/firstclasspostcodes/Events.php');
require(dirname(__FILE__) . '/lib/firstclasspostcodes/Errors.php');
require(dirname(__FILE__) . '/lib/firstclasspostcodes/Configuration.php');
require(dirname(__FILE__) . '/lib/firstclasspostcodes/Operations.php');

require(dirname(__FILE__) . '/lib/firstclasspostcodes/operations/GetPostcode.php');
require(dirname(__FILE__) . '/lib/firstclasspostcodes/operations/GetLookup.php');

require(dirname(__FILE__) . '/lib/firstclasspostcodes/Client.php');

