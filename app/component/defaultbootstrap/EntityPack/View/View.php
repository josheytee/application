<?php

namespace app\component\defaultbootstrap\EntityPack\View;

use app\core\component\Component;
use app\core\service\KernelService;

/**
 * Description of View
 *
 * @author Tobi
 */
class View extends Component {

    public $smarty;

    public function init() {
        parent::init();
        $this->smarty = KernelService::getService('SmartyCustom');
        $this->name = 'view';
        $this->pack_name = 'entitypack';
        $this->dir_name = 'defaultbootstrap';
    }

    public function render() {
        $tpl = $this->smarty->createTemplate($this->getTemplatePath('view.tpl'));
        return $tpl->fetch();
    }

}
