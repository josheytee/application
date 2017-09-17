<?php

namespace app\core\service;

/**
 * Description of SmartyTemplateManagementService
 *
 * @author Tobi
 */
class SmartyCustom extends \Smarty implements KernelServiceInterface {

    public function __construct() {
        parent::__construct();
        $this->initSmarty();
    }

    public function initSmarty() {
        $this->setCompileDir('./app/cache/smarty/compile/');
        $this->setConfigDir(__DIR__ . \DIRECTORY_SEPARATOR . 'config');
        $this->setCacheDir('./app/cache/smarty/cache/');
//        $this->setTemplateDir($this->findTemplateDir());
        $this->debugging = TRUE;
    }

    public function stop() {

    }

    public static function start() {

    }

}
