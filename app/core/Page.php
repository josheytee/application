<?php

namespace app\core;

use app\core\Component;
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

    public function display() {
        $this->init();
        var_dump($this->components);
        foreach ($this->components as $component) {
            echo $component->render();
        }
    }

}
