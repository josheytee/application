<?php

namespace app\component\defaultbootstrap\EntityPack\ListView;

use app\core\component\Component;

/**
 * Description of List
 *
 * @author Tobi
 */
class ListView extends Component {

    public $smarty;
    private $db;
    private $options;
    private $graphql;
    private $product;

    public function __construct($options = null) {
        $this->options = $options;
    }

    public function init() {
        parent::init();
        $this->smarty = $this->get('SmartyTemplateManagementService');
        $this->graphql = $this->get('Graphql');
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
