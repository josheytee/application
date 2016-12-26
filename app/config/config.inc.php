<?php

$root = dirname(__DIR__);
define('_ROOT_DIR_', $root . DIRECTORY_SEPARATOR);
define('_COMPONENT_DIR_', _ROOT_DIR_ . 'component' . DIRECTORY_SEPARATOR);
define('_PAGE_DIR_', _ROOT_DIR_ . 'page' . DIRECTORY_SEPARATOR);
define('_PAGE_ADMIN_DIR_', _PAGE_DIR_ . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR);
define('_PAGE_FRONT_DIR_', _PAGE_DIR_ . 'front' . DIRECTORY_SEPARATOR);
define('_THEME_DIR_', _ROOT_DIR_ . 'theme' . DIRECTORY_SEPARATOR);
define('_THEME_ADMIN_DIR_', _THEME_DIR_ . 'admin' . DIRECTORY_SEPARATOR);
define('_THEME_FRONT_DIR_', _THEME_DIR_ . 'front' . DIRECTORY_SEPARATOR);
//var_dump(_THEME_FRONT_DIR_);
//if (!defined('_PS_ROOT_DIR_')) {
//    define('_PS_ROOT_DIR_', realpath($currentDir . '/..'));
//}
