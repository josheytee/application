<?php

namespace app\component\defaultbootstrap\Register;

use app\core\component\Component;
use app\core\service\KernelService;

/**
 * Description of Register
 *
 * @author Tobi
 */
class Register extends Component {

    protected $smarty;

    public function __construct(\app\core\event\EventDispatcherInterface $dispatcher) {
        parent::__construct($dispatcher);
        $this->initSmarty();
    }

    public function init() {
        parent::init();
        $this->name = 'register';
        $this->dir_name = 'defaultbootstrap';
    }

    public function initSmarty() {
        $this->smarty = KernelService::getService("SmartyTemplateManagementService");
//        $this->smarty->setCompileDir('./app/misc/smarty/compile/');
//        $this->smarty->setConfigDir(__DIR__ . \DIRECTORY_SEPARATOR . 'config');
//        $this->smarty->setCacheDir('./app/misc/smarty/cache/');
//        $this->smarty->setTemplateDir(__DIR__);
    }

    public function render() {
        $tpl = $this->smarty->createTemplate($this->getTemplatePath('register.tpl'));
        return $tpl->fetch();
    }

}
