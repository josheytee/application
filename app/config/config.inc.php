<?php

require_once 'init.illuminate.php';
$root = dirname(__DIR__);
define('SCHEME', 'http://localhost/');
define('DOMAIN', SCHEME . 'application/');
define('_ROOT_DIR_', 'app/');
define('_COMPONENT_DIR_', _ROOT_DIR_ . 'component' . '/');
define('_PAGE_DIR_', _ROOT_DIR_ . 'page' . '/');
define('_THEME_DIR_', _ROOT_DIR_ . 'theme' . '/');
define("_RESOURCE_DIR_", _ROOT_DIR_ . 'resource' . '/');
require_once 'admin.config.php';
require_once 'front.config.php';
