<?php

namespace app\component\defaultbootstrap\EntityPack;

use app\core\component\ComponentPack;
use app\core\component\Component;
use app\core\service\KernelService;

/**
 * Description of newPHPClass
 *
 * @author Tobi
 */
class EntityPack extends ComponentPack {

    public $smarty;

    public function __construct($schema = null, $data = null, $options = null) {
        parent::__construct($schema, $data, $options);
    }

    public function init() {
        parent::init();
        $this->name = 'entitypack';
        $this->dir_name = 'defaultbootstrap';
        $this->default_component = 'listView';
        $this->addComponent(new ListView\ListView($this->schema, $this->data, $this->options), 'list');
        $this->addComponent(new Form\Form($this->schema, $this->data, $this->options), 'form');
        $this->addComponent(new View\View($this->schema, $this->data, $this->options), 'view');
        $this->smarty = $this->get("SmartyCustom");
    }

    public function render() {
        $components = '';
        if (isset($_GET['add'])) {
            $components = $this->renderComponent('form');
        } elseif (isset($_GET['update']) && isset($_GET['id'])) {
            $components = $this->renderComponent('form');
        } elseif (isset($_GET['view']) && isset($_GET['id'])) {
            $components = $this->renderComponent('view');
        } else {
            $components = $this->renderComponent('list');
        }
        if ($this->components != null) {
            $tpl = $this->smarty->createTemplate($this->getTemplatePath('entitypack.tpl'));
        } else {
            $tpl = $this->smarty->createTemplate($this->getTemplatePath('error.tpl'));
        }
        $tpl->assign('component', $components);
        return $tpl->fetch();
    }

}
