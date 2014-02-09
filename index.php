<?php

// Phase: Bootstrap

define('RAND_INSTALL_PATH', dirname(__FILE__));
define('RAND_SITE_PATH', RAND_INSTALL_PATH . '/site' );

require(RAND_INSTALL_PATH . '/src/CRand/bootstrap.php');

$rd = CRand::Instance();

// Phase: Front Controller

$rd->FrontControllerRoute();

// Phase: Theme engine renderer

$rd->ThemeEngineRender();