<?php

namespace app\component\defaultbootstrap\EntityPack\ListView;

use app\core\component\Component;
use app\core\service\KernelService;

/**
 * Description of List
 *
 * @author Tobi
 */
class ListView extends Component {

    public $smarty;

    public function init() {
        parent::init();
        $this->smarty = KernelService::getService('SmartyTemplateManagementService');
        $this->name = 'listview';
        $this->pack_name = 'entitypack';
        $this->dir_name = 'defaultbootstrap';
    }

    public function render() {
        $tpl = $this->smarty->createTemplate($this->getTemplatePath('listview.tpl'));
        return $tpl->fetch();
    }

}
