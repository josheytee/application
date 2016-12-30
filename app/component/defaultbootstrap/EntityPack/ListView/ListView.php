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
    private $db;
    private $options;
    private $shop;
    private $product;

    public function __construct($options = null) {
        $this->options = $options;
    }

    public function init() {
        parent::init();
        $this->smarty = KernelService::getService('SmartyTemplateManagementService');
        $this->shop = KernelService::getService('ShopManagementService');
        $this->product = KernelService::getService('ProductManagementService');
        $this->name = 'listview';
        $this->pack_name = 'entitypack';
        $this->dir_name = 'defaultbootstrap';
    }

    public function render() {
        $products = $this->product->GETpRODUCTSfROMsHOP();
        $tpl = $this->smarty->createTemplate($this->getTemplatePath('listview.tpl'));
        return $tpl->fetch();
    }

}
