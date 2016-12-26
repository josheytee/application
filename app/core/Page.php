<?php

namespace app\core;

use app\core\component\Component;
use app\core\theme\Theme;
use app\core\service\KernelService;

/**
 * Page is a container of components related to perform a particular task
 * it needs the @uses \app\core\theme\Theme  for layouts and positioning of the components\
 * @see Theme;
 * @author Tobi
 */
class Page {

    protected $title;
    protected $meta = [];
    protected $javasripts = [];
    protected $css = [];
    protected $name;
    protected $components;
    protected $theme;
    protected $url;
    public $smarty;

    public function __construct($name = '', $title = '') {
        $this->name = $name;
        $this->title = $title;
    }

    public function registerComponent(Component $component, $position = null) {
        if (isset($position)) {
            $this->components[$position] = $component;
        }
        $this->components[] = $component;
    }

    public function initPage() {
        $this->smarty = KernelService::getService("SmartyTemplateManagementService");
    }

    public function setTheme(Theme $theme) {
        $this->theme = $theme;
    }

    public function create() {
        $this->initPage();
        $this->theme->addComponents($this->components);
        $this->theme->publish();
    }

}
