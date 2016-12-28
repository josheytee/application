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

    private $database;
    private $smarty;
    private $sms;

    public function __construct() {
        parent::__construct();
        $this->database = KernelService::getService("DatabaseManagementService");
        $this->sms = KernelService::getService("ShopManagementService");
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

    public function render() {
        return $this->smarty->fetch($this->getTemplatePath('login.tpl'));
    }

}
