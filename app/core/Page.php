<?php

namespace app\core;

use app\core\component\Component;
use app\core\template\Template;
use app\core\service\KernelService;

/**
 * Description of Page
 *
 * @author Tobi
 */
class Page {

    const POSITION_HEADER = '';
    const POSITION_CONTENT = '';
    const POSITION_FOOTER = '';
    const LAYOUT_LEFT = 'left';

    protected $title;
    protected $meta = [];
    protected $javasripts = [];
    protected $css = [];
    protected $name;
    protected $components;
    protected $template;
    protected $url;
    public $smarty;

    public function __construct($name = '', $title = '') {
        $this->name = $name;
        $this->title = $title;
    }

    public function registerComponent(Component $component, $position = null) {
        $this->components[$position] = $component;
    }

    public function init() {
        $this->smarty = KernelService::getService("TemplateManagementService");
//        $smarty
    }

    public function setTemplate(Template $template) {
        $this->template[] = $template;
    }

    public function create() {
        $this->init();
//        var_dump($this->components);
        foreach ($this->components as $component) {
            $component->renderComponent();
//            var_dump($this->smarty);
//            $tpl = $this->smarty->createTemplate($component->renderComponent());
//            $tpl->display();
        }
    }

}
