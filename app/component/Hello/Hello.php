<?php

namespace app\component\Hello;

use app\core\component\Component;

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
        $this->database = \app\core\service\DatabaseManagementService::subscribe($this);
        $this->sms = \app\core\service\ShopManagementService::subscribe($this);
//        $shop = $this->subscribe(new \app\core\service\ShopManagementService());
        $this->initSmarty();
    }

    public function initSmarty() {
        $this->smarty = \app\core\service\TemplateManagementService::subsribe($this);
        $this->smarty->setCompileDir('./app/misc/smarty/compile/');
        $this->smarty->setConfigDir(__DIR__ . \DIRECTORY_SEPARATOR . 'config');
        $this->smarty->setCacheDir('./app/misc/smarty/cache/');
        $this->smarty->setTemplateDir(__DIR__);
//        var_dump($this->smarty);
    }

    public function render() {
//        $this->smarty->assign('name', 'Ned');
//** un-comment the following line to show the debug console
//        $this->smarty->debugging = true;
        $this->smarty->display('hello.tpl');
    }

}
