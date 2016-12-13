<?php

namespace app\core;

use app\core\component\Component;
use app\core\template\Template;

/**
 * Description of Page
 *
 * @author Tobi
 */
class Page {

    protected $title;
    protected $meta = [];
    protected $javasripts = [];
    protected $css = [];
    protected $name;
    protected $components;
    protected $template;

    public function __construct($name) {

    }

    public function registerComponent(Component $component, $position = null) {
        $this->components[$position] = $component;
    }

    public function init() {

    }

    public function setTemplate(Template $template) {
        $this->template[] = $template;
    }

    public function create() {
        $this->init();
        foreach ($this->components as $component) {
            echo $component->render();
        }
    }

}
