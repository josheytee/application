<?php

namespace app\component\Hello;

use app\core\component\Component;
use app\core\service\KernelService;

/**
 * Description of Hello
 *
 * @author Tobi
 */
class Hello extends Component {

    private $database;
    private $smarty;
    private $sms;

    public function __construct(\app\core\event\EventDispatcherInterface $dispatcher) {
        parent::__construct($dispatcher);
//        $this->database = \app\core\service\DatabaseManagementService::subscribe($this);
//        var_dump($this->database);
        $this->database = KernelService::getService("DatabaseManagementService");
        $this->sms = KernelService::getService("ShopManagementService");
        var_dump($this->database);
        $this->initSmarty();
    }

    public function initSmarty() {
        $this->smarty = KernelService::getService("TemplateManagementService");
        $this->smarty->setCompileDir('./app/misc/smarty/compile/');
        $this->smarty->setConfigDir(__DIR__ . \DIRECTORY_SEPARATOR . 'config');
        $this->smarty->setCacheDir('./app/misc/smarty/cache/');
        $this->smarty->setTemplateDir(__DIR__);
    }

    public function render() {
        $this->smarty->display('hello.tpl');
    }

}
