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

define('_RIJNDAEL_KEY_', 'diTesdwELQKtE1cC5nS1OA3BJjLrfPin');
define('_RIJNDAEL_IV_', 'J2R3d6TpkRVdaJuvmUmcbw==');
define('_COOKIE_KEY_', 'DoXPFsnypdFs4nkHiTszWsimX3crnQykuvWkMBJSY6ECCevFGhkT6qxb');
define('_COOKIE_IV_', 'M78BCdds');
define('_VERSION_', '1.0');

require_once 'admin.config.php';
require_once 'front.config.php';
