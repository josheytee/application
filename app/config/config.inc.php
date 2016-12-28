<?php

$root = dirname(__DIR__);
define('_ROOT_DIR_', 'app/');
define('_COMPONENT_DIR_', _ROOT_DIR_ . 'component' . '/');
define('_PAGE_DIR_', _ROOT_DIR_ . 'page' . '/');
define('_THEME_DIR_', _ROOT_DIR_ . 'theme' . '/');
define("_RESOURCE_DIR_", _ROOT_DIR_ . 'resource' . '/');
//var_dump(_RESOURCE_DIR_);
require_once 'admin.config.php';
require_once 'front.config.php';
