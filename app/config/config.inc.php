<?php

require_once __DIR__ . '/../data/init.doctrine.php';
require_once 'init.illuminate.php';
define('DS',\DIRECTORY_SEPARATOR);
$root = dirname(__DIR__);
define('_LOCAL_DIR_',dirname(dirname($root)));
define('_SCHEME_','http://localhost/');
define('_DOMAIN_',_SCHEME_ . 'application/');
define('_ABSOLUTE_ROOT_DIR_',$root);
define('_ROOT_DIR_','app/');
define('_MODULES_DIR_',$root . '/modules');
define('_COMPONENT_DIR_',$root . '/components');
define('_ADMIN_DIR_',_ROOT_DIR_ . 'admin' . '/');
define('_THEMES_DIR_',$root . '/themes');
define("_RESOURCE_DIR_",_ROOT_DIR_ . 'resource' . '/');
define("_EXTENSION_DIR_",'extensions/');

define('_RIJNDAEL_KEY_','diTesdwELQKtE1cC5nS1OA3BJjLrfPin');
define('_RIJNDAEL_IV_','J2R3d6TpkRVdaJuvmUmcbw==');
define('_COOKIE_KEY_','DoXPFsnypdFs4nkHiTszWsimX3crnQykuvWkMBJSY6ECCevFGhkT6qxb');
define('_COOKIE_IV_','M78BCdds');
define('_VERSION_','1.0');

require_once 'admin.config.php';
require_once 'front.config.php';
