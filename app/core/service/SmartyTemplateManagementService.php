<?php

namespace app\core\service;

use app\core\service\KernelServiceInterface;

/**
 * Description of SmartyTemplateManagementService
 *
 * @author Tobi
 */
class SmartyTemplateManagementService extends \Smarty implements KernelServiceInterface {

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

    public function unsubscribe() {

    }

    public static function start() {

    }

    public static function subscribe() {

    }

}