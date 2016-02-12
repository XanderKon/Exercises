<?php

error_reporting (E_ALL);

// Define stuff constants
define ('APPPATH', __DIR__ . '/app/');
define ('SYSTEMPATH', __DIR__ . '/app/system/');
define ('CONTROLLERSPATH', APPPATH . 'controllers/');
define ('MODELSPATH', APPPATH . 'models/');
define ('VIEWSPATH', APPPATH . 'views/');
define ('LAYOUTSPATH', APPPATH . 'layouts/');

// add all stuff PATHs to default include path
set_include_path(get_include_path() . PATH_SEPARATOR . CONTROLLERSPATH . PATH_SEPARATOR . SYSTEMPATH . PATH_SEPARATOR . MODELSPATH);

require_once APPPATH . 'bootstrap.php';
