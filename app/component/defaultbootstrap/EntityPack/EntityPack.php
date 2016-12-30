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

    public function __construct() {
        parent::__construct();
    }

    public function init() {
        parent::init();
        $this->name = 'entitypack';
        $this->dir_name = 'defaultbootstrap';
        $this->default_component = 'listView';
        $options = [
            'fields' => [
                'id_product' => [
                    'titile' => 'ID',
                    'class' => 'xs',
                    'type' => 'int'
                ]
            ], 'shop_url' => 'default',
            'entity' => 'product',
            'user_token' => "mk"
        ];
        $this->addComponent(new ListView\ListView($options));
        $this->addComponent(new View\View());
        $this->smarty = KernelService::getService("SmartyTemplateManagementService");
    }

    public function render() {
        $tpl = $this->smarty->createTemplate($this->getTemplatePath('entitypack.tpl'));
        $components = '';
        foreach ($this->components as $component) {
            $components .= $component->renderComponent();
        }
        $tpl->assign('component', $components);
        return $tpl->fetch();
    }

}
