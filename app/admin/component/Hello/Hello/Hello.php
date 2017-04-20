<?php

namespace app\admin\component\Hello\Hello;

use app\core\component\Component;
use app\core\service\KernelService;

/**
 * Description of Hello
 *
 * @author Tobi
 */
class Hello extends Component {

    private $smarty;

    public function __construct() {
        parent::__construct();
        $this->initSmarty();
    }

    public function init() {
        parent::init();
        $this->name = 'Hello';
        $this->dir_name = 'Hello';
    }

    public function initSmarty() {
        $this->smarty = KernelService::getService("SmartyCustom");
    }

    public function render() {
        return $this->smarty->fetch($this->getTemplatePath('hello.tpl'));
    }

}
