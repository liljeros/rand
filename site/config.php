<?php

error_reporting(-1);
ini_set('display_errors', 1);
//opcache_reset();



/**
* What type of urls should be used?
* 
* default      = 0      => index.php/controller/method/arg1/arg2/arg3
* clean        = 1      => controller/method/arg1/arg2/arg3
* querystring  = 2      => index.php?q=controller/method/arg1/arg2/arg3
*/

$rd->config['url_type'] = 1;


//Define session name
$rd->config['session_name'] = preg_replace('/[:\.\/-_]/', '', $_SERVER["SERVER_NAME"]);

// Define server timezone
$rd->config['timezone'] = 'Europe/Stockholm';

// Define internar character encoding 
$rd->config['char_code'] = 'UTF-8';

// Define language

$rd->config['language'] = 'en';


/**
* Define the controllers, their classname and enable/disable them.
*/
$rd->config['controllers'] = array(
  'index' => array('enabled' => true,'class' => 'CCIndex'),
  'developer' => array('enabled' => true,'class' => 'CCDeveloper'),
);


/**
* Settings for the theme.
*/
$rd->config['theme'] = array(
  // The name of the theme in the theme directory
  'name'    => 'core', 
);

// Set base url to use another than default

$rd->config['base_url'] = null;





