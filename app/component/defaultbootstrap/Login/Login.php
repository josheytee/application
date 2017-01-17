<?php

namespace app\component\defaultbootstrap\Login;

use app\core\component\Component;
use app\core\service\KernelService;

/**
 * Description of Login
 *
 * @author Tobi
 */
class Login extends Component {

    private $smarty;

    public function __construct() {
        parent::__construct();
        $this->initSmarty();
    }

    public function init() {
        parent::init();
        $this->name = 'Login';
        $this->dir_name = 'defaultbootstrap';
    }

    public function initSmarty() {
        $this->smarty = KernelService::getService("SmartyTemplateManagementService");
    }

    public function procesLogin() {

    }

    public function postProcess() {
        parent::postProcess();
    }

    public function render() {
        return $this->smarty->fetch($this->getTemplatePath('login.tpl'));
    }

}
