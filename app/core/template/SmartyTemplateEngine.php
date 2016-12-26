<?php

namespace app\core\template;

use app\core\template\TemplateEngineInterface;

/**
 * Description of SmartyTemplateEngine
 *
 * @author Tobi
 */
class SmartyTemplateEngine extends \Smarty implements TemplateEngineInterface {

    public function __construct() {
        parent::__construct();
        $this->initSmarty();
    }

    public function initSmarty() {
        $this->setCompileDir('./app/misc/smarty/compile/');
        $this->setConfigDir(__DIR__ . \DIRECTORY_SEPARATOR . 'config');
        $this->setCacheDir('./app/misc/smarty/cache/');
        $this->setTemplateDir($this->findTemplateDir());
        $this->debugging = TRUE;
    }

    public function findTemplateDir() {
        return "";
    }

}
