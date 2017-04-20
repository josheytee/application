<?php

namespace app\admin\component\defaultbootstrap\Register;

use app\core\component\Component;
use app\core\service\KernelService;

/**
 * Description of Register
 *
 * @author Tobi
 */
class Register extends Component {

    protected $smarty;

    public function __construct() {
        parent::__construct();
        $this->initSmarty();
    }

    public function init() {
        parent::init();
        $this->name = 'register';
        $this->dir_name = 'defaultbootstrap';
    }

    public function initSmarty() {
        $this->smarty = KernelService::getService("SmartyTemplateManagementService");
    }

    public function render() {
        $tpl = $this->smarty->createTemplate($this->getTemplatePath('register.tpl'));
        return $tpl->fetch();
    }

}
