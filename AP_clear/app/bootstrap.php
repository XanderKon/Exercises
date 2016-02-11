<?php

require_once 'system/Autoload.php';

// init autoload
spl_autoload_register('autoload\Autoload::load_class');

// init routing
routes\Route::init();

